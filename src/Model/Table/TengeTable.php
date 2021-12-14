<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeEntiteGeo Model
 *
 * @method \App\Model\Entity\TypeEntiteGeo get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeEntiteGeo findOrCreate($search, callable $callback = null, $options = [])
 */
class TengeTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_entite_geo');
        $this->setDisplayField('TYEG_CODE');
        $this->setPrimaryKey('TYEG_CODE');
        // Add the behaviour to the table
        $this->addBehavior('Search.Search');
        $this->setAlias("tenge");
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
                ->scalar('TYEG_CODE')
                ->maxLength('TYEG_CODE', 15)
                ->allowEmptyString('TYEG_CODE', null, 'create');

        $validator
                ->scalar('TYEG_LIBE')
                ->maxLength('TYEG_LIBE', 50)
                ->allowEmptyString('TYEG_LIBE');

        return $validator;
    }

}
