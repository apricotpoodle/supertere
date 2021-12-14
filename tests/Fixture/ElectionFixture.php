<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ElectionFixture
 */
class ElectionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'election';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ELEC_CLE' => ['type' => 'integer', 'length' => '9', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'INDI_CLE' => ['type' => 'string', 'length' => '3', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYSC_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEN_CODE' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEG_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYEL_CODE' => ['type' => 'string', 'length' => '15', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYRT_CODE' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ELEC_LIB' => ['type' => 'string', 'length' => '60', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'REGL_CODE' => ['type' => 'integer', 'length' => '4', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ELEC_CLE'], 'length' => []],
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
                'ELEC_CLE' => 1,
                'INDI_CLE' => 'L',
                'TYSC_CODE' => 'Lorem ipsum d',
                'TYEN_CODE' => 'Lorem ip',
                'TYEG_CODE' => 'Lorem ipsum d',
                'TYEL_CODE' => 'Lorem ipsum d',
                'TYRT_CODE' => 'Lorem ip',
                'ELEC_LIB' => 'Lorem ipsum dolor sit amet',
                'REGL_CODE' => 1
            ],
        ];
        parent::init();
    }
}
