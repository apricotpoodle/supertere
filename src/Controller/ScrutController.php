<?php
/**
 * Scrutin Controller
 *
 * Php version 7.2.10
 *
 * @category PleasingToDocBlock
 * @property ScrutinTable $Scrutin
 *
 * @method  Scrutin[]|ResultSetInterface
 * @method  paginate($object = null, array $settings = [])
 * @package PSR\Documentation\API
 * @author  Fabrice Bouillerot @ <bouillerot@lemonde.fr>
 * @license <license@lemonde.fr> MIT
 * @link    -
 */

 namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\AppTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\I18n\Time;
use Cake\Log\Log;
use Cake\Utility\Inflector;
use Exception;
use Psr\Log\LogLevel;
use function dd;
use App\FabriceTools;

/**
 * Scrutin Controller
 *
 * Php version 7.2.10
 *
 * @category PleasingToDocBlock
 * @property ScrutinTable $Scrutin
 *
 * @method  Scrutin[]|ResultSetInterface
 * @method  paginate($object = null, array $settings = [])
 * @package PSR\Documentation\API
 * @author  Fabrice Bouillerot @ <bouillerot@lemonde.fr>
 * @license <license@lemonde.fr> MIT
 * @link    -
 */
class ScrutController extends AppController
{
    /*
     * Lors de l'écran de CZ des résultats de scrutin
     * frmResultatsScr
     * frmResultatsScrLst
     * les index de tableau contenant ...
     */

    const DSCRU = "DSCRU";  // Les data du scrutin courant
    const DEGEO = "DEGEO";  // Les data de l'eg du scrutin courant
    const DRSES = "DRSES";  // les résultats de scrutin de la base
    const MRSES = "MRSES";  // les résultats modifiés
    const DCSES = "DCSES";  // les résultats des candidatures de la base
    const KCSES = "KCSES";  // les candidatures créées
    const MCSES = "MCSES";  // les candidatures modifiées
    const FCSES = "FCSES";  // les candidatures effacées

    /*
     * Les index du tableau des résultats de scrutin
     */
    const RS_INS = "RESU_SCR_INS";
    const RS_VOT = "RESU_SCR_VOT";
    const RS_EXP = "RESU_SCR_EXP";

    /*
     * Tableau des messages explicatifs pour code erreur HTTP
     * /!\ éviter autant que faire se peut l'accentutation.
     */

    private $_kodofrasoj = [
        200 => "",
        401 => "Plus d'une ligne de resultat pour ce scrutin.",
        402 => "Conflit : le nombre des sieges est incorrect.",
        403 => "Conflit : scrutin il faut INSCRITS >= VOTANTS >= EXPRIMES",
        404 => "Conflit : votes du scrutin <> total voix des candidats",
        405 => "Conflit : Total obtenu différent du total exprimé",
        406 => "Conflit : Calcul de règle impossible. Valeur nulle",
        409 => "",
    ];

    private $_koderaro = 200;

    /**
     * Fonction privée
     * renvoie vrai si l'eg selectionnée est du même type
     * que celui attendu par le scrutin ou alors il s'agit d'un canton.
     *
     * @return boolean
     */
    private function _egIdentiquesOuCantonale()
    {
        $egTyegCode = $this->modifScrutinEnGeoLire(AppTable::TYEGCODE);
        $scTyegCode = $this->modifScrutinScrutinLire(AppTable::TYEGCODE);
        $result     = ($egTyegCode === $scTyegCode)
                or (substr_compare($egTyegCode, "Can", 1, 3));
        return $result;
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /**
         * Créer un scrutin consiste à d'abord créer une élection
         * ensuite liée automatiquement au premier tour
         * du nouveau scrutin.
         */
        return $this->redirect(
            ['controller' => 'Elect', 'action' => 'add']
        );
        /*
          $this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
          return $this->redirect(['action' => 'index']);
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $scrutin = $this->Scrutin->newEntity();
          if ($this->request->is('post')) {
          $scrutin = $this->Scrutin->patchEntity($scrutin,
          $this->request->getData());
          if ($this->Scrutin->save($scrutin)) {
          $this->Flash->success(__('The scrutin has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(
          __('The scrutin could not be saved. Please, try again.')
          );
          }
          $this->set(compact('scrutin'));
         */
    }

    /**
     * Ajoute un second tour à une élection sélectionnée
     *
     * @param string $elec_cle -
     * @param string $tour     -
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function addround($elec_cle = null, $tour = null)
    {
        if (is_null($elec_cle)) {
            $msg = __(
                "{0}::{1}:: La clef d'élection est NULL",
                [__METHOD__, __LINE__]
            );
            $this->log($msg, LogLevel::ERROR);
            throw new Exception($msg);
        }
        if (is_null($tour)) {
            $msg = __(
                "{0}::{1}:: Le numéro de tour de l'élection {2} est NULL",
                [__METHOD__, __LINE__, $elec_cle]
            );
            $this->log($msg, LogLevel::ERROR);
            throw new Exception($msg);
        }
        try {
            /**
             * En principe existe puisque sélectionné
             */
            $kWanted = [AppTable::ELECCLE, AppTable::SCRUTTOUR];

            $vWanted = [$elec_cle, $tour];
            $pk      = array_combine($kWanted, $vWanted);
            // dd(__METHOD__, $elec_cle, $tour, $this->modifScrutinScrutinLire());
            $this->modifScrutinScrutinMemorise($pk);
            /**
             * $scrutin & $election are now  valid entities.
             */
            /**
             * Suivons la méthode utilisée dans programme VB
             * Cherche au moins un second tour dans une vue.
             */
            $view = $this->getTableLocator()->get(
                "VElecScrut",
                ['connection' => $this->getActiveConnexion()]
            );
            $q = $view
                ->find()
                ->where(
                    [
                    "ELEC_CLE"  => $elec_cle,
                    "SCRU_TOUR" => "02",
                    ]
                );
            $count = $q->count();
            switch ($count) {
            case 0:
                /**
                 * Aucun second tour trouvé, ballotage ?
                 * pour l'élection recherchée
                 */
                $param = [
                self:: ELECCLE => $elec_cle,
                self:: INDICLE => $this->modifScrutinScrutinLire(self::INDICLE),
                self:: TYSCCODE => $this->modifScrutinScrutinLire(self::TYSCCODE),
                ];
                $arrayParams = $this->_param2FuncEnBallottage($param);
                /* dd(__METHOD__, $arrayParams); */
                $enBallottage = $this->methodeStockee($arrayParams);
                /* dd(__METHOD__, $enBallottage); */
                if (!$enBallottage["isOk"]) {
                    $msg = __(
                        "Pour le tour {1} de l'élection {0},{2}."
                            . " Problème rencontré lors de l'exécution "
                            . "de la fonction stockée : [{3}] ",
                        [
                            $elec_cle,
                            $tour,
                            $this->modifScrutinScrutinLire("ELEC_LIB"),
                            $enBallottage["Result"]
                            ]
                    );
                    //$this->log($msg, \Psr\Log\LogLevel::INFO);
                    throw new Exception($msg);
                }
                if ($enBallottage["Result"] === "0") {
                    $msg = __(
                        "Aucun candidat en ballottage, "
                            . "pour le tour {1} de l'élection {0},{2}",
                        [
                            $elec_cle,
                            $tour,
                            /* $election->ELEC_LIB */
                            $this->modifScrutinScrutinLire("ELEC_LIB")
                            ]
                    );
                    /* $this->log($msg, \Psr\Log\LogLevel::INFO); */
                    throw new Exception($msg);
                }
                return $this->redirect(
                    [
                                'controller' => 'Scrut',
                                'action'     => 'addtour2'
                                ]
                );

            case 1:
                /**
                 * Trouvé un second tour
                 */
                $msg = __(
                    "L'élection {0} [{2}] possède déjà un second tour.",
                    [
                        $elec_cle,
                        $tour,
                        /* $election->ELEC_LIB */
                        $this->modifScrutinScrutinLire("ELEC_LIB")
                        ]
                );
                // $this->log($msg, \Psr\Log\LogLevel::INFO);
                throw new Exception($msg);

            default:
                /**
                 * L'élection possède plusieurs seconds tours
                 */
                $msg = __(
                    "L'élection {0} [{2}] "
                        . "possède plusieurs seconds tours !",
                    [
                        $elec_cle,
                        $tour,
                        /* $election->ELEC_LIB */
                        $this->modifScrutinScrutinLire("ELEC_LIB")
                        ]
                );
                $this->log($msg, LogLevel::CRITICAL);
                throw new Exception($msg);
            }
        } catch (\Exception $exc) {
            /**
             * Traite toute exception levée pour cette action
             */
            $this->Flash->error($exc);
        }
        return $this->redirect(
            ['controller' => 'Scrut', 'action' => 'index']
        );
    }

    /**
     * Tjs lancer AddRound(elec_cle,tour), avant
     * d'ajoutr un deuxième tour pour une date saisie.
     *
     * @return reponse
     */
    public function addtour2()
    {
        /**
         * 205 Reset Content
         *
         * The server successfully processed the request,
         * but is not returning any content.
         * Unlike a 204 response, this response requires
         * that the requester reset the document view.
         *
         * @var array $msg205
         */
        $msg205 = [
        __("La date est vide"),
        __("Date du second tour avant date du premier tour !"),
        __("Le second tour sélectionné n'est pas un dimanche !"),
        ];
        $idx = 0;

        if ($this->getRequest()->is("post")) {//->is(["post"])) {
            //$response = $this->response->withStatus(200, "test en cours");
            $isOk = ($idx === 0);
            $d2   = $this->getRequest()->getData(self::SCRUDATE);
            //dd(__METHOD__, "date", $d2, $isOk);
            if ($isOk) {
                /**
                 * * date vide
                 */
                $isOk = !empty($d2);
                $idx  = 1 * !$isOk;
            }
            if ($isOk) {
                /**
                 * ! conversion d2 en DateTime
                 */
                $format = "d/m/Y";
                $tzn    = "Europe/Paris";
                $dT2    = Time::createFromFormat($format, $d2);  //, $tz);
                $dT2->setTime(0, 0, 0)
                //->setTimezone($tzn) Quel que soit le fuseau horaire !
                ;
                /**
                 * Lecture de la date du premier tour
                 */
                $dT1 = $this->modifScrutinScrutinLire(self::SCRUDATE);
                $dT1 = $dT1->setTime(0, 0, 0);

                /**
                * !  date T2 Avant T1
                */
                $isOk = ($dT1 < $dT2);
                $idx  = 2 * !$isOk;
            }
            if (!$isOk) {
                $msg = $msg205[$idx - 1];
                $this->Flash->error($msg);
            } else {
                /**
                 * * Date Saisie tour 2 acceptable
                 */
                $keys = [
                self:: ELECCLE, self:: TYEGCODE, self:: SCRUTOUR, self:: INDICLE
                ];
                $data = $this->modifScrutinExtractArrayScrutin($keys);
                /*
                 * // date T2 <T1
                 * $data[self::SCRUDATE] = $dT2->i18nFormat("dd/MM/yyyy");
                 * // mois invalide
                 * $data[self::SCRUDATE] = $dT2->i18nFormat("MM/dd/yyyy");
                 */
                $data[self::SCRUDATE] = $dT2->i18nFormat("yyyy/MM/dd");
                //$data[self::SCRUDATE] = "28/06/2020";
                $data[self::NUMTOUR] = "02";
                      $params        = $this->_param2FuncInsScrutT2($data);
                      $result        = $this->methodeStockee($params);
                      $isOk          = $result["isOk"];
                if (!$isOk) {
                    $msg205[]    = (string) $result["Result"];
                            $idx = count($msg205);
                    $this->Flash->error($result["Result"]);
                }
                if ($isOk) {
                    $this->Flash->success(__("Opération effectuée !"));

                    /**
                     * C'est mieux que ce soit un dimanche !
                     * https:   //unicode-org.github.io/icu-docs/apidoc/released/icu4c/classSimpleDateFormat.html#details
                     */
                    $isOk = ($dT2->isSunday());
                    if (!$isOk) {
                        $idx    = 3 * !$isOk;
                        $msgDim = $msg205[$idx - 1];
                        $this->Flash->set($msgDim);
                    }
                }
            }
            $msg      = $isOk ? "" : $msg205[$idx - 1];
            $offset   = 5 * (!in_array($idx, [0, count($msg205)]));
            $response = $this->response->withStatus(200 + $offset, $msg);
            /* $this->Flash->set(
            *    __METHOD__ . "::" . __LINE__ . "::idx = " . $idx . "::" . $msg
            * );
            */
            return $response;
        }
    }

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        /**
         * R.A.Z. choix précédent pour la gestion des résultats d'un scrutin.
         */
        $this->sessionDelete(self::MODIFSCRUTIN);
        //dd(__METHOD__, $this->sessionRead(self::modifScrutin));
        /*
          $query = $this->Scrutin
          // Use the plugins 'search' custom finder and pass in the
          // processed query params
          ->find('search', ['search' => $this->request->getData()])
          // You can add extra things to the query if you need to
          // ->contain(['Election'])
          // ->where(['title IS NOT' => null])
          ;
          $this->log($query->sql());
          // $scrutin = $this->paginate($this->Scrutin);

          try {
          $scrutin = $this->paginate($query);
          }
          catch (Exception $exc) {
          $this->Flash->error($exc);
          return $this->redirect(['action' => 'index']);
          }

          $this->set(compact('scrutin'));
         *
         */
    }

    /**
     * Récupère la datagrid
     *
     * @param array $options -
     *
     * @return void
     */
    public function getdatagrid(array $options = [])
    {
        $options["contain"] = ['Election'];
        //dump($this->request->getData());
        Log::info(
            __METHOD__ . "::" . __LINE__ . "::"
                . print_r($this->sessionRead($this->name), true)
                . print_r($options, true)
        );
        parent:: getdatagrid($options);
    }

    /**
     * View method
     *
     * @param string|null $id Scrutin id.
     *
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $scrutin = $this->Scrutin->get(
            $id,
            [
                'contain' => []
                ]
        );

        $this->set('scrutin', $scrutin);
    }

    /**
     * Prépare insertion scrutin tour 2
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncInsScrutT2(array $data)
    {
        /**
         * Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("Proc_Init_Scru_T2");
        /* Tableau des clefs nom de paramètres */
        $k = [
        "PARELECCLE",
        "PARTYPEG",
        "PARNUMTOUR",
        "PARSCRUDATE",
        "PARINDICLE",
        ];
        /* Tableau des paramètres attendus */
        $kWanted = [
        self:: ELECCLE,
        self:: TYEGCODE,
        self:: NUMTOUR,
        self:: SCRUDATE,
        self:: INDICLE,
        ];
        $filtre = $this->arrayFilterByKeysWanted($data, $kWanted);
        /**
         * Vérifier si les tailles de $kWanted et $filtre sont identiques
         * on s'en passe très bien pour l'instant !
         */
        $v = [
        $filtre[self::ELECCLE],
        $filtre[self::TYEGCODE],
        $filtre[self::NUMTOUR],
        $filtre[self::SCRUDATE],
        $filtre[self::INDICLE],
        ];
        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Prépare modifications sièges et Libelles
     *  d'une entité géo d'un scrutin
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncModEgScru(array $data)
    {
        /**
         * Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("PROC_UPD_1_EG_SCRU");
        /* Tableau des clefs nom de paramètres */
        $k = [
        "PARELECCLE",
        "PAREGCLE",
        "PARINDICLE",
        "PARNUMTOUR", // ! Doit être nommé PARNUMTOUR et non PARSCRUTOUR
        "PAREGSIEGES",
        "PAREGLIBEL",
        "PAREGLIBEL2",
        ];
        /* Tableau des paramètres attendus */
        $kWanted = [
        self:: ELECCLE,
        self:: EGCLE,
        self:: INDICLE,
        self:: SCRUTOUR,
        self:: EGSIEGES,
        self:: EGLIB,
        self:: EGLIB2,
        ];
        $filtre = $this->arrayFilterByKeysWanted($data, $kWanted);
        /**
         * Vérifier si les tailles de $kWanted et $filtre sont identiques
         * on s'en passe très bien pour l'instant !
         */
        $v = [
        $filtre[self::ELECCLE],
        $filtre[self::EGCLE],
        $filtre[self::INDICLE],
        $filtre[self::SCRUTOUR],
        $filtre[self::EGSIEGES],
        $filtre[self::EGLIB],
        $filtre[self::EGLIB2],
        ];
        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Prépare modification des résultats d'une entité géo d'un scrutin
     * Table resultat_scrutin
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncModResScru(array $data)
    {
        /**
         * Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("PROC_UPD_1_RES_SCRU");
        /* Tableau des clefs nom de paramètres */
        $k = [
        "PARELECCLE",
        "PAREGCLE",
        "PARINDICLE",
        "PARNUMTOUR", // ! Doit être nommé PARNUMTOUR et non PARSCRUTOUR
        "PARRESINS",
        "PARRESVOT",
        "PARRESEXP",
        "PARLIBEL2",  // ! resultat_scrutin.resu_libel_2
        ];
        /* Tableau des paramètres attendus */
        $kWanted = [
        self:: ELECCLE,
        self:: EGCLE,
        self:: INDICLE,
        self:: SCRUTOUR,
        self:: RESINS,
        self:: RESVOT,
        self:: RESEXP,
        self:: RESLI2,
        ];
        $filtre = $this->arrayFilterByKeysWanted($data, $kWanted);
        /**
         * Vérifier si les tailles de $kWanted et $filtre sont identiques
         * on s'en passe très bien pour l'instant !
        $v = [
        $filtre[self::ELECCLE],
        $filtre[self::EGCLE],
        $filtre[self::INDICLE],
        $filtre[self::SCRUTOUR],
        $filtre[self::RESINS],
        $filtre[self::RESVOT],
        $filtre[self::RESEXP],
        $filtre[self::RESLI2],
        ];
         */
        $v = [];
        foreach ($kWanted as $item) {
            $v[] = $filtre[$item];
        }
        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Prépare modification des résultats d'une candidature d'un scrutin
     * Table resultat_candidature
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncModResCand(array $data = [])
    {
        /**
         * Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("PROC_UPD_1_RES_CAND");
        /* Tableau des clefs nom de paramètres */
        $k = [
        "PARELECCLE",
        "PAREGCLE",
        "PARINDICLE",
        "PARNUMTOUR", // ! Doit être nommé PARNUMTOUR et non PARSCRUTOUR
        "PARTYEG",
        "PARCANDID",
        "PARCANDVOIX",
        ];
        /* Tableau des paramètres attendus */
        $kWanted = [
        self:: ELECCLE,
        self:: EGCLE,
        self:: INDICLE,
        self:: SCRUTOUR,
        self:: TYEGCODE,
        self:: CANDID,
        self:: RESCVOIX,
        ];
        // dd(__METHOD__. "::" . __LINE__, $data, $kWanted);
        $filtre = $this->arrayFilterByKeysWanted($data, $kWanted);
        /**
         * Vérifier si les tailles de $kWanted et $filtre sont identiques
         * on s'en passe très bien pour l'instant !
         */
        $v = [];
        foreach ($kWanted as $item) {
            $v[] = $filtre[$item];
        }
        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Indique si une élection est en ballottage
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncEnBallottage(array $data)
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("Check_Ballottage");

        $k = [// $keys
        "PARELECLE",
        "PARINDICLE",
        "PARTYPSCRU",
        ];

        $v = [// Values
        $data[self::ELECCLE],
        $data[self::INDICLE],
        $data[self::TYSCCODE],
        ];

        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Prépare les paramètre de la fonction de vérification de ballotage.
     *
     * @param array $data - tableau de paramètres
     *
     * @return array
     */
    private function _param2FuncCheckBallotage1Ce(array $data)
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("CHECK_BALLOTTAGE_1_CE");

        $k = [// $keys
        ":result",
        "PARELECLE",
        "PARINDICLE",
        "PARTYPSCRU",
        "PARENTGCLE",
        ];

        $v = [// Values
        "-1",
        $data[AppTable::ELECCLE],
        $data[AppTable::INDICLE],
        $data[AppTable::TYSCCODE],
        $data[AppTable::EGCLE],
        ];

        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Prépare les paramètre de la fonction de suppression d'un scrutin.
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncDeleteScrut(array $data)
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("PROC_DEL_SCRUTIN");

        $k = [// $keys
        "PARELECCLE",
        "PARSCRUTOUR",
        ];

        $v = [// Values
        $data[self::ELECCLE],
        $data[self::SCRUTOUR],
        ];

        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Prépare les paramètre de la fonction de calul des règles d'un scrutin
     *
     * @param array $data - tableau des paramètres
     *
     * @return array
     */
    private function _param2FuncCalCulRegle(array $data = [])
    {
        // dd(__METHOD__. "::" . __LINE__, $data);
        /**
         * Éviter toute faute de frappe en minuscule !
         */
        $n = \strtoupper("PROC_REGLES");
        /* Tableau des clefs nom de paramètres */
        $k = [
            "PARELECCLE",
            "PARTYPELE",
            "PARNUMTOUR", // ! Doit être nommé PARNUMTOUR et non PARSCRUTOUR
            "PAREGCLE",
            "PARINDICLE",
            "PARTYPEN",
            // ! "PARCOMMIT",  // ! Falcultatif NUMBER DEFAULT = 1
        ];

        // * Tableau des paramètres attendus
        $kWanted = [
            self:: ELECCLE,
            self:: TYELCODE,
            self:: SCRUTOUR,
            self:: EGCLE,
            self:: INDICLE,
            self:: TYENCODE,
        //  ! pour le paramètre falcultatif => ce n'est pas le moment…
        ];
        // dd(__METHOD__. "::" . __LINE__, $data, $kWanted);
        $filtre = $this->arrayFilterByKeysWanted($data, $kWanted);
        // * Vérifier si les tailles de $kWanted et $filtre sont identiques
        // $this->isAllKeysPresentInArray($filtre,$kWanted)
        // count($filtre) === count($kWanted)
        // ! on s'en passe très bien pour l'instant !
        $v      = [];
        foreach ($kWanted as $item) {
            $v[] = $filtre[$item];
        }

        // Rajoute le Paramètre Falcultatif
        $k[] = "PARCOMMIT";
        $v[] = 1;            // Valeur par défaut

        /**
         * Prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }
    /**
     * Quantité de Candidatures / EG / Scrutin
     *
     * @param array $param - tableau des paramètres
     *
     * @return integer - nombre des enregistrements trouvés, -1 si problème
     */
    private function _compteCandidaturesParEG($param)
    {
        $result = -1;
        /**
         * Les Clefs dont j'ai besoin
         */
        $kWanted = [ AppTable::INDICLE, AppTable::EGCLE, AppTable::ELECCLE,
        AppTable::SCRUTTOUR,]
        ;

        $cond = $this->arrayFilterByKeysWanted($param, $kWanted);
        $isOk = $this->isAllKeysPresentInArray($cond, $kWanted);
        //dd(__METHOD__, $param, $cond, $isOk);
        if ($isOk) {
            $result = $this->compteDansUnetable("Candidature", $cond);
        }
        return $result;
    }

    /**
     * Compte le quantité des entités Géogr. liées à un scrutin.
     *
     * @param array $param tableau asso contenant les clefs ELEC_CLE,SCRU_TOUR
     *
     * @return integer le nombre d'entité géogr. de ce srutin. -1 si problème.
     */
    private function _compteEgScrutin($param)
    {
        $result = -1;
        /**
         * Les Clefs dont j'ai besoin
         */
        $kWanted = [AppTable::ELECCLE, AppTable::SCRUTTOUR,];
        $cond    = $this->arrayFilterByKeysWanted($param, $kWanted);
        $isOk    = $this->isAllKeysPresentInArray($cond, $kWanted);
        if ($isOk) {
            $result = $this->compteDansUnetable("EntGeoScrutin", $cond);
        }
        return $result;
    }
    /**
     * Indique l'existence d'au moins une modification dans le tableau
     * de l'EG du scrutin sélectionné.
     *
     * @param array $dataRCSES tableau de tableaux des saisies
     *
     * @return bool false si le tableau est inaccessible, true sinon
     */
    private function _isModEgScru($dataRCSES = [])
    {
        $result = !empty($dataRCSES);  // qq chose à vérifier ?
        if ($result) {
            $result = (array_key_exists(self::MRSES, $dataRCSES));
        }

        // dd(__FUNCTION__, $result);

        return $result;
    }
    /**
     * Extrait les data du scrutin modifié
     *
     * @param array $dataRCSES -
     *
     * @return array
     */
    private function _extDSCRU(array $dataRCSES=[])
    {
        /**
         * Validation du contenu des résultats du scrutin
         *
         * Mise en majuscule des différentes clefs de tableau
         */
        $tablo = FabriceTools::arrayChangeKeyCaseUnicodeRecurs(
            $dataRCSES[self::DSCRU],
            CASE_UPPER
        );
        // dd(__METHOD__. "::" . __LINE__,$tablo);
        return array_key_exists("ROWS", $tablo) ? $tablo["ROWS"] :$tablo;
    }

    /**
     * Extrait les data de l'EG du scrutin modifié
     *
     * @param array $dataRCSES -
     *
     * @return array
     */
    private function _extDEGEO(array $dataRCSES=[])
    {
        /**
         * Validation du contenu des résultats du scrutin
         *
         * Mise en majuscule des différentes clefs de tableau
         */
        $tablo = FabriceTools::arrayChangeKeyCaseUnicodeRecurs(
            $dataRCSES[self::DEGEO],
            CASE_UPPER
        );
        // dd(__METHOD__. "::" . __LINE__,$tablo);
        return array_key_exists("ROWS", $tablo) ? $tablo["ROWS"] :$tablo;
    }

    /**
     * Extrait le tableau des modifications des résultats
     * de l'EG du scrutin.
     *
     * @param array $dataRCSES - tableau des tableaux des données
     *                         saisies par utilisateur.
     *                         Le résultat du scrutin et
     *                         toutes les candidatures associées.
     *
     * @return array
     */
    private function _extModEgScru($dataRCSES = [])
    {
        // récupération de l'index du tableau à valider
        $index = $this->_isModEgScru($dataRCSES) ? self:: MRSES: self:: DRSES;
        /**
         * Validation du contenu des résultats du scrutin
         *
         * Mise en majuscule des différentes clefs de tableau
         */
        $tablo = FabriceTools::arrayChangeKeyCaseUnicodeRecurs(
            $dataRCSES[$index],
            CASE_UPPER
        );
        // dd(__METHOD__. "::" . __LINE__,$tablo);
        return array_key_exists("ROWS", $tablo) ? $tablo["ROWS"] :$tablo;
    }

    /**
     * Extrait la valeur de la somme des voix obtenues pour chaque candidat
     * de l'EG du Scrutin
     *
     * @param array $dataRCSES - toutes data de l'IHM
     *
     * @return int
     */
    private function _extSommeVoixExpCandScrutin(array $dataRCSES=[])
    {
        $tablo = $this->_extModCandScru($dataRCSES);
        // dd(__METHOD__. "::" . __LINE__,$tablo);
        $somme = 0;
        foreach ($tablo as $item) {
            $somme += (int) $item[self::RESCVOIX];
        }
        // dd(__METHOD__. "::" . __LINE__, $somme);
        return $somme;
    }
    /**
     * Extrait le tableau des modifications des résultats
     * des candidatures du scrutin.
     *
     * @param array $dataRCSES - tableau des tableaux des données
     *                         saisies par utilisateur.
     *                         Le résultat du scrutin et
     *                         toutes les candidatures associées.
     *
     * @return array
     */
    private function _extModCandScru(array $dataRCSES = [])
    {
        // récupération de l'index du tableau à valider
        // $index = $this->_isModCandScru($dataRCSES) ? self::MCSES : self::DCSES;
        $index = self::DCSES;
        /**
         * Validation du contenu des candidatures du scrutin
         *
         * Mise en majuscule des différentes clefs de tableau
         */
        $tablo = FabriceTools::arrayChangeKeyCaseUnicodeRecurs(
            $dataRCSES[$index],
            CASE_UPPER
        );
        // dd(
        //     __METHOD__.'::'. __LINE__,
        //     $dataRCSES,
        //     array_key_exists("ROWS", $tablo) ? $tablo["ROWS"] :$tablo
        // );
        return array_key_exists("ROWS", $tablo) ? $tablo["ROWS"] :$tablo;
    }
    /**
     * Valide la modif des l'EG du scrutin sélectionné.
     * Vérifie :
     *  - Sièges > 0
     *  - Incrits >= Votants >= exprimés
     *  - Somme des voix obtenues = exprimés
     *
     * @param array $dataRCSES - tableau des tableaux des données
     *                         saisies par utilisateur.
     *                         Le résultat du scrutin et
     *                         toutes les candidatures associées.
     *
     * @return bool vrai si les modifications sont valides, faux sinon.
     */
    private function _isModEgScruValid($dataRCSES = [])
    {
        /**
         * Tout se passe bien a priori
         */
        $this->_koderaro = 200;
        /*
         * Procédures stockées à utiliser
         * PROC_UPD_1_EG_SCRU:
         * UPD nombre de sièges
         * champs egsieges, eglibel et eglibel2.
         *
         * gère le cas élection municipale.
         *
         * PROC_UPD_1_RES_SCRU
         * PROC_UPD_1_RES_SCRU_LIBEL /!\ UPD Le Libel2 en plus
         * UPD votes + libellé 2 +  libellé (_LIBEL)
         * champs resu_scru_ins, resu_scr_vot, resu_srcu_exp
         *
         * Note: Quel usage ou différence entre les champs
         * resu_libel et resu_libel2 ?
         *
         * Libel   horodatage EXPORT vers methode
         * libel_2 horodatage import depuis XML
         *
         * du coup, modif de libel_2: modif. le jj/mm/aaa hh: mm
         *
         */

        /*
         * Idée: penser à gérer les valeurs Ins, Vot, Exp tous à NULL ou zéro…
         *
         * Si NON(modif SCRU Valide et Modif CAND Valide) Alors
         * {
         * Code erreur = 499
         * message     = par défaut
         * } sinon
         * {
         *  Si SCRUTIN est modifié alors
         *   {
         * isOK = lance PROC_UP_1_RESU_SCRU ou _LIBEL ?
         *   }
         *  SI CAND est modifié alors
         *  {
         * isOK = lance PROC_UPD_1_EG_SCRU
         *  }
         * }
         *
         */

        /**
         * Validation du contenu des résultats du scrutin
         */
        $tablo = $this->_extModEgScru($dataRCSES);
        // dd(__METHOD__. "::" . __LINE__, $tablo);
        /**
         * Un seul scrutin bien sûr !
         */
        $isOk            = (count($tablo) === 1);
        $this->_koderaro = $isOk ? 200 : 401;
        $tablo           = array_shift($tablo); // Uniquement données du scrutin
        // dd(__METHOD__. "::" . __LINE__, $isOk, $tablo);

        /* Nombre de sièges > 0 */
        if ($isOk) {
            $isOk = (
                array_key_exists(self::EGSIEGES, $tablo)
                AND
                ($tablo[self::EGSIEGES] >0)
            );
            $this->_koderaro = $isOk ? 200 : 402;
        }
        // dd(__METHOD__. "::" . __LINE__, $isOk, $tablo);

        /* INSCRITS >= VOTANTS >= EXPRIMÉS et différents de zéro */
        $ins             = (int) $tablo[self::RS_INS];
        $vot             = (int) $tablo[self::RS_VOT];
        $exp             = (int) $tablo[self::RS_EXP];
        if ($isOk) {
            $isOk            = (($ins >= $vot) AND ($vot >= $exp));
            $isOk0           = (($ins * $vot * $exp) !== 0);
            $this->_koderaro = $isOk  ? 200 : 403;
            $this->_koderaro = $isOk0 ? 200 : 405;

        }
        // dd(
        //  __METHOD__. "::" . __LINE__,$ins,$vot,$exp,($ins >= $vot),($vot >= $exp),
        //  (($ins >= $vot) AND ($vot >= $exp)), $isOk, $tablo
        // );
        /* Somme des voix exprimées des candidatures = celles dans EG */
        if ($isOk) {
            $expEg = (int) $tablo[self::RS_EXP]; // voix exprimées dans EGCLE
            $expCan = $this->_extSommeVoixExpCandScrutin($dataRCSES);
            $isOk = ($expEg === $expCan);
            $this->_koderaro = $isOk ? 200 : 404;
        }
        // dd(
        //     __METHOD__.'::'.__LINE__, $tablo, $isOk,
        // $expEg, $expCan, $this->_koderaro,
        //     $this->_kodofrasoj[$this->_koderaro]
        // );
        return $isOk;
    }

    /**
     * Sauvegarde les sièges et les libelles dans table ent_geo_scrutin
     *
     * @param array $dataRCSES - tous les tableaux de toutes les données
     *                         saisies par l'opérateur.
     *
     * @return array  ["isOk"=> true|false, "Result" = mixed]
     */
    private function _cmdModEgScru(array $dataRCSES)
    {
        $params = $this->_extModEgScru($dataRCSES);
        $params = array_shift($params);
        $params = $this->_param2FuncModEgScru($params);
        $result = $this->methodeStockee($params);

        /**
         * Mise en forme de la phrase d'erreur
         */

        if (!$result["isOk"]) {
            /* Mise en forme de la phrase - au mieux des possibilités */
            $phrase           = $result["Result"];
            $result["Result"] = FabriceTools::noAccentString(
                explode("\n", $phrase)[0]
            );
        }
        /**
         * TODO : Reste à gérer la possibilité d'enregistrer les conseils municipaux
         * TODO:  Voir le fichier VB correspondant.
         *  * Private Sub cmdOK_Click() de frmResultatScrutinLst.vb
         * ! situé dans le répertoire docs
         */
        return $result;
    }

    /**
     * Sauvegarde les suffrages dans table ent_geo_scrutin
     *
     * @param array $dataRCSES - tous les tableaux de toutes les données
     *                         saisies par l'opérateur.
     *
     * @return array  ["isOk"=> true|false, "Result" = mixed]
     */
    private function _cmdModResEgScru(array $dataRCSES)
    {
        $params = $this->_extModEgScru($dataRCSES);
        // dd(__METHOD__. "::" . __LINE__, $params);
        $params = array_shift($params);
        // dd(__METHOD__. "::" . __LINE__, $params);
        $params = $this->_param2FuncModResScru($params);
        // dd(__METHOD__. "::" . __LINE__, $params);
        $result = $this->methodeStockee($params);

        // Mise en forme de la phrase d'erreur
        if (!$result["isOk"]) {
            /* Mise en forme de la phrase - au mieux des possibilités */
            $phrase           = $result["Result"];
            $result["Result"] = FabriceTools::noAccentString(
                explode("\n", $phrase)[0]
            );
        }

        return $result;
    }

    /**
     * Sauvegarde les suffrages dans table resultat_scrutin
     *
     * @param array $dataRCSES - tous les tableaux de toutes les données
     *                         saisies par l'opérateur.
     *
     * @return array  ["isOk"=> true|false, "Result" = mixed]
     */
    private function _cmdModResCandScru(array $dataRCSES)
    {
        $params = $this->_extModCandScru($dataRCSES);
        // dd(__METHOD__. "::" . __LINE__, $params);
        $isOk   = true;
        $phrase = "";
        foreach ($params as $cand) {
            //  Pour chaque Candidature
            // $params = array_shift($params);
            // dd(__METHOD__. "::" . __LINE__, $params);
            $params = $this->_param2FuncModResCand($cand);
            // dd(__METHOD__. "::" . __LINE__, $params);
            $result = $this->methodeStockee($params);
            $isOk = ($isOk and $result["isOk"]);
            $phrase .= $isOk ? "" : $result["Result"];
        }

        // Mise en forme de la phrase d'erreur
        if (!$isOk) {
            /* Mise en forme de la phrase - au mieux des possibilités */
            // $phrase           = $result["Result"];
            $result["Result"] = FabriceTools::noAccentString(
                explode("\n", $phrase)[0]
            );
        }

        $result = [];
        $result["isOk"] = $isOk;
        $result["Result"] = FabriceTools::noAccentString(
            explode("\n", $phrase)[0]
        );
        return $result;

    }

    /**
     * Effectue le calcul des règles inhérentes
     * à la modification du scrutin courant.
     *
     * @param array $dataRCSES - tous les tableaux de toutes les données
     *                         saisies par l'opérateur.
     *
     * @return array  ["isOk"=> true|false, "Result" = mixed]
     */
    private function _cmdCalculRegle(array $dataRCSES = [])
    {
        $params   = $this->_extModEgScru($dataRCSES);
        $paramsEg = $this->_extDEGEO($dataRCSES);
        $paramsEl = $this->_extDSCRU($dataRCSES);
        $params   = array_shift($params);
        $paramsEl = array_shift($paramsEl);
        $paramsEg = array_shift($paramsEg);
        $params   = array_merge($params, $paramsEg, $paramsEl);
        $params   = $this->_param2FuncCalCulRegle($params);
        $result   = $this->methodeStockee($params);

        // Mise en forme de la phrase d'erreur
        if (!$result["isOk"]) {
            /* Mise en forme de la phrase - au mieux des possibilités */
            $phrase           = $result["Result"];
            $result["Result"] = FabriceTools::noAccentString(
                explode("\n", $phrase)[0]
            );
        }

        return $result;
    }

    /**
     * Cette procédure correspond
     * à l'appui sur le bouton OK de la fenêtre frmResultatScrutinLst
     *
     * Private Sub cmdOK_Click()
     *
     * Vérifie les modifs saisies, des résultats et candidatures
     * dans frmResultatScrutinLst
     * Request Data doit être de la forme
     * [0]
     *      [DRSES] Données de base   des Résultats
     *      [KRSES] Données créées    des Résultats
     *      [MRSES] Données modifiées des Résultats
     *      [FRSES] Données effacées  des Résultats
     *      [DCSES] Données de base   des Candidatures
     *      [KCSES] Données créées    des Candidatures
     *      [MCSES] Données modifiées des Candidatures
     *      [FCSES] Données effacées  des Candidatures
     *
     * @return response|null
     */
    public function okClickFrmResultatScrutinLst()
    {

        /**
         * ! Cette fonction doit avoir exactement le même comportement
         * ! que le code situé dans le fichier :
         *
         * * Private Function SauvegardeResultatsScru.vb
         * * Private Sub cmdOK_Click() de frmResultatScrutinLst.vb
         *
         * ! Situé dans le répertoire docs
         */

        /* Stocke tout d'abord la réponse à renvoyer */
        $response = $this->response;

        $phrase = "";
        /* Récupération de toutes les modifs saisies dans l'écran */
        $dataRCSES = $this->request->getData();
        // dd(__METHOD__. "::" . __LINE__, "coucou");

        /**
         * Enregistrement de la modification EG du scrutin
         */

        // Modif de l'EG du Scrutin est Valide
        $isOk = $this->_isModEgScruValid($dataRCSES);
        // Prise en compte du nombre de sièges
        if ($isOk) {
            // Prise en compte du nombre de sièges
            $result = $this->_cmdModEgScru($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
            // dd(__METHOD__. "::" . __LINE__, $isOk);
        }
        // Prise en compte des suffrages de l'eg du scrutin sélectionné
        if ($isOk) {
            // Prise en compte des suffrages de l'eg du scrutin sélectionné
            $result = $this->_cmdModResEgScru($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
        }
        // Prise en compte des suffrages des candidatures du scrutin sélectionné
        if ($isOk) {
            // Prise en compte des suffrages des candidatures du scrutin sélectionné
            $result = $this->_cmdModResCandScru($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
        }
        // Application des règles suite à la modification du scrutin.
        if ($isOk) {
            // Application des règles suite à la modification du scrutin.
            $result = $this->_cmdCalculRegle($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
        }


        // $MRSES = $this->_isModEgScruValid($dataRCSES);
        /*
          $isOk = !empty($MRSES);  //

          $DRSES = $dataRCSES["DRSES"];  // Dat'um'o'j
          $KRSES = $dataRCSES["KRSES"];  // Datumoj kreitaj
          $MRSES = $dataRCSES["MRSES"];  // Datumoj modifitaj
          $FRSES = $dataRCSES["FRSES"];  // Datumoj forviŝitaj

          $DCSES = $dataRCSES["DCSES"];  // Dat'um'o'j
          $KCSES = $dataRCSES["KCSES"];  // Datumoj kreitaj
          $MCSES = $dataRCSES["MCSES"];  // Datumoj modifitaj
          $FCSES = $dataRCSES["FCSES"];  // Datumoj forviŝitaj
         *
         */
        /*
         * Retourne la réponse pour éviter que le controller
         * n'essaie de rendre la vue
         */
        $response = $this->response->withStatus(
            $this->_koderaro,
            FabriceTools::noAccentString(
                $this->_kodofrasoj[$this->_koderaro] . $phrase
            )
        );
        return $response;
    }

    /**
     * Cette procédure correspond
     * à l'appui sur le bouton OK de la fenêtre frmResultatScrutinLst
     *
     * Private Sub cmdOK_Click()
     *
     * Vérifie les modifs saisies, des résultats et candidatures
     * dans frmResultatScrutinLst
     * Request Data doit être de la forme
     * [0]
     *      [DRSES] Données de base   des Résultats
     *      [KRSES] Données créées    des Résultats
     *      [MRSES] Données modifiées des Résultats
     *      [FRSES] Données effacées  des Résultats
     *      [DCSES] Données de base   des Candidatures
     *      [KCSES] Données créées    des Candidatures
     *      [MCSES] Données modifiées des Candidatures
     *      [FCSES] Données effacées  des Candidatures
     *
     * @return response|null
     */
    public function okClickFrmResultatScrutin()
    {

        /**
         * ! Cette fonction doit avoir exactement le même comportement
         * ! que le code situé dans le fichier :
         *
         * * Private Function SauvegardeResultatsScru.vb
         * * Private Sub cmdOK_Click() de frmResultatScrutin.vb
         *
         * ! Situé dans le répertoire docs
         */

        /* Stocke tout d'abord la réponse à renvoyer */
        $response = $this->response;

        $phrase = "";
        /* Récupération de toutes les modifs saisies dans l'écran */
        $dataRCSES = $this->request->getData();
        // dd(__METHOD__. "::" . __LINE__, "coucou",$dataRCSES);

        /**
         * Enregistrement de la modification EG du scrutin
         */

        // Modif de l'EG du Scrutin est Valide
        $isOk = $this->_isModEgScruValid($dataRCSES);
        // Prise en compte du nombre de sièges
        if ($isOk) {
            // Prise en compte du nombre de sièges
            $result = $this->_cmdModEgScru($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
            // dd(__METHOD__. "::" . __LINE__, $isOk);
        }
        // Prise en compte des suffrages de l'eg du scrutin sélectionné
        if ($isOk) {
            // Prise en compte des suffrages de l'eg du scrutin sélectionné
            $result = $this->_cmdModResEgScru($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
        }
        // Prise en compte des suffrages des candidatures du scrutin sélectionné
        if ($isOk) {
            // Prise en compte des suffrages des candidatures du scrutin sélectionné
            $result = $this->_cmdModResCandScru($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
        }
        // Application des règles suite à la modification du scrutin.
        if ($isOk) {
            // Application des règles suite à la modification du scrutin.
            $result = $this->_cmdCalculRegle($dataRCSES);
            $isOk = (true === $result["isOk"]);
            if (!$isOk) {
                $this->_koderaro = 409;
                $phrase = $result["Result"];
            }
        }


        // $MRSES = $this->_isModEgScruValid($dataRCSES);
        /*
          $isOk = !empty($MRSES);  //

          $DRSES = $dataRCSES["DRSES"];  // Dat'um'o'j
          $KRSES = $dataRCSES["KRSES"];  // Datumoj kreitaj
          $MRSES = $dataRCSES["MRSES"];  // Datumoj modifitaj
          $FRSES = $dataRCSES["FRSES"];  // Datumoj forviŝitaj

          $DCSES = $dataRCSES["DCSES"];  // Dat'um'o'j
          $KCSES = $dataRCSES["KCSES"];  // Datumoj kreitaj
          $MCSES = $dataRCSES["MCSES"];  // Datumoj modifitaj
          $FCSES = $dataRCSES["FCSES"];  // Datumoj forviŝitaj
         *
         */
        /*
         * Retourne la réponse pour éviter que le controller
         * n'essaie de rendre la vue
         */
        $response = $this->response->withStatus(
            $this->_koderaro,
            FabriceTools::noAccentString(
                $this->_kodofrasoj[$this->_koderaro] . $phrase
            )
        );
        return $response;
    }

    /**
     * Affichage de l'écran de saisie de modification des résultats d'une liste
     *
     * @return response|null
     */
    public function frmResultatScrutinLst()
    {
        // $this->Flash->set("reste à faire pour : frmresultatScrutin ");
        // $this->Flash->set(
        //     __("1 grid pour saisir des informations par entité de scrutin.")
        // );
        /**
         * Constantes utiles plus courtes à taper
         */
        // * Spécifiques à l'élection
        $kElLib    = AppTable::ELECLIB; // garder car peut être utile dans la vue
        $kElCle    = AppTable::ELECCLE;
        $kInCle    = AppTable::INDICLE;
        $kTour     = AppTable::SCRUTTOUR;
        $kTyScCode = AppTable::TYSCCODE;
        $kTyElCode = AppTable::TYELCODE; // garder car peut être utile dans la vue
        /**
         * Spécifique ENTITE GEO
         */
        $kEgCle      = AppTable::EGCLE;
        $kEgCodInsee = AppTable::EGCODINSEE; // garder peut être utile dans la vue
        $kEgDesi     = AppTable::EGDESI;
        $kTyEgCode   = AppTable::TYEGCODE;
        /**
         * Valeurs
         *
         * $vTour    = $this->modifScrutinScrutinLire($kTour);
         * $vElecLib = $this->modifScrutinScrutinLire($kElLib);
         * $tyScru   = $this->modifScrutinScrutinLire($kTyScCode);
         * $tyElec   = $this->modifScrutinScrutinLire($kTyElCode);
         */
        $vElCle    = $this->modifScrutinScrutinLire($kElCle);
        $vInCle    = $this->modifScrutinScrutinLire($kInCle);
        $vTour     = $this->modifScrutinScrutinLire($kTour); // Utilisé dans vue.
        $vEgCle    = $this->modifScrutinEnGeoLire($kEgCle);
        $vTyEgCode = $this->modifScrutinEnGeoLire($kTyEgCode); // Utilisé dans vue.
        $vTyScCode = $this->modifScrutinScrutinLire($kTyScCode);

        $vTour01 = AppTable::SCRUTTOUR1;
        /**
         * Spécifique ENTITE GEO
         *
         * $CodeInsee = $this->modifScrutinEnGeoLire($kEgCodInsee);
         * $TyEntG    = $this->modifScrutinEnGeoLire($kTyEgCode);
         * $EgDesi    = $this->modifScrutinEnGeoLire($kEgDesi);
         */
        // $isBallotage = ($vTour01 === $this->modifScrutinScrutinLire($kTour));
        $isBallotage = ($vTour01 === $vTour);
        if ($isBallotage) {
            /**
             * Vérifie le ballotage pour le premier tour uniquement
             * If SelNumTour = "01" Then
             * IsBallotage   = .cmdCheckBallo1ce(
             * SelElec, SelIndiCle, SelTypScru, selEntgCle
             * )
             *     Else
             * IsBallotage = 0
             *     End If
             */
            $data = [
                $kElCle    => $vElCle,
                $kEgCle    => $vEgCle,
                $kInCle    => $vInCle,
                $kTyScCode => $vTyScCode,
            ];
            $param       = $this->_param2FuncCheckBallotage1Ce($data);
            $result      = $this->methodeStockee($param);
            $isBallotage = $result["isOk"] ? (bool) $result["Result"] : false;
            //dd(__METHOD__, $param, $result, $isBallotage);
        }
        $this->set("isBallottage", $isBallotage);
        /*
          $resultatScrutin = $this->selectRsltsScrEg(
          [
          $kElCle    => $vElCle,
          $kInCle    => $vInCle,
          $kTour     => $vTour,
          $kEgCle    => $vEgCle,
          $kTyEgCode => $vTyEgCode,
          ]
          );
         *
         */
        /**
         * ANCIEN CODE VB
         * Private Sub Form_Activate()
         * On Error GoTo RESU_ERR
         * Dim IsBallotage As Byte
         *
         * Me.txtDate    = Format(SelDate, "dd/mm/yyyy")
         * Me.txtEleLib  = Trim(SelElecLib)
         * Me.txtNumTour = SelNumTour
         * Me.TxtTypScru = Trim(SelTypScru)
         * Me.TxtTypEle  = Trim(SelTypElec)
         * Me.txtInsee   = selEntgInsee
         * Me.txtTypEntg = Trim(selTyEntg)
         * Me.txtDesi    = Trim(selEntgDesi)
         *
         * Me.MousePointer = vbHourglass
         *   With DataEnvironment1
         *
         * If SelNumTour = "01" Then
         * IsBallotage   = .cmdCheckBallo1ce(SelElec, SelIndiCle, SelTypScru
         * , selEntgCle)
         *     Else
         * IsBallotage = 0
         *     End If
         *
         * Me.cmdConseil.Visible = Trim(SelTypElec) = "Municipale"
         * And Me.grdResult.Rows > 1 And IsBallotage = 0
         *
         * If .rscmdSelResultatScrutin.State = adStateOpen Then
         *       .rscmdSelResultatScrutin.Close
         *     End If
         *     .cmdSelResultatScrutin( SelElec, SelIndiCle, SelNumTour,
         *  selEntgCle, Trim(SelTypEg)
         *
         *     With .rscmdSelResultatScrutin
         *
         * If .EOF       = False And .BOF = False Then
         * Me.txtExprime = SeparMil(.Fields("resu_scr_exp"))
         * Me.txtVotants = SeparMil(.Fields("resu_scr_vot"))
         * Me.txtInscrit = SeparMil(.Fields("resu_scr_ins"))
         * Me.txtSiege   = EffaceNull(.Fields("egeo_sieges"))
         * Me.TxtLibel   = EffaceNull(.Fields("egeo_libel"))
         * Me.txtLibel2  = EffaceNull(.Fields("egeo_libel_2"))
         *       End If
         *
         *
         *     End With
         *     .rscmdSelResultatScrutin.Close
         * 'Modif pour permettre la saisie d'une étiquette d'une ville
         * 'quand il n'y a pas encore de saisie de candidature
         *
         * 'mis en place pour les municipales 2001
         *
         *
         *      If CompteCandEg() > 0 Then
         *         MAJ_TableauResultat
         *         Else
         * Me.grdResult.Visible  = False
         * Me.cmdComm.Visible    = False
         * Me.cmdConseil.Visible = False
         * Me.mnuComm.Visible    = False
         * Me.MnuCons.Visible    = False
         *         End If
         *
         *     PourcentAbstention
         * Dirty = False
         *
         *   End With
         *
         * RESU_EXIT:
         * Me.MousePointer = vbDefault
         *   Exit Sub
         * RESU_ERR:
         *   GestionErreur
         *   Resume RESU_EXIT
         * End Sub
         */
    }

    /**
     * Affichage de l'écran de saisie de modification des résultats d'une liste
     *
     * @return response|null
     */
    public function frmResultatScrutin()
    {
        // $this->Flash->set("reste à faire pour : frmresultatScrutin ");
        // dd(__METHOD__ . "::" . __LINE__,"Passe par ici");
        // $this->Flash->set(
        //     __("1 grid pour saisir des informations par entité de scrutin.")
        // );
        /**
         * Constantes utiles plus courtes à taper
         */
        // * Spécifiques à l'élection
        $kElLib    = AppTable::ELECLIB; // garder car peut être utile dans la vue
        $kElCle    = AppTable::ELECCLE;
        $kInCle    = AppTable::INDICLE;
        $kTour     = AppTable::SCRUTTOUR;
        $kTyScCode = AppTable::TYSCCODE;
        $kTyElCode = AppTable::TYELCODE; // garder car peut être utile dans la vue
        /**
         * Spécifique ENTITE GEO
         */
        $kEgCle      = AppTable::EGCLE;
        $kEgCodInsee = AppTable::EGCODINSEE; // garder peut être utile dans la vue
        $kEgDesi     = AppTable::EGDESI;
        $kTyEgCode   = AppTable::TYEGCODE;
        /**
         * Valeurs
         *
         * $vTour    = $this->modifScrutinScrutinLire($kTour);
         * $vElecLib = $this->modifScrutinScrutinLire($kElLib);
         * $tyScru   = $this->modifScrutinScrutinLire($kTyScCode);
         * $tyElec   = $this->modifScrutinScrutinLire($kTyElCode);
         */
        $vElCle    = $this->modifScrutinScrutinLire($kElCle);
        $vInCle    = $this->modifScrutinScrutinLire($kInCle);
        $vTour     = $this->modifScrutinScrutinLire($kTour); // Utilisé dans vue.
        $vEgCle    = $this->modifScrutinEnGeoLire($kEgCle);
        $vTyEgCode = $this->modifScrutinEnGeoLire($kTyEgCode); // Utilisé dans vue.
        $vTyScCode = $this->modifScrutinScrutinLire($kTyScCode);

        $vTour01 = AppTable::SCRUTTOUR1;
        /**
         * Spécifique ENTITE GEO
         *
         * $CodeInsee = $this->modifScrutinEnGeoLire($kEgCodInsee);
         * $TyEntG    = $this->modifScrutinEnGeoLire($kTyEgCode);
         * $EgDesi    = $this->modifScrutinEnGeoLire($kEgDesi);
         */
        // $isBallotage = ($vTour01 === $this->modifScrutinScrutinLire($kTour));
        $isBallotage = ($vTour01 === $vTour);
        if ($isBallotage) {
            /**
             * Vérifie le ballotage pour le premier tour uniquement
             * If SelNumTour = "01" Then
             * IsBallotage   = .cmdCheckBallo1ce(
             * SelElec, SelIndiCle, SelTypScru, selEntgCle
             * )
             *     Else
             * IsBallotage = 0
             *     End If
             */
            $data = [
                $kElCle    => $vElCle,
                $kEgCle    => $vEgCle,
                $kInCle    => $vInCle,
                $kTyScCode => $vTyScCode,
            ];
            $param       = $this->_param2FuncCheckBallotage1Ce($data);
            $result      = $this->methodeStockee($param);
            $isBallotage = $result["isOk"] ? (bool) $result["Result"] : false;
            //dd(__METHOD__, $param, $result, $isBallotage);
        }
        $this->set("isBallottage", $isBallotage);
        /*
          $resultatScrutin = $this->selectRsltsScrEg(
          [
          $kElCle    => $vElCle,
          $kInCle    => $vInCle,
          $kTour     => $vTour,
          $kEgCle    => $vEgCle,
          $kTyEgCode => $vTyEgCode,
          ]
          );
         *
         */
        /**
         * ANCIEN CODE VB
         * Private Sub Form_Activate()
         * On Error GoTo RESU_ERR
         * Dim IsBallotage As Byte
         *
         * Me.txtDate    = Format(SelDate, "dd/mm/yyyy")
         * Me.txtEleLib  = Trim(SelElecLib)
         * Me.txtNumTour = SelNumTour
         * Me.TxtTypScru = Trim(SelTypScru)
         * Me.TxtTypEle  = Trim(SelTypElec)
         * Me.txtInsee   = selEntgInsee
         * Me.txtTypEntg = Trim(selTyEntg)
         * Me.txtDesi    = Trim(selEntgDesi)
         *
         * Me.MousePointer = vbHourglass
         *   With DataEnvironment1
         *
         * If SelNumTour = "01" Then
         * IsBallotage   = .cmdCheckBallo1ce(SelElec, SelIndiCle, SelTypScru
         * , selEntgCle)
         *     Else
         * IsBallotage = 0
         *     End If
         *
         * Me.cmdConseil.Visible = Trim(SelTypElec) = "Municipale"
         * And Me.grdResult.Rows > 1 And IsBallotage = 0
         *
         * If .rscmdSelResultatScrutin.State = adStateOpen Then
         *       .rscmdSelResultatScrutin.Close
         *     End If
         *     .cmdSelResultatScrutin( SelElec, SelIndiCle, SelNumTour,
         *  selEntgCle, Trim(SelTypEg)
         *
         *     With .rscmdSelResultatScrutin
         *
         * If .EOF       = False And .BOF = False Then
         * Me.txtExprime = SeparMil(.Fields("resu_scr_exp"))
         * Me.txtVotants = SeparMil(.Fields("resu_scr_vot"))
         * Me.txtInscrit = SeparMil(.Fields("resu_scr_ins"))
         * Me.txtSiege   = EffaceNull(.Fields("egeo_sieges"))
         * Me.TxtLibel   = EffaceNull(.Fields("egeo_libel"))
         * Me.txtLibel2  = EffaceNull(.Fields("egeo_libel_2"))
         *       End If
         *
         *
         *     End With
         *     .rscmdSelResultatScrutin.Close
         * 'Modif pour permettre la saisie d'une étiquette d'une ville
         * 'quand il n'y a pas encore de saisie de candidature
         *
         * 'mis en place pour les municipales 2001
         *
         *
         *      If CompteCandEg() > 0 Then
         *         MAJ_TableauResultat
         *         Else
         * Me.grdResult.Visible  = False
         * Me.cmdComm.Visible    = False
         * Me.cmdConseil.Visible = False
         * Me.mnuComm.Visible    = False
         * Me.MnuCons.Visible    = False
         *         End If
         *
         *     PourcentAbstention
         * Dirty = False
         *
         *   End With
         *
         * RESU_EXIT:
         * Me.MousePointer = vbDefault
         *   Exit Sub
         * RESU_ERR:
         *   GestionErreur
         *   Resume RESU_EXIT
         * End Sub
         */
    }

    /**
     * OuvrirResultatScrutin
     *
     * --@param array $param tableau contenant les champs permettant
     * de reconstituer la clef primaire  pour effectuer cette fonction.
     *
     * @return Response|null
     */
    public function ouvrirResultatScrutin()
    {
        /**
         * Public Sub OuvrirResultatScrutin()
         * Dim NbEgScrutin As Long
         *
         * NbEgScrutin    = _compteEgScrutin()
         * If NbEgScrutin = 1 Then
         *     ' verif nombre Candidature
         *
         * If CompteCandEg() = 0 Then
         *       MsgBox "Pas de candidature rattachée à ce scrutin.", vbExclamation
         *     Else
         *        If Trim(SelTypEnt) <> "Liste" Then
         *           Load frmResultatScrutin
         *           frmResultatScrutin.Show vbModal
         *        Else
         *           Load frmResultatScrutinLst
         *           frmResultatScrutinLst.Show vbModal
         *        End If
         *     End If
         * ElseIf NbEgScrutin = 0 Then
         *    MsgBox "Pas de circonscription rattachée à ce scrutin", vbExclamation
         *   Else
         *      Load frmListeEgResScrutin
         *      frmListeEgResScrutin.Show vbModal
         *   End If
         * End Sub
         */
        $nbEgScrutin = $this->_compteEgScrutin($egDuScrutin);
        switch ($nbEgScrutin) {
        case 0:
            $this->Flash->error(
                __("Pas de circonscription rattachée à ce scrutin.")
            );
            break;
        case 1 :
        default:
            break;
        }
    }

    /**
     * Edit method
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - Chiffre du tour
     *
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($cleElec = null, $tour = null)
    {
        try {
            $entity = $this->Scrut->get(
                [$cleElec, $tour],
                ['contain' => 'Election']
            );
            //dd(__METHOD__ . "::" . __LINE__, $entity);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $data   = $this->request->getData();
                $entity = $this->Scrut->patchEntity($entity, $data);
                if ($this->Scrut->save($entity)) {
                    $this->Flash->success(__('The scrutin has been saved.'));

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error(
                    __('The scrutin could not be saved. Please, try again.')
                );
            }
        } catch (Exception $exc) {
            $this->Flash->error($exc); //->getTraceAsString();
            //return $this->redirect(['action' => 'index']);
        }
        $this->set(compact('entity'));
        //$this->Flash->info(__("Valeurs reçues pour traiter la mise à jour $id"));
        //return $this->redirect(['action' => 'index']);
        /**
         * Le reste du code est à adapter en fonction du vieux G.T.E.R.E.
         * if ($this->request->is(['patch', 'post', 'put'])) {
         * $scrutin = $this->Scrutin->patchEntity($scrutin,
         * $this->request->getData());
         * if ($this->Scrutin->save($scrutin)) {
         * $this->Flash->success(__('The scrutin has been saved.'));
         * return $this->redirect(['action' => 'index']);
         * }
         * $this->Flash->error(
         * __('The scrutin could not be saved. Please, try again.')
         * );
         * }
         * $this->set(compact('scrutin'));
         */
    }

    /**
     * Delete method
     * paramètres en entrée : la clé de l'élection, le tour de scrutin
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - tour du scrutin.
     *
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($cleElec = null, $tour = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $msgOk = __(
            'The scrutin {0} has been deleted.',
            [$cleElec . "/" . $tour]
        );
        try {
            //$entity = $this->Scrut->get([$cleElec, $tour]);
            $param = [
            self:: ELECCLE => $cleElec,
            self:: SCRUTOUR => $tour,
            ];
            /* Proc => pas de résultat */
            $this->methodeStockee($this->_param2FuncDeleteScrut($param));
            $this->Flash->success($msgOk);
        } catch (Exception $exc) {
            $this->Flash->error($exc);
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Efface une candidature attribuée à
     * une Entité géogr.
     * d'un scrutin donné
     *
     * @param trings $candId - Identifiant de Candidature
     *
     * @return response
     */
    public function deleteCandEgScrutin($candId = null)
    {
        $this->request->allowMethod(['post', 'delete', 'get']);
        $pk = [AppTable::CANDID => $candId,];
        $this->modifScrutinCandidatureMemorise($pk);

        $msgOk = __(
            "La candidature [{0}] à [{1}] "
                . "pour le scrutin [{2}] a été effacée.",
            [
                $this->modifScrutinCandidatureLireValue("ETIQ_CLE"),
                $this->modifScrutinEnGeoLire(AppTable::EGDESI),
                $this->modifScrutinScrutinLire(AppTable::TYELCODE) . "::" .
                $this->modifScrutinScrutinLire(AppTable::ELECLIB),
                ]
        );
        try {
            /*
              ! $entity = $this->Scrut->get([$cleElec, $tour]);
             */
            $param = ["PARCANDID" => $candId,];
            /* Proc => pas de résultat */
            $n = \strtoupper("PROC_DEL_1_CANDIDATURE");

            $params = ["method" => $n, "arrayParams" => [$param],];
            $this->methodeStockee($params);
            $this->Flash->success($msgOk);
        } catch (Exception $exc) {
            $this->Flash->error($exc);
        }
        /**
         * Retour vers la page ayant appelé cette action
         */
        return $this->redirect(
            $this->request->getEnv('HTTP_REFERER')
        );
    }

    /**
     * Action correspondant au bouton Caractéristiques
     * de l'écran modification d'un scrutin.
     * Modification de caractéristique
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - tour du scrutin.
     *
     * @return Response|null Redirects to edit.
     * @throws RecordNotFoundException When record not found.
     */
    public function gestionCaracteristiques($cleElec = null, $tour = null)
    {
        $this->nonImplantee(__FUNCTION__, [$cleElec, $tour]);
    }

    /**
     * Action correspondant au bouton Choix Circonscription
     * de l'écran modification d'un scrutin.
     * Modification de caractéristique
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - tour du scrutin.
     *
     * @return Response|null Redirects to edit.
     * @throws RecordNotFoundException When record not found.
     */
    public function gestionCirconscriptions($cleElec = null, $tour = null)
    {
        $pk = [AppTable::ELECCLE => $cleElec, AppTable::SCRUTTOUR => $tour];
        $this->modifScrutinScrutinMemorise($pk);
        //dd(__METHOD__, $this->modifScrutinScrutinLire());
        /**
         * Appeler le contrôleur de La table ENT_GEO_SCRUTIN
         * Lancer l'index, avec :
         * - les paramètres suivants:
         * $cleELec, $tour = pk du scrutin sélectionné
         * - les boutons suivants pour une EG de ce Scrutin:
         *      - Suppression
         *      - Ajout
         */
        /**
         * Récupération de indi_cle dans ELECTION
         */
        /**
         * Préparation d'un filtre pour ne considérer que le scrutin sélectionné
         * [$cleElec,$tour] plus indice de candidature
         */
        $CtlCible = "Entgeoscrutin";
        /**
         * Sauvegarde des éléments de clef primaire dans la session.
         */
        /**
         * ! A virer
         * ! $this->sessionWrite($CtlCible . "." . AppTable::ELECCLE, $cleElec);
         * ! $this->sessionWrite($CtlCible . "." . AppTable::SCRUTTOUR, $tour);
         * ! $this->sessionWrite($CtlCible . "." . AppTable::INDICLE, $indiCle);
         */
        $this->redirect(['controller' => $CtlCible]); //, 'action' => 'index']);
        // dd($election, $scrutin);
        // $this->Flash->set(
        // "Utiliser action index du Controller Engeochoix (à créer ?)
        // pour récupérer ENTG_CLE");
        // $this->nonImplantee(__FUNCTION__, [$cleElec, $tour, $election->INDI_CLE]);
    }

    /**
     * Action correspondant au bouton Rappels
     * de l'écran modification d'un scrutin.
     * Modification de caractéristique
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - tour du scrutin.
     *
     * @return Response|null Redirects to edit.
     * @throws RecordNotFoundException When record not found.
     */
    public function gestionRappels($cleElec = null, $tour = null)
    {
        $this->nonImplantee(__FUNCTION__, [$cleElec, $tour]);
    }

    /**
     * Action correspondant au bouton Candidatures
     * de l'écran modification d'un scrutin.
     * Modification de caractéristique
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - tour du scrutin.
     *
     * @return Response|null Redirects to edit.
     * @throws RecordNotFoundException When record not found.
     */
    public function gestionCandidatures($cleElec = null, $tour = null)
    {
        $this->modifScrutinMemoriseTraitement(self::TRTCAND);
        /**
         * Private Sub CmdCand_Click()
         * Dim NbEgScrutin As Long
         * Boolcand    = True
         * NbEgScrutin = _compteEgScrutin()
         *   If NbEgScrutin > 1 Then
         *    Load frmListeEgScrutin
         *     frmListeEgScrutin.Show vbModal
         * ElseIf NbEgScrutin = 1 Then
         *     OuvrirCandidatureScrutin
         *  Else
         *     MsgBox"Pas de circonscriptions rattachées à ce scrutin", vbExclamation
         *   End If
         *
         * End Sub
         */
        $pk = [AppTable::ELECCLE => $cleElec, AppTable::SCRUTTOUR => $tour];
        $this->modifScrutinScrutinMemorise($pk);

        $NbEgScrutin = $this->_compteEgScrutin($pk);
        $message     = __(
            "{0} {1} pour le scrutin {2}.",
            [
                $NbEgScrutin > 0 ? $NbEgScrutin: __("Aucune"),
                $NbEgScrutin < 2 ?
                Inflector:: singularize(__("circonscription")):
                Inflector:: pluralize(__("circonscription")),
                $this->modifScrutinScrutinLire(AppTable::TYELCODE)
                . "  "
                . $this->modifScrutinScrutinLire(AppTable::ELECLIB),
                ]
        );
        if ($NbEgScrutin < 1) {
            $this->Flash->error($message);
        }
        if ($NbEgScrutin === 1) {
            $this->Flash->set($message);
            $this->nonImplantee(
                __FUNCTION__ . ".OuvrirCandidatureScrutin",
                [$cleElec, $tour]
            );
        }
        if ($NbEgScrutin > 1) {
            $this->Flash->set($message);
            $this->frmListeEgScrutin();
        }
    }

    /**
     * Permet de choisir une entité géographique du scrutin mémorisé
     * afin d'effectuer le type de modification demandé
     * toujours pour le scrutin mémorisé
     *
     * Lancer l'écran de gestion soit
     *
     * 1/ des candidatures
     * 2/ des résultats
     *
     * pour cette entité géogr. pour ce scrutin.
     *
     * @param string $entgCle -
     *
     * @return response
     */
    public function frmListeEgScrutin($entgCle = null)
    {
        //        $kScruTour = AppTable::SCRUTTOUR;
        //        $kTyelCode = AppTable::TYELCODE;
        //        $kTyscCode = AppTable::TYSCCODE;

        if (null === $entgCle) {
            /**
             * Entité géographique inconnue.
             * => choix pour le scrutin donné
             */
            //            $filtre = [
            //            $kScruTour => $this->modifScrutinScrutinLire($kScruTour),
            //            $kTyelCode => $this->modifScrutinScrutinLire($kTyelCode),
            //            $kTyscCode => $this->modifScrutinScrutinLire($kTyscCode),
            //            ];
            $filtre = $this->modifScrutinExtractArrayScrutin(
                [
                    AppTable:: SCRUTTOUR,
                    AppTable:: TYELCODE,
                    AppTable:: TYSCCODE
                    ]
            );
            $this->lanceChoix(self::ENGEOSCRUT, $filtre, __FUNCTION__);
        } else {
            /**
             * Mémorisation complète de l'entité sélectionnée
             */
            $kEntGCle = AppTable::EGCLE;
            $pkeg     = [$kEntGCle => $entgCle];
            $this->modifScrutinEnGeoMemorise($pkeg);
            //dd(__METHOD__, $pkeg, $this->modifScrutinEnGeoLire());

            $vTyTraitement = $this->modifScrutinLireTraitement();
            $action        = "inconnue";
            switch ($vTyTraitement) {
            case self:: TRTCAND:
                $action = $this->_choixActionTraitementCandidature($action);
                break;
            case self:: TRTRESU:
                $action = $this->_choixActionTraitementResultat($action);
                break;
            default:
                /**
                 * Type de traitement inconnu !
                 */
                $m0  = __("Type de traitement inconnu !");
                $msg = __($m0 . " [{0}::{1}]", [$vTyTraitement, __METHOD__,]);
                $this->log($msg);
                $this->Flash->error($msg);
                break;
            }
            if ("inconnue" === $action) {
                return $this->redirect(
                    $this->request->getEnv('HTTP_REFERER')
                );
            } else {
                if (method_exists($this, $action)) {
                    $url = ['controller' => $this->name, 'action' => $action,];
                    return $this->redirect($url);
                } else {
                    $this->nonImplantee($action, $this->modifScrutinEnGeoLire());
                }
            }
        }
    }

    /**
     * Ajoute une Candidature à
     * 1 Entité géogr. ET un Scrutin connus
     *
     * @return void
     */
    public function frmAjoutCandLst()
    {
        /**
         * Activation de la saisie d'un nom de liste libre (<> de l'étiquette)
         * si le type d'élection est Européenne
         *
         * If Left(SelTypElec, 4) = "Euro" Then
         * Me.TxtNomListe.Visible = True
         *             Me.TxtNomListe.SetFocus
         *         End If
         */
        $main_str = $this->modifScrutinScrutinLire(AppTable::TYELCODE);
        /*
         * Nom libre Uniquement pour les européennes
         */
        $str0               = "Euro";
        $start              = 0;
        $length             = strlen($str0);
        $str1               = substr($main_str, $start, $length);
        $case_insensitivity = true;
        $listeNomLibre      = (0 === substr_compare(
            $str0,
            $str1,
            $start,
            $length,
            $case_insensitivity
        ));
        if ($this->request->is(["post"])) {
            dd(__METHOD__, $this->request->getData());
        }
        $this->set(compact('listeNomLibre'));
    }

    /**
     * Écran de saisie et modification
     * des candidatures
     * d’une entité géogr. mémorisée
     * d’un scrutin. mémorisé
     * Important: src/Templates/Scrut/frm_candidature_lst.ctp
     *
     * @return void
     */
    public function frmCandidatureLst()
    {
        $filtre = $this->modifScrutinExtractArrayScrutin(
            [
                AppTable:: ELECCLE,   AppTable:: SCRUTTOUR,
                AppTable:: SCRUTDATE,  /* Ce dernier paramètre pour l'affichage */
            ]
        );
        $filtre[AppTable::EGCLE] = $this->modifScrutinEnGeoLire(AppTable::EGCLE);
        /**
         * Indique si la liste des candidatures est vide ou non.
         * False si vide True sinon
         *
         * ! Nécessaire pour le rendu de la vue associées
         * ! Ne pas supprimer.
         *
         * @var boolean indique si la liste des candidatures est vide ou non.
         * False si vide True sinon
         */
        $isThereCand = (bool) ($this->compteSelCandEgLst($filtre) > 0);
    }

    /**
     * Appelée par un bouton pour effectuer la modification des RÉSULTATS
     * d'UNE Entité Géogr. CONNUE d'un scrutin CONNU.
     *
     * @param string $entgCle - Clef de l'entité géogr. à traiter
     *
     * @return reponse
     */
    public function btnModifResultat1Eg($entgCle = null)
    {
        $this->modifScrutinMemoriseTraitement(self::TRTRESU);
        $this->frmListeEgScrutin($entgCle);
    }

    /**
     * Appelée par un bouton pour effectuer la modification des CANDIDATURES
     * d'UNE Entité Géogr. CONNUE d'un scrutin CONNU.
     *
     * @param string $entgCle - Clef de l'entité géogr. à traiter
     *
     * @return reponse
     */
    public function btnModifCandidature1Eg($entgCle = null)
    {
        $this->modifScrutinMemoriseTraitement(self::TRTCAND);
        $this->frmListeEgScrutin($entgCle);
    }

    /**
     * Gestion des RÉSULTATS d'une entité géogr. d'un scrutin
     *
     * @param string $action -
     *
     * @return string $action - l'action à effectuer
     */
    private function _choixActionTraitementResultat(string $action = "inconnue")
    {
        $kElecCle  = AppTable::ELECCLE;
        $kScruTour = AppTable::SCRUTTOUR;
        $kIndicle  = AppTable::INDICLE;
        $kEntGCle  = AppTable::EGCLE;
        $kTyEnCode = AppTable::TYENCODE;
        $vTyEnCode = $this->modifScrutinScrutinLire($kTyEnCode);
        $filtre    = [
        $kScruTour => $this->modifScrutinScrutinLire($kScruTour),
        $kElecCle  => $this->modifScrutinScrutinLire($kElecCle),
        $kEntGCle  => $this->modifScrutinScrutinLire($kEntGCle),
        $kIndicle  => $this->modifScrutinScrutinLire($kIndicle),
        ];
        $nbcandEg = $this->compteCandEg($filtre);
        if (0 === $nbcandEg) {
            $this->Flash->error(
                __("Aucune candidature dans cette circonscription électorale !")
            );
        } else {
            switch ($vTyEnCode) {
            case AppTable:: TYENPERS:
            case AppTable:: TYENREPO:
                $action = "frmResultatScrutin";
                break;
            case AppTable:: TYENLIST:
                $action = "frmResultatScrutinLst";
                break;

            default:
                /**
                 * Type d'entité candidate inconnu
                 */
                $msg0 = __("Type d'entité candidate inconnu !");
                $msg  = __($msg0 . " [{0}::{1}]", [$vTyEnCode, __METHOD__,]);
                $this->log($msg);
                $this->Flash->error($msg);
                break;
            }
        }
        return $action;
    }

    /**
     * Gestion des CANDIDATURES d'une entité géogr. d'un scrutin
     *
     * @param string $action -
     *
     * @return string l'action à effectuer
     */
    private function _choixActionTraitementCandidature(string $action = "inconnue")
    {
        $kTyEnCode = AppTable::TYENCODE;
        $vTyEnCode = $this->modifScrutinScrutinLire($kTyEnCode);

        /**
         * Gestion des CANDIDATURES d'une entité géogr. d'un scrutin
         */
        switch ($vTyEnCode) {
        case AppTable:: TYENPERS:
        case AppTable:: TYENREPO:
            $action = "frmCandidatureUni";
            break;
        case AppTable:: TYENLIST:
            $action = "frmCandidatureLst";
            break;

        default:
            /**
             * Type d'entité candidate inconnu
             */
            $msg0 = __("Type inconnu d'entité candidate !");
            $msg  = __($msg0 . " [{0}::{1}]", [$vTyEnCode, __METHOD__,]);
            $this->log($msg);
            $this->Flash->error($msg);
            break;
        }
        return $action;
    }

    /**
     * Action correspondant au bouton Commentaires
     * de l'écran modification d'un scrutin.
     * Modification de caractéristique
     *
     * @param string|null $cleElec - clé de l'élection.
     * @param string|null $tour    - tour du scrutin.
     *
     * @return Response|null Redirects to edit.
     * @throws RecordNotFoundException When record not found.
     */
    public function gestionCommentaires($cleElec = null, $tour = null)
    {
        $this->nonImplantee(__FUNCTION__, [$cleElec, $tour]);
    }

    /**
     * Saisie ou choix de l'entité Géogr. passée en paramètre
     *
     * @param string $entgCle - identifiant de l'entité géogr.
     *
     * @return Response
     */
    public function choixEntGeo($entgCle = null)
    {
        $kElecCle  = AppTable::ELECCLE;
        $kScruTour = AppTable::SCRUTTOUR;
        $kIndicle  = AppTable::INDICLE;
        $kEntGCle  = AppTable::EGCLE;
        if (null === $entgCle) {
            /* Entité géographique inconnue. */
            $kTyEgCode = AppTable::TYEGCODE;
            $vTyEgCode = $this->modifScrutinScrutinLire($kTyEgCode);
            $this->lanceChoix(
                self:: ENGEO,
                [$kTyEgCode => $vTyEgCode],
                __FUNCTION__
            );
        } else {
            /**
             * Entité géographique déjà choisie
             * Est-elle dans le scrutin concerné ?
             * Ouverture du formulaire pour les résultats
             * lancer l'action du contrôleur adéquat.
             * Initialisation des variables globales décrivant l'eg
             * selEntgCle   = Me.DataGridEgResScrutin.Columns(3)
             * selEntgDesi  = Me.DataGridEgResScrutin.Columns(2)
             * selEntgInsee = Me.DataGridEgResScrutin.Columns(0)
             * selTyEntg    = Me.DataGridEgResScrutin.Columns(1)
             */
            /* Mémorisation complète de l'entité sélectionnée */
            $pkeg = [$kEntGCle => $entgCle];
            $this->modifScrutinEnGeoMemorise($pkeg);
            /**
             * Ouverture du formulaire pour les résultats
             */
            $pk = [
                $kIndicle  => $this->modifScrutinScrutinLire($kIndicle),
                $kEntGCle  => $entgCle,
                $kElecCle  => $this->modifScrutinScrutinLire($kElecCle),
                $kScruTour => $this->modifScrutinScrutinLire($kScruTour),
            ];
            $nbCandEgSc   = $this->_compteCandidaturesParEG($pk);
            $tyEntiteCode = $this->modifScrutinScrutinLire(AppTable::TYENCODE);
            $action       = "index";
            if ($this->_egIdentiquesOuCantonale()) { //identiques ou eg canton
                switch ($tyEntiteCode) {
                case "Personne":
                case "Réponse" :
                    if (0 < $nbCandEgSc) {
                        $eg = $this->modifScrutinEnGeoLire();
                        $action = "frmResultatScrutin";
                    } else {
                        /* Ouverture impossible du formulaire pour les résultats */
                        $message = __(
                            "Aucune candidature dans [{0}].",
                            [$this->modifScrutinEnGeoLire(AppTable::EGDESI)]
                        );
                        $this->Flash->error($message);
                    }
                    break;
                case "Liste":
                    if ((0 < $nbCandEgSc)
                        or ("Municipale" === $this->modifScrutinScrutinLire(
                            AppTable:: TYELCODE
                        ))
                    ) {
                        $action = "frmResultatScrutinLst";
                        /*
                        * $eg = $this->modifScrutinEnGeoLire();
                        * $this->nonImplantee($action, print_r($eg, true));
                        */
                    } else {
                        /* Ouverture impossible du formulaire pour les résultats */
                        if ("Municipale" === $this->modifScrutinScrutinLire(
                            AppTable:: TYELCODE
                        )
                        ) {
                            $message = __(
                                "Aucune candidature dans [{0}].",
                                [$this->modifScrutinEnGeoLire(AppTable::EGDESI)]
                            );
                            $this->Flash->error($message);
                        }
                        if (0 < $nbCandEgSc) {
                            $message = __("Ce n'est pas une Municipale.");
                            $this->Flash->error($message);
                        }
                    }
                    break;
                } // Switch
            } else { // différentes ou eg pas canton
                switch ($tyEntiteCode) {
                case "Personne":
                case "Réponse" :
                    $action = "frmAutResultatScrutin";
                    break;
                case "Liste":
                    $action = "frmAutResultatScrutinLst";
                    break;
                }
                $eg = $this->modifScrutinEnGeoLire();
                $this->nonImplantee($action, print_r($eg, true));
            }
            return $this->redirect(['action' => $action]);
        }
    }

    /**
     * Gestion des résultats
     *
     * @param type $elec_cle  -
     * @param type $scru_tour -
     *
     * @return Response
     */
    public function gestionResultats($elec_cle = null, $scru_tour = null)
    {
        /**
         * Reprenons le fonctionnement du source en Visual Basic. BREUM !
         *
         * Private Sub CmdResul_Click()
         * Dim NbEgScrutin As Long
         * NbEgScrutin         = _compteEgScrutin()
         * Boolcand            = False
         * If Trim(SelTypScru) = "National" And NbEgScrutin > 0 Then
         *      Load frmListeEgResScrutin
         *      frmListeEgResScrutin.Show vbModal
         * ElseIf Trim(SelTypScru) = "Partiel" And NbEgScrutin = 1 Then
         *     OuvrirResultatScrutin
         *      Else
         *     MsgBox"Pas de circonscriptions rattachées à ce scrutin", vbExclamation
         *   End If
         * End Sub
         */
        /**
         * Voici le Code de Ouvrir ResultatScrutin
         *
         * Public Sub OuvrirResultatScrutin()
         * Dim NbEgScrutin As Long
         *
         * NbEgScrutin    = _compteEgScrutin()
         * If NbEgScrutin = 1 Then
         *     ' verif nombre Candidature
         * If CompteCandEg() = 0 Then
         *       MsgBox "Pas de candidatures rattachées à ce scrutin.", vbExclamation
         *     Else
         *        If Trim(SelTypEnt) <> "Liste" Then
         *           Load frmResultatScrutin
         *           frmResultatScrutin.Show vbModal
         *           Else
         *           Load frmResultatScrutinLst
         *           frmResultatScrutinLst.Show vbModal
         *           End If
         *     End If
         * ElseIf NbEgScrutin = 0 Then
         *      "Pas de circonscriptions rattachées à ce scrutin", vbExclamation
         *   Else
         *      Load frmListeEgResScrutin
         *      frmListeEgResScrutin.Show vbModal
         *   End If
         * End Sub
         */
        $kElecCle  = AppTable::ELECCLE;
        $kScruTour = AppTable::SCRUTTOUR;
        $kEntGCle  = AppTable::EGCLE;
        /**
         * Effacement d'un événtuel précédent…
         */
        $this->sessionDelete(self::MODIFSCRUTIN);
        /**
         * Mémorise le scrutin au complet, dans une variable de session
         */
        $pkScrut = [$kElecCle => $elec_cle, $kScruTour => $scru_tour];
        $this->modifScrutinScrutinMemorise($pkScrut);
        /**
         * Cherchons les entitésgéographiques correspondantes,
         * au scrutin considéré.
         */
        $table = $this->getTableLocator()->get(
            "EntGeoScrutin",
            ['connection' => $this->getActiveConnexion()]
        );
        $stmt = $table->find()->where($pkScrut);

        /**
         ** Nbre d'entité géographiques associées à ce scrutin
         */
        $egScrutinCount = $stmt->count();


        /**
         * Type de scrutin
         */
        $typScrutin = $this->modifScrutinScrutinLire(AppTable::TYSCCODE);
        if (($typScrutin === "National") and ($egScrutinCount > 0)) {
            /**
             * Saisie Résultats EG du Scrutin sélectionné
             */
            /**
             * ! Il faut impérativement choisir !
             * ! => Ne pas fournir d'identifiant Entité géo !
             */
            $this->choixEntGeo();
        } elseif (($typScrutin === "Partiel") and ($egScrutinCount = 1)) {
            /**
             * Cherchons l'entité géographique qui nous intéresse,
             * forcément la première vu qu'elle est unique
             */
            $entity = $stmt->first()->toArray();
            $this->modifScrutinEnGeoMemorise(
                [
                    $kEntGCle => $entity[$kEntGCle]
                ]
            );
            $this->ouvrirResultatScrutin();
        } else {
            $this->Flash->error(
                __("Pas de circonscription rattachée à ce scrutin.")
            );
        }
        //$this->Flash->set(
        //"créer une fenêtre pour gérer les résultats de [$typScrutin]
        // $elec_cle $scru_tour ");
        $this->redirect(['controller' => 'scrut', 'action' => 'index']);
    }

    /**
     * Essai pour composant HTML HandsOnTable
     *
     * @return void
     */
    public function hot1load()
    {
        $answ["data"] = $this->hotGetGrid();
        /**
         * Options JSON
         */
        $this->set('_jsonOptions', JSON_PRETTY_PRINT | !JSON_FORCE_OBJECT);
        // Définit les variables de vues qui doivent être sérialisées.
        //$this->set('data', $data);
        $this->set($answ);
        // Spécifie quelles variables de vues JsonView doit sérialiser.
        $this->set('_serialize', array_keys($answ));
        //$this->set('_serialize', $answ);
    }
}