<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TypeDecisionFixture
 */
class TypeDecisionFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'type_decision';
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'TYDE_CODE' => ['type' => 'string', 'length' => '20', 'null' => false, 'default' => null, 'comment' => null, 'precision' => null, 'fixed' => null, 'collate' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['TYDE_CODE'], 'length' => []],
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
                'TYDE_CODE' => 'f843943f-3330-44da-a7dd-9be8ebdf123a'
            ],
        ];
        parent::init();
    }
}
