<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ValeurClassifGeo Entity
 *
 * @property string $TYCL_CODE
 * @property string $VACL_VALE
 * @property string|null $VACL_LIBE
 */
class Vcgeo extends Entity {

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
        'VACL_LIBE' => true
    ];

}
