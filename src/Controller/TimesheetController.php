<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;

class TimesheetController extends AppController
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
		$this->Bugs = TableRegistry::get('Bugs');
		$this->Projects = TableRegistry::get('Projects');
		$this->Timesheet = TableRegistry::get('Timesheet');
	}
	
	
	function index()
	{
			/*code to add activity logs*/	
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$data['user_id'] = $userId;
				$actdata['action'] ='Visited';
				$data['description'] = 'Visited the Time sheets page ';
				$data['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $data);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
	
		
		$timeSheets = [];
		
		$projects = TableRegistry::get('Projects');
		$team_tb = TableRegistry::get('Teams');
		$user_tb = TableRegistry::get('Users');
		$userId= $this->Auth->user('id');
		
		$allUsers = $user_tb->find('all')->where(['Users.status' => 1])->all();
		
		$getTeam = $team_tb->find('all')->where(['Teams.employer_id' => $this->Auth->user('id')])->orWhere(['Teams.member_id' => $this->Auth->user('id')])->contain(['Users','Designations'])->all();
		if(!empty($getTeam)):
			$projectslist = '';
			foreach($getTeam as $teams):
				$projectslist .= $teams->projects.',';
			endforeach;
			if(strlen($projectslist)>1){
				$projectslist = substr($projectslist, 0, strlen($projectslist)-1);
				$projectslist = explode(',',$projectslist);
			} else {
				$projectslist = array(
								$projectslist	
							);
			}
		endif;
		$Projects = $projects->find()->where(['id IN' => $projectslist])->orWhere(['user_id' => $this->Auth->user('id')])->all();

			
			$timeSheets = $this->Timesheet->find('all');
			
			if((isset($_GET['pid']))&&($_GET['pid']!=''))
			{
				if(isset($_GET['uid']) && $_GET['uid']!='')
					$timeSheets->where(['Timesheet.user_id' => $_GET['uid'],'Timesheet.project_id ' => $_GET['pid']]);
				else {
					$timeSheets->where(['Timesheet.user_id' => $this->Auth->user('id'),'Timesheet.project_id ' => $_GET['pid']]);
					$timeSheets->orWhere(['Timesheet.project_id ' => $_GET['pid']]);
				}
			}
			else
			{
				if(isset($_GET['uid']) && $_GET['uid']!='')
					$timeSheets->where(['Timesheet.user_id' => $_GET['uid']]);
				else {
					$timeSheets->where(['Timesheet.user_id' => $this->Auth->user('id')]);
					$timeSheets->orWhere(['Timesheet.project_id IN' => $projectslist]);	
				}
			}
			
			$timeSheets->order(['Timesheet.id' => 'DESC'])->contain(['Projects' , 'Bugs', 'Users'])->all();
		//echo '<pre>';
		//print_r($timeSheets);
		//echo '</pre>';
		//die;
		$ownTeam = $team_tb->find('all')->where(['Users.status' => 1])->contain(['Users','Designations'])->all();
		$this->set(compact('timeSheets','Projects','ownTeam','allUsers'));
	}
	
	public function timesheetDetails()
	{
		
		if($this->request->is('ajax')):
		
			$team_tb = TableRegistry::get('Teams');
			
			$data = $this->request->data;
			$id = convert_uudecode(base64_decode($data['id']));
			
			$timeSheets = $this->Timesheet->find('all' , ['conditions'=>['Timesheet.id' => $id] , 'contain'=>['Projects' , 'Bugs', 'Users', 'Works']])->first();
			$getTeam = $team_tb->find()->where(['FIND_IN_SET('.$timeSheets->project_id.', Teams.projects)', 'Teams.member_id' => $timeSheets->user_id])->contain(['Designations','Positions'])->first();
			
			$this->set(compact('timeSheets','getTeam'));
		else:
			throw new BadRequestException('Something went wrong. Please try again after sometime.');
		endif;
	}
	
	function newTimesheet()
	{
		
		$projects = TableRegistry::get('Projects');
		$team_tb = TableRegistry::get('Teams');
		$position_tb = TableRegistry::get('Positions');
		
		$getTeam = $team_tb->find('all')->where(['Teams.member_id' => $this->Auth->user('id'), 'Teams.designation_id' => 3])->contain(['Users','Designations'])->all();
		$getPosition = $position_tb->find('all')->where(['Positions.status' => 1])->all();
		if(!empty($getTeam)):
			$projectslist = '';
			foreach($getTeam as $teams):
				$projectslist .= $teams->projects.',';
			endforeach;
			if(strlen($projectslist)>1){
				$projectslist = substr($projectslist, 0, strlen($projectslist)-1);
				$projectslist = explode(',',$projectslist);
			} else {
				$projectslist = array(
								$projectslist	
							);
			}
		endif;
		$projects = $projects->find()->where(['id IN' => $projectslist])->orWhere(['user_id' => $this->Auth->user('id')])->all();
		
		
		$this->set(compact('projects','getPosition'));

		if($this->request->is('post')){
			$timeSheet = $this->Timesheet->newEntity();
			$data = $this->request->data;
			if($data['start_time'] && $data['end_time']){
				//$data['duration'] = round((strtotime($data['end_time']) - strtotime($data['start_time']))/3600, 1);
				$data['start_time'] = date_create($data['start_time']);
				$data['end_time'] = date_create($data['end_time']);
				$data['user_id'] = $this->Auth->user('id');
				$data['created'] = date('Y-m-d H:i:s');
			}
			
			$timeSheet = $this->Timesheet->patchEntity($timeSheet , $data);
			if($this->Timesheet->save($timeSheet)){
				
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
				$actdata['description'] = 'Created   Time sheet for the project -  '.$project_name;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
				
				
				
				if(isset($data['bug_id']) && $data['bug_id']){
					$bgUpdate = $this->Bugs->get($data['bug_id']);
					$bgUpdate['status'] = 2;
					$this->Bugs->save($bgUpdate);
				}
				$this->set(['message'=>'Timesheet has been saved successfully', 'url' => 'timesheet', '_serialize' => ['message','url']]);
				
				
			}
			else{
				throw new BadRequestException('Timesheet could not be saved.');
			}
		}
	}
	
	function editTimesheet()
	{
		$timeSheetDetail = '';
		$projects = '';
		$bugs = '';
		if($this->request->query('timesheetId')){
			$decodeId = convert_uudecode(base64_decode($this->request->query('timesheetId')));
			
			$bugData = $this->Bugs->find('list' , ['conditions'=>['user_id'=>$this->Auth->user('id')] , 'keyField'=>'id' , 'valueField'=>'project_id' , 'group'=>'project_id'])->toArray();
			
				
		
				$projects = TableRegistry::get('Projects');
				$team_tb = TableRegistry::get('Teams');
				$position_tb = TableRegistry::get('Positions');
				
				$getTeam = $team_tb->find('all')->where(['Teams.member_id' => $this->Auth->user('id'), 'Teams.designation_id' => 3])->contain(['Users','Designations'])->all();
				$getPosition = $position_tb->find('all')->where(['Positions.status' => 1])->all();
				if(!empty($getTeam)):
					$projectslist = '';
					foreach($getTeam as $teams):
						$projectslist .= $teams->projects.',';
					endforeach;
					if(strlen($projectslist)>1){
						$projectslist = substr($projectslist, 0, strlen($projectslist)-1);
						$projectslist = explode(',',$projectslist);
					} else {
						$projectslist = array(
										$projectslist	
									);
					}
				endif;
				$projects = $projects->find()->where(['id IN' => $projectslist])->orWhere(['user_id' => $this->Auth->user('id')])->all();
			if($bugData){
				
				//$projects = $this->Projects->find('list' , ['conditions'=>['Projects.id IN'=>array_values($bugData)] , 'keyField'=>'id' , 'valueField'=>'name'])->toArray();
			}
		}
		
		if($decodeId)
			$timeSheetDetail = $this->Timesheet->get($decodeId);
		
		if($timeSheetDetail)
			$bugs = $this->Bugs->find('list' , ['conditions'=>['project_id'=>$timeSheetDetail->project_id] , 'keyField'=>'id' , 'valueField'=>'title'])->toArray();
			
		$this->set(compact('timeSheetDetail' , 'projects' , 'bugs', 'getPosition'));
		
		if($this->request->is('post')){
			$data = $this->request->data();
			if($data['start_time'] && $data['end_time']){
				//$data['duration'] = round((strtotime($data['end_time']) - strtotime($data['start_time']))/3600, 1);
				$data['start_time'] = date_create($data['start_time']);
				$data['end_time'] = date_create($data['end_time']);
			}
			
			if(isset($data['bug_id']) && $data['bug_id'] != $timeSheetDetail->bug_id){
				$oldBg = $this->Bugs->get($timeSheetDetail->bug_id);
				$oldBg['status'] = 1;
				$this->Bugs->save($oldBg);
			}
			
			$timeSheetDetail = $this->Timesheet->patchEntity($timeSheetDetail , $data);
			if($this->Timesheet->save($timeSheetDetail)){
				if(isset($data['bug_id']) && $data['bug_id']){
					$bgUpdate = $this->Bugs->get($data['bug_id']);
					$bgUpdate['status'] = 2;
					$this->Bugs->save($bgUpdate);
				}
				$this->set(['message'=>'Timesheet has been updated successfully', 'url' => 'timesheet', '_serialize' => ['message','url']]);
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
				$actdata['description'] = 'Updated  Time sheet of the project -  '.$project_name;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			}
			else{
				throw new BadRequestException('Timesheet could not be updated.');
			}
		}
	}
	function projectBugs()
	{
		$bugs = '';
		$data = $this->request->data;
		if(isset($data['projectId']) && $data['projectId']){

			$team_tb = TableRegistry::get('Teams');
			$ownTeam = $team_tb->find('all')->where(['FIND_IN_SET('.$data['projectId'].', Teams.projects)','Teams.member_id' => $this->Auth->user('id'), 'Users.status' => 1])->contain(['Users','Designations'])->first();
			$bugs = $this->Bugs->find('list' , ['conditions'=>['project_id'=>$data['projectId'] , 'status !='=>2] , 'keyField'=>'id' , 'valueField'=>'title'])->toArray();
		}
		$this->set(compact('bugs','ownTeam'));
	}
	
}
