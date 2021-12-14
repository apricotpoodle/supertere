<?php

namespace App\Controller;

//use Cake\I18n\Time;


use ___;
use App\Controller\AppController;
use App\Model\Table\AppTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;
use Exception;
use function dd;

/**
 * Election Controller
 *
 * @property \App\Model\Table\ElectionTable $Election
 *
 * @method \App\Model\Entity\Election[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class ElectController extends AppController
{

    public $ELEC_CLE = "1234567"; // pour appel proc. stockée…

    /**
     * Index method
     *
     * @return Response|null
     */

    public function index()
    {
        //$election = $this->paginate($this->Elect);
        //$this->set(compact('election'));
    }

    /**
     * Get DataGrid JSON
     *
     * @param array options options du finder, entre autres…
     * @return Response|null
     */
    public function getdatagrid(array $options = [])
    {
        parent::getdatagrid($options);
    }

    /**
     * View method
     *
     * @param string|null $id Election id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $election = $this->Election->get(
            $id,
            [
                'contain' => []
            ]
        );

        $this->set('election', $election);
    }

    /**
     * set comboboxes for Entity Election
     */
    private function setComboBoxes4ElectionEntity()
    {
        /**
         * Liste les indices de candidature
         */
        $listIncan = $this->Elect->incan->find('list');
        /* défaut indice de candidature */
        $alias = "incan";
        $nchp = $this->name . ".INDI_CLE";
        $table = TableRegistry::getTableLocator()->get(
            $alias,
            ['connection' => $this->getActiveConnexion()]
        );
        $defaultIncan = $table->defautInCan();
        $defaultIncan = $this->sessionCheck($nchp) ?
            $this->sessionRead($nchp) : $table->defautInCan();
        $this->set('selIncan', $listIncan->toArray());
        $this->set("defaultIncan", $defaultIncan);
        /**
         * liste les types de scrutin
         */
        $this->set('selTscru', $this->Elect->Tscru->find('list'));
        /**
         * Liste les types d'entité Candidate
         */
        $this->set('selTenti', $this->Elect->Tenti->find('list'));
        /**
         * Liste les types d'entité Géogr.
         */
        $this->set('selTenge', $this->Elect->Tenge->find('list'));
        /**
         * Liste les types de rattachement
         */
        $cleTratt = $this->name . "." . "TYRT_CODE";
        $listTratt = $this->Elect->Tratt->find('list');
        $arrayTratt = $listTratt->toArray();
        krsort($arrayTratt);
        $defaultTratt = $this->sessionCheck($cleTratt) ?
            $this->sessionRead($cleTratt) : array_shift($arrayTratt);
        $this->set('selTratt', $listTratt->toArray());
        $this->set('defaultTratt', $defaultTratt);
        /**
         * Liste les types d'élection.
         *
         * BREUM ! LA FORMALISATION ! BORDEL !
         */
        $alias = "typeElection";
        $table = TableRegistry::getTableLocator()->get(
            $alias,
            ['connection' => $this->getActiveConnexion()]
        );
        $query = $table->find(
            'all',
            [
                'fields' => [self::TYELCODE],
                'group' => self::TYELCODE, //  por sol'ec'o, unik'ec'o
                'order' => self::TYELCODE,
            ]
        );
        /**
         * Calling all() will execute the query and return the result set.
         *
         * all() far'os demand'o kaj proviz'as far'aĵ'ar'o
         */
        $results = $query->all();
        /**
         * Converting the query to a key-value array.
         * Extract the right column,
         * then combine this column in a key value array
         *
         * proviz'as ŝlos'il-valor'a tabel'o por TYEL_CODE
         */
        $kv = array_column($results->toArray(), self::TYELCODE);
        $data = array_combine($kv, $kv);

        $this->set('selTelec', $data);
    }

    /**
     * Prépare le tableau d'appel à la Procédure stockée PROC_INS_ELEC_SCRU
     * @param array $data : tableau des data à fournir à la procédure
     * @return array
     */
    private function param2ProcInsElecScru(array $data)
    {
        $n = "PROC_INS_ELEC_SCRU";

        $k = [ // $keys
            "PARTYPELE",
            "PARTYPSCRU",
            "PARTYPENT",
            "PARTYPEG",
            "PARINDICLE",
            "PARTYRT",
            "PARELELIB",
            "PARNUMTOUR",
            "PARSCRUDATE",
            "PARELECCLE",
        ];

        $v = [ // Values
            $data[self::TYELCODE],
            $data[self::TYSCCODE],
            $data[self::TYENCODE],
            $data[self::TYEGCODE],
            $data[self::INDICLE],
            $data[self::TYRTCODE],
            $data[self::ELECLIB],
            "01", // forcément !
            $data[self::SCRUDATE], // (ok) string format "yyyy/mm/dd"
            /**
             * Parametre IN OUT (BREUM ! une FONCTION, BORDEL !)
             */
            /**
             * https://www.php.net/manual/fr/function.oci-bind-by-name.php
             *
             * […]
             * Avec Oracle, les variables liées sont habituellement divisées
             * en lien IN pour les valeurs passées à la base de données,
             * et en lien OUT pour les valeurs à retourner à PHP.
             *
             * Une variable liée peut être à la fois en lien IN et OUT.
             * Dans ce cas, le fait de savoir si la variable liée doit être utilisée
             * pour l'entrée ou la sortie sera déterminé au moment de l'exécution.
             *
             * Vous devez spécifier le paramètre maxlength lors de l'utilisation
             * du lien OUT afin que PHP alloue assez de mémoire pour contenir
             * la valeur de retour.
             * […]
             *
             * /!\ Le driver communautaire ne semble pas spécifier maxlength !
             */
            $this->ELEC_CLE, //(ok) mais ne se met pas à jour ! (RE-BREUM !)
        ];
        $params = [
            "method" => $n,
            "arrayParams" => [array_combine($k, $v)],
        ];
        return $params;
    }

    private function param2ProcInsNatEgScrutin(array $data)
    {
        $n = "PROC_INS_NATIO_EG_SCRU";

        $k = [ // $keys
            "PARELECCLE",
            "PARTYEG",
            "PARINDICLE",
            "PARNUMTOUR",
        ];

        $v = [ // Values
            //$data["PARELECCLE"],
            $data[self::ELECCLE],
            $data[self::TYEGCODE],
            $data[self::INDICLE],
            $data[self::NUMTOUR],
        ];
        $params = [
            "method" => $n,
            "arrayParams" => [array_combine($k, $v)],
        ];
        /* dd(__METHOD__ . "::" . __LINE__, $data, $params); */
        return $params;
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /**
         * Créer une nouvelle Élection implique
         * de créer un nouveau scrutin, donc un premier tour,
         * lié à cette nouvelle élection.
         */
        $election = $this->Elect->newEntity();
        if ($this->request->is('post')) {
            /**
             * Insertion dans tables
             * ELECTION et SCRUTIN
             * par Procédure stockée.
             * TEREADM1.PROC_INS_ELEC_SCRU
             */
            $election = $this->Elect->patchEntity(
                $election,
                $this->request->getData()
            );
            /**
             * Insertion dans table ELECTION et SCRUTIN
             * par Procédure stockée
             */
            $election[self::SCRUDATE] = AppTable::formateStringDate4Oracle(
                $this->request->getData(self::SCRUDATE)
            );
            $params = $this->param2ProcInsElecScru($election->toArray());
            //dd(__METHOD__ . "::" . __LINE__, $params);
            try {
                $result = $this->methodeStockee($params);
            } catch (Exception $exc) {
                $result["isOk"] = false;
                $this->Flash->error($exc);
            }
            if ($result["isOk"]) {
                $this->Flash->success(__('The election has been added.'));

                if (is_array($result["Result"])) {

                    foreach ($result["Result"] as $key => $value) {
                        $this->Flash->success($value);
                    }
                }

                /**
                 * Insertion automatique des eg
                 * pour un scrutin national excepté pour les sénatoriales
                 */
                if (
                    ("National" === $election->TYSC_CODE)
                    and (strpos($election->TYEL_CODE, "Sénat") === false)
                ) {
                    $election->ELEC_CLE = $params["out"][0]["PARELECCLE"];
                    $election->NUM_TOUR = $params["afterRequest"][0]["PARNUMTOUR"];
                    $params2 = $this->param2ProcInsNatEgScrutin($election->toArray());
                    try {
                        $result = $this->methodeStockee($params2);
                    } catch (Exception $exc) {
                        $result["isOk"] = false;
                        Log::error(print_r($exc));
                        Log::info(print_r($exc));
                        $this->Flash->error($exc);
                    }
                    //dd(__METHOD__ . "::" . __LINE__, $result);
                    if ($result["isOk"]) {
                        $this->Flash->success(__('Entités géographiques insérées.'));
                        return $this->redirect(['action' => 'index']);
                    } else {
                        $this->Flash->error(__('Problème Insertion entités géographiques'));
                        foreach ($result["Result"] as $key => $value) {
                            $this->Flash->error($value);
                        }
                    }
                }
            } else {
                foreach ($result["Result"] as $key => $value) {
                    $this->Flash->error($value);
                }
            }
        }

        $this->setComboBoxes4ElectionEntity(); // remplissage comboboxes

        /**
         * L'entité élection
         */
        $this->set(compact('election'));
    }

    private function param2ProcUpdElecScru(array $data = [])
    {
        $n = "PROC_UPD_ELEC_SCRU";

        $k = [ // $keys
            "PARTYRT",
            "PARSCRUTOUR",
            "PARELELIB",
            "PARSCRUDATE",
            "PARELECCLE",
        ];

        /** La mise à jour doit petre efective pour tout tour */
        /** Listons les tours de scrutins associés à cette élection */
        $alias = 'scrutin';
        $table = TableRegistry::getTableLocator()->get(
            $alias,
            ['connection' => $this->getActiveConnexion()]
        );
        $query = $table->find(
            'all',
            [
                'fields' => [self::SCRUTOUR, self::SCRUDATE],
                //'group' => self::TYELCODE, //  por sol'ec'o, unik'ec'o
                //'order' => self::SCRUTOUR,
            ]
        );

        $query->where(
            [
                self::ELECCLE => $data[self::ELECCLE]
            ]
        );
        $records = $query->all();
        $arrayParams = [];
        foreach ($records as $key => $value) {

            $v = [ // Values
                $data[self::TYRTCODE],
                $value[self::SCRUTOUR], //$data[self::NUMTOUR],
                $data[self::ELECLIB],
                AppTable::formateStringDate4Oracle(
                    (string) $value[self::SCRUDATE]
                ),
                $data[self::ELECCLE],
            ];
            $arrayParams[] = array_combine($k, $v);
        }
        $params = [
            "method" => $n,
            "arrayParams" => $arrayParams,
        ];
        // dd(__METHOD__ . "::" . __LINE__, $data, $params);
        return $params;
    }

    /**
     * Edit method
     *
     * @param string|null $id Election id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $election = $this->Elect->get($id); //, ['contain' => []]);
        //$toto = $this->Elect->get($id); //, ['contain' => []]);

        if ($this->request->is(['patch', 'post', 'put'])) {
            /**
             * UPdate dans table ELECTION et SCRUTIN
             * par Procédure stockée
             */
            $election = $this->Elect->patchEntity(
                $election,
                $this->request->getData()
            );
            $params = $this->param2ProcUpdElecScru($election->toArray());
            try {
                $result = $this->methodeStockee($params);
            } catch (Exception $exc) {
                $result["isOk"] = false;
                $this->Flash->error($exc);
            }
            //dd(__METHOD__ . "::" . __LINE__, $params);
            if ($result["isOk"]) {
                $this->Flash->success(__('The election has been edited.'));

                if (is_array($result["Result"])) {

                    foreach ($result["Result"] as $key => $value) {
                        $this->Flash->success($value);
                    }
                }
                return $this->redirect(['action' => 'index']);
            } else {
                foreach ($result["Result"] as $key => $value) {
                    $this->Flash->error($value);
                }
            }

            $this->Flash->error(__('The election could not be edited. Please, try again.'));
        }
        $this->setComboBoxes4ElectionEntity(); // remplissage comboboxes
        $this->set(compact('election'));
    }

    /**
     * Prépare le tableau d'appel à la Procédure stockée PROC_DEl_ELECTION
     * @param array $data : tableau des data à fournir à la procédure
     * @return array
     */
    private function param2ProcDelElection(array $data)
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \Strtoupper("PROC_DEL_ELECTION");

        /**
         *  $keys
         */
        $k = ["PARELECCLE",];

        /**
         * Values
         * $data[0] => BREUM !  un Seul Id !
         */
        $v = [$data[0],];

        /**
         * prépare le résultat
         */
        $params = ["method" => $n, "arrayParams" => [array_combine($k, $v)],];

        return $params;
    }

    /**
     * Delete method
     *
     * @param string|null $id Election id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $result = null;
        $this->request->allowMethod(['get', 'post', 'delete']);
        /**
          $election = $this->Election->get($id);
          if ($this->Election->delete($election)) {
          $this->Flash->success(__('The election has been deleted.'));
          }
          else {
          $this->Flash->error(__('The election could not be deleted. Please, try again.'));
          }

         *
         */
        try {
            $params = $this->param2ProcDelElection([$id]);
            $result = $this->methodeStockee($params);
        } catch (Exception $exc) {
            $this->Flash->error($exc);
        }
        if ($result["isOk"]) {
            $this->Flash->success(__('The election has been deleted.'));
        } else {
            $this->Flash->error(
                __('The election could not be deleted. Please, try again.')
            );
            $this->Flash->error($result["Result"]);
        }
        return $this->redirect(['action' => 'index']);
    }
}
