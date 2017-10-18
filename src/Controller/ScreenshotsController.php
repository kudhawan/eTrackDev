<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;
class ScreenshotsController extends AppController
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
	public function screenshotDetails()
	{
		//echo 111;
		if($this->request->is('post')):
			$data = $this->request->data;
			 $id = convert_uudecode(base64_decode($data['sid']));
			 $screenshot_tb = TableRegistry::get('Screenshots');
		     $screenshot = $screenshot_tb->get($id);
			// print_r($screenshot);
			 $this->set(compact('screenshot'));
			
		endif;
	}
	
	
	function create()
	{
		$deginationsList = $positionList = $usersList = $memberList = '';
		$designation_tb = TableRegistry::get('Designations');
		$position_tb = TableRegistry::get('Positions');
		$team_tb = TableRegistry::get('Teams');
		
		$usersList = $this->Users->find('all')->where(['Users.status' => 1])->all();
		$designationsList = $designation_tb->find('all')->all();
		$positionList = $position_tb->find('all')->all();
		
		//pr($positionList); die;
		if($this->request->is('post')):
			$data = $this->request->data;
			$userId= $this->Auth->user('id');
			$project = TableRegistry::get('Projects');
	        $projects = $project->newEntity();

	        $data['user_id'] = $userId;
			$data['slug'] = strtolower(str_replace(' ','_',$data['name']));
			
			foreach($designationsList as $designationsKey => $designationsVal):
				if(isset($data[$designationsVal->name]) && !empty($data[$designationsVal->name])){
					$members = explode(',', $data[$designationsVal->name]);
					$memberList[] = array(
									'id' => $designationsVal->id,
									'members' => $members
							);
				}
			endforeach;
            $projects = $project->patchEntity($projects, $data);
			$result = $project->save($projects);
        	if($result):
				$record_id=$result->id;
				foreach($memberList as $member):
					foreach($member['members'] as $values):
						$teams = $team_tb->newEntity();
						$data['projects'] = $record_id;
						$data['employer_id'] = $this->Auth->user('id');
						$data['member_id'] = $values;
						$data['designation_id'] = $member['id'];
						$teams = $team_tb->patchEntity($teams, $data);
						$team_tb->save($teams);
					endforeach;
				endforeach;
				
				$this->set(['message'=>'Screenshot has been saved successfully', 'url' => 'projects', '_serialize' => ['message','url']]);
				/*code to add activity logs*/
				$proId=$data['project_id'];
				$projects_tb = TableRegistry::get('Projects');
            	$getProject = $projects_tb->find()->where(['Projects.id' => $proId])->first();
				$project_name=$getProject->name;
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Created';
				$actdata['description'] = 'Created   Screen shot  "'.$data['title'].'" for the project -  '.$project_name;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			else:
				throw new BadRequestException('New project could not be saved.');
			endif;
			
		endif;
		
		$this->set(compact('designationsList','positionList','usersList'));
	}
	
	function view()
	{

		$dailyreports = $projects = '';
		$dailyreport_tb = TableRegistry::get('Dailyreports');
		$team_tb = TableRegistry::get('Teams');
		
		$userId = $this->Auth->user('id');
		
		  	  /*code to add activity logs*/
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Visited';
				$actdata['description'] = 'Visited   Screenshots Listing page ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
		
		$teamsList = $team_tb->find('all')
											//->orWhere(['member_id' => $userId])
											->all();

		$dailyreports = $dailyreport_tb->find('all');
						//->where(['Dailyreports.user_id' => $userId]);
						
						if(isset($this->request->query['date']))
							$dailyreports->where(['Date(Dailyreports.created_at)' => date('Y-m-d', strtotime($this->request->query['date']))]);
							
						/*$dailyreports->orWhere(['Teams.employer_id' => $userId, 'FIND_IN_SET(Dailyreports.project_id, Teams.projects)', 'Teams.member_id=Dailyreports.user_id'])
									->orWhere(['FIND_IN_SET(Dailyreports.project_id, Teams.projects)', 'Teams.designation_id IN' => [1,2,5], 'Teams.member_id' => $userId]);
						
							
						$dailyreports->contain(['Users','Designations','Projects','Positions','Teams'])*/
						$dailyreports->contain(['Users','Designations','Projects','Positions'])
						->all();
		
		//pr($otherProjects->toArray()); die;
		$this->set(compact('dailyreports','teamsList'));
	}

	function edit($id=NULL)
	{
		$decodeId = convert_uudecode(base64_decode($id));
		
		$deginationsList = $positionList = $usersList = $teamsList = $memberList = '';
		$designation_tb = TableRegistry::get('Designations');
		$position_tb = TableRegistry::get('Positions');
		$team_tb = TableRegistry::get('Teams');
		
		$teamsList = $team_tb->find('all')->where(['FIND_IN_SET("'.$decodeId.'",Teams.projects)'])->all();
		$usersList = $this->Users->find('all')->where(['Users.status' => 1])->all();
		$designationsList = $designation_tb->find('all')->all();
		$positionList = $position_tb->find('all')->all();
			
		$project_tb = TableRegistry::get('Projects');
		$getProject = $project_tb->find()->where(['Projects.id' => $decodeId])->first();
		
		if($this->request->is('post')):
			$data = $this->request->data;
			$getProject = $project_tb->find()->where(['Projects.id' => $data['id']])->first();
			$userId= $this->Auth->user('id');
	        $data['user_id'] = $userId;
			$data['slug'] = strtolower(str_replace(' ','_',$data['name']));
			
			foreach($designationsList as $designationsKey => $designationsVal):
				if(isset($data[$designationsVal->name]) && !empty($data[$designationsVal->name])){
					$members = explode(',', $data[$designationsVal->name]);
					$memberList[] = array(
									'id' => $designationsVal->id,
									'members' => $members
							);
				}
			endforeach;
            $getProject = $project_tb->patchEntity($getProject,$data);
			$result = $project_tb->save($getProject);
        	if($result):
			
				$teamtb = TableRegistry::get('Teams');
				$teamtb->deleteAll(['Teams.projects' => $data['id']]);
				
				foreach($memberList as $member):
					foreach($member['members'] as $values):
						$teams = $team_tb->newEntity();
						$teamsdata['projects'] = $data['id'];
						$teamsdata['employer_id'] = $this->Auth->user('id');
						$teamsdata['member_id'] = $values;
						$teamsdata['designation_id'] = $member['id'];
						$teams = $team_tb->patchEntity($teams, $teamsdata);
						$team_tb->save($teams);
					endforeach;
				endforeach;
				
				$this->set(['message'=>'Project has been updated successfully', 'url' => 'projects', '_serialize' => ['message','url']]);
				
				/*code to add activity logs*/
				$proId=$data['project_id'];
				$projects_tb = TableRegistry::get('Projects');
            	$getProject = $projects_tb->find()->where(['Projects.id' => $proId])->first();
				$project_name=$getProject->name;
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Updated';
				$actdata['description'] = 'Updated   Screen shot  "'.$data['title'].'" for the project -  '.$project_name;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
			else:
				throw new BadRequestException('Edit project could not be saved.');
			endif;
		endif;
		$this->set(compact('getProject','designationsList','positionList','usersList','teamsList'));
	}
	
	public function delete($id){
		$id = convert_uudecode(base64_decode($id));
		$projects_tb = TableRegistry::get('Projects');
		$project = $projects_tb->get($id);
		$projects_tb->delete($project);
		$this->redirect('/projects');
	}
	
	public function deleteAll(){
		if($this->request->is('post')):
			if(isset($this->request->data['deleteAll'])):
				foreach($this->request->data['deleteAll'] as $key => $value)
				{
					if($value != '')
					{
						$projects_tb = TableRegistry::get('Projects');
						$projects = $projects_tb->get($value);
						$projects_tb->delete($projects);
					}
				}
				$this->set(['message'=>'Records deleted successfully', 'url' => 'projects', '_serialize' => ['message','url']]);
			else:
				throw new BadRequestException('Please choose any one record to delete.');
			endif;
		endif;
	}
}
