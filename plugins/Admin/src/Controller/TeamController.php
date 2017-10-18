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
class TeamController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Team = TableRegistry::get('Team');
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
				$conditions['Team.'.$k] = $c;
			else
				$conditions['LOWER(Team.'.$k . ') LIKE '] = '%' . strtolower($c) . '%';				
		endforeach;
		$this->paginate = ['order' => array('id'=> 'desc'), 'conditions' => $conditions];
		$team = $this->paginate($this->Team);
        $this->set('team', $team);
        $this->set('_serialize', ['team']);
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
        $team = $this->Team->get($id);
        $this->set('team', $team);
    }

    /**
     * Add method
     *
     * @return void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $team = $this->Team->newEntity();
        if ($this->request->is('post')) {
			$data = $this->request->data;
			$data['status'] = 1;
			if($data['image'] && isset($data['image']['tmp_name']) && $data['image']['tmp_name']):
			$ext = explode('.', $data['image']['name']);
			
			$ext = strtolower(end($ext));
			if(!in_array($ext, array('png', 'jpeg', 'jpg', 'gif'))){
				$this->Flash->error(__('Please upload a valid image.'));
				return $this->redirect($this->referer);
			}
				$name = time()*microtime() . '.' . $ext;
				move_uploaded_file($data['image']['tmp_name'], WWW_ROOT . 'team_img/' . $name );
				$data['image'] = $name;
			else:
				unset($data['image']);
			endif;
            $team = $this->Team->patchEntity($team, $data);
            if ($this->Team->save($team)) {
                $this->Flash->success(__('Record saved successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Record could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('team'));
        $this->set('_serialize', ['team']);
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
        $team = $this->Team->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;
			
			if($data['image'] && isset($data['image']['tmp_name']) && $data['image']['tmp_name']):			
				$ext = explode('.', $data['image']['name']);
				$ext = strtolower(end($ext));
				
				if(!in_array($ext, array('png', 'jpeg', 'jpg', 'gif'))){
					$this->Flash->error(__('Please upload a valid image.'));
					return $this->redirect($this->referer);
				}
				
				$name = time()*microtime() . '.' . $ext;
				move_uploaded_file($data['image']['tmp_name'], WWW_ROOT . 'team_img/' . $name );
				if(file_exists(WWW_ROOT . 'team_img/' . $team->image))
				unlink(WWW_ROOT . 'team_img/' . $team->image);
				$data['image'] = $name;
			else:
				unset($data['image']);
			endif;
            $team = $this->Team->patchEntity($team, $data);
            if ($this->Team->save($team)) {
                $this->Flash->success(__('Record updated successfully.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('Record could not be updated. Please, try again.'));
            }
        }
        $this->set(compact('team'));
        $this->set('_serialize', ['team']);
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
        $team = $this->Team->get($id);
        if ($this->Team->delete($team)) {
			if(file_exists(WWW_ROOT . 'team_img/' . $team->image))
			unlink(WWW_ROOT . 'team_img/' . $team->image);
            $this->Flash->success(__('Record deleted successfully.'));
        } else {
            $this->Flash->error(__('Record could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
