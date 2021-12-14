<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeClassification Controller
 *
 * @property \App\Model\Table\TypeClassificationTable $TypeClassification
 *
 * @method \App\Model\Entity\TypeClassification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TClasController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /*
          $typeClassification = $this->paginate($this->TypeClassification);

          $this->set(compact('typeClassification'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Type Classification id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeClassification = $this->TypeClassification->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeClassification', $typeClassification);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeClassification = $this->TypeClassification->newEntity();
        $this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          if ($this->request->is('post')) {
          $typeClassification = $this->TypeClassification->patchEntity($typeClassification,
          $this->request->getData());
          if ($this->TypeClassification->save($typeClassification)) {
          $this->Flash->success(__('The type classification has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type classification could not be saved. Please, try again.'));
          }
          $this->set(compact('typeClassification'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Classification id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeClassification = $this->TypeClassification->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeClassification = $this->TypeClassification->patchEntity($typeClassification,
          $this->request->getData());
          if ($this->TypeClassification->save($typeClassification)) {
          $this->Flash->success(__('The type classification has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type classification could not be saved. Please, try again.'));
          }
          $this->set(compact('typeClassification'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Classification id.
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
          $typeClassification = $this->TypeClassification->get($id);
          if ($this->TypeClassification->delete($typeClassification)) {
          $this->Flash->success(__('The type classification has been deleted.'));
          }
          else {
          $this->Flash->error(__('The type classification could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
