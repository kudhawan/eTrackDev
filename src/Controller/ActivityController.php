<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
class ActivityController extends AppController
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
		$this->loadModel('Documents');
		$this->loadModel('Screenshots');
	    $this->Activities = TableRegistry::get('Activities');

	}
	
	
	public function view()
	{
	        if($this->request->is('ajax'))
			 {
				$data = $this->request->data;
				
				$userSearch='';
				$actionSearch='';
				
				$user_id=$data['user_id'];
				$action=$data['action'];
				if(($user_id!='')&&($action!=''))
				{
					$openActivities = $this->Activities->find('all')->where(['Activities.status' => 1,'Activities.user_id' => $user_id,'Activities.action ' =>$action ])->order(['Activities.id' => 'DESC'])->toArray();

				}
				else if(($user_id=='')&&($action!=''))
				{
					$openActivities = $this->Activities->find('all')->where(['Activities.status' => 1,'Activities.action ' =>$action ])->order(['Activities.id' => 'DESC'])->toArray();	
				}
				else if(($user_id!='')&&($action==''))
				{
					$openActivities = $this->Activities->find('all')->where(['Activities.status' => 1,'Activities.user_id ' =>$user_id ])->order(['Activities.id' => 'DESC'])->toArray();	
				}
				
				else
				{
						$openActivities = $this->Activities->find('all')->order(['Activities.id' => 'DESC'])->toArray();
		
				}

				
			}
			else
			{
					$openActivities = $this->Activities->find('all')->order(['Activities.id' => 'DESC'])->toArray();
	
			}

			
			
			
		     $usersList = $this->Users->find()->where(['Users.status' => 1])->all();
			 $actionsList = $this->Activities->find()->group(['Activities.action'])->all();
		
		
			$this->set(compact('openActivities','usersList' ,'actionsList'));	
	}
	
	public function documentCreate()
	{	
		$projects = TableRegistry::get('Projects');
		$team_tb = TableRegistry::get('Teams');
		
		$getTeam = $team_tb->find('all')->where(['Teams.member_id' => $this->Auth->user('id')])->contain(['Users','Designations'])->all();
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
		
		
		$this->set(compact('documents','projects'));
		
		if ($this->request->is(['post', 'put'])) {
		
			$userId = $this->Auth->user('id');
			
						
			$doc = $this->request->data['upload_file'];			
			$allowedExt = array("PDF","pdf", "doc", "docx"); 
			$extn = explode(".", $doc['name']);
			$extension = end($extn);
			$fileName 	= 	'document'.microtime(true).'.'.$extension;
			if (in_array($extension, $allowedExt))
			{
				if (move_uploaded_file($doc['tmp_name'], WWW_ROOT.'uploads/activity/documents' . DS . $fileName)){
				
					$documents = $this->Documents->newEntity();
					$documentsdata = $this->request->data;
					$documentsdata['upload_file'] = $fileName;
					$documentsdata['user_id'] = $userId;
					$documentsdata['project_id'] = $this->request->data['project_id'];
					$documentsdata['status'] = 1;
					$documents = $this->Documents->patchEntity($documents, $documentsdata);
					$this->Documents->save($documents);
					
					$this->set(['message'=>'Document has been saved successfully', 'url' => 'documents', '_serialize' => ['message','url']]);
					
					/*code to add activity logs*/
				/*$proId=$data['project_id'];
				$projects_tb = TableRegistry::get('Projects');
            	$getProject = $projects_tb->find()->where(['Projects.id' => $proId])->first();
				$project_name=$getProject->name;
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Created';
				$actdata['description'] = 'Created   Document - "'.$fileName;
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);*/
			
			   /*code to add activity logs ends here*/
			   
				}
				else{
					throw new BadRequestException('Document could not be uploaded into directory.');
				}
			}
			else{
				throw new BadRequestException('Invalid File format. Supported Formets are PDF, DOC, DOCX.');
			}
		
		}
		
		$this->render('Documents/create');
	}
	
	public function documentView()
	{
		$this->loadModel('Documents');
		//$this->Documents->belongsToMany('Users');
		/* $this->Documents->hasOne('Users', [
			'className' => 'Users',
			'foreignKey' => 'user_id'
		]); */
		$team_tb = TableRegistry::get('Teams');
		
		$getTeam = $team_tb->find('all')->contain(['Designations'])->all();
		
		/*code to add activity logs*/
				
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Visited';
				$actdata['description'] = 'Visited Documents Listing Page  ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
		
		
		$ownTeam = $team_tb->find('all')->where(['Teams.member_id' => $this->Auth->user('id')])->orWhere(['Teams.employer_id' => $this->Auth->user('id')])->contain(['Users','Designations'])->all();
		if(!empty($ownTeam)):
			$projectslist = '';
			foreach($ownTeam as $teams):
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
		
        $document = $this->Documents->find()->where(['Documents.user_id' => $this->Auth->user('id')])->orWhere(['Documents.project_id IN' => $projectslist])->orWhere(['Projects.user_id IN' => $this->Auth->user('id')])->order([ 'Documents.created' => 'DESC'])->contain(['Projects','Users'])->all();

		// pr($document);die;
        $this->set(compact('document','getTeam'));
		$this->render('Documents/view');

	}
	
	public function documentDelete($id){
		
		/*code to add activity logs*/
				
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Deleted';
				$actdata['description'] = 'Deleted  the Document';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
		$id = convert_uudecode(base64_decode($id));
		$document_tb = TableRegistry::get('Documents');
		$document = $document_tb->get($id);
		$path = WWW_ROOT.'uploads/activity/documents' . DS .$document->upload_file;
		if($document_tb->delete($document)):
			if(file_exists($path)) {
				$file = new File($path, false, 0777);
				$file->delete();
			}
		endif;
		//$this->redirect('/members');
		$this->redirect($this->referer());
	}
	
	public function documentDownload($id) {
		/*code to add activity logs*/
				
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Downloaded';
				$actdata['description'] = 'Downloaded the Document ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
		$document_tb = TableRegistry::get('Documents');
		$document = $document_tb->get($id);
		$path = WWW_ROOT.'uploads/activity/documents' . DS .$document->upload_file;
		if(file_exists($path)):
			// in this example $path should hold the filename but a trailing slash
			$this->response->file($path, array(
				'name' => $document->upload_file,
				'download' => true,
			));
			return $this->response;
		endif;
		$this->redirect($this->referer());
	}

	public function documentDeleteAll(){
		if($this->request->is('post')):
			if(isset($this->request->data['deleteAll'])):
				foreach($this->request->data['deleteAll'] as $key => $value)
				{
					if($value != '')
					{
						$document_tb = TableRegistry::get('Documents');
						$document = $document_tb->get($value);
						$path = WWW_ROOT.'uploads/activity/documents' . DS .$document->upload_file;
						if($document_tb->delete($document)):
							if(file_exists($path)) {
								$file = new File($path, false, 0777);
								$file->delete();
							}
						endif;
					}
				}
				$this->set(['message'=>'Records deleted successfully', 'url' => 'documents', '_serialize' => ['message','url']]);
				
				/*code to add activity logs*/
				
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Deleted';
				$actdata['description'] = 'Deleted Multiple Documents';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			else:
				throw new BadRequestException('Please choose any one record to delete.');
			endif;
		endif;
	}
	public function screenshotDetails()
	{
		echo 111;
	}
	
	
	public function screenshotCreate()
	{	
		$projects = TableRegistry::get('Projects');
		$team_tb = TableRegistry::get('Teams');
		
		$getTeam = $team_tb->find('all')->where(['Teams.member_id' => $this->Auth->user('id')])->contain(['Users','Designations'])->all();
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
		
		
		$this->set(compact('screenshots','projects'));
		
		if ($this->request->is(['post', 'put'])) {
		
			$userId = $this->Auth->user('id');	
			$docs = $this->request->data['upload_file'];		
			$allowedExt = array("jpg","JPG", "JPEG", "jpeg", "PNG", "png", "GIF", "gif"); 
			foreach($docs as $doc):
				$extn = explode(".", $doc['name']);
				$extension = end($extn);
				$fileName 	= 	'screenshot'.microtime(true).'.'.$extension;
				if (in_array($extension, $allowedExt))
				{
					if (move_uploaded_file($doc['tmp_name'], WWW_ROOT.'uploads/activity/screenshots' . DS . $fileName)){
					
						$screenshots = $this->Screenshots->newEntity();
						$screenshotsdata = $this->request->data;
						$screenshotsdata['upload_file'] = $fileName;
						$screenshotsdata['user_id'] = $userId;
						$screenshotsdata['project_id'] = $this->request->data['project_id'];
						$screenshotsdata['status'] = 1;
						$screenshots = $this->Screenshots->patchEntity($screenshots, $screenshotsdata);
						$this->Screenshots->save($screenshots);
					}
					else{
						throw new BadRequestException('Screenshot could not be uploaded into directory.');
					}
				}
				else{
					throw new BadRequestException('Invalid File format. Supported Formets are JPG, JPEG, PNG, GIF.');
				}
			endforeach;
			$this->set(['message'=>'Screenshot has been saved successfully', 'url' => 'activity/screenshot-create', '_serialize' => ['message','url']]);
			
			/*code to add activity logs*/
				/*$proId=$data['project_id'];
				$projects_tb = TableRegistry::get('Projects');
            	$getProject = $projects_tb->find()->where(['Projects.id' => $proId])->first();
				$project_name=$getProject->name;
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Created';
				$actdata['description'] = 'Created   Screen shot ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);*/
			
			   /*code to add activity logs ends here*/
		
		}
		
		$this->render('Screenshots/create');
	}
	
	public function screenshotView($id = '')
	{
		$this->loadModel('Screenshots');
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
			   
		//$this->Screenshots->belongsToMany('Users');
		/* $this->Screenshots->hasOne('Users', [
			'className' => 'Users',
			'foreignKey' => 'user_id'
		]); */
		$projects = TableRegistry::get('Projects');
		$team_tb = TableRegistry::get('Teams');
		
		$getTeam = $team_tb->find('all')->contain(['Designations'])->all();
		
		
		$ownTeam = $team_tb->find('all')->where(['Teams.member_id' => $this->Auth->user('id')])->orWhere(['Teams.employer_id' => $this->Auth->user('id')])->contain(['Users','Designations'])->all();
		if(!empty($ownTeam)):
			$projectslist = '';
			foreach($ownTeam as $teams):
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
		
		$date = '';
		if(isset($this->request->query['date']))
			$date = date('Y-m-d',strtotime($this->request->query['date']));
		if($id != ''){
			$currentId = convert_uudecode(base64_decode($id));
        	$screenshot = $this->Screenshots->find()->where(['Screenshots.project_id' => $currentId]);
			if($date != '')
				$screenshot->where(['DATE(Screenshots.created)' => $date]);
				
			$screenshot->order([ 'Screenshots.created' => 'DESC'])->contain(['Projects','Users'])->all();
		} else {
        	$screenshot = $this->Screenshots->find()->where(['Screenshots.user_id' => $this->Auth->user('id')])->orWhere(['Screenshots.project_id IN' => $projectslist])->orWhere(['Projects.user_id IN' => $this->Auth->user('id')]);
			
			if($date != '')
				$screenshot->where(['DATE(Screenshots.created)' => $date]);
				
			$screenshot->order([ 'Screenshots.created' => 'DESC'])->contain(['Projects','Users'])->all();
		}
			

		// pr($screenshot);die;
        $this->set(compact('screenshot','getTeam','projects','currentId'));
		$this->render('Screenshots/view');

	}
	
	public function screenshotDelete($id){
		$id = convert_uudecode(base64_decode($id));
		$screenshot_tb = TableRegistry::get('Screenshots');
		$screenshot = $screenshot_tb->get($id);
		$path = WWW_ROOT.'uploads/activity/screenshots' . DS .$screenshot->upload_file;
		
		/*code to add activity logs*/
				
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Deleted';
				$actdata['description'] = 'Deleted   Screen shot  ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
		if($screenshot_tb->delete($screenshot)):
			if(file_exists($path)) {
				$file = new File($path, false, 0777);
				$file->delete();
			}
		endif;
		//$this->redirect('/members');
		$this->redirect($this->referer());
	}
	
	public function screenshotDownload($id) {
		$screenshot_tb = TableRegistry::get('Screenshots');
		$screenshot = $screenshot_tb->get($id);
		$path = WWW_ROOT.'uploads/activity/screenshots' . DS .$screenshot->upload_file;
		
		
		/*code to add activity logs*/
				
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Downloaded';
				$actdata['description'] = 'Downloaded   Screen shot  ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
		if(file_exists($path)):
			// in this example $path should hold the filename but a trailing slash
			$this->response->file($path, array(
				'name' => $screenshot->upload_file,
				'download' => true,
			));
			return $this->response;
		endif;
		$this->redirect($this->referer());
	}

	public function screenshotDeleteAll(){
		if($this->request->is('post')):
			if(isset($this->request->data['deleteAll'])):
				foreach($this->request->data['deleteAll'] as $key => $value)
				{
					if($value != '')
					{
						$screenshot_tb = TableRegistry::get('Screenshots');
						$screenshot = $screenshot_tb->get($value);
						$path = WWW_ROOT.'uploads/activity/screenshots' . DS .$screenshot->upload_file;
						if($screenshot_tb->delete($screenshot)):
							if(file_exists($path)) {
								$file = new File($path, false, 0777);
								$file->delete();
							}
						endif;
					}
				}
				$this->set(['message'=>'Records deleted successfully', 'url' => 'screenshots', '_serialize' => ['message','url']]);
				/*code to add activity logs*/
				
			
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$actdata['user_id'] = $userId;
				$actdata['action'] ='Deleted';
				$actdata['description'] = 'Deleted  multiple  Screen shots  ';
				$actdata['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $actdata);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
			else:
				throw new BadRequestException('Please choose any one record to delete.');
			endif;
		endif;
	}
}
