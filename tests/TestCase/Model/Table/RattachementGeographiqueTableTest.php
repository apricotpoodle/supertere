<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RattachementGeographiqueTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RattachementGeographiqueTable Test Case
 */
class RattachementGeographiqueTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RattachementGeographiqueTable
     */
    public $RattachementGeographique;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RattachementGeographique'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RattachementGeographique') ? [] : ['className' => RattachementGeographiqueTable::class];
        $this->RattachementGeographique = TableRegistry::getTableLocator()->get('RattachementGeographique', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RattachementGeographique);

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
