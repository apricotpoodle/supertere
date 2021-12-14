<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VentilationTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VentilationTable Test Case
 */
class VentilationTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VentilationTable
     */
    public $Ventilation;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.Ventilation'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Ventilation') ? [] : ['className' => VentilationTable::class];
        $this->Ventilation = TableRegistry::getTableLocator()->get('Ventilation', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Ventilation);

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
