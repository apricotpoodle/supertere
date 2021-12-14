<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ScrutinFixture
 */
class ScrutinFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'scrutin';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ELEC_CLE' => ['type' => 'integer', 'length' => '9', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'SCRU_TOUR' => ['type' => 'string', 'length' => '2', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'SCRU_DATE' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'SCRU_VALIDE' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null],
        'SCRU_VALI_DATE' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null],
        'SCRU_ACTIF' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null],
        '_indexes' => [
            'A6_FK' => ['type' => 'index', 'columns' => ['ELEC_CLE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ELEC_CLE', 'SCRU_TOUR'], 'length' => []],
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
                'SCRU_TOUR' => 'b866cfde-2781-4420-8f7f-10ff5380f023',
                'SCRU_DATE' => '2019-09-27 14:06:10',
                'SCRU_VALIDE' => 1,
                'SCRU_VALI_DATE' => '2019-09-27 14:06:10',
                'SCRU_ACTIF' => 1
            ],
        ];
        parent::init();
    }
}
