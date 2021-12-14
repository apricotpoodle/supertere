<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeDecision Model
 *
 * @method \App\Model\Entity\TypeDecision get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeDecision newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeDecision[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeDecision|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeDecision saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeDecision patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeDecision[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeDecision findOrCreate($search, callable $callback = null, $options = [])
 */
class TDeciTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_decision');
        $this->setDisplayField('TYDE_CODE');
        $this->setPrimaryKey('TYDE_CODE');
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
                ->scalar('TYDE_CODE')
                ->maxLength('TYDE_CODE', 20)
                ->allowEmptyString('TYDE_CODE', null, 'create');

        return $validator;
    }

}
