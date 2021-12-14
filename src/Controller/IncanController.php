<?php

/**
 * Contrôleur
 *
 * @category Description
 * @package  Category
 * @author   Name <email@email.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */

namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;
use Exception;

/**
 * IndiceCandidature Controller
 *
 * @property \App\Model\Table\IndiceCandidatureTable $IndiceCandidature
 *
 * @method \App\Model\Entity\IndiceCandidature[]|ResultSetInterface paginate($object = null, array $settings = [])
 *
 * @category Description
 * @package  Category
 * @author   Name <email@email.com>
 * @license  MIT http://url.com
 * @link     http://url.com
 */
class IncanController extends AppController
{

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        //    $indiceCandidature = $this->paginate($this->IndCand);
        //  $this->set(compact('indiceCandidature'));
    }

    /**
     * View method
     *
     * @param string|null $id Indice Candidature id.
     *
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $indiceCandidature = $this->IndCand->get($id, ['contain' => []]);
        $this->set('indiceCandidature', $indiceCandidature);
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $msgSuccess = __('The indice candidature has been saved.');
        $msgError = __('The indice candidature could not be saved. Please, try again.');
        /**
         * Le reste du code est à adapter en fonction du vieux G.T.E.R.E.
         * Après Vérification, le code VB est un simple INSERT.
         */
        try {
            $table = TableRegistry::getTableLocator()->get(
                $this->name,
                ['connection' => $this->getActiveConnexion()]
            );
            $entity = $table->newEntity();
            if ($this->request->is('post')) {
                $entity = $table->patchEntity($entity, $this->request->getData());
                if ($table->save($entity)) {
                    $this->Flash->success($msgSuccess);
                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error($msgError);
            }
            $this->set(compact('entity'));
        } catch (Exception $exc) {
            $this->Flash->error($exc); //->getTraceAsString();
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Indice Candidature id.
     *
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $msgSuccess = __('The indice candidature has been saved.');
        $msgError = __('The indice candidature could not be saved. Please, try again.');
        /**
         * Le reste du code est à adapter en fonction du vieux G.T.E.R.E.
         * Après Vérification, le code VB est un simple UPDATE.
         */
        try {
            $table = TableRegistry::getTableLocator()->get(
                $this->name,
                ['connection' => $this->getActiveConnexion()]
            );
            $entity = $table->get($id, ['contain' => []]);
            if ($this->request->is(['patch', 'post', 'put'])) {
                $entity = $table->patchEntity($entity, $this->request->getData());
                if ($table->save($entity)) {
                    $this->Flash->success($msgSuccess);

                    return $this->redirect(['action' => 'index']);
                }
                $this->Flash->error($msgError);
            }
            $this->set(compact('entity'));
        } catch (Exception $exc) {
            $this->Flash->error($exc); //->getTraceAsString();
            return $this->redirect(['action' => 'index']);
        }
    }

    /**
     * Delete method
     *
     * @param string|null $id Indice Candidature id.
     *
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $msgSuccess = __('The indice candidature has been deleted.');
        $msgError = __('The indice candidature could not be deleted. Please, try again.');
        /**
         * Le reste du code est à adapter en fonction du vieux G.T.E.R.E.
         * Après Vérification, le code VB est un simple DELETE.
         */
        $this->request->allowMethod(['post', 'delete', 'get']);
        try {
            $table = TableRegistry::getTableLocator()->get(
                $this->name,
                ['connection' => $this->getActiveConnexion()]
            );
            $entity = $table->get($id);
            if ($table->delete($entity)) {
                $this->Flash->success($msgSuccess);
            } else {
                $this->Flash->error($msgError);
            }
        } catch (Exception $exc) {
            $this->Flash->error($exc);
        }
        return $this->redirect(['action' => 'index']);
    }


    /**
     * Duplique les param
     *
     * @param [type] $pk -
     *
     * @return void
     */
    public function duplicate($pk)
    {
        $keys = ["INDI_CLE", "INDI_LIBELLE", "INDI_DATE_OUV", "INDI_DATE_FER"];
        $entity = $this->Incan->get($pk);
        try {
            $e2 = $this->Incan->get($pk + 1);
            $this->Flash->error("Fiche " . $e2[$keys[0]] . ". Déjà existante !");
            $this->Flash->error($e2);
        } catch (Exception $exc) {
            //$this->Flash->error($exc->getTraceAsString());
            $newEntity = $this->Incan->newEntity(); // create new record;
            $dupEntity = $this->Incan->patchEntity(
                $newEntity,
                $entity->toArray()
            );
            $dupEntity[$keys[0]] = $dupEntity[$keys[0]] + 1;
            $dupEntity->setDirty($keys[0], false);
            $dupEntity[$keys[1]] = "Copie de " . $entity[$keys[1]];
            $dupEntity->setDirty($keys[1], true);

            try {
                $this->Incan->saveOrFail($dupEntity);
                $this->Flash->set("Opération effectuée ! ");
            } catch (Exception $exc) {
                $this->Flash->error($exc->getTraceAsString());
            }
        }
        /*
          $newEntity = $this->Incan->newEntity(); // create new record;
          $dupEntity = $this->Incan->patchEntity($newEntity, $entity->toArray());

          $dupEntity[$keys[0]] = $dupEntity[$keys[0]] + 1;
          $dupEntity->setDirty($keys[0], false);
          $dupEntity[$keys[1]] = "Copie de " . $entity[$keys[1]];
          $dupEntity->setDirty($keys[1], true);

          try {
          $this->Incan->saveOrFail($dupEntity);
          $this->Flash->set("Opération effectuée ! ");
          }
          catch (Exception $exc) {
          $this->Flash->error($exc->getTraceAsString());
          }
         */
        parent::duplicate($pk);
        //$this->redirect(["controller" => $this->name, "action" => "index"]);
    }
}