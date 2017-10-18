<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;

class ClientsController extends AppController
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
	}
	
 function view()
	{
		 $getUsers = '';
		 $activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Visited';
				$actdata['description'] = 'Visited   Users Listing page ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
		$user_tb = TableRegistry::get('Users');
		$getUsers = '';
		$getUsers = $user_tb->find('all')->where(['Users.is_admin IN' => [0,1],'Users.status'=>1])->all();
		$this->set(compact('getUsers'));
	}
	
public function delete($id){
		$id = convert_uudecode(base64_decode($id));
		$users_tb = TableRegistry::get('Users');
		$user = $users_tb->get($id);
		$getUser = $users_tb->find()->where(['Users.id' => $id])->first();
		$user_name=$getUser->name;
		
		
		if($users_tb->delete($user)){
			
			/*code to add activity logs*/	
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$data['user_id'] = $userId;
				$data['action'] = 'Deleted';
				$data['description'] = 'Deleted the user  -'.$user_name;
				$data['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $data);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
			/*$users_tb->deleteAll(
				[ 
					'Users.id' => $id
				]
			); */ 
			   
			$team_tb = TableRegistry::get('Teams');
			$team_tb->deleteAll(
				[
					'FIND_IN_SET('.$id.', employer_id)'
				]
			);
			$timesheet_tb = TableRegistry::get('Timesheet');
			$timesheet_tb->deleteAll(
				[ 
					'Timesheet.user_id' => $id
				]
			);
			$dailyreports_tb = TableRegistry::get('Dailyreports');
			$dailyreports_tb->deleteAll(
				[ 
					'Dailyreports.user_id' => $id
				]
			);
			$bugs_tb = TableRegistry::get('Bugs');
			$bugs_tb->deleteAll(
				[ 
					'Bugs.user_id' => $id
				]
			);
			$features_tb = TableRegistry::get('Features');
			$features_tb->deleteAll(
				[ 
					'Features.user_id' => $id
				]
			);
			$documents_tb = TableRegistry::get('Documents');
			$documents_tb->deleteAll(
				[ 
					'Documents.user_id' => $id
				]
			);
			$screenshots_tb = TableRegistry::get('Screenshots');
			$screenshots_tb->deleteAll(
				[ 
					'Screenshots.user_id' => $id
				]
			);
			
			
			$conversations_tb = TableRegistry::get('Conversations');
			$conversations_tb->deleteAll(
				[ 
					'Conversations.user_id' => $id
				]
			);
		}
		$this->redirect($this->referer());
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
			$data['password'] = $this->request->data['password'];
			$data['is_admin'] = $this->request->data['user_type'];
			//$data['password'] = md5($password);
			$data['status'] = 1;
			
			$data['token'] = md5(time()*microtime());
			$user = $this->Users->patchEntity($user, $data);
			
            if ($this->Users->save($user)):
				$user = $this->Users->get($user->id)->toArray();

				if($_SERVER['HTTP_HOST'] != 'localhost')
					$this->sendEmailClient(
						$user['email'], 
						'Account Created', 
						"Hi,\nWelcome to eTrack!\nPlease login to your account using following credentials.\n Username:{$user['email']}\npassword:{$password}"
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
				//$this->set(['message'=>'Account has been created', 'url' => 'Clients', '_serialize' => ['message','url']]);
				$this->set(array('message' => 'Account has been created .', 'url' => 'clients/create', '_serialize' => array('message', 'url')));
				
			else:
				throw new BadRequestException(json_encode($user->errors()));
			endif;
		endif;
	}
}
