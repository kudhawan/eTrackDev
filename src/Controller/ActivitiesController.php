<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
class TasksController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$authUser = '';
		if($this->Auth->user())
			$authUser = $this->Auth->user();
			
		$this->set(compact('authUser'));
		$this->Auth->Deny();
		$this->Users = TableRegistry::get('Users');
		
		$this->Activities = TableRegistry::get('Activities');
	}

	function activityList()
	{
		
			$openActivities = $this->Activities->find('all' , )->order(['Activities.id' => 'DESC'])->toArray();
			
			
			$this->set(compact('openActivities' ));
		}
	}
	

}
