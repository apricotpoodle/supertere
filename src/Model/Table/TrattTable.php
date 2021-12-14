<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeRattachement Model
 *
 * @method \App\Model\Entity\TypeRattachement get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeRattachement newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeRattachement[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeRattachement|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeRattachement saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeRattachement patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeRattachement[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeRattachement findOrCreate($search, callable $callback = null, $options = [])
 */
class TrattTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setAlias("Tratt");
        $this->setTable('type_rattachement');
        $this->setDisplayField('TYRT_CODE');
        $this->setPrimaryKey('TYRT_CODE');
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
                ->scalar('TYRT_CODE')
                ->maxLength('TYRT_CODE', 10)
                ->allowEmptyString('TYRT_CODE', null, 'create');

        $validator
                ->scalar('TYRT_LIBE')
                ->maxLength('TYRT_LIBE', 50)
                ->allowEmptyString('TYRT_LIBE');

        return $validator;
    }

}
