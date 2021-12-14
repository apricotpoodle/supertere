<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * IndiceCandidatureFixture
 */
class IndiceCandidatureFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'indice_candidature';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'INDI_CLE' => ['type' => 'string', 'length' => '3', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'INDI_DATE_OUV' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'INDI_DATE_FER' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => null, 'precision' => null],
        'INDI_LIBELLE' => ['type' => 'string', 'length' => '40', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['INDI_CLE'], 'length' => []],
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
                'INDI_CLE' => '5206381c-2f61-4236-8cf9-fff2a436e554',
                'INDI_DATE_OUV' => '2019-10-04 14:48:24',
                'INDI_DATE_FER' => '2019-10-04 14:48:24',
                'INDI_LIBELLE' => 'Lorem ipsum dolor sit amet'
            ],
        ];
        parent::init();
    }
}
