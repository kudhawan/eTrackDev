<?php
namespace Admin\Controller;

use App\Controller\AppController as BaseController;
use Cake\ORM\TableRegistry;

class AppController extends BaseController
{
	
    public function initialize()
    {
        parent::initialize();
        if($this->Auth->user() && !in_array($this->Auth->user('level_id'), array(9)))
        throw new \Cake\Network\Exception\ForbiddenException();
        
    }
}
