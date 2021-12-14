<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TElect Model
 *
 * @method \App\Model\Entity\TypeElection get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeElection newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeElection[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeElection|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeElection saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeElection patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeElection[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeElection findOrCreate($search, callable $callback = null, $options = [])
 */
class TElecTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_election');
        $this->setDisplayField('TYSC_CODE');
        $this->setPrimaryKey(['TYSC_CODE', 'TYEN_CODE', 'TYEG_CODE', 'TYEL_CODE']);
        // Add the behaviour to the table
        $this->addBehavior('Search.Search');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
                ->scalar('TYSC_CODE')
                ->maxLength('TYSC_CODE', 15)
                ->allowEmptyString('TYSC_CODE', null, 'create');

        $validator
                ->scalar('TYEN_CODE')
                ->maxLength('TYEN_CODE', 10)
                ->allowEmptyString('TYEN_CODE', null, 'create');

        $validator
                ->scalar('TYEG_CODE')
                ->maxLength('TYEG_CODE', 15)
                ->allowEmptyString('TYEG_CODE', null, 'create');

        $validator
                ->scalar('TYEL_CODE')
                ->maxLength('TYEL_CODE', 15)
                ->allowEmptyString('TYEL_CODE', null, 'create');

        $validator
                ->scalar('TYFO_CODE')
                ->maxLength('TYFO_CODE', 20)
                ->requirePresence('TYFO_CODE', 'create')
                ->notEmptyString('TYFO_CODE');

        $validator
                ->scalar('TYCO_CODE')
                ->maxLength('TYCO_CODE', 15)
                ->allowEmptyString('TYCO_CODE');

        return $validator;
    }

}
