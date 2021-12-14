<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * EtiquettePolitique Controller
 *
 * @property \App\Model\Table\EtiquettePolitiqueTable $EtiquettePolitique
 *
 * @method \App\Model\Entity\EtiquettePolitique[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EtPolController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {/*
      $etiquettePolitique = $this->paginate($this->EtPol);

      $this->set(compact('etiquettePolitique'));
     * 
     */
    }

    /**
     * View method
     *
     * @param string|null $id Etiquette Politique id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $etiquettePolitique = $this->EtiquettePolitique->get($id,
                [
            'contain' => []
        ]);

        $this->set('etiquettePolitique', $etiquettePolitique);
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
          $etiquettePolitique = $this->EtiquettePolitique->newEntity();
          if ($this->request->is('post')) {
          $etiquettePolitique = $this->EtiquettePolitique->patchEntity($etiquettePolitique,
          $this->request->getData());
          if ($this->EtiquettePolitique->save($etiquettePolitique)) {
          $this->Flash->success(__('The etiquette politique has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The etiquette politique could not be saved. Please, try again.'));
          }
          $this->set(compact('etiquettePolitique'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Etiquette Politique id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $etiquettePolitique = $this->EtiquettePolitique->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $etiquettePolitique = $this->EtiquettePolitique->patchEntity($etiquettePolitique,
          $this->request->getData());
          if ($this->EtiquettePolitique->save($etiquettePolitique)) {
          $this->Flash->success(__('The etiquette politique has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The etiquette politique could not be saved. Please, try again.'));
          }
          $this->set(compact('etiquettePolitique'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Etiquette Politique id.
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
          $etiquettePolitique = $this->EtiquettePolitique->get($id);
          if ($this->EtiquettePolitique->delete($etiquettePolitique)) {
          $this->Flash->success(__('The etiquette politique has been deleted.'));
          }
          else {
          $this->Flash->error(__('The etiquette politique could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
