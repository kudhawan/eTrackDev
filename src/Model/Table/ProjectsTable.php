<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\ORM\Table;


class ProjectsTable extends Table
{

    public function initialize(array $config)
    { 
    	parent::initialize($config);
    	
        $this->addBehavior('Timestamp'); 
		
		/*$this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]); */  
    }

    public function beforeFind(Event $event, Query $query)
    {
        return $query->where(['Projects.is_deleted' => 0]);
    } 
    
}