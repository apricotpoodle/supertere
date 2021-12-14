<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * RattachementGeographique Controller
 *
 * @property \App\Model\Table\RattachementGeographiqueTable $RattachementGeographique
 *
 * @method \App\Model\Entity\RattachementGeographique[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TRaGeController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {/*
      $rattachementGeographique = $this->paginate($this->TRaGe);

      $this->set(compact('rattachementGeographique'));
     *
     */
    }

    /**
     * View method
     *
     * @param string|null $id Rattachement Geographique id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $rattachementGeographique = $this->RattachementGeographique->get($id,
                [
            'contain' => []
        ]);

        $this->set('rattachementGeographique', $rattachementGeographique);
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
          $rattachementGeographique = $this->RattachementGeographique->newEntity();
          if ($this->request->is('post')) {
          $rattachementGeographique = $this->RattachementGeographique->patchEntity($rattachementGeographique,
          $this->request->getData());
          if ($this->RattachementGeographique->save($rattachementGeographique)) {
          $this->Flash->success(__('The rattachement geographique has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The rattachement geographique could not be saved. Please, try again.'));
          }
          $this->set(compact('rattachementGeographique'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Rattachement Geographique id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $rattachementGeographique = $this->RattachementGeographique->get($id,
          [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $rattachementGeographique = $this->RattachementGeographique->patchEntity($rattachementGeographique,
          $this->request->getData());
          if ($this->RattachementGeographique->save($rattachementGeographique)) {
          $this->Flash->success(__('The rattachement geographique has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The rattachement geographique could not be saved. Please, try again.'));
          }
          $this->set(compact('rattachementGeographique'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Rattachement Geographique id.
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
          $rattachementGeographique = $this->RattachementGeographique->get($id);
          if ($this->RattachementGeographique->delete($rattachementGeographique)) {
          $this->Flash->success(__('The rattachement geographique has been deleted.'));
          }
          else {
          $this->Flash->error(__('The rattachement geographique could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
