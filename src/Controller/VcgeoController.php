<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * ValeurClassifGeo Controller
 *
 * @property \App\Model\Table\ValeurClassifGeoTable $ValeurClassifGeo
 *
 * @method \App\Model\Entity\ValeurClassifGeo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VcgeoController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /*
          $valeurClassifGeo = $this->paginate($this->ValeurClassifGeo);

          $this->set(compact('valeurClassifGeo'));
         */
    }

    /**
     * View method
     *
     * @param string|null $id Valeur Classif Geo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $valeurClassifGeo = $this->ValeurClassifGeo->get($id,
                [
            'contain' => []
        ]);

        $this->set('valeurClassifGeo', $valeurClassifGeo);
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
          $valeurClassifGeo = $this->ValeurClassifGeo->newEntity();
          if ($this->request->is('post')) {
          $valeurClassifGeo = $this->ValeurClassifGeo->patchEntity($valeurClassifGeo,
          $this->request->getData());
          if ($this->ValeurClassifGeo->save($valeurClassifGeo)) {
          $this->Flash->success(__('The valeur classif geo has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The valeur classif geo could not be saved. Please, try again.'));
          }
          $this->set(compact('valeurClassifGeo'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Valeur Classif Geo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $valeurClassifGeo = $this->ValeurClassifGeo->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $valeurClassifGeo = $this->ValeurClassifGeo->patchEntity($valeurClassifGeo,
          $this->request->getData());
          if ($this->ValeurClassifGeo->save($valeurClassifGeo)) {
          $this->Flash->success(__('The valeur classif geo has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The valeur classif geo could not be saved. Please, try again.'));
          }
          $this->set(compact('valeurClassifGeo'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Valeur Classif Geo id.
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
          $valeurClassifGeo = $this->ValeurClassifGeo->get($id);
          if ($this->ValeurClassifGeo->delete($valeurClassifGeo)) {
          $this->Flash->success(__('The valeur classif geo has been deleted.'));
          }
          else {
          $this->Flash->error(__('The valeur classif geo could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
