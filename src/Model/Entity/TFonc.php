<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * TypeFonction Entity
 *
 * @property string $TYFO_CODE
 * @property string $TYFO_LIBE
 * @property string $TYFO_TYPO
 * @property string|null $TYFO_CAUSE
 * @property int|null $TYFO_ORDRE
 * @property int|null $TYFO_ORDRE_FLOT
 */
class TFonc extends Entity {

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
        'TYFO_LIBE' => true,
        'TYFO_TYPO' => true,
        'TYFO_CAUSE' => true,
        'TYFO_ORDRE' => true,
        'TYFO_ORDRE_FLOT' => true
    ];

}
