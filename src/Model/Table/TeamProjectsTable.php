<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\ORM\Table;


class TeamProjectsTable extends Table
{

    public function initialize(array $config)
    { 
    	parent::initialize($config);
    	
        $this->addBehavior('Timestamp'); 

        $this->belongsTo('Teams', [
            'foreignKey' => 'team_id',
            'className' => 'Teams'
        ]);
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'className' => 'Projects'
        ]);
    }

    public function beforeFind(Event $event, Query $query)
    {
        return $query->where(['TeamProjects.is_deleted' => 0]);
    } 
    
}