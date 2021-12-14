<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ValeurClassifGeo Model
 *
 * @method \App\Model\Entity\ValeurClassifGeo get($primaryKey, $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ValeurClassifGeo findOrCreate($search, callable $callback = null, $options = [])
 */
class VcgeoTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('valeur_classif_geo');
        $this->setDisplayField('TYCL_CODE');
        $this->setPrimaryKey(['TYCL_CODE', 'VACL_VALE']);
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
                ->scalar('TYCL_CODE')
                ->maxLength('TYCL_CODE', 20)
                ->allowEmptyString('TYCL_CODE', null, 'create');

        $validator
                ->scalar('VACL_VALE')
                ->maxLength('VACL_VALE', 30)
                ->allowEmptyString('VACL_VALE', null, 'create');

        $validator
                ->scalar('VACL_LIBE')
                ->maxLength('VACL_LIBE', 50)
                ->allowEmptyString('VACL_LIBE');

        return $validator;
    }

    public function findAll(Query $query, array $options)
    {
        $query->where([AppTable::VACLVALE . " NOT LIKE" => "De%"]);
        return parent::findAll($query, $options);
    }

}
