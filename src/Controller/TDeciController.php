<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeDecision Controller
 *
 * @property \App\Model\Table\TypeDecisionTable $TypeDecision
 *
 * @method \App\Model\Entity\TypeDecision[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TDeciController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /*
          $typeDecision = $this->paginate($this->TypeDecision);

          $this->set(compact('typeDecision'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Type Decision id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeDecision = $this->TypeDecision->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeDecision', $typeDecision);
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
          $typeDecision = $this->TypeDecision->newEntity();
          if ($this->request->is('post')) {
          $typeDecision = $this->TypeDecision->patchEntity($typeDecision, $this->request->getData());
          if ($this->TypeDecision->save($typeDecision)) {
          $this->Flash->success(__('The type decision has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type decision could not be saved. Please, try again.'));
          }
          $this->set(compact('typeDecision'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Decision id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeDecision = $this->TypeDecision->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeDecision = $this->TypeDecision->patchEntity($typeDecision,
          $this->request->getData());
          if ($this->TypeDecision->save($typeDecision)) {
          $this->Flash->success(__('The type decision has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type decision could not be saved. Please, try again.'));
          }
          $this->set(compact('typeDecision'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Decision id.
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
          $typeDecision = $this->TypeDecision->get($id);
          if ($this->TypeDecision->delete($typeDecision)) {
          $this->Flash->success(__('The type decision has been deleted.'));
          }
          else {
          $this->Flash->error(__('The type decision could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
