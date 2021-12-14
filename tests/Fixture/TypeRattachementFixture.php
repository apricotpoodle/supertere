<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeRattachementFixture
 */
class TypeRattachementFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_rattachement';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYRT_CODE' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYRT_LIBE' => ['type' => 'string', 'length' => '50', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYRT_CODE'], 'length' => []],
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
                'TYRT_CODE' => '7d87b8d6-8594-4e7a-8fd4-624db2fd3cf2',
                'TYRT_LIBE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
