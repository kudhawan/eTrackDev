<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsersFixture
 *
 */
class UsersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'email' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'password' => ['type' => 'string', 'fixed' => true, 'length' => 64, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'token' => ['type' => 'string', 'fixed' => true, 'length' => 40, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'level' => ['type' => 'integer', 'length' => 3, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fname' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'lname' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'company' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'title' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'phone' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'avatar' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'city' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'state' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'country' => ['type' => 'string', 'length' => 60, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'lat' => ['type' => 'decimal', 'length' => 10, 'precision' => 8, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'lon' => ['type' => 'decimal', 'length' => 11, 'precision' => 8, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => ''],
        'employer' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'verified_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'login_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'active_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'deleted_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'level' => ['type' => 'index', 'columns' => ['level'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'email' => ['type' => 'unique', 'columns' => ['email'], 'length' => []],
            'users_ibfk_1' => ['type' => 'foreign', 'columns' => ['level'], 'references' => ['levels', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'email' => 'Lorem ipsum dolor sit amet',
            'password' => 'Lorem ipsum dolor sit amet',
            'token' => 'Lorem ipsum dolor sit amet',
            'level' => 1,
            'fname' => 'Lorem ipsum dolor sit amet',
            'lname' => 'Lorem ipsum dolor sit amet',
            'company' => 'Lorem ipsum dolor sit amet',
            'title' => 'Lorem ipsum dolor sit amet',
            'phone' => 'Lorem ipsum d',
            'avatar' => 'Lorem ipsum dolor sit amet',
            'city' => 'Lorem ipsum dolor sit amet',
            'state' => 'Lorem ipsum dolor sit amet',
            'country' => 'Lorem ipsum dolor sit amet',
            'lat' => '',
            'lon' => '',
            'employer' => 1,
            'verified_at' => '2016-02-03 09:20:27',
            'login_at' => '2016-02-03 09:20:27',
            'active_at' => '2016-02-03 09:20:27',
            'modified' => '2016-02-03 09:20:27',
            'deleted_at' => '2016-02-03 09:20:27',
            'created' => '2016-02-03 09:20:27'
        ],
    ];
}
