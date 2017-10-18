<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\ORM\Table;


class ConversationsTable extends Table
{

    public function initialize(array $config)
    { 
    	parent::initialize($config);
    	
        $this->addBehavior('Timestamp'); 
        
         $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);
        $this->belongsTo('Designations', [
            'foreignKey' => 'designation_id',
            'className' => 'Designations'
        ]);
        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id',
            'className' => 'Positions'
        ]);
       
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'className' => 'Projects'
        ]);   
    }

    public function beforeFind(Event $event, Query $query)
    {
        return $query->where(['Conversations.is_deleted' => 0]);
    } 
    
}
