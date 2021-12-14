<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeEntiteGeo Controller
 *
 * @property \App\Model\Table\TypeEntiteGeoTable $TypeEntiteGeo
 *
 * @method \App\Model\Entity\TypeEntiteGeo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TengeController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        //      $typeEntiteGeo = $this->paginate($this->TypeEntiteGeo);
//        $this->set(compact('typeEntiteGeo'));
    }

    /**
     * View method
     *
     * @param string|null $id Type Entite Geo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeEntiteGeo = $this->TypeEntiteGeo->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeEntiteGeo', $typeEntiteGeo);
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
          $typeEntiteGeo = $this->TypeEntiteGeo->newEntity();
          if ($this->request->is('post')) {
          $typeEntiteGeo = $this->TypeEntiteGeo->patchEntity($typeEntiteGeo,
          $this->request->getData());
          if ($this->TypeEntiteGeo->save($typeEntiteGeo)) {
          $this->Flash->success(__('The type entite geo has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type entite geo could not be saved. Please, try again.'));
          }
          $this->set(compact('typeEntiteGeo'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Entite Geo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeEntiteGeo = $this->TypeEntiteGeo->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeEntiteGeo = $this->TypeEntiteGeo->patchEntity($typeEntiteGeo,
          $this->request->getData());
          if ($this->TypeEntiteGeo->save($typeEntiteGeo)) {
          $this->Flash->success(__('The type entite geo has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type entite geo could not be saved. Please, try again.'));
          }
          $this->set(compact('typeEntiteGeo'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Entite Geo id.
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
          $typeEntiteGeo = $this->TypeEntiteGeo->get($id);
          if ($this->TypeEntiteGeo->delete($typeEntiteGeo)) {
          $this->Flash->success(__('The type entite geo has been deleted.'));
          }
          else {
          $this->Flash->error(__('The type entite geo could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
