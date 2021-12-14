<?php

namespace App\Controller;

use ___;
use App\Controller\AppController;
use App\Model\Table\AppTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Log\Log;

/**
 * EntGeoScrutin Controller
 * Table listant les entités géographiques (EG) liées à un scrutin.
 *
 * Note :
 * La session doit contenir les valeurs des parties de la clef primaire
 * permettant ainsi de trouver l'EG considérée liée au scrutin considéré.
 *
 * @property \App\Model\Table\EntGeoScrutinTable $EntGeoScrutin
 *
 * @method \App\Model\Entity\EntGeoScrutin[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class EntgeoscrutinController extends AppController {

    var $kCle = AppTable::ELECCLE;
    var $kTour = AppTable::SCRUTTOUR;
    var $kIndice = AppTable::INDICLE;
    var $kElection = AppTable::SETTABELECT; //'election'

    /**
     *
     * @return type
     */

    private function getLibelleScrutin()
    {
        $libelle = "Impossible lire Scrutin ";
        if ($this->isScrutinSelectedExist()) {
            $tyel_code = $this->modifScrutinScrutinLire(AppTable::TYELCODE);
            $elec_lib = $this->modifScrutinScrutinLire(AppTable::ELECLIB);
            $tysc_code = $this->modifScrutinScrutinLire(AppTable::TYSCCODE);
            $numTour = $this->modifScrutinScrutinLire(AppTable::SCRUTTOUR);
            $lscrutin = '%s %s %s - Tour : %s';
            $libelle = sprintf(
                    $lscrutin, $tyel_code, $tysc_code, $elec_lib, $numTour
            );
        }
        return $libelle;
    }

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        //dd(__METHOD__);
        $libelle = $this->getLibelleScrutin();
        // dd($lscrutin, $args, $libelle);
        $msg = __("Gestion Entités Géographiques / scrutin [{0}]", [$libelle]);
        //$this->Flash->set($msg); inutile car datagridScrutinCourant désormais
        $this->set(compact('msg'));
        //dd(__METHOD__, $aInfo);
        /*
          $entGeoScrutin = $this->paginate($this->EntGeoScrutin);

          $this->set(compact('entGeoScrutin'));
         * 
         */
    }

    public function getdatagrid(array $options = [])
    {
        /*
         * Pour Filtre Search
         * Sauvegarde des éléments de clef primaire dans la session.
         */
        $this->sessionWrite(
                $this->name . "." . AppTable::INDICLE,
                $this->modifScrutinScrutinLire(AppTable::INDICLE)
        );
        $this->sessionWrite(
                $this->name . "." . AppTable::SCRUTTOUR,
                $this->modifScrutinScrutinLire(AppTable::SCRUTTOUR)
        );
        $this->sessionWrite(
                $this->name . "." . AppTable::ELECCLE,
                $this->modifScrutinScrutinLire(AppTable::ELECCLE)
        );
        $options["contain"] = ['Election', 'Engeo'];
        /*
          Log::info(
          __METHOD__ . "::" . __LINE__ . "::"
          . print_r($this->sessionRead($this->name), true)
          . print_r($options, true)
          );
         * 
         */
        parent::getdatagrid($options);
    }

    /**
     * View method
     *
     * @param string|null $id Ent Geo Scrutin id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $entGeoScrutin = $this->EntGeoScrutin->get($id,
                [
            'contain' => []
        ]);

        $this->set('entGeoScrutin', $entGeoScrutin);
    }

    /**
     * Prépare le tableau d'appel à la Procédure stockée
     * PROC_INS_1_EG_SCRU
     *
     * @param string $raz
     * @param string $inCan
     * @param string $typEg
     * @param string $select
     * @return type
     */
    private function param2ProcAdd1EgScru(
    $indicle = null, $entgCle = null, $elecCle = null, $numtour = null
    )
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \Strtoupper("PROC_INS_1_EG_SCRU");
        /**
         *  $keys
         */
        $k = [
            "PARELECCLE",
            "PAREGCLE",
            "PARINDICLE",
            "PARNUMTOUR",
        ];
        $v = [$elecCle, $entgCle, $indicle, $numtour];
        $arrayParams = [array_combine($k, $v)];
        return ["method" => $n, "arrayParams" => $arrayParams,];
    }

    private function param2ProcInsRappels($elecCle, $typElec, $egCle, $numTour)
    {
        /**
         * TEREADM1.PROC_INIT_REF_PART_PARTIELLE
         * PARELECCLE
         * PARTYPELEC
         * PARDATESCRUT -- BREUM !
         * PAREGCLE
         */
        /*
         * Détermination de la date de scrutin
         */
        $alias = "Scrutin";
        $tblScrut = $this->getTableLocator()->get($alias,
                ['connection' => $this->getActiveConnexion()]);
        $scrutEntity = $tblScrut->get([$elecCle, $numTour]);
        $dateScru = $scrutEntity[AppTable::SCRUTDATE];
        //dd(__METHOD__ . '::' . __LINE__, $dateScru, $scrutEntity);
        $k = [
            "PARELECCLE",
            "PARTYPELEC",
            "PARDATESCRUT",
            "PAREGCLE",
        ];
        $v = [
            $elecCle,
            $typElec,
            $dateScru,
            $egCle,
        ];
        $arrayParams = [array_combine($k, $v)];
        return ["method" => $n, "arrayParams" => $arrayParams,];
    }

    /**
     * Add method based on VB Application
     * Private Sub CmdChoix_Click()
     * On Error GoTo CHOIX_ERR
     *   Me.MousePointer = vbHourglass
     *   selEntgCle = Me.DataGridSelEgCand.Columns(0)
     *   With DataEnvironment1
     *    .CmdAjoutEG SelElec, selEntgCle, SelIndiCle, SelNumTour
     *   End With
     *   Strmessage = Me.DataGridSelEgCand.Columns(3) & " " _
     *             & Me.DataGridSelEgCand.Columns(4) & " ajouté(e) !"
     *   
     *   MsgBox Strmessage, vbInformation
     *     
     *   If Trim(SelTypScru) = "Partiel" Then
     *    ' insertion des rappels
     *    DataEnvironment1.cmdInitRappelScrutinPartiels SelElec, Trim(SelTypElec), SelDate, selEntgCle
     *     ' pas de second choix si partielles
     *     Unload Me
     *   End If
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($entgCle = null)
    {
        /**
         * Préparation du message résultant de l'action.
         */
        $msg = [
            'error' => __('The ent geo scrutin could not be added. Please, try again.'),
            'success' => __('The ent geo scrutin has been added.'),
        ];
        $CtlCible = "Engeo";
        if (null === $entgCle) { // lance le choix
            $filtre = [
                AppTable::TYEGCODE => $this->modifScrutinScrutinLire(AppTable::TYEGCODE)
            ];
            $this->lanceChoix($CtlCible, [$filtre], __FUNCTION__);
        }
        else { // récupère le choix
            if ($this->isScrutinSelectedExist()) {
                $indicle = $this->modifScrutinScrutinLire(AppTable::INDICLE);
                $elecCle = $this->modifScrutinScrutinLire(AppTable::ELECCLE);
                $numTour = $this->modifScrutinScrutinLire(AppTable::SCRUTTOUR);
                /**
                 * Appel à la procédure stockée PROC_DEL_1_EG_SCRU
                 */
                $param = $this->param2ProcAdd1EgScru(
                        $indicle, $entgCle, $elecCle, $numTour
                );
                //dd(__METHOD__, __LINE__, $param);
                $result = $this->methodeStockee($param);
                $typeScrutin = $this->modifScrutinScrutinLire(AppTable::TYSCCODE);
                if ($result["isOk"]) {
                    /**
                     * Gestion insertion des rappels pour scrutin PARTIEL
                     * NON TESTÉ NON TESTÉ NON TESTÉ NON TESTÉ NON TESTÉ
                     * Car au 20200131 les scrutins Partiels ne sont plus gérés.
                     */
                    if ("Partiel" === $typeScrutin) {
                        /**
                         *   Insertion des rappels
                         */
                        $pInsRap = $this->param2ProcInsRappels(
                                $elecCle, $typeScrutin, $entgCle, $numTour
                        );
                        $result2 = $this->methodeStockee($pInsRap);
                        if (!$result2["isOk"]) {
                            $this->Flash->error(
                                    print_r(
                                            [
                                'CleElec' => $elecCle,
                                'TypeScrutin' => $typeScrutin,
                                'EntgCle' => $entgCle,
                                'SCRU_TOUR' => $numTour
                                            ]
                                            , true
                                    )
                            );
                            $this->Flash->error(print_r($result2["Result"], true));
                        }
                    }
                    $this->Flash->success($msg['success']);
                    $this->Flash->success($this->modifScrutinScrutinLire(AppTable::ELECLIB));
                }
                else {
                    $this->Flash->error($msg['error']);
                    $this->Flash->error(
                            print_r(
                                    [
                        'CleElec' => $elecCle,
                        'TypeScrutin' => $typeScrutin,
                        'EntgCle' => $entgCle,
                        'SCRU_TOUR' => $numTour
                                    ]
                                    , true
                            )
                    );
                    $this->Flash->error(print_r($result["Result"], true));
                }
                return $this->redirect(['action' => 'index']);
            }
            else {
                $this->Flash->set(__("Veuillez resélectionner un Scrutin."));
                return $this->redirect(['controller' => 'Scrut', 'action' => 'index']);
            }
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Ent Geo Scrutin id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $entGeoScrutin = $this->EntGeoScrutin->get($id,
                [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $entGeoScrutin = $this->EntGeoScrutin->patchEntity($entGeoScrutin,
                    $this->request->getData());
            if ($this->EntGeoScrutin->save($entGeoScrutin)) {
                $this->Flash->success(__('The ent geo scrutin has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ent geo scrutin could not be saved. Please, try again.'));
        }
        $this->set(compact('entGeoScrutin'));
    }

    /**
     * Prépare le tableau d'appel à la Procédure stockée
     * PROC_DEL_1_EG_SCRU
     *
     * @param string $raz
     * @param string $inCan
     * @param string $typEg
     * @param string $select
     * @return type
     */
    private function param2ProcDel1EgScru(
    $indicle = null, $entgCle = null, $elecCle = null, $numtour = null
    )
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \Strtoupper("PROC_DEL_1_EG_SCRU");
        /**
         *  $keys
         */
        $k = [
            "PARELECCLE",
            "PAREGCLE",
            "PARINDICLE",
            "PARNUMTOUR",
        ];
        $v = [$elecCle, $entgCle, $indicle, $numtour];
        $arrayParams = [array_combine($k, $v)];

        return ["method" => $n, "arrayParams" => $arrayParams,];
    }

    /**
     * Delete method
     *
     * @param string|null $indicle
     * @param string|null $entgCle
     * @param string|null $elecCle
     * @param string|null $numtour
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete(
    $indicle = null, $entgCle = null, $elecCle = null, $numtour = null
    )
    {
        //$this->request->allowMethod(['post', 'delete']);
        /**
         * Suivons le code VB initial dont voici le contenu
         * Private Sub cmdDelete_Click()
         * On Error GoTo DEL_ERR
         * Dim VarEntgcle As Long
         * Strmessage = "Confirmez vous la suppression de cette circonscription électorale ?"
         *   If MsgBox(Strmessage, vbQuestion + vbYesNo) = vbYes Then
         *     Strmessage = Me.DataGridEg_Scrutin.Columns(1) & " " & Me.DataGridEg_Scrutin.Columns(2) & " supprimé(e) !"
         *     VarEntgcle = Val(Me.DataGridEg_Scrutin.Columns(3).Text)
         *     DataEnvironment1.cmdDelEg_Scrutin SelElec, VarEntgcle, SelIndiCle, SelNumTour
         *
         *     MsgBox Strmessage, vbInformation
         *     Form_Activate
         *   End If
         *   Exit Sub
         * DEL_ERR:
         *   GestionErreur
         * End Sub
         * 
         */
        /**
         * La confirmation de la demande de suppression s'effectue
         * au niveau du navigateur du client.
         */
        /**
         * Préparation du message résultant de l'action.
         */
        $msg = [
            'error' => __("L'entité géogr. ne peut être retirée de ce scrutin !  Veuillez Réessayer."),
            'success' => __("L'entité géogr. a été supprimée de ce scrutin."),
        ];
        /**
         * Appel à la procédure stockée PROC_DEL_1_EG_SCRU
         */
        $param = $this->param2ProcDel1EgScru($indicle, $entgCle, $elecCle,
                $numtour);
        //dd(__METHOD__, __LINE__, $param);
        $result = $this->methodeStockee($param);
        if ($result["isOk"]) {
            $this->Flash->success($msg['success']);
        }
        else {
            $this->Flash->error($msg['error']);
            $this->Flash->error(print_r($result["Result"], true));
        }
        return $this->redirect(['action' => 'index']);
    }

}
