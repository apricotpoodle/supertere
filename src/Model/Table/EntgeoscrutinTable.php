<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EntGeoScrutin Model
 *
 * @method \App\Model\Entity\EntGeoScrutin get($primaryKey, $options = [])
 * @method \App\Model\Entity\EntGeoScrutin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EntGeoScrutin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EntGeoScrutin|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntGeoScrutin saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntGeoScrutin patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EntGeoScrutin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EntGeoScrutin findOrCreate($search, callable $callback = null, $options = [])
 */
class EntgeoscrutinTable extends AppTable {

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('ent_geo_scrutin');
        $this->setDisplayField('INDI_CLE');
        $this->setPrimaryKey(['INDI_CLE', 'ENTG_CLE', 'ELEC_CLE', 'SCRU_TOUR']);
        /**
         *  Add the behaviour to the table
         */
        $this->addBehavior('Search.Search');
        /**
         *  Association(s)
         */
        $this->belongsTo('Election') /* many Scrutins belong to an election */
                ->setForeignKey(AppTable::ELECCLE)
        ;
        $this->belongsTo('engeo') /* many Scrutins belong to an election */
                ->setForeignKey(AppTable::EGCLE)
        ;
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
                ->integer('ELEC_CLE')
                ->allowEmptyString('ELEC_CLE', null, 'create');

        $validator
                ->scalar('SCRU_TOUR')
                ->maxLength('SCRU_TOUR', 2)
                ->allowEmptyString('SCRU_TOUR', null, 'create');

        $validator
                ->integer('EGEO_SIEGES')
                ->allowEmptyString('EGEO_SIEGES');

        $validator
                ->scalar('EGEO_LIBEL')
                ->maxLength('EGEO_LIBEL', 60)
                ->allowEmptyString('EGEO_LIBEL');

        $validator
                ->scalar('EGEO_LIBEL_2')
                ->maxLength('EGEO_LIBEL_2', 1000)
                ->allowEmptyString('EGEO_LIBEL_2');

        return $validator;
    }

}
