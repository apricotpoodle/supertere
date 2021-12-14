<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeEntiteFixture
 */
class TypeEntiteFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_entite';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYEN_CODE' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYEN_CODE'], 'length' => []],
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
                'TYEN_CODE' => '395b5e8e-627e-4d26-a5db-cfe1d1d35248'
            ],
        ];
        parent::init();
    }
}
