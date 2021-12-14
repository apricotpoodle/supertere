<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EtiquettePolitique Entity
 *
 * @property string $ETIQ_CLE
 * @property string|null $ETIQ_LIBEL
 * @property string|null $ETIQ_TYPO
 * @property \Cake\I18n\FrozenTime|null $ETIQ_DATE
 * @property string|null $ETIQ_COM
 * @property bool|null $ETIQ_PREF_PART
 * @property int|null $ETIQ_ORDRE
 */
class EtPol extends Entity {

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
        'ETIQ_LIBEL' => true,
        'ETIQ_TYPO' => true,
        'ETIQ_DATE' => true,
        'ETIQ_COM' => true,
        'ETIQ_PREF_PART' => true,
        'ETIQ_ORDRE' => true
    ];

}
