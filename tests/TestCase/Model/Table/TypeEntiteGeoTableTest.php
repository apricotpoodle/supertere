<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeEntiteGeoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeEntiteGeoTable Test Case
 */
class TypeEntiteGeoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeEntiteGeoTable
     */
    public $TypeEntiteGeo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeEntiteGeo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeEntiteGeo') ? [] : ['className' => TypeEntiteGeoTable::class];
        $this->TypeEntiteGeo = TableRegistry::getTableLocator()->get('TypeEntiteGeo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeEntiteGeo);

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
