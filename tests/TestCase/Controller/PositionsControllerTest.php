<?php
namespace App\Test\TestCase\Controller;

use App\Controller\PositionsController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\PositionsController Test Case
 */
class PositionsControllerTest extends IntegrationTestCase
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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
