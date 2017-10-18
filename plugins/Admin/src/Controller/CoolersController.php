<?php
namespace Admin\Controller;

use Cake\ORM\TableRegistry;
use Admin\Controller\AppController;
use Cake\I18n\Time;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class CoolersController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Coolers = TableRegistry::get('Coolers');
		$this->Users = TableRegistry::get('Users');
		$this->TemperatureSettings = TableRegistry::get('TemperatureSettings');
	}
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
		$conditions = array();
		foreach($this->request->query as $k => $c):
			if(trim($c) == '' || in_array(strtolower($k), array('page', 'sort', 'direction')))
				continue;
			elseif(is_numeric($c))
				$conditions['Coolers.'.$k] = $c;
			else
				$conditions['LOWER(Coolers.'.$k . ') LIKE '] = '%' . strtolower($c) . '%';				
		endforeach;
		$this->paginate = ['order' => array('id'=> 'desc'), 'conditions' => $conditions , 'contain' => ['Users']];
		$coolers = $this->paginate($this->Coolers);
		$users = $this->Users->find('list',['conditions'=>['Users.status'=>1 , 'is_deleted'=>0 ,'level_id' =>1] , 'keyField'=>'id' , 'valueField'=>'name'])->toArray();
        $this->set(compact('coolers', 'users') , '_serialize', ['coolers' , 'users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return void
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cooler = $this->Coolers->get($id,['contain'=>'Users']);
        $this->set('cooler', $cooler);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cooler = $this->Coolers->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['status'] = 1;
            $cooler = $this->Coolers->patchEntity($cooler, $data);
            if ($this->Coolers->save($cooler)) {
                $this->Flash->success(__('Record saved successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
            }
        }
        $users = $this->Users->find('list',['conditions'=>['Users.status'=>1 , 'is_deleted'=>0 ,'level_id' =>1] , 'keyField'=>'id' , 'valueField'=>'name'])->toArray();
        $this->set(compact('cooler' ,'users'));
        $this->set('_serialize', ['cooler' ,'users']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cooler = $this->Coolers->get($id, [
            'contain' => ['Users']
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;			
            $cooler = $this->Coolers->patchEntity($cooler, $data);
            if ($this->Coolers->save($cooler)) {
                $this->Flash->success(__('Record updated successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Record could not be updated. Please, try again.'));
            }
        }
        $users = $this->Users->find('list',['conditions'=>['Users.status'=>1 , 'is_deleted'=>0 ,'level_id' =>1] , 'keyField'=>'id' , 'valueField'=>'name'])->toArray();
        $this->set(compact('cooler' ,'users'));
        $this->set('_serialize', ['cooler' ,'users']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cooler = $this->Coolers->get($id);
        if ($this->Coolers->delete($cooler)) {
            $this->Flash->success(__('Record deleted successfully.'));
        } else {
            $this->Flash->error(__('Record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function changeField($id = null)
    {
        $cooler = $this->Coolers->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
			if($this->request->data('status'))
			$this->request->data['status'] = 1;
            $cooler = $this->Coolers->patchEntity($cooler, $this->request->data);
            if ($this->Coolers->save($cooler)) {
				$this->set('message', 'Record updated');
            } else {
				throw new \Cake\Network\Exception\BadRequestException(current(current($cooler->errors())));
            }
        }
        $this->set('_serialize', ['message']);
    }
    
    public function setting($id = null)
    {
		$cooler = $this->Coolers->get($id);
		$users = $this->Users->find('list',['conditions'=>['Users.status'=>1 , 'is_deleted'=>0 ,'level_id' =>1] , 'keyField'=>'id' , 'valueField'=>'name'])->toArray();
		$currentDate = new Time('Asia/Kolkata');
		$this->paginate = ['order' => array('id'=> 'desc'), 'conditions' => ['TemperatureSettings.cooler_id'=>$id]];
		$tempSettings = $this->paginate($this->TemperatureSettings);
		$this->set(compact('users' ,'cooler' ,'tempSettings' , 'currentDate') , '_serialize', ['users' ,'cooler','tempSettings', 'currentDate']);
		
    }
    
    public function settingEdit($id = null)
    {
		$currentTime = new Time('Asia/Kolkata');
        $tempSetting = $this->TemperatureSettings->get($id,['contain'=>['Coolers']]);
        $fromDuration  = date_format($tempSetting->from_duration , "H:i");
        $toDuration  = date_format($tempSetting->to_duration , "H:i");
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;			
			$data['from_duration'] = str_replace(' ','',$data['from']);
			$data['to_duration'] = str_replace(' ','',$data['to']);
            $tempSetting = $this->TemperatureSettings->patchEntity($tempSetting, $data);
            if ($this->TemperatureSettings->save($tempSetting)) {
                $this->Flash->success(__('Record updated successfully.'));
                return $this->redirect(['action' => 'setting' , $tempSetting->cooler_id]);
            } else {
                $this->Flash->error(__('Record could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('tempSetting' , 'fromDuration' ,'toDuration','currentTime'));
        $this->set('_serialize', ['tempSetting' ,'fromDuration' ,'toDuration','currentTime']);
    }
    
    public function settingDelete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tempSetting = $this->TemperatureSettings->get($id);
        if ($this->TemperatureSettings->delete($tempSetting)) {
            $this->Flash->success(__('Record deleted successfully.'));
        } else {
            $this->Flash->error(__('Record could not be deleted. Please, try again.'));
        }
        return $this->redirect($this->referer());
    }
    
    
    public function setTemp()
    {
		$temp = $this->TemperatureSettings->newEntity();
		if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;
			$data['from_duration'] = str_replace(' ','',$data['from']);
			$data['to_duration'] = str_replace(' ','',$data['to']);
			$temp = $this->TemperatureSettings->patchEntity($temp, $data);
			if($this->TemperatureSettings->save($temp)){
				$this->Flash->success(__('Record added successfully.'));
				$this->redirect($this->referer());
            }
		}
	}
	
	public function timeCheck()
	{
		if($this->request->is('ajax')){
			$data = $this->request->data;
			$data['from_duration'] = str_replace(' ','',$data['fromTime']);
			$data['to_duration'] = str_replace(' ','',$data['toTime']);
			$fromChkTime = $this->TemperatureSettings->find('all')->where(['created >' => date('Y-m-d')])->andWhere(["from_duration Between '{$data['from_duration']}' and '{$data['to_duration']}'", "to_duration Between '{$data['from_duration']}' and '{$data['to_duration']}'"])->toArray();
			pr($fromChkTime); die;
		}
	}
	
}
