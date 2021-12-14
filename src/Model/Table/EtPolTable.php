<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EtiquettePolitique Model
 *
 * @method \App\Model\Entity\EtiquettePolitique get($primaryKey, $options = [])
 * @method \App\Model\Entity\EtiquettePolitique newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EtiquettePolitique[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EtiquettePolitique|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EtiquettePolitique saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EtiquettePolitique patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EtiquettePolitique[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EtiquettePolitique findOrCreate($search, callable $callback = null, $options = [])
 */
class EtPolTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('etiquette_politique');
        $this->setAlias("etPol");
        $this->setDisplayField('ETIQ_CLE');
        $this->setPrimaryKey('ETIQ_CLE');
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
                ->scalar('ETIQ_LIBEL')
                ->maxLength('ETIQ_LIBEL', 60)
                ->allowEmptyString('ETIQ_LIBEL');

        $validator
                ->scalar('ETIQ_TYPO')
                ->maxLength('ETIQ_TYPO', 30)
                ->allowEmptyString('ETIQ_TYPO');

        $validator
                ->dateTime('ETIQ_DATE')
                ->allowEmptyDateTime('ETIQ_DATE');

        $validator
                ->scalar('ETIQ_COM')
                ->allowEmptyString('ETIQ_COM');

        $validator
                ->boolean('ETIQ_PREF_PART')
                ->allowEmptyString('ETIQ_PREF_PART');

        $validator
                ->integer('ETIQ_ORDRE')
                ->allowEmptyString('ETIQ_ORDRE');

        return $validator;
    }

}
