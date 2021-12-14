<?php

namespace App\Controller;

use App\Controller\AppController;
use App\Model\Table\AppTable;
use Cake\Chronos\Chronos;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\Log\Log;
use function dd;

/**
 * EgCandidature Controller
 *
 * @property \App\Model\Table\EgCandidatureTable $EgCandidature
 *
 * @method \App\Model\Entity\EgCandidature[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class EgcanController extends AppController
{

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
        $egCandidature = $this->EgCandidature->get(
            $id,
            [
                'contain' => []
            ]
        );

        $this->set('egCandidature', $egCandidature);
    }

    /**
     * Prépare tableau pour paramètre de méthode stockée.
     * insère sélection de EGCan pour un indice de candidature
     * @param string $param
     * @return array
     */
    private function param2ProcIns1EgCand($entgCles)
    {
        /**
         * Indicle Cible est l'indiclé sauvegardé dans Egcanadd
         * lors de l'action EgcanController:add
         */
        $nvariable = AppTable::INDICLE . "CIBLE";
        $delimiter = ",";
        $Egs = explode($delimiter, $entgCles);
        /*
         * Il s'agit de l'indice de candidature courant
         */
        //$indicleCible = $this->sessionRead($this->name . "." . $nvariable)[0];
        $cle = AppTable::INDICLE;
        //        $clecible = $cle . "CIBLE";
        $nCtlSrc = $this->name;
        $indiceCible = $this->sessionRead($nCtlSrc . "." . $cle)[0];


        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = strtoupper("PROC_INS_1_EG_CAND");
        /**
         *  $keys
         */
        $k = [
            "PAREGCLE",
            "PARINDICLE",
        ];
        $v = [
            $entgCles,
            $indiceCible,
        ];

        $arrayParams[] = array_combine($k, $v);
        return ["method" => $n, "arrayParams" => $arrayParams,];
    }

    /**
     * Add method
     * Ajoute une Entité Géographique Candidate depuis la liste des Entités Géogr.
     * Lance la procédure stockée : PROC_INS_1_EG_CAND
     * Nécessite 4 paramètres : ["PARINDICLE", "PAREGCLE", "PARELECCLE", "PARNUMTOUR"]
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add($entg_cle = null)
    {
        if (null === $entg_cle) {
            /*
             * Aucune entité géogr. choisie
             */
            $CtlCible = self::ENGEO;
            $kTyEgCode = AppTable::TYEGCODE;
            $nCtlSrc = $this->name;
            $vTyEgCode = $this->sessionRead($nCtlSrc . "." . $kTyEgCode)[0];
            $filtre = [$kTyEgCode => $vTyEgCode];
            $nFncOK = __FUNCTION__;

            $this->lanceChoix($CtlCible, $filtre, $nFncOK);
        } else {
            $quoi = "Ajout d'une entité géographique candidate";
            $msg = [
                "ok" => __("Action [{0}] Effectuée.", [$quoi]),
                "pb" => __("Problème Rencontré.")
            ];
            $param = $this->param2ProcIns1EgCand((string) $entg_cle);
            //dd(__METHOD__, "entg_cle choisi [$entg_cle]", $param);
            try {
                $result = $this->methodeStockee($param);
            } catch (Exception $exc) {
                $context = ['scope' => ['error']];

                //    echo $exc->getTraceAsString();
                $result["isOk"] = false;
                /**
                 * Jounaliser l'erreur
                 */
                //$tag = Chronos::now()->format(Chronos::ISO8601);
                $tag = Chronos::now()->format("YmdHis");
                $tag .= " " . __METHOD__ . "::" . __LINE__;
                Log::debug(">" . $tag, $context);
                Log::debug($exc->getMessage(), $context);
                Log::debug("<" . $tag, $context);
                $this->Flash->error(__(
                    "Vérifier dans error.log au Tag [{0}]",
                    $tag
                ));
            }
            if ($result["isOk"]) {
                $this->Flash->success($msg["ok"]);
            } else {
                $this->Flash->error($msg["pb"]);
                $this->Flash->error(print_r($result["Result"], true));
            }
            return $this->redirect(['controller' => 'Egcan', 'action' => 'index']);
        }

        //        /**
        //         * Sauvegarde de indi_cle Cible dans le **contrôleur Egcanadd**
        //         * où l'on va ajouter le choix que l'on va faire
        //         */
        //        $cle = AppTable::INDICLE;
        //        $clecible = $cle . "CIBLE";
        //        $nCtlSrc = $this->name;
        //        $nCtlCbl = $nCtlSrc . "add"; // le **contrôleur Egcanadd**
        //        $indiceCible = $this->sessionRead($nCtlSrc . "." . $cle)[0];
        //        //dd(__METHOD__, $indiceCible);
        //        $this->sessionMergeArray($nCtlCbl, [$clecible => $indiceCible]);
        //        //return $this->redirect(['controller' => 'Egcanadd', 'action' => 'index']);
        //        return $this->redirect(['controller' => 'Engeo', 'action' => 'choix', '?' => [
        //                        "C" => "egcan"]]);
        //        //$this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
        //        //return $this->redirect(['action' => 'index']);
    }

    public function getdatagrid(array $options = [])
    {
        /**
         * tri par défaut CODINSEE ASC
         * fournir deux tableaux de la forme
         * $options["sort"] = "FieldName1,FieldName2,Fieldname3…";
         * $options["order"] = "asc,asc,desc,…";
         *
         */
        $options["sort"] = AppTable::EGCODINSEE;
        $options["order"] = "asc";
        parent::getdatagrid($options);
    }

    /**
     * Bascule la sélection d'une liste d'article
     * @param string $param : liste des primary keys concernées
     */
    public function toggleSelect($param)
    {
        $quoi = "Bascule la sélection d'entité géographique candidate";
        $msg = [
            "ok" => __("Action [{0}] Effectuée.", [$quoi]),
            "pb" => __("Problème Rencontré.")
        ];
        $param = $this->param2ProcUpd1EgCand($param);
        $result = $this->methodeStockee($param);
        if ($result["isOk"]) {
            $this->Flash->success($msg["ok"]);
        } else {
            $this->Flash->error($msg["pb"]);
            $this->Flash->error(print_r($result["Result"], true));
        }
        return $this->redirect(['action' => 'index']);
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
        $glue = "::";
        $pieces = [$indi_cle, $entg_cle];
        $param = implode($glue, $pieces);
        return $this->setAction('toggleSelect', $param);
    }

    private function param2ProcDel1EgCand(array $param)
    {
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = strtoupper("PROC_DEL_1_EG_CAND");
        /**
         *  $keys
         */
        $k = ["PAREGCLE", "PARINDICLE",];
        $v = [];
        foreach ($k as $value) {
            $v[] = $param[$value];
        }
        $arrayParams[] = array_combine($k, $v);
        return ["method" => $n, "arrayParams" => $arrayParams,];
    }

    /**
     * Prépare tableau pour paramètre de méthode stockée.
     * Bascule sélection de EGCan
     * @param string $param
     * @return array
     */
    private function param2ProcUpd1EgCand(string $param)
    {
        $delimiter = ",";
        $EgCands = explode($delimiter, $param);
        /**
         *  Éviter toute faute de frappe en minuscule !
         */
        $n = strtoupper("PROC_UPD_1_EG_CAND");
        /**
         *  $keys
         */
        $k = ["PAREGCLE", "PARINDICLE", "PARSELECT",];
        $v = [];
        foreach ($EgCands as $value) {
            $pk = \explode("::", $value); // un array !
            $egcan = $this->Egcan->get($pk);
            $v = [ // dans le bon ordre !
                $egcan->ENTG_CLE,
                $egcan->INDI_CLE,
                !$egcan->ENTG_SELECT ? "1" : "0",
            ];
            $arrayParams[] = array_combine($k, $v);
        }
        return ["method" => $n, "arrayParams" => $arrayParams,];
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
        $quoi = "Effacement Une Entité Géographique Candidate";
        $msg = [
            "ok" => __(
                "Action [{0}] sur [{1}::{2}] Effectuée.",
                [$quoi, $indi_cle, $entg_cle]
            ),
            "pb" => __("Problème Rencontré [{0}/{1}]", [$indi_cle, $entg_cle])
        ];
        /*
          $this->Flash->info(
          __("Valeur reçue pour traiter l'effacement : $indi_cle / $entg_cle")
          );
         */
        $data = [
            "PAREGCLE" => $entg_cle,
            "PARINDICLE" => $indi_cle,
        ];
        $param = $this->param2ProcDel1EgCand($data);
        $result = $this->methodeStockee($param);
        if ($result["isOk"]) {
            $this->Flash->success($msg["ok"]);
        } else {
            $this->Flash->error($msg["pb"]);
            $this->Flash->error(print_r($result["Result"], true));
        }
        return $this->redirect(['action' => 'index']);
    }
}
