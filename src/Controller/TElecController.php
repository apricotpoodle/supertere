<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * TypeElection Controller
 *
 * @property \App\Model\Table\TypeElectionTable $TypeElection
 *
 * @method \App\Model\Entity\TypeElection[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TElecController extends AppController {

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        /**
          $typeElection = $this->paginate($this->TypeElection);

          $this->set(compact('typeElection'));
         * 
         */
    }

    /**
     * View method
     *
     * @param string|null $id Type Election id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $typeElection = $this->TypeElection->get($id,
                [
            'contain' => []
        ]);

        $this->set('typeElection', $typeElection);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $typeElection = $this->Telec->newEntity();
        if ($this->request->is('post')) {
            $typeElection = $this->Telec->patchEntity($typeElection,
                    $this->request->getData());
            if ($this->Telec->save($typeElection)) {
                $this->Flash->success(__('The type election has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(
                    __('The type election could not be saved. Please, try again.')
            );
        }
        $this->set(compact('typeElection'));
        /**
          $this->Flash->info(__("Ajout sécurisé avant adaptation G.T.E.R.E."));
          return $this->redirect(['action' => 'index']);
         * le reste du code est à adapter en fonction du vieux G.T.E.R.E.
         */
    }

    /**
     * Edit method
     *
     * @param string|null $id Type Election id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter la mise à jour: $id"));
        return $this->redirect(['action' => 'index']);
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $typeElection = $this->TypeElection->get($id, [
          'contain' => []
          ]);
          if ($this->request->is(['patch', 'post', 'put'])) {
          $typeElection = $this->TypeElection->patchEntity($typeElection, $this->request->getData());
          if ($this->TypeElection->save($typeElection)) {
          $this->Flash->success(__('The type election has been saved.'));

          return $this->redirect(['action' => 'index']);
          }
          $this->Flash->error(__('The type election could not be saved. Please, try again.'));
          }
          $this->set(compact('typeElection'));
         * 
         */
    }

    /**
     * Delete method
     *
     * @param string|null $id Type Election id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->Flash->info(__("Valeur reçue pour traiter l'effacement : $id"));
        return $this->redirect(['action' => 'index']);
        /** le reste du code est à adapter en fonction du vieux G.T.E.R.E.
          $this->request->allowMethod(['post', 'delete']);
          $typeElection = $this->TypeElection->get($id);
          if ($this->TypeElection->delete($typeElection)) {
          $this->Flash->success(__('The type election has been deleted.'));
          }
          else {
          $this->Flash->error(__('The type election could not be deleted. Please, try again.'));
          }

          return $this->redirect(['action' => 'index']);
         * 
         */
    }

}
