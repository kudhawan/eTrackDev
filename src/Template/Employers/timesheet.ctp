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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Timesheet</h1></div>
						</div>
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="inner-box-heading">Quick Search</div>
								<div class="search-input top-margin">
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group date">
												<button class="btn grey corner"><span class="fa fa-arrow-left"></span></button>
											</div>
											
											<div class="input-group date">
												<button class="btn grey corner"><span class="fa fa-arrow-right"></span></button>
											</div>
											
											
											<div class="input-group date" data-provide="datepicker">
												<input type="text" class="form-control corner" placeholder="Feb 6 2017">
												<div class="input-group-addon corner">
													<span class="glyphicon glyphicon-th"></span>
												</div>
											</div>
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
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="table-design">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th>Project / Task</th>
										  <th>Start time <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
										  <th>Stop time <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
										  <th>Duration</th>
										  <th>Automatic</th>
										  <th>Manual</th>
										  <th>Reasons</th>
										  <th>Actions</th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
										<tr>
										  <td class="project-name">
											<div><span class="project-int">E</span> E Track UI Design </div>
										  </td>
										  <td>10:39 am</td>
										  <td>10:52 am</td>
										  <td>0:13:16</td>
										  <td>100%</td>
										  <td>0%</td>
										  <td></td>
										  <td><button class="btn blue corner"><span class="fa fa-pencil"></span> Edit</button> <button class="btn orange corner"><span class="fa fa-trash-o"></span> Delete</button></td>
										</tr>
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
