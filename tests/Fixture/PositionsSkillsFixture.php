<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PositionsSkillsFixture
 *
 */
class PositionsSkillsFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'position' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'skill' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'importance' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'positions_skills_skill' => ['type' => 'index', 'columns' => ['skill'], 'length' => []],
            'positions_skills_job' => ['type' => 'index', 'columns' => ['position'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'position_skill' => ['type' => 'unique', 'columns' => ['position', 'skill'], 'length' => []],
            'positions_skills_position' => ['type' => 'foreign', 'columns' => ['position'], 'references' => ['positions', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'positions_skills_skill' => ['type' => 'foreign', 'columns' => ['skill'], 'references' => ['skills', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'position' => 1,
            'skill' => 1,
            'importance' => 1
        ],
    ];
}
