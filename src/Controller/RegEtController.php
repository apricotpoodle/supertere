<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * RegroupementEtiquette Controller
 *
 * @property \App\Model\Table\RegroupementEtiquetteTable $RegroupementEtiquette
 *
 * @method \App\Model\Entity\RegroupementEtiquette[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegEtController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /**
          $regroupementEtiquette = $this->paginate($this->RegEt);

          $this->set(compact('regroupementEtiquette'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Regroupement Etiquette id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $regroupementEtiquette = $this->RegroupementEtiquette->get($id,
                [
            'contain' => []
        ]);

        $this->set('regroupementEtiquette', $regroupementEtiquette);
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
          $regroupementEtiquette = $this->RegroupementEtiquette->newEntity();
          if ($this->request->is('post')) {
          $regroupementEtiquette = $this->RegroupementEtiquette->patchEntity($regroupementEtiquette, $this->request->getData());
          if ($this->RegroupementEtiquette->save($regroupementEtiquette)) {
          $this->Flash->success(__('The regroupement etiquette has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The regroupement etiquette could not be saved. Please, try again.'));
          }
          $this->set(compact('regroupementEtiquette'));
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Regroupement Etiquette id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /**
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $regroupementEtiquette = $this->RegroupementEtiquette->get($id, [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $regroupementEtiquette = $this->RegroupementEtiquette->patchEntity($regroupementEtiquette, $this->request->getData());
          if ($this->RegroupementEtiquette->save($regroupementEtiquette)) {
          $this->Flash->success(__('The regroupement etiquette has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The regroupement etiquette could not be saved. Please, try again.'));
          }
          $this->set(compact('regroupementEtiquette'));
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Regroupement Etiquette id.
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
          $regroupementEtiquette = $this->RegroupementEtiquette->get($id);
          if ($this->RegroupementEtiquette->delete($regroupementEtiquette)) {
          $this->Flash->success(__('The regroupement etiquette has been deleted.'));
          } else {
          $this->Flash->error(__('The regroupement etiquette could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         */
    }

}
