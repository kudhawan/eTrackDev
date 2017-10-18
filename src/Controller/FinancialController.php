<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\I18n\Time;

class FinancialController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->loadComponent('Pdf', ['viewClass' => 'Pdf', 'autoDetect' => true]);
        $this->loadComponent('Codegenerate');
		
		$authUser = '';
		if($this->Auth->user())
			$authUser = $this->Auth->user();
			
		$this->set(compact('authUser'));
		$this->Auth->Deny();
		$this->Users = TableRegistry::get('Users');
	}
	
	function budgetCalculation()
	{
	
		$project_tb = TableRegistry::get('Projects');
		$user_tb = TableRegistry::get('Users');
		
		$superadminCheck = $user_tb->find('all')->where(['Users.id' => $this->Auth->user('id'),'Users.is_admin' => 3])->all();
		$superadmin_visible= count($superadminCheck);
		if($superadmin_visible==1)
		{
			$projects = $project_tb->find()->all();
		}
		else
		{
			$projects = $project_tb->find()->where(['user_id' => $this->Auth->user('id')])->all();
		}
		
		
		//$projects = $project_tb->find()->where(['user_id' => $this->Auth->user('id')])->all();
		

		
		$this->set(compact('projects'));
		
		if($this->request->is('post')):
		
			$projectBudgets = TableRegistry::get('ProjectBudgets');
			
			$data = $this->request->data;
			if(isset($data['totalamt']) && count($data['totalamt']) > 0):
				for($i=0;$i<count($data['totalamt']);$i++):
					$budgets = $projectBudgets->newEntity();
					if($data['totalamt'][$i] != ''):
						$budgetData['project_id'] = $data['project_id'];
						$budgetData['position_id'] = $data['position_id'][$i];
						$budgetData['no_of_resource'] = $data['no_of_resource'][$i];
						$budgetData['hrs'] = $data['hrs'][$i];
						$budgetData['cost_per_hr'] = $data['cost_per_hr'][$i];
						$budgetData['status'] = 1;
						
						$budgets = $projectBudgets->patchEntity($budgets, $budgetData);
						$result = $projectBudgets->save($budgets);
					endif;
				
				endfor;
			endif;
			
			$this->set(['message'=>'Budget has been saved successfully', 'url' => 'financial/project-budget', '_serialize' => ['message','url']]);
		endif;
	}
	
	public function viewPdf($id = null)
	{
		
		$projectId = convert_uudecode(base64_decode($id));
		$projectpayment_tb = TableRegistry::get('ProjectPayments');
		$projectbudget_tb = TableRegistry::get('ProjectBudgets');
		$paymentDetails = $projectpayment_tb->find('all')->where(['ProjectPayments.id' => $projectId])->contain(['Users'])->first();
		$this->set(compact('budgetDetails', 'paymentDetails', 'projectId'));

		Configure::write('CakePdf.download', false);
    		Configure::write('CakePdf.filename', "MyCustomName.pdf");
	}
		
	function projectBudget()
	{
		
		$project_tb = TableRegistry::get('Projects');
		$user_tb = TableRegistry::get('Users');
		
		$superadminCheck = $user_tb->find('all')->where(['Users.id' => $this->Auth->user('id'),'Users.is_admin' => 3])->all();
		$superadmin_visible= count($superadminCheck);
		if($superadmin_visible==1)
		{
			$projects = $project_tb->find()->all();
		}
		else
		{
			$projects = $project_tb->find()->where(['user_id' => $this->Auth->user('id')])->all();
		}
		
		//$projects = $project_tb->find()->where(['Projects.user_id' => $this->Auth->user('id'),'Users.is_admin' => 3])->contain(['Users'])->all();
		
		$this->set(compact('projects'));
	}
		
	function sendInvoice()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$projectId = convert_uudecode(base64_decode($data['paymentId']));
			$projectpayment_tb = TableRegistry::get('ProjectPayments');
			$paymentDetails = $projectpayment_tb->get($projectId);
			$paymentDetails->status = 2;
			$projectpayment_tb->save($paymentDetails);
			$this->set(['message'=>'Invoice successfully sent to '.$paymentDetails->email, 'status' => 'success', '_serialize' => ['message','status']]);
		else:
			$this->set(['message'=>'Something went wrong.', 'status' => 'error', '_serialize' => ['message','status']]);
		endif;
	}
		
	function payInvoice()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$projectId = convert_uudecode(base64_decode($data['paymentId']));
			$projectpayment_tb = TableRegistry::get('ProjectPayments');
			$paymentDetails = $projectpayment_tb->get($projectId);
			$paymentDetails->status = 3;
			$projectpayment_tb->save($paymentDetails);
			$this->set(['message'=>'Invoice successfully paid', 'url' => 'financial/project-budget', '_serialize' => ['message','url']]);
		else:
			$this->set(['message'=>'Something went wrong.', '_serialize' => ['message']]);
		endif;
	}
		
	function cancelInvoice()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$projectId = convert_uudecode(base64_decode($data['paymentId']));
			$projectpayment_tb = TableRegistry::get('ProjectPayments');
			$paymentDetails = $projectpayment_tb->get($projectId);
			$paymentDetails->status = 4;
			$projectpayment_tb->save($paymentDetails);
			$this->set(['message'=>'Invoice cancelled successfully', 'url' => 'financial/project-budget', '_serialize' => ['message','url']]);
		else:
			$this->set(['message'=>'Something went wrong.', '_serialize' => ['message']]);
		endif;
	}
	
	function budgetDetails()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$projectbudget_tb = TableRegistry::get('ProjectBudgets');
			$budgetDetails = $projectbudget_tb->find()->where(['project_id' => $data['projectId']])->contain(['Positions', 'Projects'])->all();
			$this->set(compact('budgetDetails'));
		endif;
	}
	
	public function projectPayments(){
		if($this->request->is('ajax')):
			$data = $this->request->data;
			$projectId = convert_uudecode(base64_decode($data['projectId']));
			$projectpayment_tb = TableRegistry::get('ProjectPayments');
			$projectbudget_tb = TableRegistry::get('ProjectBudgets');
			$budgetDetails = $projectbudget_tb->find()->where(['project_id' => $projectId])->contain(['Positions', 'Projects'])->all();
			$paymentDetails = $projectpayment_tb->find('all')->where(['project_id' => $projectId])->contain(['Users'])->all();
			$this->set(compact('budgetDetails', 'paymentDetails', 'projectId'));
		endif;
	}
	
	public function addPayment(){
		if($this->request->is('post')):
			$data = $this->request->data;
			
			$projectpayment_tb = TableRegistry::get('ProjectPayments');
			
			$paymentCount = $projectpayment_tb->find('all')->count();
			
			$paymentData['amt'] = $data['amt'];
			$paymentData['code'] = $this->Codegenerate->generate('INV', $paymentCount);
			$paymentData['project_id'] = $data['project_id'];
			$paymentData['addedby'] = $this->Auth->user('id');
			$paymentData['company_name'] = $data['company_name'];
			$paymentData['client_name'] = $data['client_name'];
			$paymentData['email'] = $data['email'];
			$paymentData['address1'] = $data['address1'];
			$paymentData['address2'] = $data['address2'];
			$paymentData['address3'] = $data['address3'];
			$paymentData['particulars'] = $data['particulars'];
			$paymentData['notes'] = $data['notes'];
			$paymentData['status'] = 1;
						
			$projectPayments = TableRegistry::get('ProjectPayments');
			$payments = $projectPayments->newEntity();
			$payments = $projectPayments->patchEntity($payments, $paymentData);
			$result = $projectPayments->save($payments);
			if($result):
				
			/*code to add activity logs*/	
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$data['user_id'] = $userId;
				$data['action'] = 'Visited';
				$data['description'] = 'Payment Added';
				$data['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $data);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
				$this->set(['message'=>'Invoice has been added successfully', 'url' => 'financial/project-budget', '_serialize' => ['message','url']]);
			else:
				$this->set(['message'=>'Something went wrong. Please try again.', '_serialize' => ['message']]);
			endif;
		endif;
		//$this->redirect('/financial/');
	}
	
	function budgetDelete()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$projectbudget_tb = TableRegistry::get('ProjectBudgets');
			$budget = $projectbudget_tb->get($data['budgetId']);
			if($projectbudget_tb->delete($budget)):
				
			/*code to add activity logs*/	
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$data['user_id'] = $userId;
				$data['action'] = 'Visited';
				$data['description'] = 'Budget deleted';
				$data['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $data);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
				$this->set(['message'=>'Budget has been removed successfully', 'status' => 'success', '_serialize' => ['message','status']]);
			else:
				$this->set(['message'=>'Something went wrong. Please try again', 'status' => 'error', '_serialize' => ['message','status']]);
			endif;
		endif;
	}
	
	function paymentDelete()
	{
		if($this->request->is('post')):
			$data = $this->request->data;
			$projectpayment_tb = TableRegistry::get('ProjectPayments');
			$payment = $projectpayment_tb->get($data['paymentId']);
			if($projectpayment_tb->delete($payment)):
				
			/*code to add activity logs*/	
				$activity_tb = TableRegistry::get('Activities');
				$userId= $this->Auth->user('id');
				$activityLog = $activity_tb->newEntity();
				$data['user_id'] = $userId;
				$data['action'] = 'Visited';
				$data['description'] = 'Payment deleted';
				$data['created'] = Time::now();
				$activityLog = $activity_tb->patchEntity($activityLog, $data);
				$result = $activity_tb->save($activityLog);
			
			   /*code to add activity logs ends here*/
			   
				$this->set(['message'=>'Invoice has been removed successfully', 'status' => 'success', '_serialize' => ['message','status']]);
			else:
				$this->set(['message'=>'Something went wrong. Please try again', 'status' => 'error', '_serialize' => ['message','status']]);
			endif;
		endif;
	}
	function edit($id=NULL)
	{
		$decodeId = convert_uudecode(base64_decode($id));
		$position_tb = TableRegistry::get('Positions');
		$positionList = $position_tb->find('all')->all();
		
		
		$budget_tb = TableRegistry::get('ProjectBudgets');
		$getBudget = $budget_tb->find()->where(['ProjectBudgets.id' => $decodeId])->first();
		
		if($this->request->is('post')):
		
		$data = $this->request->data;
		$getBudget = $budget_tb->find('all' , ['conditions'=>['ProjectBudgets.id'=>$data['id']]])->first();
		//$getBudget = $budget_tb->find()->where(['ProjectBudgets.id' => $decodeId])->first();
		$getBudget = $budget_tb->patchEntity($getBudget,$data);
		$result = $budget_tb->save($getBudget);
		if($result):
		
				$this->set(['message'=>'Budget has been updated successfully', 'url' => 'financial/budget-calculation', '_serialize' => ['message','url']]);
		else:
				throw new BadRequestException(' Budget could not be updated.');
			endif;
		endif;
		
		
		
		
		$this->set(compact('getBudget','positionList'));
		
		
		
		
		
		
	}

}
