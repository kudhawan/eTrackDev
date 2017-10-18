<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;
class EmployersController extends AppController
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
		$team_tb = TableRegistry::get('Teams');
		$user_tb = TableRegistry::get('Users');
		$project_tb = TableRegistry::get('Projects');
		
		       /*code to add activity logs*/
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Visited';
				$actdata['description'] = 'Visited   Members Listing page ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
		
		$getOwnerManager = $getClientViewer = $getWorker = '';
	
			$getOwnerManager = $team_tb->find()->where(['Teams.designation_id IN' => [1,2],'Users.status'=>1])->andWhere([
		        'OR' => [
		            ['Teams.member_id' => $this->Auth->user('id')],
		            ['Teams.employer_id' => $this->Auth->user('id')]
		        ]
		    ])->contain(['Users','Designations'])->all();
			$getClientViewer = $team_tb->find()->where(['Teams.designation_id IN' => [4,5],'Users.status'=>1])->andWhere([
		        'OR' => [
		            ['Teams.member_id' => $this->Auth->user('id')],
		            ['Teams.employer_id' => $this->Auth->user('id')]
		        ]
		    ])->contain(['Users','Designations'])->all();
			$getWorker = $team_tb->find()->where(['Teams.designation_id' => 3,'Users.status'=>1])->andWhere([
		        'OR' => [
		            ['Teams.member_id' => $this->Auth->user('id')],
		            ['Teams.employer_id' => $this->Auth->user('id')]
		        ]
		    ])->contain(['Users','Designations','Positions'])->all();
			
			$getProjects = $project_tb->find('all')->all();
			
		
		//pr($getProjects->toArray()); die;
		$this->set(compact('getClientViewer','getOwnerManager','getWorker','getProjects'));
	}

	function edit($id=NULL)
	{
		$decodeId = convert_uudecode(base64_decode($id));
		$team_tb = TableRegistry::get('Teams');
		$user_tb = TableRegistry::get('Users');
			
		if($this->request->is('post')):
		
				$data = $this->request->data;
				$teams = $team_tb->find()->where(['Teams.id' => $data['id']])->first();
				$data['projects'] = $data['projects'];
				$data['designation_id'] = $data['designation_id'];
				if(isset($data['position']))
					$data['position_id'] = $data['position'];
				else
					$data['position_id'] = '';
				$data['projects'] = $data['projects'];
				$teams = $team_tb->patchEntity($teams, $data);
				
        	if($team_tb->save($teams)):
				$this->set(['message'=>'Member has been updated successfully', 'url' => 'members', '_serialize' => ['message','url']]);
				
				/*code to add activity logs*/
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Updated';
				$actdata['description'] = 'Updated  Member details of -  ' .$data['name'];
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
			else:
				throw new BadRequestException('Member update could not be saved.');
			endif;
		endif;
	
		$datas = $team_tb->find()->where(['Teams.id' => $decodeId])->contain(['Users','Designations'])->first();
		$this->set(compact('datas'));
	}
	
	public function positions(){
		if($this->request->is('ajax')){
		
			$data = $this->request->data;
			$id = $data['id'];
			if(isset($data['selectedposition']))
				$selectedposition = $data['selectedposition'];
			else
				$selectedposition = '';
				
			if(isset($data['positionField']))
				$positionField = $data['positionField'];
			else
				$positionField = '';
				
			$options = '';
			$position_tb = TableRegistry::get('Positions');
			$datas = $position_tb->find()->where(['Positions.designation' => $id])->all();
			$this->set(compact('datas','selectedposition', 'positionField'));
		}
	}
	
	function screenshots()
	{
		
	}
	
	function documents()
	{
		
	}
	
	function activites()
	{
		
	}
	
	function description()
	{
		
	}
	
	function timesheet()
	{
		
	}
	
	function weeklyReport()
	{
		
	}
	
	function dailyReport()
	{
		
	}
	
	public function delete($id){
		$id = convert_uudecode(base64_decode($id));
		
		 /*code to add activity logs*/
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Deleted';
				$actdata['description'] = 'Deleted  Member ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
		$team_tb = TableRegistry::get('Teams');
		$team = $team_tb->get($id);
		$team_tb->delete($team);
		//$this->redirect('/members');
		$this->redirect($this->referer());
	}
	
	
	
		function inviteMembers(){
		if($this->request->is('post')):
			$data = $this->request->data;
			
			/*code to add activity logs*/
				$proId=$data['projects'];
				$projects_tb = TableRegistry::get('Projects');
            	$getProject = $projects_tb->find()->where(['Projects.id' => $proId])->first();
				$project_name = $getProject->name;
			
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
				$users_tb = TableRegistry::get('Users');

			$existUser = $users_tb->find('all' , ['conditions'=>['Users.email' => $data['email']]])->count();
			if($existUser == 1):
				
				$user = $users_tb->find()->where(array('email' =>  $data['email']))->first();
			
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
					//$this->set(array('url' => 'members','message' => 'Member invitation has been sent successfully', '_serialize' => array('message','url')));
						$this->set(array('message' => 'Member invitation has been sent successfully', '_serialize' => array('message')));

			else:
				$data = $this->request->data;
				$employer_id = base64_encode(convert_uuencode($this->Auth->user('id')));
				$projects = base64_encode(convert_uuencode($data['projects']));
				if(isset($data['position']))
					$positions = '&position='.base64_encode(convert_uuencode($data['position']));
				else
					$positions = '';
					
				 $link = 'http://' . $_SERVER['HTTP_HOST'] . HTTP_ROOT .'?email='.base64_encode(convert_uuencode($data['email'])).'&employer_id='.$employer_id.'&designation='.base64_encode(convert_uuencode($data['designation_id'])).$positions.'&projects='.$projects;
				if($_SERVER['HTTP_HOST'] != 'localhost'):
						
						
						//$this->sendEmail(
						$this->sendEmailClient(
							$data['email'], 
							'Account Invitation', 
							"Hi,\nWelcome to eTrack!\nPlease create your account first and then you will able to invited in access project.\n<a target=\"_blank\" href='{$link}'>{$link}</a>\n"
						);
				endif;
					//$this->set(array('message' => 'New user invitation messages has been sent', '_serialize' => array('message')));
					$this->set(array('url' => 'members','message' => 'New user invitation messages has been sent', '_serialize' => array('message','url')));
					
			endif;
		endif;
	return;
	}
	
	public function deleteAll(){
		if($this->request->is('post')):
			if(isset($this->request->data['deleteAll'])):
				foreach($this->request->data['deleteAll'] as $key => $value)
				{
					if($value != '')
					{
						$team_tb = TableRegistry::get('Teams');
						$team = $team_tb->get($value);
						$team_tb->delete($team);
					}
				}
				$this->set(['message'=>'Records deleted successfully', 'url' => 'members', '_serialize' => ['message','url']]);
			else:
				throw new BadRequestException('Please choose any one record to delete.');
			endif;
		endif;
	}
}
