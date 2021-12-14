<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TypeEntiteGeo Entity
 *
 * @property string $TYEG_CODE
 * @property string|null $TYEG_LIBE
 */
class Tenge extends Entity {

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
        'TYEG_LIBE' => true
    ];

}
