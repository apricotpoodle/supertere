<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VentilationFixture
 */
class VentilationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'ventilation';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'VENT_CODE' => ['type' => 'string', 'length' => '30', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'VENT_LIBE' => ['type' => 'string', 'length' => '50', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['VENT_CODE'], 'length' => []],
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
                'VENT_CODE' => '0d0c3eb1-3401-4a45-9547-d29146ec5560',
                'VENT_LIBE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
