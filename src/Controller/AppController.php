<?php 
 // ob_start();
 // session_start();
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Mailer\Email;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
			'loginAction' => [
				'controller' => 'Users',
				'action' => 'login',
				'plugin' => $this->request->plugin == 'Admin' ? 'Admin' : null
			],
			'logoutRedirect' => [
				'controller' => 'Users',
				'action' => 'login',
				'plugin' => $this->request->plugin  == 'Admin' ? 'Admin' : null
			],
			'loginRedirect' => $this->request->plugin ? "/administrator/users" : 'dashboard',
			'authenticate' => [
				'Form' => [
					'fields' => ['username' => 'email']
				]
			]
		]);
		
		$this->set('loginUser', $this->Auth->user());
		
		### UPDATE LAST VISIT ###
		$currentuser = [];
		$currentuser = $this->Auth->user();
		
		
        $online_offline_status = 0;
        if ($currentuser['id']){
        // Checking for the SESSION - Proceed only if MEMBER/USER is logged in.
            //$this->loadModel('Member'); // Loading MEMBER Model
            $user = $this->Auth->identify();
			$this->Users = TableRegistry::get('Users');
            // UPDATE MEMBER VISIT TIME
            $last_visit = date('Y-m-d H:i:s', time());
			
			
			$user = $this->Users->get($currentuser['id']);
			$user->last_login_at = Time::now();
			$this->Users->save($user);
        } 
    }
    
    public function sendEmailClient($to, $subject, $content, $template = 'default', $cc = '', $attach = '')
    {
		$email = new Email();
		//$email->from(['info@codemunks.com' => 'eTrack'])
		$email->from(['aruna@albertatechworks.com' => 'eTrack'])
			->emailFormat('html')
			->template('default')
			->viewVars(['content' => $content])
			->to($to)
			->subject($subject);
			if($cc != '')
			$email->cc($cc);
		
		if($attach != '')
			$email->attachments($attach);
			
		if ($email->send()) {
			return 'Success';
		} else {
			return 'Failed';
		}
		/*if ( $email->send() ) {
			return 'Success';
		} else {
			return 'Failed';
		}*/
	}
	
	public function sendEmail($to, $subject, $content, $template = 'default', $cc = '', $attach = '')
    {
		$email = new Email();
		$email->from(['info@codemunks.com' => 'eTrack'])
			->emailFormat('html')
			->template($template)
			->viewVars(['content' => $content, 'siteconfig' => $this->viewVars['siteconfig']])
			->to($to)
			->subject($subject);
			
		if($cc != '')
			$email->cc($cc);
		
		if($attach != '')
			$email->attachments($attach);
			
		if ($email->send()) {
			return 'Success';
		} else {
			return 'Failed';
		}
	}
	
	
	public function beforeFilter(Event $event){
        $projects= TableRegistry::get('Projects');
        if(!empty($this->Auth->user('id'))){
            $userProjects=$projects->find('all')->where(['user_id'=>$this->Auth->user('id')]);
            $this->set(compact('userProjects'));      
        }
        $designation = TableRegistry::get('Designations');
        
            $getDesignations=$designation->find('all')->where(['is_deleted'=>0]);
            $this->set(compact('getDesignations'));      
        
    }
    function  deleteRecord($model=NULL,$id=NULL){

		$id = convert_uudecode(base64_decode($id));
        $table = TableRegistry::get($model);
        $rec = $table->find()->where([$model.'.id' =>$id])->first();
        $data['is_deleted'] = 1;
        // echo "<pre>"; print_r($rec); die;
        $rec = $table->patchEntity($rec, $data);
        // pr($rec); die;
        if($table->save($rec)) {
            $this->Flash->success('Record has been deleted successfully.');
        } else {
            $this->Flash->error('Some problem occured. Please, try again.');
        }
        return $this->redirect($this->referer());
    }
}
