<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;
use Cake\Mailer\Email;

class LandingController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
		$this->loadComponent('Upload');
	}
	
	function view()
	{	
		

	}
	

}
