	<body class="dashboard-bg">    
	    <div id="wrapper">
			<!-- Sidebar -->
			<?php echo $this->element('sidebar')?>
			<!-- /#sidebar-wrapper -->
			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="dashboard-top-bar">
					<div class="top-bar-left">
						<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-long-arrow-left"></span> Dashboard</a>
					</div>
					 <?php echo $this->element('topbar');?>
				</div>
				<!-- //////// Content Part START ///////// -->
					<div class="col-lg-12">
						<div class="page-heading"><h1><span class="fa fa-home"></span> Conversation</h1></div>
					</div>
					
					<div class="col-lg-12">
						<div class="box-dashboard custom-chat">
							<!-- <div class="inner-box-heading">Conversation</div> -->
							<!-- Post -->
							<div class="post">
								<div class="user-block">
									<!-- <img class="img-circle img-bordered-sm" src="images/user-icon.png" alt="user image"> -->
									<h2 class="detail-title"><?php echo isset($getProject->name) && $getProject->name ? 'Project Details' : 'Bug Detail'?></h2>
									<span class="username">
										<label>Bug</label>
										<a href="#"><?php echo (isset($getProject->name) && $getProject->name) ? $getProject->name : $getProject->title?></a>
									</span>
									<div class="description">
										<div><label>From</label><span><?php echo $getProject->start_date?></span></div>
										<div><label>To</label><span><?php echo $getProject->end_date ?></span></div>
									</div>
									<div class="description">
										<p>Description :</p>
										<p><?php echo $getProject->description;?></p>
									</div>
								</div>
								  <!-- /.user-block -->
								<div class="comment-outer">
									<div id="cmnt-section">
									<?php foreach($getConversation as $key =>$val):
										if($val->designation_id > 0):
											$maindesignation = @$val->designation->name ? ' <small>'.$val->designation->name.'</small>':''; 
											$subdesignation = @$val->position->title ? ' <small>('.$val->position->title .')</small>':''; 
										else:
											$maindesignation = ' <small>Project Creator</small>'; 
											$subdesignation = ''; 
										endif;
									?>
										<div class="comment-indvidual">
											<label class="user-name"><?php echo $val->user->name.$maindesignation.$subdesignation; ?><span><?php echo date('m/d/y, h:i a' , strtotime($val->created)); ?></span></label>
											<p><?php  echo $val->comment; ?></p>
										</div>
									<?php endforeach;?>
									</div>
									<form class="form-horizontal form-chat" method="post" id="conversationForm"name="chat-form" action="<?php echo HTTP_ROOT.'conversation.json?bug_id='.base64_encode(convert_uuencode($getProject->id)) ?>">
										<div class="form-group margin-bottom-none">
										  <div class="text-comment-section">
											 <textarea class="form-control required" placeholder="Enter your comment" name="comment"></textarea>
										  </div>
										  <div class="">
										  	<input type="hidden" name="project_id" value="<?php echo base64_encode(convert_uuencode($getProject->project_id)); ?>" />
											<button type="submit" class="btn blue corner pull-right btn-block btn-sm">Send</button>
										  </div>
										</div>
									</form>
								</div>    
							</div>
							<!-- /.post -->
						</div>
					</div>				
				<!--- //////// Content Part END ///////// --->
			</div>
			<!-- /#page-content-wrapper -->
		</div>
		<!-- /#wrapper -->
  </body>
