<?php
namespace App\Model\Table;

use App\Model\Entity\User;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Event\Event;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;
/**
 * Users Model
 *
 */
class TimesheetTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->addBehavior('Timestamp');

        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'className' => 'Projects'
        ]);
		
        $this->belongsTo('Works', [
            'foreignKey' => 'worked_id',
            'className' => 'Positions'
        ]);
        
        $this->belongsTo('Bugs', [
            'foreignKey' => 'bug_id',
            'className' => 'Bugs'
        ]);
        
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);
        
    } 
    
    public function beforeFind(Event $event, Query $query)
    {
        return $query->where(['Timesheet.is_deleted' => 0]);
    }
}
