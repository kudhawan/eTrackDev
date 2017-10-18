<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobsSkillsFixture
 *
 */
class JobsSkillsFixture extends TestFixture
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
        'importance' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'jobs_skills_skill' => ['type' => 'index', 'columns' => ['skill'], 'length' => []],
            'jobs_skills_job' => ['type' => 'index', 'columns' => ['job'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'job_skill' => ['type' => 'unique', 'columns' => ['job', 'skill'], 'length' => []],
            'jobs_skills_job' => ['type' => 'foreign', 'columns' => ['job'], 'references' => ['jobs', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_skills_skill' => ['type' => 'foreign', 'columns' => ['skill'], 'references' => ['skills', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'importance' => 1
        ],
    ];
}
