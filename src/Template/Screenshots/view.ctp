<body class="dashboard-bg">
    
	    <div id="wrapper">

			<!-- Sidebar -->
			<?php echo $this->element('sidebar');?>
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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Screenshots</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="inner-box-heading">Quick Search</div>
								<div class="search-input top-margin">
									<div class="row">
									<?php 
										if(isset($this->request->query['date'])){
											$today_date = date('d-m-Y', strtotime($this->request->query['date']));
										} else {
											$today_date = date('d-m-Y');
										}
										$next_date = date('d-m-Y', strtotime('+1 days',strtotime($today_date)));
										$previous_date = date('d-m-Y', strtotime('-1 days',strtotime($today_date)));
									?>
										<div class="col-lg-6">
											<a href="<?php echo HTTP_ROOT.$this->request->url.'?date='.$previous_date; ?>" class="btn grey corner pull-left"><span class="fa fa-arrow-left"></span></a>
											
											<div class="input-group date" data-provide="datepicker" data-date-format="dd-mm-yyyy">
												<form id="date_search" method="GET" action="">
												<input type="text" name="date" class="form-control" placeholder="" value="<?php echo $today_date; ?>">
												</form>
												<div class="input-group-addon corner">
													<span class="glyphicon glyphicon-th"></span>
												</div>
											</div>
											<button form="date_search" type="submit" class="btn grey pull-left"><i class="fa fa-search"></i></button>
											<a href="<?php echo HTTP_ROOT.$this->request->url.'?date='.$next_date; ?>" class="btn grey corner pull-left"><span class="fa fa-arrow-right"></span></a>
										</div>
										
										<div class="col-lg-2">
											<div class="input-text-box margin-0"><input type="text" value="" placeholder="All Projects"></div>
										</div>
										
										<div class="col-lg-2">
											<div class="input-text-box margin-0"><input type="text" value="" placeholder="Select"></div>
										</div>
										<div class="col-lg-2">
											<div class="input-text-box margin-0"><input type="text" value="" placeholder="Select"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="screenshot-list clearfix">
									<div class="col-lg-2 col-md-3 col-sm-4 col-xs-3">
										<div class="screenshot-box">
											<div class="no-image"><img src="images/no-image.png" alt="" ></div>
											<div class="progress screenshot-progress">
											  <div class="progress-bar orange" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%"></div>
											</div>
											<p>10:30 - 10:40 <span class="fa fa-picture-o"></span> x1</p>
											<p>71% of 28 seconds</p>
										</div>
									</div>
								</div>
							</div>
						</div>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
  </body>