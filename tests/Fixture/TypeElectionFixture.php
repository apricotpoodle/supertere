<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeElectionFixture
 */
class TypeElectionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_election';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYSC_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEN_CODE' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEG_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEL_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYFO_CODE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYCO_CODE' => ['type' => 'string', 'length' => '15', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_indexes' => [
            'CORRESPOND2_FK' => ['type' => 'index', 'columns' => ['TYEN_CODE'], 'length' => []],
            'CORRESPOND6_FK' => ['type' => 'index', 'columns' => ['TYFO_CODE'], 'length' => []],
            'CORRESPOND4_FK' => ['type' => 'index', 'columns' => ['TYSC_CODE'], 'length' => []],
            'CORRESPOND1_FK' => ['type' => 'index', 'columns' => ['TYEG_CODE'], 'length' => []],
            'ASSOC_6665_FK' => ['type' => 'index', 'columns' => ['TYCO_CODE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYSC_CODE', 'TYEN_CODE', 'TYEG_CODE', 'TYEL_CODE'], 'length' => []],
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
                'TYSC_CODE' => 'a4f4e6fd-2681-4987-aade-de31e10caf21',
                'TYEN_CODE' => 'b443d22e-1f6c-46d7-8838-711d8ba5d95d',
                'TYEG_CODE' => '1f137cf9-6ea7-4f11-bef9-da14486dc8b1',
                'TYEL_CODE' => '882d35e3-6791-41f6-8bcb-0e4aa3b0174e',
                'TYFO_CODE' => 'Lorem ipsum dolor ',
                'TYCO_CODE' => 'Lorem ipsum d'
            ],
        ];
        parent::init();
    }
}
