<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EgCandidatureTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EgCandidatureTable Test Case
 */
class EgCandidatureTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EgCandidatureTable
     */
    public $EgCandidature;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.EgCandidature'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('EgCandidature') ? [] : ['className' => EgCandidatureTable::class];
        $this->EgCandidature = TableRegistry::getTableLocator()->get('EgCandidature', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EgCandidature);

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
