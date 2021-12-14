<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TypeRappel Entity
 *
 * @property string $TYRA_CODE
 * @property string|null $TYRA_LIBE
 * @property string|null $TYRA_CHAMP
 */
class TRapp extends Entity {

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
        'TYRA_LIBE' => true,
        'TYRA_CHAMP' => true
    ];

}
