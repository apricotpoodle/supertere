<?php

/**
 * Short description for file
 *
 * Long description for file (if any)...
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category   CategoryName
 * @package    PackageName
 * @author     Original Author <author@example.com>
 * @author     Another Author <another@example.com>
 * @copyright  1997-2005 The PHP Group
 * @license    http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version    SVN: $Id$
 * @link       http://pear.php.net/package/PackageName
 * @see        NetOther, Net_Sample::Net_Sample()
 * @since      File available since Release 1.2.0
 * @deprecated File deprecated in Release 2.0.0
 */


namespace App\Model\Table;

use Cake\Datasource\EntityInterface;
use Cake\Validation\Validator;

//use function false;

/**
 * Scrutin Model
 *
 * @method \App\Model\Entity\Scrutin get($primaryKey, $options = [])
 * @method \App\Model\Entity\Scrutin newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Scrutin[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Scrutin|false save(EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scrutin saveOrFail(EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Scrutin patchEntity(EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Scrutin[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Scrutin findOrCreate($search, callable $callback = null, $options = [])
 */
class ScrutTable extends AppTable
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

        $this->setTable('scrutin');
        $this->setDisplayField(self::ELECCLE);
        $this->setPrimaryKey([self::ELECCLE, self::SCRUTTOUR]);

        // Add the behaviour to the table
        $this->addBehavior('Search.Search');

        /* Association(s) */
        $this->belongsTo('Election') /* many Scrutins belong to an election */
                ->setForeignKey(self::ELECCLE)
        ;
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
                ->integer('ELEC_CLE')
                ->allowEmptyString('ELEC_CLE', null, 'create');

        $validator
                ->scalar('SCRU_TOUR')
                ->maxLength('SCRU_TOUR', 2)
                ->allowEmptyString('SCRU_TOUR', null, 'create');

        $validator
                //->dateTime('SCRU_DATE')
                ->requirePresence('SCRU_DATE', 'create')
                ->notEmptyDateTime('SCRU_DATE');

        $validator
                ->boolean('SCRU_VALIDE')
                ->allowEmptyString('SCRU_VALIDE');

        $validator
                //->dateTime('SCRU_VALI_DATE')
                ->allowEmptyDateTime('SCRU_VALI_DATE');

        $validator
                ->boolean('SCRU_ACTIF')
                ->allowEmptyString('SCRU_ACTIF');

        return $validator;
    }
}
