<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
class LinkedinController extends AppController
{
	
	/*var $components = array('Linkedin.Linkedin' => array(
		'key' => '81fqazexg4zsns',
		'secret' => 'RiZpUnvMsOi2Aqiw',
	));*/
	
	
	function initialize()
	{
		parent::initialize();
		$this->loadComponent('linkedin');
		
		
		$authUser = '';
		if($this->Auth->user())
			$authUser = $this->Auth->user();
			
		$this->set(compact('authUser'));
		//$this->Auth->Deny();
		$this->Auth->allow(['view','linkedinDetails']); // Allows the display page without loggin in.
		$this->Users = TableRegistry::get('Users');
		 

	}

	public function view()
	{
		//$this->Linkedin->connect( /* optionally provide a custom callback url -> array('action'=>'custom_connect_callback') */ );
		$this->Linkedin->connect( array('action'=>'http://162.216.17.175/eTrack/linkedin') );
		
	}
	
	
	public function profile() {
		$this->set('response', $this->Linkedin->call('people/~',
													 array(
														  'id',
														  'picture-url',
														  'first-name', 'last-name', 'summary', 'specialties', 'associations', 'honors', 'interests', 'twitter-accounts',
														  'positions' => array('title', 'summary', 'start-date', 'end-date', 'is-current', 'company'),
														  'educations',
														  'certifications',
														  'skills' => array('id', 'skill', 'proficiency', 'years'),
														  'recommendations-received',
													 )));
	}




	
	public function linkedin_connect_callback() {
		$this->Linkedin->authorize(  array('action'=>'http://162.216.17.175/eTrack/facebook') );
	}
	
	/**
	 * Default callback: we're successfully connected with linkedin API
	 */
	public function linkedin_authorize_callback() {
		// we are successfully connected with linkedin API, now you can call any API method you like and retrieve the data you want
	}
	
	public function saveSearch()
	{
			if($this->request->is('post')){
			$data = $this->request->data;
			
			//print_r($data);
			//exit;
			
			
			$search_val=$_POST['search_val'];
			$search_brand = $_POST['search_brand'];
			$count=count($search_brand);
			//foreach($search_brand as $media) :
           //foreach ($_POST['search_brand'] as $id => $row) :
		   for($i = 0 ; $i < $count ; $i++){
			$brands_tb = TableRegistry::get('Brands');
			$userId= $this->Auth->user('id');
			$brandsDT = $brands_tb->newEntity();
			$timeVal=Time::now();	
			$timeSplit=@explode(",",$timeVal);
			$datetime= $timeSplit[0];
			
            $media_value=$_POST['search_brand'][$i];
		    $media_array=@explode('_', $media_value);
		   
		    $data['user_id'] = $userId;
			$data['search_keyword'] = $search_val;
			 $data['media_name'] = $media_array[0];
			 $data['value'] =$media_array[1];
			$data['datetime'] = Time::now();
			$data['dateval'] =$datetime;
			$data['created'] =date("H:i:s");
            $brands = $brands_tb->patchEntity($brandsDT, $data);
			$result = $brands_tb->save($brands);
			
			//endforeach;
			
		   }
			if($result):
			echo "Search has been saved successfully";
			//$this->set(['message'=>'Search has been saved successfully']);
			else:
			echo "Your search could not be saved.";
				//throw new BadRequestException('Your search could not be saved.', 'url' =>'saveSearch', '_serialize' => ['message','url']]);
			endif;
			}
			        	
	}
	
	
	 function linkedinDetails()
	{
				
		 if($this->request->is('post')){
			$data = $this->request->data;
			

		  function httpGet($url)
			{
				$ch = curl_init();  
			 
				curl_setopt($ch,CURLOPT_URL,$url);
				curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
			//  curl_setopt($ch,CURLOPT_HEADER, false); 
				$output=curl_exec($ch);
				 if($errno = curl_errno($ch)) {
					$error_message = curl_strerror($errno);

					return "";
					}
					else
					{
						return $output;
							
					}
				curl_close($ch);
				  
			}
	
$brands_tb = TableRegistry::get('Brands');
$search_val=$_POST['search_val'];

 $timeVal=Time::now();	
 $timeSplit=@explode(",",$timeVal);
 $datetime= $timeSplit[0];
//$search_val='HSBC';
	
$fb_post_url = 'http://45.79.7.27/get_facebook_post?code=skcor_ppa_kvs&q='.$search_val;

$fb_pt='';
$fb_posts='';


$data = $this->request->data;
		  
$userId= $this->Auth->user('id');
$brandsDT = $brands_tb->newEntity();
			
 
	 
	$facebookVal=httpGet($fb_post_url);
	if(isset($facebookVal)&&($facebookVal!='')){
		
		$valueJsn=json_decode($facebookVal);
		
		 $fb_pt= $valueJsn->facebook_post;
		if($fb_pt>0){
		$fb_posts_length= $valueJsn->comments_length;
		$fb_posts= $valueJsn->comments;
		
		}

	}
			$datas['brands'] = array(
							'search_val' => $search_val,
							'Linkedin' => $fb_pt,
							'Linkedin_posts' => $fb_posts
							
						);
						
					$userId= $this->Auth->user('id');
						
					 $statistics = $brands_tb->find('all')->where(['Brands.user_id' => $userId, 'Brands.search_keyword' => $search_val])->order(['Brands.dateval' => 'ASC'])->group(['Brands.media_name','Brands.dateval'])->toArray();
					 $dates = 0;
					 $caps = 0;
					 $values = 0;
					 $datas['statistics']='';
					 $datas['statisticsValues']='';
					 foreach($statistics as $statisticsdata)
											 
											 {
													  $dates = $statisticsdata->dateval;
													  $datesSplit = @explode(',',$dates);
													  $caps =$statisticsdata->media_name;
													  $values =$statisticsdata->value;
													  $datas['statistics'].= $datesSplit[0].','.$caps.','.$values.'_';
													 	
											  }
			$this->set(compact('datas'));
			
		}
	}
}
