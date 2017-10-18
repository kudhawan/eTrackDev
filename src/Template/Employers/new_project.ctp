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
				
				
				
				<!-- //////// Content Part START ///////// -->
				
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> New Project</h1></div>
						</div>
						<form method="POST" name="" id="newProject" action="<?php echo HTTP_ROOT.'Employers/newProject.json' ?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Projects Details</div>
												<div class="ui-form"><label>Project Name</label>
													<input type="text" name="name" class="required" value=""></div>
												<div class="ui-form">
													<label>Project Description</label>
													<textarea name="description" class="required"></textarea>
												</div>
												<div class="clearfix">
													<div class="ui-form fl">
														<label>Start Date</label>
														<div class="input-group date lg" data-provide="datepicker">
															<input type="text" class="form-control required" name="start_date" placeholder="Start Date">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</div>
													<div class="ui-form fr">
														<label>End Date</label>
														<div class="input-group date lg" data-provide="datepicker">
															<input type="text" name="end_date"
															class="form-control required" placeholder="End Date">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</div>
												</div>
												<div class="ui-form"><label>Project Access</label><input type="radio" name="project_access" value="0" checked><span>Public</span> 
													<input type="radio" name="project_access" value="1"><span>Private</span></div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Manage Team</div>
												<div class="ui-form">
													<label>Manager</label><span class="hints">(who's Manages on this project's)<span class="select-all"><a hre="#">Select all</a></span></span>
													<div class="textarea-box"><span>Kunal</span> <span>Badri</span></div>
												</div>
												<div class="ui-form top-margin">
													<label>Worker's</label><span class="hints">(who's works on this project's)<span class="select-all"><a hre="#">Select all</a></span></span>
													<div class="textarea-box"><span>Vinoth</span> <span>John smith</span></div>
												</div>
												<div class="ui-form top-margin">
													<label>Viewer's</label><span class="hints">(who's works on this project's)<span class="select-all"><a hre="#">Select all</a></span></span>
													<div class="textarea-box"><span>Steve Austin</span> <span>Joe</span></div>
												</div>
											</div>
										</div>
									</div>	
									
									
									<div class="optional-button top-margin clearfix">
										<div class="left-buttons">
											<button class="btn corner"><span class="fa fa-trash"></span> Delete</button>
											<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
										</div>
										<div class="right-buttons">
											<button  type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save Project</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'dashboard' ?>"><span class="fa fa-ban"></span> Cancel Project</a>
										</div>
									</div>
								</div>
							</div>
						</form>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
  </body>
