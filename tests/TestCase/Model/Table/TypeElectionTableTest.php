<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeElectionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeElectionTable Test Case
 */
class TypeElectionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeElectionTable
     */
    public $TypeElection;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeElection'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeElection') ? [] : ['className' => TypeElectionTable::class];
        $this->TypeElection = TableRegistry::getTableLocator()->get('TypeElection', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeElection);

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
