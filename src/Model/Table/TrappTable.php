<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TypeRappel Model
 *
 * @method \App\Model\Entity\TypeRappel get($primaryKey, $options = [])
 * @method \App\Model\Entity\TypeRappel newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TypeRappel[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TypeRappel|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeRappel saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TypeRappel patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TypeRappel[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TypeRappel findOrCreate($search, callable $callback = null, $options = [])
 */
class TrappTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('type_rappel');
        $this->setDisplayField('TYRA_CODE');
        $this->setPrimaryKey('TYRA_CODE');
        // Add the behaviour to the table
        $this->addBehavior('Search.Search');
        $this->setAlias("trapp");
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
                ->scalar('TYRA_CODE')
                ->maxLength('TYRA_CODE', 2)
                ->allowEmptyString('TYRA_CODE', null, 'create');

        $validator
                ->scalar('TYRA_LIBE')
                ->maxLength('TYRA_LIBE', 20)
                ->allowEmptyString('TYRA_LIBE');

        $validator
                ->scalar('TYRA_CHAMP')
                ->maxLength('TYRA_CHAMP', 20)
                ->allowEmptyString('TYRA_CHAMP');

        return $validator;
    }

}
