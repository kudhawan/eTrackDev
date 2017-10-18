	<body class="dashboard-bg">
	    <div id="wrapper">
			<!-- Sidebar -->
				 <!-- menu -->
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
					<div class="page-heading"><h1><span class="fa fa-home"></span> Projects</h1></div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-dashboard">
						<div class="box-heading">Total hours worked today</div>
						<div class="number-bold">5 <span class="fa fa-bar-chart pull-right"></span></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-dashboard">
						<div class="box-heading">Average activity today</div>
						<div class="number-bold">60% <span class="fa fa-signal pull-right"></span></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-dashboard">
						<div class="box-heading">Total hrs worked past 7 days</div>
						<div class="number-bold">8:28:55 <span class="fa fa-line-chart pull-right"></span></div>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="box-dashboard">
						<div class="box-heading">Average activity past 7 days</div>
						<div class="number-bold">71% <span class="fa fa-pie-chart pull-right"></span></div>
					</div>
				</div>
				<div class="col-lg-12 top-margin">
					<div class="box-dashboard">
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#members" aria-controls="members" role="tab" data-toggle="tab">Members</a></li>
							<li role="presentation"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">Projects</a></li>
						</ul>
						<div class="tab-content">
							<div role="tabpanel" class="tab-pane active" id="members">
								<div class="table-design">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th>Member</th>
										  <th>Last Worked on</th>
										  <th>Activity (7 days)</th>
										  <th class="text-right">Time worked on (7 days)</th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										  <td class="project-name">
											<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" > <span>Vinoth SN</span> </div>
										  </td>
										  <td>Web Design</td>
										  <td>
											<div class="progress progress-striped active" data-original-title="80% Completed" data-toggle="tooltip" data-placement="bottom" data-container="body" title="">
												<div class="progress-bar blue" style="width: 80%">
													<span class="sr-only">80%</span>
												</div>
											</div>
										  </td>
										  <td class="number-bold text-right">44:45:10</td>
										</tr>
										<tr>
										  <td class="project-name">
											<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" > <span>Badri </span> </div>
										  </td>
										  <td>PHP Developmet</td>
										  <td>
											<div class="progress progress-striped active" data-original-title="60% Completed" data-toggle="tooltip" data-placement="bottom" data-container="body" title="">
												<div class="progress-bar orange" style="width: 60%">
													<span class="sr-only">80%</span>
												</div>
											</div>
										  </td>
										  <td class="number-bold text-right">44:45:10</td>
										</tr>
										<tr>
										  <td class="project-name">
											<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" > <span>Kunal</span> </div>
										  </td>
										  <td>Java</td>
										  <td>
											<div class="progress progress-striped active" data-original-title="100% Completed" data-toggle="tooltip" data-placement="bottom" data-container="body" title="">
												<div class="progress-bar green" style="width: 100%">
													<span class="sr-only">80%</span>
												</div>
											</div>
										  </td>
										  <td class="number-bold text-right">44:45:10</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
							<div role="tabpanel" class="tab-pane" id="projects">								
								<div class="table-design top-margin">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th>Project</th>
										  <th>Activity (7 days)</th>
										  <th>Time worked (7 days)</th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> <a href="employer-dash-task-list.html">E Track UI Design</a> <span class="label-hint grey" data-original-title="February 08, 2017  1:16 PM IST" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="February 08, 2017  1:16 PM IST">Worked on 1 days ago</span></div>
										  </td>
										  <td>
											<div class="progress progress-striped active" data-original-title="80% Completed" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="80% Completed">
												<div class="progress-bar blue" style="width: 80%">
													<span class="sr-only">80%</span>
												</div>
											</div>
										  </td>
										  <td class="text-right">
											<div class="number-bold">40:28:55 <span class="fa fa-clock-o"></span></div>
										  </td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">O</span> <a href="#">Oasis HTML Development</a> <span class="label-hint grey" data-original-title="Finished" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" data-container="body" title="Finished"> 1 Month ago</span></div>
										  </td>
										  <td>
											<div class="progress progress-striped active" data-original-title="100% Completed" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="100% Completed">
												<div class="progress-bar red" style="width: 100%">
													<span class="sr-only">100%</span>
												</div>
											</div>
										  </td>
										  <td class="text-right">
											<div class="number-bold">30:28:55 <span class="fa fa-clock-o"></span></div>
										  </td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">C</span> <a href="#">CW Bank UI </a> <span class="label-hint grey" data-original-title="Finished" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" data-container="body" title="Finished">Worked on 1 weeks ago</span></div>
										  </td>
										  <td>
											<div class="progress progress-striped active" data-original-title="95% Completed" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="95% Completed">
												<div class="progress-bar green" style="width: 95%">
													<span class="sr-only">95%</span>
												</div>
											</div>
										  </td>
										  <td class="text-right">
											<div class="number-bold">45:28:55 <span class="fa fa-clock-o"></span></div>
										  </td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">M</span> <a href="#">Mentor 4u UI </a> <span class="label-hint grey" data-original-title="Finished" data-toggle="tooltip" data-placement="bottom" class="matrisHeader" data-container="body" title="Finished">Worked on 1 weeks ago</span></div>
										  </td>
										  <td>
											<div class="progress progress-striped active" data-original-title="100% Completed" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="100% Completed">
												<div class="progress-bar orange" style="width: 100%">
													<span class="sr-only">100%</span>
												</div>
											</div>
										  </td>
										  <td class="text-right">
											<div class="number-bold">45:28:55 <span class="fa fa-clock-o"></span></div>
										  </td>
										</tr>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--- //////// Content Part END ///////// --->
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->
  </body>
