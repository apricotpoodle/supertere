<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ElectionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ElectionTable Test Case
 */
class ElectionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ElectionTable
     */
    public $Election;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Election'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Election') ? [] : ['className' => ElectionTable::class];
        $this->Election = TableRegistry::getTableLocator()->get('Election', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Election);

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
