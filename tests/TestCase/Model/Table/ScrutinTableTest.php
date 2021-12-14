<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ScrutinTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ScrutinTable Test Case
 */
class ScrutinTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ScrutinTable
     */
    public $Scrutin;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Scrutin'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Scrutin') ? [] : ['className' => ScrutinTable::class];
        $this->Scrutin = TableRegistry::getTableLocator()->get('Scrutin', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Scrutin);

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
