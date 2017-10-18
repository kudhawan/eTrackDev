<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * JobsFixture
 *
 */
class JobsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'token' => ['type' => 'string', 'fixed' => true, 'length' => 40, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'company' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'title' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 60, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'state' => ['type' => 'string', 'length' => 60, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'country' => ['type' => 'string', 'length' => 60, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'nationwide' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'lat' => ['type' => 'decimal', 'length' => 10, 'precision' => 8, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'lon' => ['type' => 'decimal', 'length' => 11, 'precision' => 8, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'radius' => ['type' => 'integer', 'length' => 5, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'phone' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'role' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'seniority' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'xfunction' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'active_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'ended_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'deleted_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'jobs_user' => ['type' => 'index', 'columns' => ['user'], 'length' => []],
            'jobs_seniority' => ['type' => 'index', 'columns' => ['seniority'], 'length' => []],
            'jobs_role' => ['type' => 'index', 'columns' => ['role'], 'length' => []],
            'jobs_function' => ['type' => 'index', 'columns' => ['xfunction'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'jobs_function' => ['type' => 'foreign', 'columns' => ['xfunction'], 'references' => ['responsibility', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_role' => ['type' => 'foreign', 'columns' => ['role'], 'references' => ['roles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_seniority' => ['type' => 'foreign', 'columns' => ['seniority'], 'references' => ['seniority', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'jobs_user' => ['type' => 'foreign', 'columns' => ['user'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'user' => 1,
            'token' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'title' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'state' => 'Lorem ipsum dolor sit amet',
            'country' => 'Lorem ipsum dolor sit amet',
            'nationwide' => 1,
            'lat' => '',
            'lon' => '',
            'radius' => 1,
            'phone' => 'Lorem ipsum d',
            'email' => 'Lorem ipsum dolor sit amet',
            'role' => 1,
            'seniority' => 1,
            'xfunction' => 1,
            'active_at' => '2016-02-03 10:06:31',
            'ended_at' => '2016-02-03 10:06:31',
            'modified' => 1454493991,
            'deleted_at' => '2016-02-03 10:06:31',
            'created' => '2016-02-03 10:06:31'
        ],
    ];
}
