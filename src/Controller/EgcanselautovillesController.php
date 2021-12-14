<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\AppTable;
use Cake\Chronos\Chronos;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Log\Log;

/**
 * EgCandidature Controller
 *
 * @property \App\Model\Table\EgCandidatureTable $EgCandidature
 *
 * @method \App\Model\Entity\EgCandidature[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class EgcanselautovillesController extends AppController {

    /**
     * #FMB201912271525:
     * @TODO A remplacer par action index , pas besoin de paramètres
     * @TODO à faire pour simplifier le code, penser à funct_Egcanselautovilles.js
     * Les paramètres sont déjà tamponnés dans le bon contrôleur.
     * #FMB201912271525:
     * @param type $indicle
     * @param type $tyegcode
     * @return type
     */
    public function a_virer_pretraitemenrr($indicle, $tyegcode)
    {
        /**
         * @TODO : Vérification des deux paramètres, tamponnage dans la session.
         */
        /**
         * Tamponne les données de session
         */
        $gdata = [self::INDICLE => $indicle, self::TYEGCODE => $tyegcode];
        $this->sessionMergeArray($this->name, $gdata);

        return $this->redirect(['action' => 'index']);
    }

    public function getdatagridgauche(array $options = [])
    {
        // contrôleur des valeurs de classification des EG
        $tblCtl = AppTable::VCGEO;
        /** Tamponne les options de requête dans le bon Controleur */
        $opts = array_merge($options, $this->request->getData());
        $this->sessionMergeArray($tblCtl, $opts);
        /** Journalise */
        //$infoOpt = ['scope' => ['getdatagrid']];
        //Log::info(__METHOD__ . "::" . __LINE__ . $tblCtl . PHP_EOL, $infoOpt);
        /** Passe la main à qui va bien */
        return $this->redirect(['controller' => $tblCtl, 'action' => 'getdatagrid',]);
    }

    /**
     * Datagrid à DROITE
     * @param array $options
     * @return type
     */
    public function getdatagrid(array $options = [])
    {
        /** Journalise */
        /* $infoOpt = ['scope' => ['getdatagrid']]; // dans getdatagrid.log */
        /** Journalise */
        /* Log::info(__METHOD__ . "::" . __LINE__ . "::" . $tblCtl, $infoOpt); */
        /* Log::info(print_r($opts, true), $infoOpt); */

        /** Tamponne les options de requête dans le bon Contrôleur */
        $tblCtl = AppTable::EGCAN; // contrôleur des EG Candidature
        $opts = array_merge($options, $this->request->getData());
        /**
         * Attention : gestion au mieux entg_select
         * Si valeur dans un état indéterminé alors forçage à "0" 
          $nchp = AppTable::EGCANSEL;
          if (key_exists($nchp, $opts)) {
          $opts[$nchp] = ($opts[$nchp] === "") ? "0" : $opts[$nchp];
          }
         */
        $this->sessionMergeArray($tblCtl, $opts);

        /** Passe la main à qui va bien */
        return $this->redirect(['controller' => $tblCtl, 'action' => 'getdatagrid',]);
    }

    public function cbIndiCle($selected = null)
    {
        // contrôleur des valeurs de classification des EG
        /**
         * Tamponne les données de session
         */
        $gdata = [self::TYELCODE => $selected];
        $this->sessionMergeArray('Egcan', $gdata);

        return $this->redirect(
                        [
                            'controller' => 'Egcan',
                            'action' => 'cbIndiCle',
                            $selected
                        ]
        );
    }

    /**
     *
     * @param type $selected
     * @return type
     */
    public function cbTyegCode($selected = null)
    {
        // contrôleur des valeurs de classification des EG
        /**
         * Tamponne les données de session
         */
        $gdata = [self::INDICLE => $selected];
        $this->sessionMergeArray('Egcan', $gdata);

        return $this->redirect(
                        [
                            'controller' => 'Egcan',
                            'action' => 'cbTyegCode',
                            $selected
                        ]
        );
    }

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        /*
          $egCandidature = $this->paginate($this->EgCandidature);

          $this->set(compact('egCandidature'));
         */
    }

    /**
     * View method
     *
     * @param string|null $id Eg Candidature id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $egCandidature = $this->EgCandidature->get($id,
                [
            'contain' => []
        ]);

        $this->set('egCandidature', $egCandidature);
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $egCandidature = $this->EgCandidature->newEntity();
          if ($this->request->is('post')) {
          $egCandidature = $this->EgCandidature->patchEntity($egCandidature,
          $this->request->getData());
          if ($this->EgCandidature->save($egCandidature)) {
          $this->Flash->success(__('The eg candidature has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The eg candidature could not be saved. Please, try again.'));
          }
          $this->set(compact('egCandidature'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Eg Candidature id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $egCandidature = $this->EgCandidature->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $egCandidature = $this->EgCandidature->patchEntity($egCandidature,
          $this->request->getData());
          if ($this->EgCandidature->save($egCandidature)) {
          $this->Flash->success(__('The eg candidature has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The eg candidature could not be saved. Please, try again.'));
          }
          $this->set(compact('egCandidature'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Eg Candidature id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Flash->info(
                __("Valeur reçue pour traiter l'effacement : $id ")
        );
        return $this->redirect(['action' => 'index']);
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $this->request->allowMethod(['post', 'delete']);
          $egCandidature = $this->EgCandidature->get($id);
          if ($this->EgCandidature->delete($egCandidature)) {
          $this->Flash->success(__('The eg candidature has been deleted.'));
          }
          else {
          $this->Flash->error(__('The eg candidature could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

    /**
     * Prépare le tableau d'appel à la Procédure stockée
     * PROC_SEL_AUTO_EG_CAND_PAR_CLAS
     *
     * @param string $raz
     * @param string $inCan
     * @param string $typEg
     * @param string $select
     * @return type
     */
    private function param2ProcSelectAutoVille(string $raz, string $inCan,
            string $typEg, string $select)
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = \Strtoupper("PROC_SEL_AUTO_EG_CAND_PAR_CLAS");
        /**
         *  $keys
         */
        $k = ["PARRAZ", "PARINDICLE", "PARTYPEG", "PARVALCLAS",];
        /**
         * Fabrication du lot de traitement
         */
        $valcle = explode(",", $select);
        $arrayParams = [];
        foreach ($valcle as $key => $value) {
            /**
             * Values
             * "0" => BREUM !  semble être la seule manière de coder false...
             */
            $v = ["0", $inCan, $typEg, $value];
            $arrayParams[] = array_combine($k, $v);
        }
        if ($raz === "true") {
            /**
             * Ne faire qu'une seule fois la RAZ
             */
            $arrayParams[0]["PARRAZ"] = "1";
        }
        /**
         * prépare le résultat
         */
        return ["method" => $n, "arrayParams" => $arrayParams,];
        //dd(__METHOD__ . "::" . __LINE__, $raz, $params);
    }

    /**
     * Prépare le tableau d'appel à la Procédure stockée PROC_
     *
     * @param string $raz
     * @param string $inCan
     * @param string $typEg
     * @param string $select
     */
    public function selectAutoVille(string $raz, string $inCan, string $typEg,
            string $select)
    {
        $context = ['scope' => ['error']];
        $params = $this->param2ProcSelectAutoVille($raz, $inCan, $typEg, $select);
        try {
            $result = $this->methodeStockee($params);
        }
        catch (Exception $exc) {
            $result["isOk"] = false;
            /**
             * Jounaliser l'erreur
             */
            //$tag = Chronos::now()->format(Chronos::ISO8601);
            $tag = Chronos::now()->format("YmdHis");
            $tag .= " " . __METHOD__ . "::" . __LINE__;
            Log::debug(">" . $tag);
            Log::debug($exc->getMessage(), $context);
            Log::debug("<" . $tag);
            $this->Flash->error(__("Vérifier dans error.log au Tag [{0}]", $tag));
        }
        if ($result["isOk"]) {
            $this->Flash->success(
                    __('Sélection automatique des villes effectuée.')
            );
        }
        else {
            $this->Flash->error(
                    __('Sélection automatique des villes interrompue. Essaye encore !')
            );
            $this->Flash->error(print_r($result["Result"], true));
        }
        // dd(__METHOD__ . "::" . __LINE__, $raz, $params, $result["Result"]);


        return $this->redirect(['action' => 'index']);
    }

}
