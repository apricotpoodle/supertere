<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EntiteGeo Model
 *
 * @method \App\Model\Entity\EntiteGeo get($primaryKey, $options = [])
 * @method \App\Model\Entity\EntiteGeo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EntiteGeo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EntiteGeo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntiteGeo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntiteGeo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EntiteGeo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EntiteGeo findOrCreate($search, callable $callback = null, $options = [])
 */
class EngeoTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('entite_geo');
        $this->setDisplayField('ENTG_CLE');
        $this->setPrimaryKey('ENTG_CLE');
        //$this->setAlias("engeo");
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
                ->integer('ENTG_CLE')
                ->allowEmptyString('ENTG_CLE', null, 'create');

        $validator
                ->scalar('TYEG_CODE')
                ->maxLength('TYEG_CODE', 15)
                ->requirePresence('TYEG_CODE', 'create')
                ->notEmptyString('TYEG_CODE');

        $validator
                ->scalar('ENTG_DESI')
                ->maxLength('ENTG_DESI', 50)
                ->requirePresence('ENTG_DESI', 'create')
                ->notEmptyString('ENTG_DESI');

        $validator
                ->scalar('ENTG_CODINSEE')
                ->maxLength('ENTG_CODINSEE', 15)
                ->requirePresence('ENTG_CODINSEE', 'create')
                ->notEmptyString('ENTG_CODINSEE');

        $validator
                ->scalar('ENTG_LIBELLE')
                ->maxLength('ENTG_LIBELLE', 100)
                ->allowEmptyString('ENTG_LIBELLE');

        $validator
                ->scalar('ENTG_TYPO')
                ->maxLength('ENTG_TYPO', 100)
                ->allowEmptyString('ENTG_TYPO');

        $validator
                ->scalar('ENTG_TRI')
                ->maxLength('ENTG_TRI', 100)
                ->allowEmptyString('ENTG_TRI');

        $validator
                ->scalar('ENTG_GEOCODE')
                ->maxLength('ENTG_GEOCODE', 10)
                ->allowEmptyString('ENTG_GEOCODE');

        return $validator;
    }

}
