<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\Event\Event;
use Cake\ORM\Table;


class ProjectBudgetsTable extends Table
{

    public function initialize(array $config)
    { 
    	parent::initialize($config);
    	
        $this->addBehavior('Timestamp');    
		
        $this->belongsTo('Positions', [
            'foreignKey' => 'position_id',
            'className' => 'Positions'
        ]);
       
        $this->belongsTo('Projects', [
            'foreignKey' => 'project_id',
            'className' => 'Projects'
        ]);
    }
    
}