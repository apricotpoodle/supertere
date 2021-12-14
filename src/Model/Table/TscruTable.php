<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeScrutin Model
 *
 * @method \App\Model\Entity\TypeScrutin get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeScrutin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeScrutin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeScrutin|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeScrutin saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeScrutin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeScrutin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeScrutin findOrCreate($search, callable $callback = null, $options = [])
 */
class TscruTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_scrutin');
        $this->setDisplayField('TYSC_CODE');
        $this->setPrimaryKey('TYSC_CODE');
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

        return $validator;
    }

}
