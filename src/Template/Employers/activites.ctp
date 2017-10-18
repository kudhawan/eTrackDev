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
				
				
				
				<!--- //////// Content Part START ///////// --->
				
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> Activities</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="inner-box-heading">Activities</div>
								
								<!-- Post -->
									<div class="post">
									  <div class="user-block">
										<img class="img-circle img-bordered-sm" src="images/user-icon.png" alt="user image">
											<span class="username">
											  <a href="#">Badri Narayanan</a>
											  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
											</span>
										<span class="description">Shared publicly - 7:30 PM today</span>
									  </div>
									  <!-- /.user-block -->
									  <p>
										Lorem ipsum represents a long-held tradition for designers,
										typographers and the like. Some people hate it and argue for
										its demise, but others ignore the hate as they create awesome
										tools to help create filler text for everyone from bacon lovers
										to Charlie Sheen fans.
									  </p>

									  <input class="form-control input-sm" type="text" placeholder="Type a comment">
									</div>
								<!-- /.post -->
								
								
								<!-- Post -->
									<div class="post clearfix">
									  <div class="user-block">
										<img class="img-circle img-bordered-sm" src="images/user-icon.png" alt="User Image">
											<span class="username">
											  <a href="#">Kunal</a>
											  <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
											</span>
										<span class="description">Sent you a message - 3 days ago</span>
									  </div>
									  <!-- /.user-block -->
									  <p>
										Lorem ipsum represents a long-held tradition for designers,
										typographers and the like. Some people hate it and argue for
										its demise, but others ignore the hate as they create awesome
										tools to help create filler text for everyone from bacon lovers
										to Charlie Sheen fans.
									  </p>

									  <form class="form-horizontal">
										<div class="form-group margin-bottom-none">
										  <div class="col-sm-9">
											<input class="form-control input-sm" placeholder="Response">
										  </div>
										  <div class="col-sm-3">
											<button type="submit" class="btn blue corner pull-right btn-block btn-sm">Send</button>
										  </div>
										</div>
									  </form>
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
