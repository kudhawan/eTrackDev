<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobsTasksFixture
 *
 */
class JobsTasksFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'job' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'skill' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'skill_importance' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'task' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'task_importance' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'years' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'jobs_tasks_task' => ['type' => 'index', 'columns' => ['task'], 'length' => []],
            'jobs_tasks_job' => ['type' => 'index', 'columns' => ['job'], 'length' => []],
            'jobs_task_skill' => ['type' => 'index', 'columns' => ['skill'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'job_task' => ['type' => 'unique', 'columns' => ['job', 'task'], 'length' => []],
            'jobs_task_skill' => ['type' => 'foreign', 'columns' => ['skill'], 'references' => ['skills', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_tasks_job' => ['type' => 'foreign', 'columns' => ['job'], 'references' => ['jobs', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_tasks_task' => ['type' => 'foreign', 'columns' => ['task'], 'references' => ['tasks', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_bin'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'job' => 1,
            'skill' => 1,
            'skill_importance' => 1,
            'task' => 1,
            'task_importance' => 1,
            'years' => 1
        ],
    ];
}
