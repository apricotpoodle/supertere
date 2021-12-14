<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Election Model
 *
 * @method \App\Model\Entity\Election get($primaryKey, $options = [])
 * @method \App\Model\Entity\Election newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Election[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Election|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Election saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Election patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Election[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Election findOrCreate($search, callable $callback = null, $options = [])
 */
class ElectTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->setTable(self::SETTABELECT);
        $this->setDisplayField(self::ELECCLE);
        $this->setPrimaryKey(self::ELECCLE);
        // Add the behaviour to the table
        $this->addBehavior('Search.Search');

        //Association(s)
        $this->belongsTo(
                'Incan', // Indice Candidature
                [
            /**
             * The class name of the other table.
             */
            "className" => "Incan",
            /**
             *  The name of the foreign key column in the other table.
             */
            "foreignKey" => "INDI_CLE",
            /**
             * The name of the column in the current table
             * used to match the foreignKey.
             */
            "bindingKey" => "INDI_CLE",
                /**
                 * An array of find() compatible conditions
                 * such as ['Addresses.primary' => true]
                 */
                // "conditions" => [],
                /**
                 * The type of the join used in the SQL query.
                 * Accepted values are ‘LEFT’ and ‘INNER’.
                 * You can use ‘INNER’ to get results only where
                 * the association is set.
                 * The default value is ‘LEFT’.
                 */
                // "joinType" => "LEFT",
                /**
                 * When the dependent key is set to true,
                 * and an entity is deleted,
                 * the associated model records are also deleted.
                 */
                // "dependent" => false, // (false by default) else true,
                /**
                 * The property name that should be filled with data
                 * from the associated table into the source table results.
                 * By default this is the underscored & singular name
                 * of the association so address in our example.
                 *
                 */
                // "propertyName" => "INDI_CLE",
                ]
        );

        $this->belongsTo(
                'Tscru', // Type Scrutin
                [
            "className" => "Tscru",
            "foreignKey" => "TYSC_CODE",
            "bindingKey" => "TYSC_CODE",
                // "conditions" => [],
                // "joinType" => "LEFT",
                // "dependent" => false, // (false by default) else true,
                // "propertyName" => "TYSC_CODE",
                ]
        );
        $this->belongsTo(
                'Tenti', // Type Entité Canditate
                [
            "className" => "Tenti",
            "foreignKey" => "TYEN_CODE",
            "bindingKey" => "TYEN_CODE",
                // "conditions" => [],
                // "joinType" => "LEFT",
                // "dependent" => false, // (false by default) else true,
                // "propertyName" => "TYEN_CODE",
                ]
        );
        $this->belongsTo(
                'Tenge', // Type Entité Géographique
                [
            "className" => "Tenge",
            "foreignKey" => "TYEG_CODE",
            "bindingKey" => "TYEG_CODE",
                // "conditions" => [],
                // "joinType" => "LEFT",
                // "dependent" => false, // (false by default) else true,
                // "propertyName" => "TYEG_CODE",
                ]
        );
        $this->belongsTo(
                'Tratt', // Type de rattachement
                [
            "className" => "Tratt",
            "foreignKey" => "TYRT_CODE",
            "bindingKey" => "TYRT_CODE",
                // "conditions" => [],
                // "joinType" => "LEFT",
                // "dependent" => false, // (false by default) else true,
                // "propertyName" => "TYRT_CODE",
                ]
        );
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
                ->integer('ELEC_CLE')
                ->allowEmptyString('ELEC_CLE', null, 'create');

        $validator
                ->scalar('INDI_CLE')
                ->maxLength('INDI_CLE', 3)
                ->requirePresence('INDI_CLE', 'create')
                ->notEmptyString('INDI_CLE');

        $validator
                ->scalar('TYSC_CODE')
                ->maxLength('TYSC_CODE', 15)
                ->requirePresence('TYSC_CODE', 'create')
                ->notEmptyString('TYSC_CODE');

        $validator
                ->scalar('TYEN_CODE')
                ->maxLength('TYEN_CODE', 10)
                ->requirePresence('TYEN_CODE', 'create')
                ->notEmptyString('TYEN_CODE');

        $validator
                ->scalar('TYEG_CODE')
                ->maxLength('TYEG_CODE', 15)
                ->requirePresence('TYEG_CODE', 'create')
                ->notEmptyString('TYEG_CODE');

        $validator
                ->scalar('TYEL_CODE')
                ->maxLength('TYEL_CODE', 15)
                ->requirePresence('TYEL_CODE', 'create')
                ->notEmptyString('TYEL_CODE');

        $validator
                ->scalar('TYRT_CODE')
                ->maxLength('TYRT_CODE', 10)
                ->requirePresence('TYRT_CODE', 'create')
                ->notEmptyString('TYRT_CODE');

        $validator
                ->scalar('ELEC_LIB')
                ->maxLength('ELEC_LIB', 60)
                ->requirePresence('ELEC_LIB', 'create')
                ->notEmptyString('ELEC_LIB');

        $validator
                ->integer('REGL_CODE')
                ->allowEmptyString('REGL_CODE');
        return $validator;
    }

}
