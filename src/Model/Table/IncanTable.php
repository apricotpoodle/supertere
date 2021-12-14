<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * IndiceCandidature Model
 *
 * @method \App\Model\Entity\IndiceCandidature get($primaryKey, $options = [])
 * @method \App\Model\Entity\IndiceCandidature newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\IndiceCandidature[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\IndiceCandidature|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndiceCandidature saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\IndiceCandidature patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\IndiceCandidature[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\IndiceCandidature findOrCreate($search, callable $callback = null, $options = [])
 */
class IncanTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('indice_candidature');
        $this->setDisplayField('INDI_CLE');
        $this->setPrimaryKey('INDI_CLE');
        // Add the behaviour to the table
        $this->addBehavior('Search.Search');
        $this->setAlias("Incan");
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
                ->dateTime('INDI_DATE_OUV')
                ->requirePresence('INDI_DATE_OUV', 'create')
                ->notEmptyDateTime('INDI_DATE_OUV');

        $validator
                ->dateTime('INDI_DATE_FER')
                ->requirePresence('INDI_DATE_FER', 'create')
                ->notEmptyDateTime('INDI_DATE_FER');

        $validator
                ->scalar('INDI_LIBELLE')
                ->maxLength('INDI_LIBELLE', 40)
                ->allowEmptyString('INDI_LIBELLE');

        return $validator;
    }

    /**
     * Gestion indice courant, par défaut
     * @return string
     */
    static public function defautInCan()
    {
        /**
         * Il y a une valeur par défaut
         * Gestion indice courant, par défaut
         */
        $annee_courante = \date('Y');  // par exemple 2020
        $defaut = \substr($annee_courante, 0, 1); // 2
        $defaut .= \substr($annee_courante, -2); // 2 + 20 = 220
        return $defaut;
    }

}
