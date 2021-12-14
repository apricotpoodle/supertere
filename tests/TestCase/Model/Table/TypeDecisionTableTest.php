<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeDecisionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeDecisionTable Test Case
 */
class TypeDecisionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeDecisionTable
     */
    public $TypeDecision;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeDecision'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeDecision') ? [] : ['className' => TypeDecisionTable::class];
        $this->TypeDecision = TableRegistry::getTableLocator()->get('TypeDecision', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeDecision);

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
