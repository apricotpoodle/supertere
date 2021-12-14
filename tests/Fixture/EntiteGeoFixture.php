<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EntiteGeoFixture
 */
class EntiteGeoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'entite_geo';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ENTG_CLE' => ['type' => 'integer', 'length' => '9', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'TYEG_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_DESI' => ['type' => 'string', 'length' => '50', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_CODINSEE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_LIBELLE' => ['type' => 'string', 'length' => '100', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_TYPO' => ['type' => 'string', 'length' => '100', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_TRI' => ['type' => 'string', 'length' => '100', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_GEOCODE' => ['type' => 'string', 'length' => '10', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_indexes' => [
            'EST1_FK' => ['type' => 'index', 'columns' => ['TYEG_CODE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ENTG_CLE'], 'length' => []],
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'ENTG_CLE' => 1,
                'TYEG_CODE' => 'Lorem ipsum d',
                'ENTG_DESI' => 'Lorem ipsum dolor sit amet',
                'ENTG_CODINSEE' => 'Lorem ipsum d',
                'ENTG_LIBELLE' => 'Lorem ipsum dolor sit amet',
                'ENTG_TYPO' => 'Lorem ipsum dolor sit amet',
                'ENTG_TRI' => 'Lorem ipsum dolor sit amet',
                'ENTG_GEOCODE' => 'Lorem ip'
            ],
        ];
        parent::init();
    }
}
