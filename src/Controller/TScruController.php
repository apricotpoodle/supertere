<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeScrutin Controller
 *
 * @property \App\Model\Table\TypeScrutinTable $TypeScrutin
 *
 * @method \App\Model\Entity\TypeScrutin[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TScruController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /*
          $typeScrutin = $this->paginate($this->TScru);

          $this->set(compact('typeScrutin'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Type Scrutin id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeScrutin = $this->TypeScrutin->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeScrutin', $typeScrutin);
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
          $typeScrutin = $this->TypeScrutin->newEntity();
          if ($this->request->is('post')) {
          $typeScrutin = $this->TypeScrutin->patchEntity($typeScrutin,
          $this->request->getData());
          if ($this->TypeScrutin->save($typeScrutin)) {
          $this->Flash->success(__('The type scrutin has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type scrutin could not be saved. Please, try again.'));
          }
          $this->set(compact('typeScrutin'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Scrutin id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.

          $typeScrutin = $this->TypeScrutin->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeScrutin = $this->TypeScrutin->patchEntity($typeScrutin,
          $this->request->getData());
          if ($this->TypeScrutin->save($typeScrutin)) {
          $this->Flash->success(__('The type scrutin has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type scrutin could not be saved. Please, try again.'));
          }
          $this->set(compact('typeScrutin'));
         * 
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Scrutin id.
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
          $typeScrutin = $this->TypeScrutin->get($id);
          if ($this->TypeScrutin->delete($typeScrutin)) {
          $this->Flash->success(__('The type scrutin has been deleted.'));
          } else {
          $this->Flash->error(__('The type scrutin could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         * 
         */
    }

}
