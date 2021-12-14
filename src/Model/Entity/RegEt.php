<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegroupementEtiquette Entity
 *
 * @property string $ETIQ_CLE
 * @property string $VENT_CODE
 * @property string $REGP_ETIQ_GROUPE
 */
class RegEt extends Entity {

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
        'REGP_ETIQ_GROUPE' => true
    ];

}
