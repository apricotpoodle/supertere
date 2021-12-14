<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RattachementGeographique Entity
 *
 * @property string $INDI_CLE
 * @property int $ENTG_CLE
 * @property string $EG__INDI_CLE
 * @property int $EG__ENTG_CLE
 * @property string $TYRT_CODE
 */
class TRaGe extends Entity {

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
        '*' => true,
        'INDI_CLE' => false,
        'ENTG_CLE' => false,
        'EG__INDI_CLE' => false,
        'EG__ENTG_CLE' => false,
        'TYRT_CODE' => false
    ];

}
