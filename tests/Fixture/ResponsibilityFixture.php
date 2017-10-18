<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResponsibilityFixture
 *
 */
class ResponsibilityFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'responsibility';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'user' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'role' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'name' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'active' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'shifted_from' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'shifted_to' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'deleted_at' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'functions_user' => ['type' => 'index', 'columns' => ['user'], 'length' => []],
            'functions_role' => ['type' => 'index', 'columns' => ['role'], 'length' => []],
            'functions_shifted_from' => ['type' => 'index', 'columns' => ['shifted_from'], 'length' => []],
            'functions_shifted_to' => ['type' => 'index', 'columns' => ['shifted_to'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'functions_role' => ['type' => 'foreign', 'columns' => ['role'], 'references' => ['roles', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'functions_shifted_from' => ['type' => 'foreign', 'columns' => ['shifted_from'], 'references' => ['responsibility', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'functions_shifted_to' => ['type' => 'foreign', 'columns' => ['shifted_to'], 'references' => ['responsibility', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'functions_user' => ['type' => 'foreign', 'columns' => ['user'], 'references' => ['users', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'role' => 1,
            'name' => 'Lorem ipsum dolor sit amet',
            'active' => 1,
            'shifted_from' => 1,
            'shifted_to' => 1,
            'modified' => 1454493965,
            'deleted_at' => '2016-02-03 10:06:05',
            'created' => '2016-02-03 10:06:05'
        ],
    ];
}
