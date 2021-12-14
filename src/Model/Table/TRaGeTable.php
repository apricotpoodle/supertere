<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RattachementGeographique Model
 *
 * @method \App\Model\Entity\RattachementGeographique get($primaryKey, $options = [])
 * @method \App\Model\Entity\RattachementGeographique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RattachementGeographique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RattachementGeographique|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RattachementGeographique saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RattachementGeographique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RattachementGeographique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RattachementGeographique findOrCreate($search, callable $callback = null, $options = [])
 */
class TRaGeTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('rattachement_geographique');
        $this->setDisplayField('INDI_CLE');
        $this->setPrimaryKey(['INDI_CLE', 'ENTG_CLE', 'EG__INDI_CLE', 'EG__ENTG_CLE',
            'TYRT_CODE']);
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
                ->scalar('INDI_CLE')
                ->maxLength('INDI_CLE', 3)
                ->allowEmptyString('INDI_CLE', null, 'create');

        $validator
                ->integer('ENTG_CLE')
                ->allowEmptyString('ENTG_CLE', null, 'create');

        $validator
                ->scalar('EG__INDI_CLE')
                ->maxLength('EG__INDI_CLE', 3)
                ->allowEmptyString('EG__INDI_CLE', null, 'create');

        $validator
                ->integer('EG__ENTG_CLE')
                ->allowEmptyString('EG__ENTG_CLE', null, 'create');

        $validator
                ->scalar('TYRT_CODE')
                ->maxLength('TYRT_CODE', 10)
                ->allowEmptyString('TYRT_CODE', null, 'create');

        return $validator;
    }

}
