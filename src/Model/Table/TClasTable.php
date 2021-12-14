<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeClassification Model
 *
 * @method \App\Model\Entity\TypeClassification get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeClassification newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeClassification[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeClassification|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeClassification saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeClassification patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeClassification[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeClassification findOrCreate($search, callable $callback = null, $options = [])
 */
class TClasTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_classification');
        $this->setDisplayField('TYCL_CODE');
        $this->setPrimaryKey('TYCL_CODE');
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
                ->scalar('TYCL_CODE')
                ->maxLength('TYCL_CODE', 20)
                ->allowEmptyString('TYCL_CODE', null, 'create');

        $validator
                ->scalar('TYCL_LIBE')
                ->maxLength('TYCL_LIBE', 50)
                ->requirePresence('TYCL_LIBE', 'create')
                ->notEmptyString('TYCL_LIBE');

        return $validator;
    }

}
