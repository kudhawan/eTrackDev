<?php  
$serverUrl=$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];  
$url=@explode("facebook",$serverUrl);
$facebook_page_url= $url[0]."facebookDetails";
?>

<body class="dashboard-bg">
<div id="wrapper"> 
  <!-- Sidebar --> 
  <!-- menu --> 
  <?php //echo $this->element('sidebar');?> 
  <!-- /#sidebar-wrapper --> 
  <!-- Page Content -->
  <div id="page-content-wrapper">
    <!--- //////// Content Part START ///////// --->
    <div class="col-lg-12">
      <div class="page-heading">
        <h1><span class="fa fa-bar-chart"></span> bTrack Facebook</h1>
      </div>
    </div>
    <div class="col-lg-10">
      <form method="POST" id="brandSearch" action="<?php echo HTTP_ROOT.'brands' ?>">
        <div class="box-dashboard">
          <div class="row">
            <div class="col-lg-12">
              <div class="top-margin">
                <div class="inner-box-heading line-bottom">Search With Keyword on Facebook
                </div>
                <div id="checkbox_error" style="color:red;"></div>
                <div class="ui-form">
                  <label id="keyword_lbl">Keyword</label>
                  <input type="text" name="keyword" id="keyword" class="required" value="">
                </div>
                <div id="keyword_error" style="color:red;"></div>
              </div>
            </div>
          </div>
          <div class="optional-button top-margin clearfix">
            <div class="right-buttons">
              <button  type="button" id="search_brand_fpost" class="btn corner blue"> <span class="fa fa-save"></span> Search </button>
              <a class="btn corner grey" href="<?php echo HTTP_ROOT.'brands' ?>"> <span class="fa fa-ban"></span> Cancel </a> </div>
          </div>
        </div>
      </form>
      <h3 id="searchMsg" style="display:none;color:#3C0; margin-left:20px;" ></h3>
      <div id="subscribeMsg" style="display:none">
        <h3 style="color:#3C0; margin-left:20px;  ">You are  successfully subscribed for the Weekly Report</h3>
      </div>
<!--      <div style="float:left; margin-right:15px;display:none;" class="subscribe_div">
        <div class="optional-button top-margin clearfix">
          <div class="right-buttons">
            <input type="email" class="" name="email" id="email" value="" placeholder="Enter Your email address">
            <button  type="btton" class="btn corner blue" id="subscribeButton">Request Weekly Report</button>
          </div>
          <div class="emailError" style="color:red;"></div>
        </div>
      </div>
      <div style="float:right; margin-right:15px;display:none;" class="svaesearch_div">
        <div class="optional-button top-margin clearfix">
          <div class="right-buttons">
            <button  type="btton" class="btn corner blue" id="saveSearch">Save This Search</button>
          </div>
        </div>
      </div>-->
      <div class="row">
        <div class="col-lg-12">
          <div class="box-dashboard">
            <div class="optional-button clearfix">
              <div class="">
                <div id="wait" style="display:none"><img src="<?php echo HTTP_ROOT.'images/loading.gif'; ?>"></div>
                <div id="brand-chart-view"> </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- <div class="col-lg-12">
						<div class="box-dashboard">
                           
                                    </div>
                                    

                    </div>--> 
    
    <!--- //////// Content Part END ///////// ---> 
  </div>
  <!-- /#page-content-wrapper --> 
  
</div>
<!-- /#wrapper -->
</body>
<script>
jQuery(document).ready(function(){

	 $('#search_brand_fpost').on('click' , function(){
		  $('.svaesearch_div').hide();
		 $('.subscribe_div').hide();
		 $('#searchMsg').hide();
		 var search_val=$('#keyword').val();
		 if(search_val=='')
		{
			$('#keyword').focus();
			$('#keyword_error').html('Please enter a keyword to search');
			return false;
		}
		else
		{
			
		$('#wait').show();
		$('#brand-chart-view').html('');
		$('#keyword_error').html('');
		$('#checkbox_error').html('');
		$.ajax({            
				  type :'POST',
				  data : { search_val : search_val},
				  url:'facebookDetails',
				  success:function(resp){
					  $('#wait').hide();
					  //alert(resp);
					  
					  $('#brand-chart-view').html(resp);
					  $('.svaesearch_div').show();
					  $('.subscribe_div').show();
						
				  }
			  });
		
		}
		
	 });	
	 });	
	 </script>