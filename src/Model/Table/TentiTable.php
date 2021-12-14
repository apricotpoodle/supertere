<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeEntite Model
 *
 * @method \App\Model\Entity\TypeEntite get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeEntite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeEntite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeEntite|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeEntite saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeEntite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeEntite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeEntite findOrCreate($search, callable $callback = null, $options = [])
 */
class TentiTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_entite');
        $this->setDisplayField('TYEN_CODE');
        $this->setPrimaryKey('TYEN_CODE');
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
                ->scalar('TYEN_CODE')
                ->maxLength('TYEN_CODE', 10)
                ->allowEmptyString('TYEN_CODE', null, 'create');

        return $validator;
    }

}
