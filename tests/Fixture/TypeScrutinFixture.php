<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeScrutinFixture
 */
class TypeScrutinFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_scrutin';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYSC_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYSC_CODE'], 'length' => []],
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
                'TYSC_CODE' => 'd7b4d5a0-ac2b-4adc-b6a5-0371832fb7f1'
            ],
        ];
        parent::init();
    }
}
