<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeRappelTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeRappelTable Test Case
 */
class TypeRappelTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeRappelTable
     */
    public $TypeRappel;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeRappel'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeRappel') ? [] : ['className' => TypeRappelTable::class];
        $this->TypeRappel = TableRegistry::getTableLocator()->get('TypeRappel', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeRappel);

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
