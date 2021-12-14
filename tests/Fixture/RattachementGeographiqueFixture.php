<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RattachementGeographiqueFixture
 */
class RattachementGeographiqueFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'rattachement_geographique';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'INDI_CLE' => ['type' => 'string', 'length' => '3', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ENTG_CLE' => ['type' => 'integer', 'length' => '9', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'EG__INDI_CLE' => ['type' => 'string', 'length' => '3', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'EG__ENTG_CLE' => ['type' => 'integer', 'length' => '9', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'TYRT_CODE' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_indexes' => [
            'LIEN_1165_FK' => ['type' => 'index', 'columns' => ['TYRT_CODE'], 'length' => []],
            'DEPEND_DE_FK' => ['type' => 'index', 'columns' => ['EG__INDI_CLE', 'EG__ENTG_CLE'], 'length' => []],
            'REGROUPE_FK' => ['type' => 'index', 'columns' => ['INDI_CLE', 'ENTG_CLE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['INDI_CLE', 'ENTG_CLE', 'EG__INDI_CLE', 'EG__ENTG_CLE', 'TYRT_CODE'], 'length' => []],
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
                'INDI_CLE' => '498f55b5-c479-4305-934e-f2ac9458637c',
                'ENTG_CLE' => 1,
                'EG__INDI_CLE' => 'af2334e7-2f79-4e98-8a39-4e8848c67f30',
                'EG__ENTG_CLE' => 1,
                'TYRT_CODE' => 'a3920655-5cf8-44d1-bfca-3c53ad87cdee'
            ],
        ];
        parent::init();
    }
}
