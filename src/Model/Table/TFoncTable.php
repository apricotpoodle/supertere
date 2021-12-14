<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeFonction Model
 *
 * @method \App\Model\Entity\TypeFonction get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeFonction newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeFonction[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeFonction|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeFonction saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeFonction patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeFonction[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeFonction findOrCreate($search, callable $callback = null, $options = [])
 */
class TFoncTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_fonction');
        $this->setDisplayField('TYFO_CODE');
        $this->setPrimaryKey('TYFO_CODE');
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
                ->scalar('TYFO_CODE')
                ->maxLength('TYFO_CODE', 20)
                ->allowEmptyString('TYFO_CODE', null, 'create');

        $validator
                ->scalar('TYFO_LIBE')
                ->maxLength('TYFO_LIBE', 70)
                ->requirePresence('TYFO_LIBE', 'create')
                ->notEmptyString('TYFO_LIBE');

        $validator
                ->scalar('TYFO_TYPO')
                ->maxLength('TYFO_TYPO', 20)
                ->requirePresence('TYFO_TYPO', 'create')
                ->notEmptyString('TYFO_TYPO');

        $validator
                ->scalar('TYFO_CAUSE')
                ->maxLength('TYFO_CAUSE', 20)
                ->allowEmptyString('TYFO_CAUSE');

        $validator
                ->integer('TYFO_ORDRE')
                ->allowEmptyString('TYFO_ORDRE');

        $validator
                ->integer('TYFO_ORDRE_FLOT')
                ->allowEmptyString('TYFO_ORDRE_FLOT');

        return $validator;
    }

}
