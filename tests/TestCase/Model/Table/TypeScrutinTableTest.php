<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeScrutinTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeScrutinTable Test Case
 */
class TypeScrutinTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeScrutinTable
     */
    public $TypeScrutin;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeScrutin'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeScrutin') ? [] : ['className' => TypeScrutinTable::class];
        $this->TypeScrutin = TableRegistry::getTableLocator()->get('TypeScrutin', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeScrutin);

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
