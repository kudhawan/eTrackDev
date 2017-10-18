<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TasksTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TasksTable Test Case
 */
class TasksTableTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tasks',
        'app.jobs',
        'app.skills',
        'app.jobs_skills',
        'app.positions',
        'app.positions_skills',
        'app.jobs_tasks',
        'app.positions_tasks'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Tasks') ? [] : ['className' => 'App\Model\Table\TasksTable'];
        $this->Tasks = TableRegistry::get('Tasks', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Tasks);

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
