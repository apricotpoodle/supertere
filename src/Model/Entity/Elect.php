<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Election Entity
 *
 * @property int $ELEC_CLE
 * @property string $INDI_CLE
 * @property string $TYSC_CODE
 * @property string $TYEN_CODE
 * @property string $TYEG_CODE
 * @property string $TYEL_CODE
 * @property string $TYRT_CODE
 * @property string $ELEC_LIB
 * @property int|null $REGL_CODE
 */
class Elect extends Entity {

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'INDI_CLE' => true,
        'TYSC_CODE' => true,
        'TYEN_CODE' => true,
        'TYEG_CODE' => true,
        'TYEL_CODE' => true,
        'TYRT_CODE' => true,
        'ELEC_LIB' => true,
        'REGL_CODE' => true
    ];

}
