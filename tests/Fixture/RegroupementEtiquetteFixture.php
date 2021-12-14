<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RegroupementEtiquetteFixture
 */
class RegroupementEtiquetteFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'regroupement_etiquette';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ETIQ_CLE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'VENT_CODE' => ['type' => 'string', 'length' => '30', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'REGP_ETIQ_GROUPE' => ['type' => 'string', 'length' => '30', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_indexes' => [
            'CORRESPOND8_FK' => ['type' => 'index', 'columns' => ['VENT_CODE'], 'length' => []],
            'EST_DANS_FK' => ['type' => 'index', 'columns' => ['ETIQ_CLE'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ETIQ_CLE', 'VENT_CODE'], 'length' => []],
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
                'ETIQ_CLE' => '975d2a5f-34de-431b-b63c-61451789bcd0',
                'VENT_CODE' => 'ed73754c-9dd1-4e0c-a3c9-52f9538dffdf',
                'REGP_ETIQ_GROUPE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
