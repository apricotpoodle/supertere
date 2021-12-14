<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * RegroupementEtiquette Model
 *
 * @method \App\Model\Entity\RegroupementEtiquette get($primaryKey, $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RegroupementEtiquette findOrCreate($search, callable $callback = null, $options = [])
 */
class RegEtTable extends Table {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('regroupement_etiquette');
        $this->setDisplayField('ETIQ_CLE');
        $this->setPrimaryKey(['ETIQ_CLE', 'VENT_CODE']);
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
                ->scalar('ETIQ_CLE')
                ->maxLength('ETIQ_CLE', 20)
                ->allowEmptyString('ETIQ_CLE', null, 'create');

        $validator
                ->scalar('VENT_CODE')
                ->maxLength('VENT_CODE', 30)
                ->allowEmptyString('VENT_CODE', null, 'create');

        $validator
                ->scalar('REGP_ETIQ_GROUPE')
                ->maxLength('REGP_ETIQ_GROUPE', 30)
                ->requirePresence('REGP_ETIQ_GROUPE', 'create')
                ->notEmptyString('REGP_ETIQ_GROUPE');

        return $validator;
    }

}
