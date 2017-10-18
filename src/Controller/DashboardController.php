<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\StringTemplateTrait;

class DashboardController extends AppController
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
		
		
		
		$Projects = $ownTeam = $usersList='';
		$Timesheet = TableRegistry::get('Timesheet');
		$projects = TableRegistry::get('Projects');
		$team_project_tb = TableRegistry::get('TeamProjects');
		$user_tb = TableRegistry::get('Users');
		$team_tb = TableRegistry::get('Teams');
		$activity_tb = TableRegistry::get('Activities');
		
		
		$userId= $this->Auth->user('id');
		$recentAction=$activity_tb->find('all')->where(['Activities.user_id' => $userId])->order(['Activities.id' => 'DESC'])->limit(1)->first();
		
		if(isset($_GET['user_id']))
		//if($this->request->is('ajax'))
			 {
				//$data = $this->request->data;
				
				$userSearch='';
				$actionSearch='';
				
				$user_id=$_GET['user_id'];
				$action=$_GET['action'];
				if(($user_id!='')&&($action!=''))
				{
					$openActivities = $this->Activities->find('all')->where(['Activities.status' => 1,'Activities.user_id' => $user_id,'Activities.action ' =>$action ])->order(['Activities.id' => 'DESC'])->limit(5)->toArray();

				}
				else if(($user_id=='')&&($action!=''))
				{
					$openActivities = $this->Activities->find('all')->where(['Activities.status' => 1,'Activities.action ' =>$action ])->order(['Activities.id' => 'DESC'])->limit(5)->toArray();	
				}
				else if(($user_id!='')&&($action==''))
				{
					$openActivities = $this->Activities->find('all')->where(['Activities.status' => 1,'Activities.user_id ' =>$user_id ])->order(['Activities.id' => 'DESC'])->limit(5)->toArray();	
				}
				
				else
				{
						$openActivities = $this->Activities->find('all')->order(['Activities.id' => 'DESC'])->limit(5)->toArray();
		
				}

				
			}
			else
			{
				$openActivities = $activity_tb->find('all')->order(['Activities.id' => 'DESC'])->limit(5)->toArray();
			}
			
			//$actionsList = $this->Activities->find()->group(['Activities.action'])->all();
			
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
		//print_r($projectslist);
		



		
		 $timeSheets = $Timesheet->find('all')->where(['Timesheet.project_id IN' => $projectslist])->orWhere(['Timesheet.user_id' => $userId])->order(['Timesheet.end_time' => 'ASC'])->contain(['Projects'])->all();
		 
		// print_r($timeSheets);
		
		$Projects = $projects->find()->where(['id IN' => $projectslist])->orWhere(['user_id' => $userId])->all();
		$ProjectsAsc = $projects->find()->where(['id IN' => $projectslist])->orWhere(['user_id' => $userId])->order(['Projects.id' => 'ASC'])->limit(1)->toArray();
		//$firstProject=$ProjectsAsc[0]['id'];
		$week_back_date=date('Y-m-d', strtotime('-7 days'));
		$start_date=date('Y-m-d');
		
		
	    $timeSheetsWeek = $Timesheet->find('all')->where(['Timesheet.user_id' => $userId,'Date(Timesheet.end_time) <= '=>$start_date, 'Date(Timesheet.end_time) >= '=>$week_back_date])->all();
		
    $timeSheetsDay = $Timesheet->find('all')->where(['Timesheet.user_id' => $userId,'Date(Timesheet.end_time)' => date('Y-m-d')])->all();

		//print_r($timeSheetsWeek);

//echo $timeSheetsWeek->duration;
		
		$usersList = $user_tb->find()->where(['Users.status' => 1])->all();
		$actionsList = $activity_tb->find()->group(['Activities.action'])->all();
		$ownTeam = $team_tb->find('all')->where(['Users.status' => 1])->contain(['Users','Designations'])->all();
		
		//pr($otherProjects->toArray()); die;
		$this->set(compact('Projects','ownTeam', 'timeSheets','usersList','openActivities','actionsList','recentAction','timeSheetsWeek','timeSheetsDay','ProjectsAsc'));
		
		if(isset($_GET['uid'])){
			//print_r($projectslist);
			
			$uid=$_GET['uid'];
			if($uid=='')
			{
					 $timeSheets = $Timesheet->find('all')->where(['Timesheet.project_id IN' => $projectslist])->orWhere(['Timesheet.user_id' => $userId])->order(['Timesheet.end_time' => 'ASC'])->contain(['Projects'])->all();
	
			}
			else
			{
					 $timeSheets = $Timesheet->find('all')->where(['Timesheet.project_id IN' => $projectslist,'Timesheet.user_id' =>$_GET['uid']])->orWhere(['Timesheet.user_id' => $_GET['uid']])->order(['Timesheet.end_time' => 'ASC'])->contain(['Projects'])->all();
	
			}
		//print_r($projectslist);
		 
									
									 foreach($Projects as $project)
									 { 
											$total_worked_hrs = 0;
											 foreach($timeSheets as $timesheetdata)
											 {
												// echo $timesheetdata->project_id;
												if($project->id == $timesheetdata->project_id)
												{
													//echo $timesheetdata->project_id;
													 $total_worked_hrs += $timesheetdata->duration;
												}
											  }
											 echo ",".$total_worked_hrs; 
											  
		                              }		 
		
		                          exit;
		
		                         }
	}
}
