<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * EntiteGeo Controller
 *
 * @property \App\Model\Table\EntiteGeoTable $EntiteGeo
 *
 * @method \App\Model\Entity\EntiteGeo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EngeoController extends AppController
{
    //const CHXCLE = "CHX_CLE"; à virer ?

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /**
          $entiteGeo = $this->paginate($this->EntiteGeo);

          $this->set(compact('entiteGeo'));
         */
    }

    /**
     * View method
     *
     * @param string|null $id Entite Geo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $entiteGeo = $this->EntiteGeo->get(
            $id,
            [
            'contain' => []
        ]
        );

        $this->set('entiteGeo', $entiteGeo);
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
          $entiteGeo = $this->EntiteGeo->newEntity();
          if ($this->request->is('post')) {
          $entiteGeo = $this->EntiteGeo->patchEntity($entiteGeo,
          $this->request->getData());
          if ($this->EntiteGeo->save($entiteGeo)) {
          $this->Flash->success(__('The entite geo has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The entite geo could not be saved. Please, try again.'));
          }
          $this->set(compact('entiteGeo'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Entite Geo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $entiteGeo = $this->EntiteGeo->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $entiteGeo = $this->EntiteGeo->patchEntity($entiteGeo,
          $this->request->getData());
          if ($this->EntiteGeo->save($entiteGeo)) {
          $this->Flash->success(__('The entite geo has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The entite geo could not be saved. Please, try again.'));
          }
          $this->set(compact('entiteGeo'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Entite Geo id.
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
          $entiteGeo = $this->EntiteGeo->get($id);
          if ($this->EntiteGeo->delete($entiteGeo)) {
          $this->Flash->success(__('The entite geo has been deleted.'));
          }
          else {
          $this->Flash->error(__('The entite geo could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }
}
