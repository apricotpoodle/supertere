<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeClassificationFixture
 */
class TypeClassificationFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_classification';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYCL_CODE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYCL_LIBE' => ['type' => 'string', 'length' => '50', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYCL_CODE'], 'length' => []],
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
                'TYCL_CODE' => '8277e31c-eae2-41cf-8668-d42253b2640e',
                'TYCL_LIBE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
