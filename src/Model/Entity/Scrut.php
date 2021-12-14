<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Scrutin Entity
 *
 * @property int $ELEC_CLE
 * @property string $SCRU_TOUR
 * @property \Cake\I18n\FrozenTime $SCRU_DATE
 * @property bool|null $SCRU_VALIDE
 * @property \Cake\I18n\FrozenTime|null $SCRU_VALI_DATE
 * @property bool|null $SCRU_ACTIF
 */
class Scrut extends Entity {

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
        'SCRU_DATE' => true,
        'SCRU_VALIDE' => true,
        'SCRU_VALI_DATE' => true,
        'SCRU_ACTIF' => true
    ];

}
