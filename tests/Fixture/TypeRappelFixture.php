<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeRappelFixture
 */
class TypeRappelFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_rappel';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYRA_CODE' => ['type' => 'string', 'length' => '2', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYRA_LIBE' => ['type' => 'string', 'length' => '20', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        'TYRA_CHAMP' => ['type' => 'string', 'length' => '20', 'null' => true, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYRA_CODE'], 'length' => []],
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
                'TYRA_CODE' => 'a404ebce-8126-4317-8a2e-1246b98d3928',
                'TYRA_LIBE' => 'Lorem ipsum dolor ',
                'TYRA_CHAMP' => 'Lorem ipsum dolor '
            ],
        ];
        parent::init();
    }
}
