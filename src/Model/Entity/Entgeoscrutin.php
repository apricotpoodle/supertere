<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EntGeoScrutin Entity
 *
 * @property string $INDI_CLE
 * @property int $ENTG_CLE
 * @property int $ELEC_CLE
 * @property string $SCRU_TOUR
 * @property int|null $EGEO_SIEGES
 * @property string|null $EGEO_LIBEL
 * @property string|null $EGEO_LIBEL_2
 */
class Entgeoscrutin extends Entity {

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
        'EGEO_SIEGES' => true,
        'EGEO_LIBEL' => true,
        'EGEO_LIBEL_2' => true
    ];

}
