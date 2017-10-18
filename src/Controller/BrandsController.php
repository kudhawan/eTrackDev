<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Network\Exception\BadRequestException;
use Cake\Network\Exception\NotFoundException;
use Cake\Filesystem\File;
use Cake\I18n\Time;
use Cake\I18n\Date;

class BrandsController extends AppController
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
		$this->loadModel('Documents');
		$this->loadModel('Screenshots');
	    $this->Activities = TableRegistry::get('Activities');

	}
	public function view()
	{
		
	}
	
	public function subscribe()
	{
		    		
			$brands_tb = TableRegistry::get('Brands_subscribe');
			$userId= $this->Auth->user('id');
			$brandsDT = $brands_tb->newEntity();
			
           
		    $userId= $this->Auth->user('id');
			
			if($this->request->is('post')){
			$data = $this->request->data;
		

					$subscribe_search = $brands_tb->find('all')->where(['Brands_subscribe.user_id' => $userId,'Brands_subscribe.email ' =>$_POST['email'] ])->toArray();	

			//$subscribe_search = $brands_tb->find('all')->where(['Brands_subscribe.user_id' => $userId, 'Brands_subscribe.email' => $_POST['email']])->toArray();
			$count=count($subscribe_search);
			if($count==0)
			{
           
		    $data['user_id'] = $userId;
			$data['search_val'] =$_POST['search_val'];;
			$data['email'] = $_POST['email'];
			$data['status'] = 1;
			$brands = $brands_tb->patchEntity($brandsDT, $data);
			$result = $brands_tb->save($brands);
			if($result):
			echo "You are successfully subscribed for the week report";
			else:
			echo "<span style='color:red'>Something went wrong.</span>";
			endif;
			
			}
			else
			{
				echo "<span style='color:red'>You are already subscribed for the week report</span>";
			}
			
		}
			
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
	
	function brandDetails()
	{
				
		 if($this->request->is('post')){
			$data = $this->request->data;
			
		$checkbox_array=$_POST['search_by'];

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
		$checkbox_array=$_POST['search_by'];
		
		 $timeVal=Time::now();	
		 $timeSplit=@explode(",",$timeVal);
		 $datetime= $timeSplit[0];
		//$search_val='HSBC';
			
		$fb_url = 'http://45.79.7.27/get_facebook?code=skcor_ppa_kvs&q='.$search_val;
		$fb_post_url = 'http://45.79.7.27/get_facebook_post?code=skcor_ppa_kvs&q='.$search_val;
		$guardian_url='http://45.79.7.27/get_guardian?code=skcor_ppa_kvs&q='.$search_val;
		$twt_url='http://45.79.7.27/get_twitter?code=skcor_ppa_kvs&q='.$search_val;
		$ft_url='http://45.79.7.27/get_ft?code=skcor_ppa_kvs&q='.$search_val;
		$nytimes_url='http://45.79.7.27/get_nytimes?code=skcor_ppa_kvs&q='.$search_val;
		$linkidin_url='http://45.79.7.27/get_linkedin?code=skcor_ppa_kvs&api_key='.$search_val;
		$bingo_url='http://45.79.7.27/get_bing?code=skcor_ppa_kvs&q='.$search_val;
		
		$fb_pt=$fb_post_pt=$twitter_pt=$guardian_pt=$ft_pt=$nytimes_pt=$linkidin_pt=$bingo_pt='';
		$fb_posts=$twitter_posts=$guardian_posts=$ft_posts=$nytimes_posts=$linkidin_posts=$bingo_posts='';


		$data = $this->request->data;
				  
		$userId= $this->Auth->user('id');
		$brandsDT = $brands_tb->newEntity();
					
		if (in_array("Facebook", $checkbox_array))
		{ 
			 
			$facebookVal=httpGet($fb_url);
			if(isset($facebookVal)&&($facebookVal!='')){
				
				$valueJsn=json_decode($facebookVal);
				
				 $fb_pt= $valueJsn->facebook;
				if($fb_pt>0){
				$fb_posts_length= $valueJsn->posts_length;
				$fb_posts= $valueJsn->posts;
				
				}
		
			}
		}
		
		if (in_array("Twitter", $checkbox_array))
		{ 
		
			$twtVal=httpGet($twt_url);
			if(isset($twtVal)&&($twtVal!='')){
				$valueJsn=json_decode($twtVal);
				$twitter_pt= $valueJsn->twitter;
				if($twitter_pt>0){
				$twitter_posts_length= $valueJsn->tweets_length;
				$twitter_posts= $valueJsn->tweets;
				}
			}
		}
		
		if (in_array("Gaurdian", $checkbox_array))
		{
			$guardianVal=httpGet($guardian_url);
			if(isset($guardianVal)&&($guardianVal!='')){
			$valueJsn=json_decode($guardianVal);
			$guardian_pt= $valueJsn->guardian;
			if($guardian_pt>0){
				$guardian_posts_length= $valueJsn->documents_length;
				$guardian_posts= $valueJsn->documents;
			}
			}
		}
		if (in_array("FT", $checkbox_array))
		{
			$ftVal=httpGet($ft_url);
			if(isset($ftVal)&&($ftVal!='')){
			$valueJsn=json_decode($ftVal);
			$ft_pt= $valueJsn->ft;
			if($ft_pt>0){
			$ft_posts_length= $valueJsn->documents_length;
			$ft_posts= $valueJsn->documents;
			}
			}
		
		}
		if (in_array("NYTimes", $checkbox_array))
		{
			$nytimesVal=httpGet($nytimes_url);
			if(isset($nytimesVal)&&($nytimesVal!='')){
			$valueJsn=json_decode($nytimesVal);
			
			$nytimes_pt= $valueJsn->nytimes;
			if($nytimes_pt>0){
			$nytimes_posts_length= $valueJsn->documents_length;
			$nytimes_posts= $valueJsn->documents;
			}
		}
		}
		
		if (in_array("Bingo", $checkbox_array))
		{
			$bingoVal=httpGet($bingo_url);
			if(isset($bingoVal)&&($bingoVal!='')){
			$valueJsn=json_decode($bingoVal);
			
			$bingo_pt= $valueJsn->bing;
			if($bingo_pt>0){
			$bingo_posts_length= $valueJsn->documents_length;
			$bingo_posts= $valueJsn->documents;
			}
		}
		
		}
		if (in_array("Linkidin", $checkbox_array))
		{ 
	
		$linkidinVal=httpGet($linkidin_url);
			if(isset($linkidinVal)&&($linkidinVal!='')){
				$valueJsn=json_decode($linkidinVal);
				$linkidin_pt= $valueJsn->linkedin;
	
			}
		}
			$datas['brands'] = array(
							'search_val' => $search_val,
							'Facebook' => $fb_pt,
							'Twitter' => $twitter_pt,
							'Gaurdian' => $guardian_pt,
							'FT' => $ft_pt,
							'NYTimes' => $nytimes_pt,
							'Linkidin' => $linkidin_pt,
							'Bingo' => $bingo_pt,
							'Facebook_posts' => $fb_posts,
							'Twitter_posts' => $twitter_posts,
							'Gaurdian_posts' => $guardian_posts,
							'FT_posts' => $ft_posts,
							'NYTimes_posts' => $nytimes_posts,
							'Linkidin_posts' => $linkidin_posts,
							'Bingo_posts' => $bingo_posts
							
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
	
	
	
	
 function facebookDetails()
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
							'Facebook' => $fb_pt,
							'Facebook_posts' => $fb_posts
							
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
  function linkedinDetails()
	{
		
	}
	
}
