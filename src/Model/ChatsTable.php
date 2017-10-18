<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\ORM\Table;


class ChatsTable extends Table
{

    public function initialize(array $config)
    { 
    	parent::initialize($config);
    	
        $this->addBehavior('Timestamp'); 
        
         $this->belongsTo('Users', [
            'foreignKey' => 'sender_id',
            'className' => 'Users'
        ]);
    }
    
}
