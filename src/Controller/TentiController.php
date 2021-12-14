<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeEntite Controller
 *
 * @property \App\Model\Table\TypeEntiteTable $TypeEntite
 *
 * @method \App\Model\Entity\TypeEntite[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TentiController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
//        $typeEntite = $this->paginate($this->TypeEntite);
//        $this->set(compact('typeEntite'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Entite id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeEntite = $this->TypeEntite->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeEntite', $typeEntite);
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
          $typeEntite = $this->TypeEntite->newEntity();
          if ($this->request->is('post')) {
          $typeEntite = $this->TypeEntite->patchEntity($typeEntite,
          $this->request->getData());
          if ($this->TypeEntite->save($typeEntite)) {
          $this->Flash->success(__('The type entite has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type entite could not be saved. Please, try again.'));
          }
          $this->set(compact('typeEntite'));
         * 
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Entite id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeEntite = $this->TypeEntite->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeEntite = $this->TypeEntite->patchEntity($typeEntite,
          $this->request->getData());
          if ($this->TypeEntite->save($typeEntite)) {
          $this->Flash->success(__('The type entite has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type entite could not be saved. Please, try again.'));
          }
          $this->set(compact('typeEntite'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Entite id.
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
          $typeEntite = $this->TypeEntite->get($id);
          if ($this->TypeEntite->delete($typeEntite)) {
          $this->Flash->success(__('The type entite has been deleted.'));
          }
          else {
          $this->Flash->error(__('The type entite could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         * 
         */
    }

}
