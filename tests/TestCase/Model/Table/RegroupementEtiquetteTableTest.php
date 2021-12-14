<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RegroupementEtiquetteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RegroupementEtiquetteTable Test Case
 */
class RegroupementEtiquetteTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\RegroupementEtiquetteTable
     */
    public $RegroupementEtiquette;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.RegroupementEtiquette'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RegroupementEtiquette') ? [] : ['className' => RegroupementEtiquetteTable::class];
        $this->RegroupementEtiquette = TableRegistry::getTableLocator()->get('RegroupementEtiquette', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RegroupementEtiquette);

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
