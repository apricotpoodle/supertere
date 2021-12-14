<?php

namespace App\Controller;

use ___;
use App\Controller\AppController;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;
use Cake\ORM\TableRegistry;

/**
 * TypeRattachement Controller
 *
 * @property \App\Model\Table\TypeRattachementTable $TypeRattachement
 *
 * @method \App\Model\Entity\TypeRattachement[]|ResultSetInterface paginate($object = null, array $settings = [])
 */
class TrattController extends AppController {

    /**
     * Index method
     *
     * @return Response|null
     */
    public function index()
    {
        /*
          $typeRattachement = $this->paginate($this->TypeRattachement);

          $this->set(compact('typeRattachement'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Type Rattachement id.
     * @return Response|null
     * @throws RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeRattachement = $this->TypeRattachement->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeRattachement', $typeRattachement);
    }

    /**
     * Add method
     *
     * @return Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
          return $this->redirect(['action' => 'index']);
         */
        $typeRattachement = $this->Tratt->newEntity();
        if ($this->request->is('post')) {
            $typeRattachement = $this->Tratt->patchEntity($typeRattachement,
                    $this->request->getData());
            if ($this->Tratt->save($typeRattachement)) {
                $this->Flash->success(__('The type rattachement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type rattachement could not be saved. Please, try again.'));
        }
        $this->set(compact('typeRattachement'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Rattachement id.
     * @return Response|null Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
          return $this->redirect(['action' => 'index']);
         */
        $table = TableRegistry::getTableLocator()->get("Tratt",
                ['connection' => $this->getActiveConnexion()]);
        $typeRattachement = $table->get($id, ['contain' => []]);
        //$typeRattachement = $this->Tratt->get($id, ['contain' => []]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $typeRattachement = $table->patchEntity($typeRattachement,
                    $this->request->getData());
            if ($table->save($typeRattachement)) {
                $this->Flash->success(__('The type rattachement has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The type rattachement could not be saved. Please, try again.'));
        }
        $this->set(compact('typeRattachement'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Rattachement id.
     * @return Response|null Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $this->Flash->info(
          __("Valeur reçue pour traiter l'effacement : $id ")
          );
          return $this->redirect(['action' => 'index']);
         */
        $this->request->allowMethod(['post', 'delete']);
        $table = TableRegistry::getTableLocator()->get("Tratt",
                ['connection' => $this->getActiveConnexion()]);
        $typeRattachement = $table->get($id);
        if ($table->delete($typeRattachement)) {
            $this->Flash->success(__('The type rattachement has been deleted.'));
        }
        else {
            $this->Flash->error(__('The type rattachement could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

}
