<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EtiquettePolitiqueTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EtiquettePolitiqueTable Test Case
 */
class EtiquettePolitiqueTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EtiquettePolitiqueTable
     */
    public $EtiquettePolitique;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EtiquettePolitique'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EtiquettePolitique') ? [] : ['className' => EtiquettePolitiqueTable::class];
        $this->EtiquettePolitique = TableRegistry::getTableLocator()->get('EtiquettePolitique', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EtiquettePolitique);

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
