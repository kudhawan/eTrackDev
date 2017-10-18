<?php
namespace Admin\Controller;

use Cake\ORM\TableRegistry;
use Admin\Controller\AppController;
use Cake\I18n\Time;

class DefaultController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Users = TableRegistry::get('Users');
	}
	
	function dashboard()
	{
	}
	
	function import()
	{
		
	}
	
}
