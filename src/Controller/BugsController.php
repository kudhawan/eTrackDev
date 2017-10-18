<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;
class BugsController extends AppController
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
		$this->Bugs = TableRegistry::get('Bugs');
	}

	function bugSheet($id = null)
	{
		
	   
		if(isset($id) && $id){
			$decodeId = convert_uudecode(base64_decode($id));
			$projectDetail = $this->Projects->find('all' , ['conditions'=>['Projects.id'=>$decodeId]])->first();
			
			
			$projects_tb = TableRegistry::get('Projects');
		    /*code to add activity logs*/
            $getProject = $projects_tb->find()->where(['Projects.id' => $decodeId])->first();
			$project_name=$getProject->name;
		    $activity_tb = TableRegistry::get('Activities');
		    $userId= $this->Auth->user('id');
	        $activityLog = $activity_tb->newEntity();
	        $data['user_id'] = $userId;
			$data['action'] = 'Visited';
			$data['description'] = 'Visited Bugs Listing page of the project - '.$project_name;
			$data['created'] = Time::now();
            $activityLog = $activity_tb->patchEntity($activityLog, $data);
			if($project_name!=''){$result = $activity_tb->save($activityLog);}
	        /*code to add activity logs ends here*/
			
			
			
			$openBugs = $this->Bugs->find('all' , ['conditions'=>['Bugs.project_id'=>$decodeId , 'Bugs.status'=>1, 'Bugs.is_deleted' => 0] , 'contain'=>['Users']])->order(['Bugs.priority' => 'DESC'])->toArray();
			$closeBugs = $this->Bugs->find('all' , ['conditions'=>['Bugs.project_id'=>$decodeId , 'Bugs.status'=>2, 'Bugs.is_deleted' => 0] , 'contain'=>['Users']])->order(['Bugs.priority' => 'DESC'])->toArray();
			$workingBugs = $this->Bugs->find('all' , ['conditions'=>['Bugs.project_id'=>$decodeId , 'Bugs.status'=>3, 'Bugs.is_deleted' => 0] , 'contain'=>['Users']])->order(['Bugs.priority' => 'DESC'])->toArray();

			$ownTeam = $this->Teams->find('all')->where(['FIND_IN_SET('.$decodeId.',Teams.projects)', 'Users.status' => 1])->contain(['Users','Designations'])->all();
			
			$this->set(compact('projectDetail' , 'id' , 'openBugs' , 'closeBugs' , 'workingBugs','ownTeam'));
		}
	}
	
	function newBug($id = null)
	{
		$decodeId = '';
		if(isset($id) && $id){
			$decodeId = convert_uudecode(base64_decode($id));
			$projectDetail = $this->Projects->find('all' , ['conditions'=>['Projects.id'=>$decodeId]])->first();
		}
		$WorkerDesignations = $this->Positions->find('list' , ['KeyField'=>'id' , 'valueField'=>'title'])->toArray();
		$this->set(compact('projectDetail' , 'WorkerDesignations','id'));
		if($this->request->is('post')){
			$bug = $this->Bugs->newEntity();
			$data = $this->request->data;
			//pr($data); die;
			if(isset($data['file_name']) && $data['file_name']){
				$ext = pathinfo($data['file_name']['name'], PATHINFO_EXTENSION);
				$name = time() * microtime() . '.' . $ext;
				$path = WWW_ROOT.'files/'.$name;
				move_uploaded_file($data['file_name']['tmp_name'] , $path);
			}
			if(@$data['file_name'] && !empty($data['file_name']))
				$data['file_name'] = $name;

			$data['created'] = Time::now();
			$bug = $this->Bugs->patchEntity($bug , $data);
			if($this->Bugs->save($bug)):
				$projectId =base64_encode(convert_uuencode($bug->project_id));
			// echo $projectId; die;
				$this->set(['message'=>'Bug has been saved successfully', 'url' =>'bug-sheet/'.$projectId, '_serialize' => ['message','url']]);
				
				
			/*code to add activity logs*/
			$projects_tb = TableRegistry::get('Projects');
            $getProject = $projects_tb->find()->where(['Projects.id' =>$data['project_id']])->first();
			$project_name=$getProject->name;
		    $activity_tb = TableRegistry::get('Activities');
		    $userId= $this->Auth->user('id');
	        $activityLog = $activity_tb->newEntity();
	        $data['user_id'] = $userId;
			$data['action'] = 'Created';
			$data['description'] = 'Created Bug List "'.$data['title'].'" for  the project - '.$project_name;
			$data['created'] = Time::now();
            $activityLog = $activity_tb->patchEntity($activityLog, $data);
			$result = $activity_tb->save($activityLog);
	        /*code to add activity logs ends here*/
				
				
			else:
				throw new BadRequestException('Task could not be saved.');
			endif;
		}
	}
	
	function editBug($id = null)
	{
		
		
		
		$decodeId = '';
		if(isset($id) && $id){
		 $decodeId = convert_uudecode(base64_decode($id));
			$bugDetail = $this->Bugs->find('all' , ['conditions'=>['Bugs.id'=>$decodeId] , 'contain'=>'Users'])->first();
			}
		$WorkerDesignations = $this->Positions->find('list' , ['KeyField'=>'id' , 'valueField'=>'title'])->toArray();
		$this->set(compact('bugDetail' , 'WorkerDesignations'));
		if($this->request->is('post')){
			$data = $this->request->data;
			
			/*code to add activity logs*/
			$projects_tb = TableRegistry::get('Projects');
            $getProject = $projects_tb->find()->where(['Projects.id' =>$data['project_id']])->first();
			$project_name=$getProject->name;
		    $activity_tb = TableRegistry::get('Activities');
		    $userId= $this->Auth->user('id');
	        $activityLog = $activity_tb->newEntity();
	        $dataAct['user_id'] = $userId;
			$dataAct['action'] = 'Updated';
			$dataAct['description'] = 'Updated Bug List "'.$data['title'].'" for  the project - '.$project_name;
			$dataAct['created'] = Time::now();
            $activityLog = $activity_tb->patchEntity($activityLog, $dataAct);
			$result = $activity_tb->save($activityLog);
	        /*code to add activity logs ends here*/
			
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
			$data['created'] = Time::now();
			$bug = $this->Bugs->patchEntity($bugDetail , $data);
			if($this->Bugs->save($bug)):
				$projectId =base64_encode(convert_uuencode($bug->project_id));
				$this->set(['message'=>'Bug has been updated successfully', 'url' => 'bug-sheet/'.$projectId, '_serialize' => ['message','url']]);
				
				
			
			else:
				throw new BadRequestException('Bug could not be updated.');
			endif;
		}
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
