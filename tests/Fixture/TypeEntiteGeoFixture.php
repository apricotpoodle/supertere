<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeEntiteGeoFixture
 */
class TypeEntiteGeoFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_entite_geo';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYEG_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEG_LIBE' => ['type' => 'string', 'length' => '50', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYEG_CODE'], 'length' => []],
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
                'TYEG_CODE' => '541d341f-6bdc-417f-bbb2-7e35158a2f0e',
                'TYEG_LIBE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
