<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeRappel Controller
 *
 * @property \App\Model\Table\TypeRappelTable $TypeRappel
 *
 * @method \App\Model\Entity\TypeRappel[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TRappController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /**
          $typeRappel = $this->paginate($this->TypeRappel);

          $this->set(compact('typeRappel'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Type Rappel id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.

     */
    public function view($id = null)
    {
        $typeRappel = $this->TypeRappel->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeRappel', $typeRappel);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeRappel = $this->TypeRappel->newEntity();
          if ($this->request->is('post')) {
          $typeRappel = $this->TypeRappel->patchEntity($typeRappel, $this->request->getData());
          if ($this->TypeRappel->save($typeRappel)) {
          $this->Flash->success(__('The type rappel has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type rappel could not be saved. Please, try again.'));
          }
          $this->set(compact('typeRappel'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Rappel id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeRappel = $this->TypeRappel->get($id, [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeRappel = $this->TypeRappel->patchEntity($typeRappel, $this->request->getData());
          if ($this->TypeRappel->save($typeRappel)) {
          $this->Flash->success(__('The type rappel has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type rappel could not be saved. Please, try again.'));
          }
          $this->set(compact('typeRappel'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Rappel id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Flash->info(
                __("Valeur reçue pour traiter l'effacement : $id ")
        );
        return $this->redirect(['action' => 'index']);
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $this->request->allowMethod(['post', 'delete']);
          $typeRappel = $this->TypeRappel->get($id);
          if ($this->TypeRappel->delete($typeRappel)) {
          $this->Flash->success(__('The type rappel has been deleted.'));
          } else {
          $this->Flash->error(__('The type rappel could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
