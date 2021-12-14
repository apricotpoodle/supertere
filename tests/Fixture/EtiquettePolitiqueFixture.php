<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * EtiquettePolitiqueFixture
 */
class EtiquettePolitiqueFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'etiquette_politique';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'ETIQ_CLE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ETIQ_LIBEL' => ['type' => 'string', 'length' => '60', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ETIQ_TYPO' => ['type' => 'string', 'length' => '30', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ETIQ_DATE' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null],
        'ETIQ_COM' => ['type' => 'string', 'length' => '0', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'ETIQ_PREF_PART' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => null, 'precision' => null],
        'ETIQ_ORDRE' => ['type' => 'integer', 'length' => '6', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['ETIQ_CLE'], 'length' => []],
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
                'ETIQ_CLE' => '6a2158f4-9403-40fc-9494-2f75f04177e0',
                'ETIQ_LIBEL' => 'Lorem ipsum dolor sit amet',
                'ETIQ_TYPO' => 'Lorem ipsum dolor sit amet',
                'ETIQ_DATE' => '2019-10-15 10:15:38',
                'ETIQ_COM' => 'Lorem ipsum dolor sit amet',
                'ETIQ_PREF_PART' => 1,
                'ETIQ_ORDRE' => 1
            ],
        ];
        parent::init();
    }
}
