<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use App\Controller\AppController;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\MethodNotAllowedException;
use Cake\I18n\Time;

class ApiController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Responsibility = TableRegistry::get('Responsibility');
		$this->Skills = TableRegistry::get('Skills');
		$this->Tasks = TableRegistry::get('Tasks');
	}
	
	function functions()
	{
		$conditions = array('Responsibility.active' => 1);
		if($this->request->query('role_id'))
		$conditions['Responsibility.role_id'] = $this->request->query('role_id');
		$functions = $this->Responsibility->find('all', array('conditions' => $conditions, 'order' => 'Responsibility.id asc', 'fields' => array('id', 'name')));
		$this->set(array('functions' => $functions, '_serialize' => array('functions')));
	}
	
	function skills()
	{
		if(!$this->request->query('responsibility_id'))
		throw new BadRequestException();
		$conditions = array('OR' => array('Skills.active' => 1, 'Skills.user_id' => $this->Auth->user('id')));
		if($this->request->query('responsibility_id'))
		$conditions['Skills.responsibility_id'] = $this->request->query('responsibility_id');
		if($this->request->query('not'))
		$conditions['Skills.id NOT IN'] = array_filter(explode(',', $this->request->query('not')));
		
		if($this->request->query('q'))
		$conditions['LOWER(Skills.name) LIKE'] = '%'.strtolower($this->request->query('q')).'%';
		$result = $this->Skills->find('all', array('conditions' => $conditions, 'order' => 'Skills.name asc', 'fields' => array('id', 'name')));
		$skills = array();
		foreach($result as $k => $s)
		{
			$skills[$k] = $s->toArray();
			$skills[$k]['candidates'] = $s->candidates;
		}
		$this->set(array('skills' => $skills, '_serialize' => array('skills')));
	}
	
	function addSkill()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$data['active'] = 0;
			$data['is_tmp'] = 1;
			$data['user_id'] = $this->Auth->user('id');
			$data['name'] = trim($data['name']);
			if($this->Skills->find('all', array('conditions' => array('responsibility_id' => $data['responsibility_id'], 'name' => $data['name'])))->count())
			throw new BadRequestException($data['name'] . ' is already exists. Please select from library');
			
			$skill = $this->Skills->newEntity();
			$skill = $this->Skills->patchEntity($skill, $data);
			if ($this->Skills->save($skill)) {
				$this->set(array('message' => 'Skill added.', 'id' => $skill->id, '_serialize' => array('message', 'id')));
			} else {
				throw new BadRequestException(current(current($skill->errors())));
			}
		else:
			throw new MethodNotAllowedException();
		endif;
	}
	
	function tasks()
	{
		if(!$this->request->query('skill_id'))
		throw new BadRequestException();
		$conditions = array('OR' => array('Tasks.active' => 1, 'Tasks.user_id' => $this->Auth->user('id')));
		if($this->request->query('skill_id'))
		$conditions['Tasks.skill_id'] = $this->request->query('skill_id');
		if($this->request->query('q'))
		$conditions['LOWER(Tasks.description) LIKE'] = '%'.strtolower($this->request->query('q')).'%';
		if($this->request->query('not'))
		$conditions['Tasks.id NOT IN'] = array_filter(explode(',', $this->request->query('not')));
		$result = $this->Tasks->find('all', array('conditions' => $conditions, 'order' => 'Tasks.description asc', 'fields' => array('id', 'description')));
		$tasks = array();
		foreach($result as $k => $s)
		{
			$tasks[$k] = $s->toArray();
			$tasks[$k]['candidates'] = $s->candidates;
		}
		$this->set(array('tasks' => $tasks, '_serialize' => array('tasks')));
	}
	
	function addTask()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$data['active'] = 0;
			$data['is_tmp'] = 1;
			$data['user_id'] = $this->Auth->user('id');
			$data['description'] = trim($data['description']);
			if($this->Tasks->find('all', array('conditions' => array('skill_id' => $data['skill_id'], 'description' => $data['description'])))->count())
			throw new BadRequestException($data['description'] . ' is already exists. Please select from library');
			
			$task = $this->Tasks->newEntity();
			$task = $this->Tasks->patchEntity($task, $data);
			if ($this->Tasks->save($task)) {
				$this->set(array('message' => 'Task added.', 'id' => $task->id, '_serialize' => array('message', 'id')));
			} else {
				throw new BadRequestException(current(current($skill->errors())));
			}
		else:
			throw new MethodNotAllowedException();
		endif;
	}
}
