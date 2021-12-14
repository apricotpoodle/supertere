<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeEntiteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeEntiteTable Test Case
 */
class TypeEntiteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeEntiteTable
     */
    public $TypeEntite;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeEntite'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeEntite') ? [] : ['className' => TypeEntiteTable::class];
        $this->TypeEntite = TableRegistry::getTableLocator()->get('TypeEntite', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeEntite);

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
