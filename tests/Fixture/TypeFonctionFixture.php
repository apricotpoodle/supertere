<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeFonctionFixture
 */
class TypeFonctionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_fonction';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYFO_CODE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYFO_LIBE' => ['type' => 'string', 'length' => '70', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYFO_TYPO' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYFO_CAUSE' => ['type' => 'string', 'length' => '20', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYFO_ORDRE' => ['type' => 'integer', 'length' => '3', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'TYFO_ORDRE_FLOT' => ['type' => 'integer', 'length' => '3', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYFO_CODE'], 'length' => []],
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
                'TYFO_CODE' => '033562de-b7dd-496e-86e6-8d97d3218e01',
                'TYFO_LIBE' => 'Lorem ipsum dolor sit amet',
                'TYFO_TYPO' => 'Lorem ipsum dolor ',
                'TYFO_CAUSE' => 'Lorem ipsum dolor ',
                'TYFO_ORDRE' => 1,
                'TYFO_ORDRE_FLOT' => 1
            ],
        ];
        parent::init();
    }
}
