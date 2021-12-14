<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ValeurClassifGeoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ValeurClassifGeoTable Test Case
 */
class ValeurClassifGeoTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ValeurClassifGeoTable
     */
    public $ValeurClassifGeo;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.ValeurClassifGeo'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('ValeurClassifGeo') ? [] : ['className' => ValeurClassifGeoTable::class];
        $this->ValeurClassifGeo = TableRegistry::getTableLocator()->get('ValeurClassifGeo', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ValeurClassifGeo);

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
