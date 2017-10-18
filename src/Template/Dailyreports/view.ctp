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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Daily Report</h1></div>
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
										
										<div class="col-lg-6">
											<div class="label-button text-right">
												<button class="btn blue corner "><span class="fa fa-plus"></span> New Report</button>
												<button class="btn blue corner "><span class="fa fa-file-pdf-o"></span> Download PDF</button>
												<button class="btn blue corner "><span class="fa fa-file-excel-o"></span> Download CSV</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="inner-box-heading">Sun, February 12 2017</div>
								<div class="table-design">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th>Member</th>
										  <th>Project</th>
										  <th>Project Hours</th>
										  <th>Tasks</th>
										  <th>Worked Hours</th>
										  <th>Activity</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  <tbody>
									  <?php foreach($dailyreports as $dailyreportsData):
									  	$visiblility = false;
										foreach($teamsList as $teamsListData):
											if(($teamsListData->employer_id == $authUser['id'] || ($teamsListData->member_id == $authUser['id'] && in_array($teamsListData->designation_id, [1,2,5]))) && in_array($dailyreportsData['project_id'], explode(',',$teamsListData->projects))):
												$visiblility = true;
											endif;
										endforeach;
									  if($visiblility == true):
									   ?>
										<tr>
										  <td class="project-name">
											<div class="user-block" ><img class="img-circle img-bordered-sm" src="<?php echo HTTP_ROOT.'images/user-icon.png'; ?>" > <span><?php echo $dailyreportsData['user']['name']; ?></span><small><?php echo ' - '.$dailyreportsData['designation']['name']; ?></small></div>
										  </td>
										  <td><?php echo ucwords($dailyreportsData['project']['name']); ?></td>
										  <td><?php echo date('d/m/Y',strtotime($dailyreportsData['project']['start_date'])).' - '.date('d/m/Y',strtotime($dailyreportsData['project']['end_date'])); ?></td>
										  <td><?php echo $dailyreportsData['task_name']; ?></td>
										  <td><?php echo $dailyreportsData['time_start'].' - '.$dailyreportsData['time_end']; ?></td>
										  <td><?php echo $dailyreportsData['time_status']; ?></td>
										  <td>
										  </td>
										</tr>
									  <?php 
									  	endif;
									  endforeach; ?>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->
  </body>
