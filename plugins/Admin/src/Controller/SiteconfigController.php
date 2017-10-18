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
class SiteconfigController extends AppController
{
	function initialize()
	{
		parent::initialize();
		$this->Siteconfig = TableRegistry::get('Siteconfig');
	}
	
    /**
     * Setting method
     *
     * @return void
     */
    public function setting()
    {
		$siteconfig = $this->Siteconfig->get(1);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
			$data = $this->request->data;
            $siteconfig = $this->Siteconfig->patchEntity($siteconfig, $data);
            if ($this->Siteconfig->save($siteconfig)) {
                $this->Flash->success(__('The site setting has been updated.'));
            } else {
                $this->Flash->error(__('The site setting could not be updated. Please, try again.'));
            }
        }
		
        $this->set(compact('siteconfig'));
        $this->set('_serialize', ['siteconfig']);
    }
    
}
