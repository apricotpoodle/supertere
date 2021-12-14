<?php

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EgCandidature Entity
 *
 * @property string $INDI_CLE
 * @property int $ENTG_CLE
 * @property string $TYEG_CODE
 * @property string $ENTG_DESI
 * @property string $ENTG_CODINSEE
 * @property string|null $ENTG_LIBELLE
 * @property string|null $ENTG_TYPO
 * @property bool|null $ENTG_SELECT
 * @property string|null $ENTG_TRI
 * @property string|null $ENTG_GEOCODE
 */
class Egcan extends Entity {

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
        'TYEG_CODE' => true,
        'ENTG_DESI' => true,
        'ENTG_CODINSEE' => true,
        'ENTG_LIBELLE' => true,
        'ENTG_TYPO' => true,
        'ENTG_SELECT' => true,
        'ENTG_TRI' => true,
        'ENTG_GEOCODE' => true
    ];

}
