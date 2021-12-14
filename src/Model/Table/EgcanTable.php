<?php

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\Validation\Validator;

/**
 * EgCandidature Model
 *
 * @method \App\Model\Entity\EgCandidature get($primaryKey, $options = [])
 * @method \App\Model\Entity\EgCandidature newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EgCandidature[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EgCandidature|false save(EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EgCandidature saveOrFail(EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EgCandidature patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EgCandidature[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EgCandidature findOrCreate($search, callable $callback = null, $options = [])
 */
class EgcanTable extends AppTable
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('eg_candidature');
        $this->setDisplayField('INDI_CLE');
        $this->setPrimaryKey(['INDI_CLE', 'ENTG_CLE']);
        // Add the behaviour to the table
        $this->addBehavior('Search.Search');
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
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
                ->boolean('ENTG_SELECT')
                ->allowEmptyString('ENTG_SELECT');

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
