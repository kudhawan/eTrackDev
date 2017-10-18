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
class UsersController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Users = TableRegistry::get('Users');
		$this->Address = TableRegistry::get('Address');
		$this->Technology = TableRegistry::get('Technology');
	}
    /**
     * Index method
     *
     * @return void
     */
    public function index()
    {
		$conditions = array('Users.level_id'=>1);
		foreach($this->request->query as $k => $c):
			if(trim($c) == '' || in_array(strtolower($k), array('page', 'sort', 'direction')))
				continue;
			elseif(is_numeric($c))
				$conditions['Users.'.$k] = $c;
			else
				$conditions['LOWER(Users.'.$k . ') LIKE '] = '%' . strtolower($c) . '%';				
		endforeach;
		$this->paginate = ['contain' => ['Levels'], 'order' => array('id'=> 'desc'), 'conditions' => $conditions];
		$users = $this->paginate($this->Users);
        $this->set('users', $users);
        $levels = $this->Users->Levels->find('list')->toArray();
        $this->set('levels', $levels);
        $this->set('_serialize', ['users', 'levels']);
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
        $user = $this->Users->get($id);
        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['status'] = 1;
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be saved. Please, try again.'));
            }
        }
        $levels = $this->Users->Levels->find('list')->toArray();
        $this->set(compact('user', 'levels'));
        $this->set('_serialize', ['user', 'levels']);
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
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;
			$data['duration'] = str_replace(' ','',$data['duration']);
			if(!$data['password'])
			unset($data['password']);
            $user = $this->Users->patchEntity($user, $data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been updated.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The user could not be updated. Please, try again.'));
            }
        }
		$levels = $this->Users->Levels->find('list')->toArray();
        $this->set(compact('user', 'levels','duration'));
        $this->set('_serialize', ['user', 'levels','duration']);
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
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
    
    public function login()
	{
		$this->viewBuilder()->layout(false);
		if ($this->request->is('post')) {
			$user = $this->Auth->identify();
			if ($user && $user['level_id'] == 9) {
				$this->Auth->setUser($user);
				//~ Update user login date
				$user = $this->Users->get($user['id']);
				$user->login_at = Time::now();
				$this->Users->save($user);
				return $this->redirect($this->Auth->redirectUrl());
			} else {
				$this->Flash->error(__('Username or password is incorrect'));
			}
		}
	}
	
	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
	function settings()
	{
			
	}
	
	function setTechnology()
	{
		$technology = $this->Technology->get('1');
		if($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data();
			$technology = $this->Technology->patchEntity($technology, $data);	
            if ($this->Technology->save($technology)) {
                $this->Flash->success(__('Record updated successfully.'));
                return $this->redirect(['action' => 'settings']);
            } else {
                $this->Flash->error(__('Record could not be updated. Please, try again.'));
            }
		}
	}
	
	function changePassword()
	{
		if ($this->request->is(['patch', 'post', 'put'])) {
			
			if($this->request->data['new_password'] == $this->request->data['confirm_password'])
			{
				$user = $this->Users->get($this->Auth->user('id'));
				if($user->checkPassword($this->request->data['old_password'], $user->password))
				{
					$user = $this->Users->patchEntity($user, array('password' => $this->request->data('new_password')));
					if ($this->Users->save($user)) {
						$this->Flash->success(__('The password has been changed.'));
						return $this->redirect(['action' => 'settings']);
					} else {
						$this->Flash->error(__('The password could not be saved. Please, try again.'));
						return $this->redirect(['action' => 'settings']);
					}
				}
				else {
					$this->Flash->error(__('Old password does not match'));
					return $this->redirect(['action' => 'settings']);
				}
			}
			else {
				$this->Flash->error(__('Confirm password does not match'));
				return $this->redirect(['action' => 'settings']);
			}
        }
        
        throw new \Cake\Network\Exception\MethodNotAllowedException();
	}
	
	public function changeField($id = null)
    {
        $user = $this->Users->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
			if($this->request->data('status'))
			$this->request->data['token'] = '';
			$this->request->data['verified_at'] = Time::now();
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
				$this->set('message', 'User has been updated');
            } else {
				throw new \Cake\Network\Exception\BadRequestException(current(current($user->errors())));
            }
        }
        $this->set('_serialize', ['message']);
    }
}
