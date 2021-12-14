<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EntiteGeoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EntiteGeoTable Test Case
 */
class EntiteGeoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EntiteGeoTable
     */
    public $EntiteGeo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EntiteGeo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EntiteGeo') ? [] : ['className' => EntiteGeoTable::class];
        $this->EntiteGeo = TableRegistry::getTableLocator()->get('EntiteGeo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EntiteGeo);

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
