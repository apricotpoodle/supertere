<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * IndiceCandidature Entity
 *
 * @property string $INDI_CLE
 * @property \Cake\I18n\FrozenTime $INDI_DATE_OUV
 * @property \Cake\I18n\FrozenTime $INDI_DATE_FER
 * @property string|null $INDI_LIBELLE
 */
class Incan extends Entity {

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
        'INDI_DATE_OUV' => true,
        'INDI_DATE_FER' => true,
        'INDI_LIBELLE' => true
    ];

}
