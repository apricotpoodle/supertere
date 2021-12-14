<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeFonction Controller
 *
 * @property \App\Model\Table\TypeFonctionTable $TypeFonction
 *
 * @method \App\Model\Entity\TypeFonction[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TFoncController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {/*
      $typeFonction = $this->paginate($this->TypeFonction);

      $this->set(compact('typeFonction'));
     * 
     */
    }

    /**
     * View method
     *
     * @param string|null $id Type Fonction id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeFonction = $this->TypeFonction->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeFonction', $typeFonction);
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
          $typeFonction = $this->TypeFonction->newEntity();
          if ($this->request->is('post')) {
          $typeFonction = $this->TypeFonction->patchEntity($typeFonction,
          $this->request->getData());
          if ($this->TypeFonction->save($typeFonction)) {
          $this->Flash->success(__('The type fonction has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type fonction could not be saved. Please, try again.'));
          }
          $this->set(compact('typeFonction'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Fonction id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeFonction = $this->TypeFonction->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeFonction = $this->TypeFonction->patchEntity($typeFonction,
          $this->request->getData());
          if ($this->TypeFonction->save($typeFonction)) {
          $this->Flash->success(__('The type fonction has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type fonction could not be saved. Please, try again.'));
          }
          $this->set(compact('typeFonction'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Fonction id.
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
          $typeFonction = $this->TypeFonction->get($id);
          if ($this->TypeFonction->delete($typeFonction)) {
          $this->Flash->success(__('The type fonction has been deleted.'));
          }
          else {
          $this->Flash->error(__('The type fonction could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
