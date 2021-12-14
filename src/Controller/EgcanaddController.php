<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\AppTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use function dd;

/**
 * EgCandidature Controller
 *
 * @property \App\Model\Table\EgCandidatureTable $EgCandidature
 *
 * @method \App\Model\Entity\EgCandidature[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class EgcanaddController extends AppController
{

    public function index()
    {
        $idx = $this->name . "." . AppTable::INDICLE . "CIBLE";
        $icc = $this->sessionRead($idx)[0];
        $this->Flash->set("Indice de candidature cible : [$icc]");
    }

    /**
     * Datagrid
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
        $tblCtl = AppTable::EGCAN;                                   // contrôleur des EG Candidature
        $opts   = array_merge($options, $this->request->getData());
        $this->sessionMergeArray($tblCtl, $opts);
        $this->sessionDelete($tblCtl . "." . AppTable::INDICLE);
        $this->sessionDelete($tblCtl . ".CBSELECT");
        /** Passe la main à qui va bien */
        return $this->redirect(['controller' => $tblCtl, 'action' => 'getdatagrid',]);
    }

    /**
     * Prépare tableau pour paramètre de méthode stockée.
     * insère sélection de EGCanEntité Géographique Candidat(ures)
     * @param string $param
     * @return array
     */
    private function param2ProcIns1EgCand(string $param)
    {
        /**
         * Indicle Cible est l'indiclé sauvegardé dans Egcanadd
         * lors de l'action EgcanController:add
         */
        $nvariable    = AppTable::INDICLE . "CIBLE";
        $delimiter    = ",";
        $EgCands      = explode($delimiter, $param);
        $indicleCible = $this->sessionRead($this->name . "." . $nvariable)[0];


        /**
         **  Afin d'éviter toute faute de frappe en minuscule !
         **  utilisation de strtoupper()
         */
        $n = strtoupper("PROC_INS_1_EG_CAND");
        /**
         *  $keys
         */
        $k = ["PARINDICLE", "PAREGCLE", "PARELECCLE", "PARNUMTOUR"];
        $v = [];
        foreach ($EgCands as $value) {
            $pk = \explode("::", $value);  // un array [INDI_CLE,ENTG_CLE]!
            // pourquoi écrire vers la console ?
            // echo print_r($pk, true); // true => retourne une chaîne au lieu d'afficher directement
            $pk[0]          = $indicleCible;
            $arrayParams[]  = array_combine($k, $pk);
        }
        return ["method" => $n, "arrayParams" => $arrayParams,];
    }

    /**
     * Add method
     * Redirects on successful add, renders view otherwise.
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add(string $selection)
    {
        $nvariable    = AppTable::INDICLE . "CIBLE";
        $indicleCible = $this->sessionRead($this->name . "." . $nvariable)[0];
        $quoi         = "Bascule la sélection d'entité géographique candidate";
        $msg          = [
            "ok" => __("Action [{0}] Effectuée.", [$quoi]),
            "pb" => __("Problème Rencontré.")
        ];
        $param = $this->param2ProcIns1EgCand($selection);
        // dd($param); //* Vérifier ordre INDICLE, ENTG_CLE
        $result = $this->methodeStockee($param);
        if ($result["isOk"]) {
            $this->Flash->success($msg["ok"]);
            /**
             * Sauvegarde de indi_cle CIble dans le **contrôleur Egcan**
             * pour retrouver "ses petits"
             */
            $cle       = AppTable::INDICLE;
            $clecible  = $cle . "CIBLE";
            $nCtlSrc   = $this->name;                                        //* le **contrôleur Egcanadd**
            $nCtlCbl   = "Egcan";                                            //* le **contrôleur Egcan**
            $indiceSrc = $this->sessionRead($nCtlSrc . "." . $clecible)[0];
            $this->sessionMergeArray($nCtlCbl, [$cle => $indiceSrc]);
        } else {
            $this->Flash->error($msg["pb"]);
            $this->Flash->error(print_r($result["Result"], true));
        }
        return $this->redirect(['controller' => 'Egcan', 'action' => 'index']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Eg Candidature id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($indi_cle = null, $entg_cle = null, $select = null)
    {
        $msg = ["pb" => __("Pas d'édition à ce niveau !")];
        $this->Flash->error($msg["pb"]);
        return $this->redirect(['controller' => 'Egcanadd', 'action' => 'index']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Eg Candidature id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($indi_cle = null, $entg_cle = null)
    {
        $msg = ["pb" => __("Pas d'effacement à ce niveau !")];
        $this->Flash->error($msg["pb"]);
        return $this->redirect(['controller' => 'Egcanadd', 'action' => 'index']);
    }
}
