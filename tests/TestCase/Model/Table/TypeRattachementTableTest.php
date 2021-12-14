<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TypeRattachementTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TypeRattachementTable Test Case
 */
class TypeRattachementTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TypeRattachementTable
     */
    public $TypeRattachement;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.TypeRattachement'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('TypeRattachement') ? [] : ['className' => TypeRattachementTable::class];
        $this->TypeRattachement = TableRegistry::getTableLocator()->get('TypeRattachement', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TypeRattachement);

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
