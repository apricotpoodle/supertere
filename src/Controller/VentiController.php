<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Ventilation Controller
 *
 * @property \App\Model\Table\VentilationTable $Ventilation
 *
 * @method \App\Model\Entity\Ventilation[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class VentiController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /**
          $ventilation = $this->paginate($this->Venti);

          $this->set(compact('ventilation'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Ventilation id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $ventilation = $this->Ventilation->get($id,
                [
            'contain' => []
        ]);

        $this->set('ventilation', $ventilation);
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
          $ventilation = $this->Ventilation->newEntity();
          if ($this->request->is('post')) {
          $ventilation = $this->Ventilation->patchEntity($ventilation, $this->request->getData());
          if ($this->Ventilation->save($ventilation)) {
          $this->Flash->success(__('The ventilation has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The ventilation could not be saved. Please, try again.'));
          }
          $this->set(compact('ventilation'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Ventilation id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $ventilation = $this->Ventilation->get($id, [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $ventilation = $this->Ventilation->patchEntity($ventilation, $this->request->getData());
          if ($this->Ventilation->save($ventilation)) {
          $this->Flash->success(__('The ventilation has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The ventilation could not be saved. Please, try again.'));
          }
          $this->set(compact('ventilation'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Ventilation id.
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
         * 
          $this->request->allowMethod(['post', 'delete']);
          $ventilation = $this->Ventilation->get($id);
          if ($this->Ventilation->delete($ventilation)) {
          $this->Flash->success(__('The ventilation has been deleted.'));
          } else {
          $this->Flash->error(__('The ventilation could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
