<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ValeurClassifGeoFixture
 */
class ValeurClassifGeoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'valeur_classif_geo';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYCL_CODE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'VACL_VALE' => ['type' => 'string', 'length' => '30', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'VACL_LIBE' => ['type' => 'string', 'length' => '50', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_indexes' => [
            'CORRESPOND5_FK' => ['type' => 'index', 'columns' => ['TYCL_CODE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYCL_CODE', 'VACL_VALE'], 'length' => []],
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
                'TYCL_CODE' => '474c0a01-b97b-404c-b70d-14e3eae1db70',
                'VACL_VALE' => 'd8c5627d-44c8-4e39-9820-60a40ea243df',
                'VACL_LIBE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
