<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;

class ChatController extends AppController
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
		$this->Chats = TableRegistry::get('Chats');
		$this->Chatmain = TableRegistry::get('Chatmain');
	}
	
	public function userList(){
		if($this->request->is('ajax')){
			$usersList = $this->Users->find()->where(['Users.status' => 1])->all();
			
			//pr($otherProjects->toArray()); die;
			$this->set(['message'=>'User list got successfully', 'usercount' => count($usersList), 'userlist' => $usersList, 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','usercount','userlist','currentUser']]);
		}
	}
	
	public function messageList(){
		if($this->request->is('ajax')){
			if(isset($this->request->query['userID'])):
				$userid = $this->request->query('userID');
				$chatlist = $this->Chatmain->find()->where(['Chatmain.first_user' => $userid,'Chatmain.second_user' => $this->Auth->user()['id']])->orWhere(['Chatmain.first_user' => $this->Auth->user()['id'],'Chatmain.second_user' => $userid])->first();
				
				if($chatlist):
					$messagelist = $this->Chats->find()->where(['Chats.chat_id' => $chatlist->id])->all();
				
					$this->set(['message'=>'Message list got successfully', 'msgcount' => count($messagelist), 'messagelist' => $messagelist, 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','msgcount','messagelist','currentUser']]);
				else:
					$this->set(['message'=>'No Records Found', 'msgcount' => 0, 'messagelist' => [], 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','msgcount','messagelist','currentUser']]);
				endif;
			else:
				$this->set(['message'=>'No Records Found', 'msgcount' => 0, 'messagelist' => [], 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','msgcount','messagelist','currentUser']]);
			endif;
		}
	}
	
	public function newMessage(){
		//if($this->request->is('ajax')){
			if(isset($this->request->query['userID'])):
				$userid = $this->request->query('userID');
				$chatlist = $this->Chatmain->find()->where(['Chatmain.first_user' => $userid])->orWhere(['Chatmain.second_user' => $userid])->all();
				if($chatlist):
					$msgreturnData['messages'] = $messagelist = [];
					foreach($chatlist->toArray() as $chatdata):
						$messagedata = '';
						$chatreturnData['chats'] = $chatdata;
						$messagedata = $this->Chats->find('all')->where(['Chats.chat_id' => $chatdata->id,'Chats.newmsg' => 1])->all();
						$msgreturnData['messages'] = $messagedata->toArray();
						foreach($messagedata->toArray() as $key => $messagedatas):
							if($this->Auth->user()['id'] != $messagedatas->sender_id):
								$chatsupdate = $this->Chats->get($messagedatas->id);
								$chatsupdate->newmsg = 2;
								$this->Chats->save($chatsupdate);
							else:
									unset( $msgreturnData['messages'][$key] );
							endif;
						endforeach;
						$messagelist[] = array_merge($chatreturnData,$msgreturnData);
					endforeach;
					
					$this->set(['message'=>'Message list got successfully', 'msgcount' => count($messagedata), 'messagelist' => $messagelist, 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','msgcount','messagelist','currentUser']]);
				else:
					$this->set(['message'=>'No Records Found', 'msgcount' => 0, 'messagelist' => [], 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','msgcount','messagelist','currentUser']]);
				endif;
			else:
				$this->set(['message'=>'No Records Found', 'msgcount' => 0, 'messagelist' => [], 'currentUser' => $this->Auth->user()['id'], '_serialize' => ['message','msgcount','messagelist','currentUser']]);
			endif;
		//}
	}
	
	public function sendMsg(){
		if($this->request->is('ajax')){
			$requestdata = $this->request->data;
			$chatmainlist = $this->Chatmain->find()->where(['Chatmain.first_user' => $requestdata['from'],'Chatmain.second_user' => $requestdata['to']])->orWhere(['Chatmain.first_user' => $requestdata['to'],'Chatmain.second_user' => $requestdata['from']])->first();
			if(count($chatmainlist) > 0):
				$chatmain_id = $chatmainlist->id;
			else:
				$chatmain = $this->Chatmain->newEntity();
				$data['first_user'] = $requestdata['from'];
				$data['second_user'] = $requestdata['to'];
				$chatmain = $this->Chatmain->patchEntity($chatmain, $data);
				$result = $this->Chatmain->save($chatmain);
				$chatmain_id = $result->id;
			endif;
			if($chatmain_id):
				$chat = $this->Chats->newEntity();
				$data['sender_id'] = $requestdata['from'];
				$data['chat_id'] = $chatmain_id;
				$data['message'] = $requestdata['msg'];
				$data['newmsg'] = 1;
				$data['ip_address'] = $this->request->clientIp();
				$chat = $this->Chats->patchEntity($chat, $data);
				
				if ($this->Chats->save($chat)):
				//pr($otherProjects->toArray()); die;
					$this->set(['message'=>'Successfully sent', '_serialize' => ['message']]);
				else:
					$this->set(['message'=>'Successfully sent', '_serialize' => ['message']]);
				endif;
			else:
				$this->set(['message'=>'Successfully sent', '_serialize' => ['message']]);
			endif;
		}
	}
}
	

