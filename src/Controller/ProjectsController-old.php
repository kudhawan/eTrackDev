<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;
class ProjectsController extends AppController
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
	
	public function manageTeams(){
		if($this->request->is('ajax')):
			$data = $this->request->data;
			
			$memberCount = $data['memberCount'];
			$deginationsList = $positionList = $usersList = $memberList = '';
			$designation_tb = TableRegistry::get('Designations');
			
			$usersList = $this->Users->find('all')->where(['Users.status' => 1])->all();
			$designationsList = $designation_tb->find('all')->all();
			$this->set(compact('designationsList','usersList','memberCount'));
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
			
			
			
			if(isset($data['file_name']) && $data['file_name']){
				$ext = pathinfo($data['file_name']['name'], PATHINFO_EXTENSION);
				$name = time() * microtime() . '.' . $ext;
				$path = WWW_ROOT.'files/'.$name;
				move_uploaded_file($data['file_name']['tmp_name'] , $path);
			}
			if(@$data['file_name'] && !empty($data['file_name']))
				$data['file_name'] = $name;
			
			
			$data['created'] = Time::now();
            $projects = $project->patchEntity($projects, $data);
			$result = $project->save($projects);
        	if($result):
				$record_id=$result->id;
				
			for($i=1; $i<=$data['addMoreCount']; $i++):
				$teams = $team_tb->newEntity();
				if(isset($data['user_id'.$i]) && $data['user_id'.$i] != ''):
					$teamdata['projects'] = $record_id;
					$teamdata['employer_id'] = $this->Auth->user('id');
					if(isset($data['user_id'.$i]) && $data['user_id'.$i] != '')
						$teamdata['member_id'] = $data['user_id'.$i];
					else
						$teamdata['member_id'] = '';
						
					if(isset($data['designation_id'.$i]) && $data['designation_id'.$i] != '')
						$teamdata['designation_id'] = $data['designation_id'.$i];
					else
						$teamdata['designation_id'] = '';
						
					if(isset($data['position'.$i]) && $data['position'.$i] != '')
						$teamdata['position_id'] = $data['position'.$i];
					else
						$teamdata['position_id'] = '';
						
					$teams = $team_tb->patchEntity($teams, $teamdata);
					$team_tb->save($teams);
				endif;
			endfor;
				
				$this->set(['message'=>'Project has been saved successfully', 'url' => 'projects', '_serialize' => ['message','url']]);
			else:
				throw new BadRequestException('New project could not be saved.');
			endif;
			
		endif;
		
		$this->set(compact('designationsList','positionList','usersList'));
	}
	
	function view()
	{

		$Projects = $ownTeam = '';
		$projects = TableRegistry::get('Projects');
		$team_project_tb = TableRegistry::get('TeamProjects');
		$user_tb = TableRegistry::get('Users');
		$team_tb = TableRegistry::get('Teams');
		
		$userId= $this->Auth->user('id');
		$getTeam = $team_tb->find('all')->where(['Teams.member_id' => $userId,'Teams.employer_id !=' => $userId])->contain(['Users','Designations'])->all();
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
		$Projects = $projects->find()->where(['id IN' => $projectslist])->orWhere(['user_id' => $userId])->all();

		$ownTeam = $team_tb->find('all')->where(['Users.status' => 1])->contain(['Users','Designations'])->all();
		
		//pr($otherProjects->toArray()); die;
		$this->set(compact('Projects','ownTeam'));
	}

	function edit($id=NULL)
	{
		$decodeId = convert_uudecode(base64_decode($id));
		
		$deginationsList = $positionList = $usersList = $teamsList = $memberList = '';
		$designation_tb = TableRegistry::get('Designations');
		$position_tb = TableRegistry::get('Positions');
		$team_tb = TableRegistry::get('Teams');
		
		$teamsList = $team_tb->find('all')->where(['FIND_IN_SET("'.$decodeId.'",Teams.projects)', 'Teams.employer_id' => $this->Auth->user('id')])->all();
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
			
			
			if(isset($data['file_name']) && $data['file_name']){
				$ext = pathinfo($data['file_name']['name'], PATHINFO_EXTENSION);
				$name = time() * microtime() . '.' . $ext;
				$path = WWW_ROOT.'files/'.$name;
				move_uploaded_file($data['file_name']['tmp_name'] , $path);
				$data['file_name'] = $name;
			}
			else
			{
				unset($data['file_name']);
			}
			
			
			
            $getProject = $project_tb->patchEntity($getProject,$data);
			$result = $project_tb->save($getProject);
        	if($result):
				
			for($i=1; $i<=$data['addMoreCount']; $i++):
			
				if(isset($data['team_id'.$i]))
					$teams = $team_tb->find()->where(['Teams.id' => $data['team_id'.$i]])->first();
				else
					$teams = $team_tb->newEntity();
				
				if(isset($data['user_id'.$i]) && $data['user_id'.$i] != ''):
					$teamdata['projects'] = $data['id'];
					$teamdata['employer_id'] = $this->Auth->user('id');
					
					if(isset($data['user_id'.$i]) && $data['user_id'.$i] != '')
						$teamdata['member_id'] = $data['user_id'.$i];
					else
						$teamdata['member_id'] = '';
						
					if(isset($data['designation_id'.$i]) && $data['designation_id'.$i] != '')
						$teamdata['designation_id'] = $data['designation_id'.$i];
					else
						$teamdata['designation_id'] = '';
						
					if(isset($data['position'.$i]) && $data['position'.$i] != '')
						$teamdata['position_id'] = $data['position'.$i];
					else
						$teamdata['position_id'] = '';
						
					$teams = $team_tb->patchEntity($teams, $teamdata);
					$team_tb->save($teams);
				endif;
			endfor;
				
				$this->set(['message'=>'Project has been updated successfully', 'url' => 'projects', '_serialize' => ['message','url']]);
			else:
				throw new BadRequestException('Edit project could not be saved.');
			endif;
		endif;
		$this->set(compact('getProject','designationsList','positionList','usersList','teamsList'));
	}
	
	public function projectDetails(){
			
			$Timesheet = TableRegistry::get('Timesheet');
			$team_tb = TableRegistry::get('Teams');
			
		if($this->request->is('ajax')):
			$data = $this->request->data;
			$projects_tb = TableRegistry::get('Projects');
			$projectId = convert_uudecode(base64_decode($data['projectId']));
			
			$getProject = $projects_tb->find()->where(['Projects.id' => $projectId])->first();
			
			
			$timeSheets = $Timesheet->find('all' , ['conditions'=>['Timesheet.project_id' => $projectId] , 'contain'=>['Projects']])->all();
			
			$total_developer_hrs = 0;
			$total_designer_hrs = 0;
			$total_tester_hrs = 0;
			$designer_arr = '';
			$developer_arr = '';
			$tester_arr = '';
			foreach($timeSheets as $timesheetdata):
				$teamsList = $team_tb->find('all')->where(['FIND_IN_SET("'.$timesheetdata->project_id.'",Teams.projects)', 'Teams.member_id' => $timesheetdata->user_id])->contain(['Positions'])->first();
				if(count($teamsList) > 0):
					if($teamsList->position['id'] == 1):
						$total_designer_hrs += $timesheetdata->duration;
						$designer_arr = array(
										'cap' => $teamsList->position['title'],
										'assigned' => $getProject->designer_hrs,
										'worked' => $total_designer_hrs
									);
					elseif($teamsList->position['id'] == 2):
						$total_developer_hrs += $timesheetdata->duration;
						$developer_arr = array(
										'cap' => $teamsList->position['title'],
										'assigned' => $getProject->developer_hrs,
										'worked' => $total_developer_hrs
									);
					elseif($teamsList->position['id'] == 3):
						$total_tester_hrs += $timesheetdata->duration;
						$tester_arr = array(
										'cap' => $teamsList->position['title'],
										'assigned' => $getProject->tester_hrs,
										'worked' => $total_tester_hrs
									);
					endif;
				endif;
			endforeach;
			
			
			$datas['project'] = array(
							'cap' => 'Project',
							'assigned' => $getProject->total_effort,
							'worked' => $total_developer_hrs+$total_designer_hrs+$total_tester_hrs
						);
			if(is_array($designer_arr))
				$datas['designer'] = $designer_arr;
			if(is_array($developer_arr))
				$datas['developer'] = $developer_arr;
			if(is_array($tester_arr))
				$datas['tester'] = $tester_arr;
			
			$reqfor = $data['requestfor'];
			
			$this->set(compact('datas', 'reqfor'));
		else:
			throw new BadRequestException('Something went wrong. Please try again after sometime.');
		endif;
	}
	
	public function delete($id){
		$id = convert_uudecode(base64_decode($id));
		$projects_tb = TableRegistry::get('Projects');
		$project = $projects_tb->get($id);
		if($projects_tb->delete($project)){
			$team_tb = TableRegistry::get('Teams');
			$team_tb->deleteAll(
				[
					'FIND_IN_SET('.$id.', Teams.projects)'
				]
			);
			$timesheet_tb = TableRegistry::get('Timesheet');
			$timesheet_tb->deleteAll(
				[ 
					'Timesheet.project_id' => $id
				]
			);
			$dailyreports_tb = TableRegistry::get('Dailyreports');
			$dailyreports_tb->deleteAll(
				[ 
					'Dailyreports.project_id' => $id
				]
			);
			$bugs_tb = TableRegistry::get('Bugs');
			$bugs_tb->deleteAll(
				[ 
					'Bugs.project_id' => $id
				]
			);
			$features_tb = TableRegistry::get('Features');
			$features_tb->deleteAll(
				[ 
					'Features.project_id' => $id
				]
			);
			$conversations_tb = TableRegistry::get('Conversations');
			$conversations_tb->deleteAll(
				[ 
					'Conversations.project_id' => $id
				]
			);
		}
		$this->redirect($this->referer());
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
