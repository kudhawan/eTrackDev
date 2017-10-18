<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;

class ConversationController extends AppController
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
		$this->Positions = TableRegistry::get('Positions');
		$this->Bugs = TableRegistry::get('Bugs');
		$this->Features = TableRegistry::get('Features');
	}

	function chat($id=NULL){
		$project = TableRegistry::get('Projects');
		$conversation = TableRegistry::get('Conversations');
		
		$projectId = '';
		$bugId = '';
		
		/*
		$actionName = explode('/' , $this->referer())[4];
		pr($this->request); die;
		if(isset($actionName) && $actionName == 'bug-sheet'){
			$bugId = convert_uudecode(base64_decode($id));
			$getProject = $this->Bugs->find()->where(array('id' => $bugId))->first();
			$getConversation = $conversation->find()->where(['Conversations.bug_id' => $bugId])->contain(['Users'])->all();
		}

		else{*/
			$projectId = convert_uudecode(base64_decode($id));
			$getProject = $project->find()->where(array('id' => $projectId))->first();
			$getConversation = $conversation->find()->where(['Conversations.project_id' => $projectId,'Conversations.bug_id' => 0,'Conversations.feature_id' => 0])->contain(['Users','Projects','Designations','Positions'])->all();
		//}
		$this->set(compact('getProject','getConversation'));
	}

	function bugchat($id=NULL){
		$project = TableRegistry::get('Projects');
		$conversation = TableRegistry::get('Conversations');
		
		$projectId = '';
		$bugId = '';
		
		$bugId = convert_uudecode(base64_decode($id));
		$getProject = $this->Bugs->find()->where(array('id' => $bugId))->first();
		$getConversation = $conversation->find()->where(['Conversations.bug_id' => $bugId])->contain(['Users'])->all();
		
		$this->set(compact('getProject','getConversation'));
	}

	function featurechat($id=NULL){
		$project = TableRegistry::get('Projects');
		$conversation = TableRegistry::get('Conversations');
		
		$projectId = '';
		$featureId = '';
		
		$featureId = convert_uudecode(base64_decode($id));
		$getProject = $this->Features->find()->where(array('id' => $featureId))->first();
		$getConversation = $conversation->find()->where(['Conversations.feature_id' => $featureId])->contain(['Users'])->all();
		
		$this->set(compact('getProject','getConversation'));
	}

		function conversation(){
			$chat = TableRegistry::get('Conversations');
			$team = TableRegistry::get('Teams');
			
			$projectId = '';
			$bugId = '';
		
			$getSubDesignationId = $subDesignation ='';

			if($this->request->query('bug_id')){
				$bug_id = convert_uudecode(base64_decode($this->request->query('bug_id')));
			} 
			if($this->request->query('feature_id')){
				$feature_id = convert_uudecode(base64_decode($this->request->query('feature_id')));
			} 
			if($this->request->query('project_id')){
				$project_id = convert_uudecode(base64_decode($this->request->query('project_id')));
			} else
				$project_id = convert_uudecode(base64_decode($this->request->data('project_id')));
				
			if($this->request->is('post')){
				$data = $this->request->data;
				$userId= $this->Auth->user('id');
		        $getSubDesignationId = $team->find()->where(['Teams.position_id !='=>'','Users.status'=>1])->andWhere([
			        'OR' => [
			            ['Teams.member_id' => $this->Auth->user('id')],
			            ['Teams.employer_id' => $this->Auth->user('id')]
			        ]
			    ])->contain(['Users'])->first();
				
				$getDesignations = $team->find()->where(['FIND_IN_SET('.$project_id.', Teams.projects)', 'Teams.member_id'=>$userId])->orWhere(['FIND_IN_SET('.$project_id.', Teams.projects)', 'Teams.employer_id'=>$userId])->where(['Users.status'=>1])->contain(['Users'])->first();

		        if($getDesignations['member_id'] == $userId){
		        	$mainDesignation = $getDesignations['designation_id'];
		        	$subDesignation = $getDesignations['position_id'];
		        } else if($getDesignations['employer_id'] == $userId) {
		        	$mainDesignation = 0;
		        	$subDesignation = 0;
				}

		        $getChat = $chat->newEntity();
		        $data['user_id'] = $userId;
		        if(isset($project_id) && $project_id){
					$data['project_id'] = $project_id;
					$data['designation_id'] = $mainDesignation;
					$data['position_id'] = $subDesignation;
				}

				if(isset($bug_id) && $bug_id){
					$data['bug_id'] = $bug_id;
				} else
					$data['bug_id'] = 0;
					
				if(isset($feature_id) && $feature_id){
					$data['feature_id'] = $feature_id;
				} else
					$data['feature_id'] = 0;

	            $getChat = $chat->patchEntity($getChat, $data);

	            if($chat->save($getChat))
	            {
					$chatData = $chat->get($getChat->id, ['contain' => ['Users','Designations','Positions']]);
					if($chatData->designation_id > 0):
						$maindesignation = @$chatData->designation->name ? ' <small>'.$chatData->designation->name.'</small>':''; 
						$subdesignation = @$chatData->position->title ? ' <small>('.$chatData->position->title .')</small>':''; 
					else:
						$maindesignation = ' <small>Project Creator</small>'; 
						$subdesignation = ''; 
					endif;
					$this->set(['message'=>'Message sent.', 'html'=>'<div class="comment-indvidual"><label class="user-name">'.$chatData->user->name.$maindesignation.$subdesignation.'<span>'.$chatData->created->format('m/d/y, h:i a').'</span></label><p>'.$chatData->comment.'</p></div>', '_serialize' => ['html','message']]);
				}else{
					throw new BadRequestException('Oops! Message could not be sent.');
				}
			}
		}
}
	

