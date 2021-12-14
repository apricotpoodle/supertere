<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TypeElection Entity
 *
 * @property string $TYSC_CODE
 * @property string $TYEN_CODE
 * @property string $TYEG_CODE
 * @property string $TYEL_CODE
 * @property string $TYFO_CODE
 * @property string|null $TYCO_CODE
 */
class TElec extends Entity {

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
        'TYSC_CODE' => true,
        'TYEN_CODE' => true,
        'TYEG_CODE' => true,
        'TYEL_CODE' => true,
        'TYFO_CODE' => true,
        'TYCO_CODE' => true
    ];

}
