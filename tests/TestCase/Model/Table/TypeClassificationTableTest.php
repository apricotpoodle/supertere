<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeClassificationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeClassificationTable Test Case
 */
class TypeClassificationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeClassificationTable
     */
    public $TypeClassification;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeClassification'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeClassification') ? [] : ['className' => TypeClassificationTable::class];
        $this->TypeClassification = TableRegistry::getTableLocator()->get('TypeClassification', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeClassification);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
