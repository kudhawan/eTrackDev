<?php
namespace App\Controller;

use Cake\ORM\TableRegistry;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;
use Cake\Mailer\Email;

class UsersController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Auth->allow();
		$this->loadComponent('Upload');
	}
	
	function login()
	{	
		if($this->request->is('post')):
			if($this->Auth->user())
			throw new BadRequestException('You are already logged in with this or another account. Please refresh the page to proceed.');
			
			$user = $this->Auth->identify();

			if($user && !$user['status'] && $user['token']):
				throw new BadRequestException('Please verify your email account.');
			elseif($user && !$user['status']):
				throw new BadRequestException('Your account has been disabled by admin. For more please contact us at info@codemunks.com.');
			elseif($user):
				$this->Auth->setUser($user);
				//~ Update user login date
				$user = $this->Users->get($user['id']);
				$user->active_now = 1;
				$user->login_at = Time::now();
				$this->Users->save($user);
				
				
				/*if(count($ownTeam)>0):
					foreach($ownTeam as $teamkey => $teamval):
						//if(in_array($timeSheet->id,explode(',',$teamval->projects))): 
							if(($teamval->member_id == $authUser['id'] && (in_array($teamval->position_id, [3]) || in_array($teamval->designation_id, [1,2]))) || $teamval->employer_id == $authUser['id'] || $timeSheet->user_id == $authUser['id'] || $timeSheet->project->user_id == $authUser['id'])
								$visible_bugsheet = true;
						//endif;
					endforeach;
				endif;*/
				
				
				
				$this->set(['message'=>'You have been logged in successfully', 'url' => 'dashboard', '_serialize' => ['message','url']]);
				// $this->Auth->redirectUrl();
				//$this->redirect('/');
			else:
				throw new BadRequestException('Your email and password combination is incorrect.');
			endif;
		else:
			if($this->Auth->user())
				$this->redirect('/dashboard');
		endif;
	}
	
	function register()
	{
		if($this->Auth->user())
		return $this->redirect('/');
		
		$user = $this->Users->newEntity();
		if($this->request->is('post')):
		
			$password = $this->request->data['password'];
			
			if(strlen($password) < 6)
			throw new BadRequestException('Please enter atleast 6 characters for password.');
			
			if($password != $this->request->data['confirm'])
			throw new BadRequestException('Password does not match.');
			
			$data = $this->request->data;
			// pr($data); die;
			$emailChk = $this->Users->find('all' , ['conditions'=>['Users.email' => $data['email']]])->count();
			
			if($emailChk == 1)
			throw new BadRequestException('User already register with this e-mail.');
			
			$data['name'] = $this->request->data['name'];
			$data['email'] = $this->request->data['email'];
			$data['phone'] = $this->request->data['phone'];
			$data['role'] = $this->request->data['designation_id'];
			// $data['password'] = md5($password);
			$data['status'] = 0;
			
			$data['token'] = md5(time()*microtime());
			$user = $this->Users->patchEntity($user, $data);
			
            if ($this->Users->save($user)):
				$user = $this->Users->get($user->id)->toArray();

				$link = (@$_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . HTTP_ROOT . 'users/verify-account/'.$data['token'];
				if($_SERVER['HTTP_HOST'] != 'localhost')
					$this->sendEmail(
						$user['email'], 
						'Account Verification', 
						"Hi {$user['name']},\nWelcome to eTrack!\nPlease verify your email with below link.\n<a target=\"_blank\" href='{$link}'>{$link}</a>\n"
					);
				if(@$data['employer_id'] || !empty($data['employer_id'])){
					//saving new user's data in team table
						$team_tb = TableRegistry::get('Teams');
						$teams = $team_tb->newEntity();
			        	$data['projects'] = $data['projects'];
			        	$data['employer_id'] = $data['employer_id'];
			        	$data['member_id'] = $user['id'];
			        	$data['designation_id'] = $data['designation_id'];
			        	$data['position'] = $data['position'];
	        			$teams = $team_tb->patchEntity($teams, $data);
	        			$team_tb->save($teams);
	        		// saving new user's data in team_project table 
	        			/*$project = TableRegistry::get('Projects');
	        			$team_project_tb = TableRegistry::get('TeamProjects');
	        			$recordId=$teams->id;
	        			$projects = '';
	        			if(@$data['projects'] && !empty($data['projects']))
				        	$projects = explode(',',$data['projects']);
						
						$projectList = $project->find()->where(['Projects.name IN'=>$projects]);
						if($projectList):
					        foreach($projectList as $key => $val):
					        	$teamProjects = $team_project_tb->newEntity();
			        			$data['team_id'] = $recordId;
					        	$data['project_id'] = $val['id'];
			        			$teamProjects = $team_project_tb->patchEntity($teamProjects, $data);
			        			$team_project_tb->save($teamProjects);
			        		endforeach;
			        	endif;*/
			    }
				$this->set(array('message' => 'We have sent you a verification email. Please verify your account', 'url' => 'login', '_serialize' => array('message', 'url')));
				
			else:
				throw new BadRequestException(json_encode($user->errors()));
			endif;
		endif;
	}
	
	function forgotPassword()
	{
		$user = $this->Users->find()->where(array('email' => $this->request->data['email']))->first();
		if(!$user)
		throw new NotFoundException('Email not registered with us.');
		// echo "<pre>";print_r($user['id']);
		$Token = md5(time());
		$this->Users->patchEntity($user, array('token' => $Token));
		$this->Users->save($user);
		// $encToken = base64_encode(convert_uuencode($token));
		$encId = base64_encode(convert_uuencode($user['id']));
		$link = (@$_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . HTTP_ROOT . 'recover?token='.$Token.'&id='.$encId;
		$this->sendEmail(
				$user->email, 
				'Recover Account', 
				"Hi {$user['User']['name']},\nYou can recover your account by clicking on below link.\n<a href='{$link}'>{$link}</a>\n"
			);
		$this->set(array('message' => 'A recovery email has been sent to your registered email address', '_serialize' => array('message')));
	}
	
	function recover()
	{
		if($this->request->is('post')):
			$user = $this->Users->find()->where(array('id'=>$this->request->data['id'],'token' => trim($this->request->data['token'])))->first();
				if(!$user)
				throw new NotFoundException('Token has been expired or not found.');

				if(strlen($this->request->data['new_password']) < 6)
				throw new BadRequestException('Please enter atleast 6 characters for password.');
				if($this->request->data['new_password'] == $this->request->data['confirm_password'])
				{
					// $data = array('password' => $this->request->data['new_password'], 'token' => '','login_at' =>Time::now());
					$data['password'] = $this->request->data['new_password'];
					$data['token'] = '';

					$dataUser = $user->toArray();
						$this->Auth->setUser($dataUser);

					$this->Users->patchEntity($user, $data);
					if ($this->Users->save($user))

						

						$this->set(array('url'=>'login','message' => 'Password has been changed', '_serialize' => array('url','message')));
					else
						throw new BadRequestException('The password could not be saved. Please, try again.');
				}
				else {
					throw new BadRequestException('Confirm password does not match.');
				}
		endif;
	}
	
	function logout()
	{
		$this->Auth->logout();
		return $this->redirect('/');
	}
	
	function verifyAccount($token)
	{
		$user = $this->Users->findByToken(trim($token))->first();
		if(!$user)
		die('Error: Link has been expired.');
		$data = $user->toArray();
		$data['token'] = '';
		$data['status'] = 1;
		$data['verified_at'] = Time::now();
		$user = $this->Users->patchEntity($user, $data);
        $this->Users->save($user);
        $this->Auth->setUser($data);
        $link = (@$_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . HTTP_ROOT;
        $this->sendEmail(
				$data['email'], 
				'Welcome to eTrack', 
				"Hi {$data['name']},\nYour account is verified. Get started now.<a href='{$link}'>{$link}</a>"
			);
		$this->Flash->set('Your account is verified. Get started now');
		return $this->redirect('/dashboard');
	}
	
	function updateProfile()
	{
		$user = $this->Users->get($this->Auth->user('id'));
		$this->set('user', $user);
		if($this->request->is('post')):
			$this->Users->patchEntity($user, $this->request->data);
			if($this->Users->save($user)):
				if($this->request->data('avatar'))
				$this->Upload->upload(
					$this->request->data['avatar'], 
					WWW_ROOT . 'images/userimages/', 
					$user->id . '.jpg',
					array(
						'type' => 'resizecrop', 
						'size' => array(300,300),
					)
				);
				$this->set(array('message' => 'Profile Updated.', 'redirect' => 'dashboard', '_serialize' => array('message', 'redirect')));
			else:
				throw new BadRequestException(current(current($user->errors())));
			endif;
		else:
			$this->viewBuilder()->layout();
		endif;
	}
	
	function changePassword()
	{
		$user = $this->Users->get($this->Auth->user('id'));

		if(!$user)
		throw new NotFoundException();
		
		if($this->request->is('post')):
			if(!$user->checkPassword($this->request->data['old_password'], $user->password))
			throw new BadRequestException('Old password did not match.');
			
			if($this->request->data['new_password'] == $this->request->data['confirm_password'])
			{
				if(strlen($this->request->data['new_password']) < 6)
				throw new BadRequestException('Please enter atleast 6 characters for password.');
				$data = array('password' => $this->request->data['new_password']);
				$this->Users->patchEntity($user, $data);
				if ($this->Users->save($user))
					$this->set(array('message' => 'Password has been changed', 'redirect' => 'dashboard', '_serialize' => array('message', 'redirect')));
				else
					throw new BadRequestException(__('The password could not be saved. Please, try again.'));
			}
			else {
				throw new BadRequestException(__('Confirm password does not match'));
			}
		endif;

	}


	function inviteMembers(){
		if($this->request->is('post')):
			$data = $this->request->data;
			
			/*code to add activity logs*/
				$proId=$data['projects'];
				$projects_tb = TableRegistry::get('Projects');
            	$getProject = $projects_tb->find()->where(['Projects.id' => $proId])->first();
				$project_name=$getProject->name;
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Invited';
				$actdata['description'] = 'Sent invitation to  "'.$data['email'];
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
		// pr($data); 
			  $team_tb = TableRegistry::get('Teams');
		        $team_project_tb = TableRegistry::get('TeamProjects');
	        	$project = TableRegistry::get('Projects');

			$existUser = $this->Users->find('all' , ['conditions'=>['Users.email' => $data['email']]])->count();
			if($existUser == 1):
				
				$user = $this->Users->find()->where(array('email' =>  $data['email']))->first();
			
		        $projects = explode(',',$data['projects']);
					
				$presentProject = false;
				foreach($projects as $project){
		        	$getTeam = $team_tb->find()->where(['member_id'=>$user['id'],'FIND_IN_SET(\''. $project .'\',projects)'])->first();
		        	//$getTeam = $team_tb->find()->where(['employer_id'=>$this->Auth->user('id'),'member_id'=>$user['id'],'designation_id'=>$data['designation_id'],'FIND_IN_SET(\''. $project .'\',projects)'])->first();
					if($getTeam){
						$presentProject = true;
					}
				}
		        if($presentProject): 
						throw new BadRequestException(__('This user already added to this project')); 
		        elseif($data['projects'] == ''):
						throw new BadRequestException(__('Please Select Project'));
		        else:
		        	$teams = $team_tb->newEntity();
					$data['projects'] = $data['projects'];
					$data['employer_id'] = $this->Auth->user('id');
					$data['member_id'] = $user['id'];
					$data['designation_id'] = $data['designation_id'];
					if(isset($data['position']))
						$data['position_id'] = $data['position'];
					$data['projects'] = $data['projects'];
					$teams = $team_tb->patchEntity($teams, $data);
					$team_tb->save($teams);
		
	        	endif;
					$this->set(array('url' => 'members','message' => 'Member invitation has been sent successfully', '_serialize' => array('message','url')));

			else:
				$data = $this->request->data;
				$employer_id = base64_encode(convert_uuencode($this->Auth->user('id')));
				$projects = base64_encode(convert_uuencode($data['projects']));
				if(isset($data['position']))
					$positions = '&position='.base64_encode(convert_uuencode($data['position']));
				else
					$positions = '';
					
				 $link = (@$_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . HTTP_ROOT .'?email='.base64_encode(convert_uuencode($data['email'])).'&employer_id='.$employer_id.'&designation='.base64_encode(convert_uuencode($data['designation_id'])).$positions.'&projects='.$projects;
				//if($_SERVER['HTTP_HOST'] != 'localhost'):
						$this->sendEmail(
							$data['email'], 
							'Account Invitation', 
							"Hi,\nWelcome to eTrack!\nPlease create your account first and then you will able to invited in access project.\n<a target=\"_blank\" href='{$link}'>{$link}</a>\n"
						);
						
					endif;	
						
						
						$this->set(array('url' => 'members','message' => 'New user invitation messages has been sent', '_serialize' => array('message','url')));
						
			/* $this->sendEmail(
				$data['email'], //to mail address
				'Account Invitation', //subject of mail
				"Hi,\nWelcome to eTrack!\nPlease create your account first and then you will able to invited in access project.\n<a target=\"_blank\" href='{$link}'>{$link}</a>\n",
				'order', //mail template name
				'arunavkda@gmail.com' //cc mail address of mail
			);
			*/
			
				//endif;
					//$this->set(array('url' => 'members','message' => 'New user invitation messages has been sent', '_serialize' => array('message','url')));
			
		endif;
	return;
	}
	public function testmail($emailid){
		$subject = 'Account Invitation';
		$content = "Hi,\nWelcome to eTrack!\nPlease create your account first and then you will able to invited in access project.\n<a target=\"_blank\" href='{}'>{}</a>\n";
		
		$email = new Email();
		$email->from(['info@codemunks.com' => 'eTrack'])
			->emailFormat('html')
			->template('default')
			->viewVars(['content' => $content])
			->to($emailid)
			->subject($subject);
		if ( $email->send() ) {
			echo 'Success';
		} else {
			echo 'Failed';
		}
		die;
	}
	
	public function activeUser(){
		//if($this->request->is('ajax')){
			$userId = $this->request->query('id');
			$this->Users = TableRegistry::get('Users');
			// GET TIME DIFFERENCE
			$member_list = $this->Users->find('all', ['conditions' => ['Users.status' => 1,'Users.id !=' => $this->Auth->user('id')]])->all();
			//$member_last_visit = $this->Users->find('all', ['conditions' => ['Users.id' => $userId]])->first();
			foreach($member_list->toArray() as $key => $member_last_visit):
				$current_time = strtotime(date("Y-m-d H:i:s")); // CURRENT TIME
				$last_visit = strtotime($member_last_visit['last_login_at']); // LAST VISITED TIME
				
				$time_period = floor(round(abs($current_time - $last_visit)/60,2)); //CALCULATING MINUTES
				
				//IF YOU WANT TO CALCULATE DAYS THEN USER THIS
				//$time_period = floor(round(abs($current_time - $last_visit)/60,2)/1440);
				
				if ($time_period <= 10){
					$member_last_visit['online_offline_status'] = 1; // Means User is ONLINE
				} else {
					$member_last_visit['online_offline_status'] = 0; // Means User is OFFLINE
				}
			endforeach;
			$this->set(['online_offline_status' => $member_list, '_serialize' => ['online_offline_status']]);
		//}
	}
	
	
 function create()
	{
		
		
		$user = $this->Users->newEntity();
		if($this->request->is('post')):
		
			$password = $this->request->data['password'];
			
			if(strlen($password) < 6)
			throw new BadRequestException('Please enter atleast 6 characters for password.');
			
			if($password != $this->request->data['confirm'])
			throw new BadRequestException('Password does not match.');
			
			$data = $this->request->data;
			// pr($data); die;
			$emailChk = $this->Users->find('all' , ['conditions'=>['Users.email' => $data['email']]])->count();
			
			if($emailChk == 1)
			throw new BadRequestException('User already register with this e-mail.');
			
			$data['name'] = $this->request->data['name'];
			$data['email'] = $this->request->data['email'];
			$data['phone'] = $this->request->data['phone'];
			$data['role'] = $this->request->data['designation_id'];
			$data['password'] = md5($password);
			$data['status'] = 1;
			
			$data['token'] = md5(time()*microtime());
			$user = $this->Users->patchEntity($user, $data);
			
            if ($this->Users->save($user)):
				$user = $this->Users->get($user->id)->toArray();

				$link = (@$_SERVER['HTTPS'] ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . HTTP_ROOT . 'users/verify-account/'.$data['token'];
				if($_SERVER['HTTP_HOST'] != 'localhost')
					$this->sendEmail(
						$user['email'], 
						'Account Created', 
						"Hi {$user['name']},\nWelcome to eTrack!\Use the below details to login to eTrack.\nUser name: {$user['email']}\n Password : {$password}"
					);
				if(@$data['employer_id'] || !empty($data['employer_id'])){
					//saving new user's data in team table
						$team_tb = TableRegistry::get('Teams');
						$teams = $team_tb->newEntity();
			        	$data['projects'] = $data['projects'];
			        	$data['employer_id'] = $data['employer_id'];
			        	$data['member_id'] = $user['id'];
			        	$data['designation_id'] = $data['designation_id'];
			        	$data['position'] = $data['position'];
	        			$teams = $team_tb->patchEntity($teams, $data);
	        			$team_tb->save($teams);
	        		// saving new user's data in team_project table 
	        			/*$project = TableRegistry::get('Projects');
	        			$team_project_tb = TableRegistry::get('TeamProjects');
	        			$recordId=$teams->id;
	        			$projects = '';
	        			if(@$data['projects'] && !empty($data['projects']))
				        	$projects = explode(',',$data['projects']);
						
						$projectList = $project->find()->where(['Projects.name IN'=>$projects]);
						if($projectList):
					        foreach($projectList as $key => $val):
					        	$teamProjects = $team_project_tb->newEntity();
			        			$data['team_id'] = $recordId;
					        	$data['project_id'] = $val['id'];
			        			$teamProjects = $team_project_tb->patchEntity($teamProjects, $data);
			        			$team_project_tb->save($teamProjects);
			        		endforeach;
			        	endif;*/
			    }
				$this->set(array('message' => 'Account has been created .', 'url' => 'create', '_serialize' => array('message', 'url')));
				
			else:
				throw new BadRequestException(json_encode($user->errors()));
			endif;
		endif;
	}
	
	
	
}
