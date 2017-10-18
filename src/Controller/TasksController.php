<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
class TasksController extends AppController
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
		$this->TeamProjects = TableRegistry::get('TeamProjects');
		$this->Teams = TableRegistry::get('Teams');
		$this->Positions = TableRegistry::get('Positions');
		$this->Projects = TableRegistry::get('Projects');
		$this->Tasks = TableRegistry::get('Tasks');
	}

	function taskList($id = null)
	{
		if(isset($id) && $id){
			$decodeId = convert_uudecode(base64_decode($id));
			$projectDetail = $this->Projects->find('all' , ['conditions'=>['Projects.id'=>$decodeId]])->first();
			
			 /*code to add activity logs*/
			$projects_tb = TableRegistry::get('Projects');
            $getProject = $projects_tb->find()->where(['Projects.id' => $decodeId])->first();
			$project_name=$getProject->name;
		    $activity_tb = TableRegistry::get('Activities');
		    $userId= $this->Auth->user('id');
	        $activityLog = $activity_tb->newEntity();
	        $data['user_id'] = $userId;
			$data['action'] = 'Visited';
			$data['description'] = 'Visited Tasks Listing page of the project - '.$project_name;
			$data['created'] = Time::now();
            $activityLog = $activity_tb->patchEntity($activityLog, $data);
			if($project_name!=''){$result = $activity_tb->save($activityLog);}
	        /*code to add activity logs ends here*/
			
			$openTasks = $this->Tasks->find('all' , ['conditions'=>['Tasks.project_id'=>$decodeId , 'Tasks.status'=>1, 'Tasks.is_deleted' => 0] , 'contain'=>['Users']])->order(['Tasks.priority' => 'DESC'])->toArray();
			$closeTasks = $this->Tasks->find('all' , ['conditions'=>['Tasks.project_id'=>$decodeId , 'Tasks.status'=>2, 'Tasks.is_deleted' => 0] , 'contain'=>['Users']])->order(['Tasks.priority' => 'DESC'])->toArray();
			$workingTasks = $this->Tasks->find('all' , ['conditions'=>['Tasks.project_id'=>$decodeId , 'Tasks.status'=>3, 'Tasks.is_deleted' => 0] , 'contain'=>['Users']])->order(['Tasks.priority' => 'DESC'])->toArray();

			$ownTeam = $this->Teams->find('all')->where(['FIND_IN_SET('.$decodeId.',Teams.projects)', 'Users.status' => 1])->contain(['Users','Designations'])->all();
			
			$this->set(compact('projectDetail' , 'id' , 'openTasks' , 'closeTasks' , 'workingTasks','ownTeam'));
		}
	}
	
	function newTask($id = null)
	{
		$decodeId = '';
		if(isset($id) && $id){
			$decodeId = convert_uudecode(base64_decode($id));
			$projectDetail = $this->Projects->find('all' , ['conditions'=>['Projects.id'=>$decodeId]])->first();
		}
		$WorkerDesignations = $this->Positions->find('list' , ['KeyField'=>'id' , 'valueField'=>'title'])->toArray();
		$this->set(compact('projectDetail' , 'WorkerDesignations','id'));
		if($this->request->is('post')){
			$task = $this->Tasks->newEntity();
			$data = $this->request->data;
			//pr($data); die;
			if(isset($data['file_name']) && $data['file_name']){
				$ext = pathinfo($data['file_name']['name'], PATHINFO_EXTENSION);
				$name = time() * microtime() . '.' . $ext;
				$path = WWW_ROOT.'uploads/tasks/'.$name;
				move_uploaded_file($data['file_name']['tmp_name'] , $path);
			}
			if(@$data['file_name'] && !empty($data['file_name']))
				$data['file_name'] = $name;

			$data['created'] = Time::now();
			$task = $this->Tasks->patchEntity($task , $data);
			if($this->Tasks->save($task)):
				$projectId =base64_encode(convert_uuencode($task->project_id));
				
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
				$actdata['description'] = 'Created   Task  "'.$data['title'].'" for the project -  '.$project_name;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
			// echo $projectId; die;
				$this->set(['message'=>'Task has been saved successfully', 'url' =>'task-list/'.$projectId, '_serialize' => ['message','url']]);
			else:
				throw new BadRequestException('Task could not be saved.');
			endif;
		}
	}
	
	function editTask($id = null)
	{
		$decodeId = '';
		if(isset($id) && $id){
		$decodeId = convert_uudecode(base64_decode($id));
			$taskDetail = $this->Tasks->find('all' , ['conditions'=>['Tasks.id'=>$decodeId] , 'contain'=>'Users'])->first();
			$projectDetail = $this->Projects->find('all' , ['conditions'=>['Projects.id'=>$taskDetail->project_id]])->first();
		}
		$WorkerDesignations = $this->Positions->find('list' , ['KeyField'=>'id' , 'valueField'=>'title'])->toArray();
		$this->set(compact('taskDetail' , 'WorkerDesignations', 'projectDetail'));
		if($this->request->is('post')){
			$data = $this->request->data;
			
			if(isset($data['file_name']) && $data['file_name']){
				$taskDetail = $this->Tasks->find('all' , ['conditions'=>['Tasks.id'=>$data['id']]])->first();
				$ext = pathinfo($data['file_name']['name'], PATHINFO_EXTENSION);
				$name = time() * microtime() . '.' . $ext;
				$old_path = WWW_ROOT.'uploads/tasks/'.$taskDetail->file_name;
				$path = WWW_ROOT.'uploads/tasks/'.$name;
				if(move_uploaded_file($data['file_name']['tmp_name'] , $path)):
					if(file_exists($old_path)) {
						$file = new File($old_path, false, 0777);
						$file->delete();
					}
					$data['file_name'] = $name;
				endif;
			}
			else
			{
				unset($data['file_name']);
			}
			$data['created'] = Time::now();
			$task = $this->Tasks->patchEntity($taskDetail , $data);
			if($this->Tasks->save($task)):
				$projectId =base64_encode(convert_uuencode($task->project_id));
				
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
				$actdata['description'] = 'Updated   Task  "'.$data['title'].'" of  the project -  '.$project_name;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
				$this->set(['message'=>'Project Task has been saved successfully', 'url' => 'task-list/'.$projectId, '_serialize' => ['message','url']]);
			else:
				throw new BadRequestException('Task could not be saved.');
			endif;
		}
	}
	
	public function fileDownload($id) {
		$id = convert_uudecode(base64_decode($id));
		$task_tb = TableRegistry::get('Tasks');
		$task = $feature_tb->get($id);
		$path = WWW_ROOT.'uploads/tasks' . DS .$task->file_name;
		if(file_exists($path)):
			// in this example $path should hold the filename but a trailing slash
			$this->response->file($path, array(
				'name' => $task->file_name,
				'download' => true,
			));
			return $this->response;
		endif;
		$this->redirect($this->referer());
	}
	
	function teamMembers()
	{
		if($this->request->is('ajax')){
			$data = $this->request->data;
			// pr($data); die;
			$designation = $data['designation'];
			$projectId = $data['projectId'];
		
			$teamMembers = '';
			$teamMembers = $this->Teams->find('all' , ['conditions'=>['FIND_IN_SET('.$projectId.',Teams.projects)', 'Teams.position_id'=>$designation] , 'contain'=>['Users']])->toArray();
			$this->set(compact('teamMembers'));
		}
	}
}
