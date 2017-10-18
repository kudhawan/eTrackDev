<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PositionsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PositionsTable Test Case
 */
class PositionsTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.positions',
        'app.skills',
        'app.jobs',
        'app.jobs_skills',
        'app.tasks',
        'app.jobs_tasks',
        'app.positions_tasks',
        'app.positions_skills'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Positions') ? [] : ['className' => 'App\Model\Table\PositionsTable'];
        $this->Positions = TableRegistry::get('Positions', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Positions);

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
