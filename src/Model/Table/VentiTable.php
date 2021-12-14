<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Ventilation Model
 *
 * @method \App\Model\Entity\Ventilation get($primaryKey, $options = [])
 * @method \App\Model\Entity\Ventilation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Ventilation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Ventilation|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ventilation saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Ventilation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Ventilation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Ventilation findOrCreate($search, callable $callback = null, $options = [])
 */
class VentiTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ventilation');
        $this->setDisplayField('VENT_CODE');
        $this->setPrimaryKey('VENT_CODE');
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
                ->scalar('VENT_CODE')
                ->maxLength('VENT_CODE', 30)
                ->allowEmptyString('VENT_CODE', null, 'create');

        $validator
                ->scalar('VENT_LIBE')
                ->maxLength('VENT_LIBE', 50)
                ->allowEmptyString('VENT_LIBE');

        return $validator;
    }

}
