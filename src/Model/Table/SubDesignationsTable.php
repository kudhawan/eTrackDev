<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\ORM\Table;


class SubDesignationsTable extends Table
{

    public function initialize(array $config)
    { 
    	parent::initialize($config);
    	
        $this->addBehavior('Timestamp');    
    }

    public function beforeFind(Event $event, Query $query)
    {
        return $query->where(['SubDesignations.is_deleted' => 0]);
    } 
    
}