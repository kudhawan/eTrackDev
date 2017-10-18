<body class="dashboard-bg">
<div id="wrapper"> 
  <!-- Sidebar --> 
  <!-- menu --> 
  <?php echo $this->element('sidebar');?> 
  <!-- /#sidebar-wrapper --> 
  <!-- Page Content -->
  <div id="page-content-wrapper">
    
    <div class="dashboard-top-bar">
      <div class="top-bar-left"> <a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-bars"></span> Menu</a> </div>
      <?php echo $this->element('topbar');?>
    </div>
    
    
    
   
    <!--- //////// Content Part START ///////// --->
    <div class="col-lg-12">
      <div class="page-heading">
        <h1><span class="fa fa-bar-chart"></span> bTrack</h1>
      </div>
    </div>
    <div class="col-lg-12">
      <form method="POST" id="brandSearch" action="<?php echo HTTP_ROOT.'brands' ?>">
        <div class="box-dashboard">
          <div class="row">
            <div class="col-lg-12">
              <div class="top-margin">
                <div class="inner-box-heading line-bottom">Search Brand On
                
               <!-- <span style="float:right; margin-right:20px; " class="post_link_class"><a id="fbpost_link" style="cursor:pointer" >Search by Facebook Post</a></span>
                <span style="float:right; margin-right:20px; display:none;" class="back_class"><a id="back" style="cursor:pointer">Go Back</a></span>-->
                
                </div>
                <div class="ui-form" id="search_links_div">
                  <input type="checkbox" name="search_by[]" id="brand_Facebook"  value="Facebook" checked>
                  &nbsp; Facebook&nbsp;&nbsp;
                  <input type="checkbox" name="search_by[]" id="brand_Twitter" value="Twitter" checked>
                  &nbsp; Twitter
                  &nbsp;&nbsp;
                  <input type="checkbox" name="search_by[]" id="brand_Gaurdian" value="Gaurdian" checked>
                  &nbsp; Guardian
                  
                  &nbsp;&nbsp;
                  <input type="checkbox" name="search_by[]" id="brand_FT" value="FT" checked>
                  &nbsp; FT
                  
                  &nbsp;&nbsp;
                  <input type="checkbox" name="search_by[]" id="brand_NYTimes" value="NYTimes" checked>
                  &nbsp; NYTimes
                   &nbsp;&nbsp;
                  <input type="checkbox" name="search_by[]" id="brand_Linkidin" value="Linkidin" >
                  &nbsp; Linkedin
                  &nbsp;&nbsp;
                  <input type="checkbox" name="search_by[]" id="brand_Bingo" value="Bingo"  >
                  &nbsp; Bing News
                  
                  
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
              <button  type="button" id="search_brand" class="btn corner blue"> <span class="fa fa-save"></span> Search </button>
              <!--<button  type="button" id="search_brand_fpost" class="btn corner blue" style="display:none"> <span class="fa fa-save"></span> Search </button>-->
              <a class="btn corner grey" href="<?php echo HTTP_ROOT.'brands' ?>"> <span class="fa fa-ban"></span> Cancel </a> </div>
          </div>
        </div>
      </form>
      <h3 id="searchMsg" style="display:none;color:#3C0; margin-left:20px;" ></h3>
      <div id="subscribeMsg" style="display:none">
        <h3 style="color:#3C0; margin-left:20px;  ">You are  successfully subscribed for the Weekly Report</h3>
      </div>
      <div style="float:left; margin-right:15px;display:none;" class="subscribe_div">
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
      </div>
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