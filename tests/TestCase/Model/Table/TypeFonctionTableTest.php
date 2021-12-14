<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeFonctionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeFonctionTable Test Case
 */
class TypeFonctionTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeFonctionTable
     */
    public $TypeFonction;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeFonction'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeFonction') ? [] : ['className' => TypeFonctionTable::class];
        $this->TypeFonction = TableRegistry::getTableLocator()->get('TypeFonction', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeFonction);

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
