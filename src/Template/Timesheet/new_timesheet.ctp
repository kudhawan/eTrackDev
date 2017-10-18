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
							<div class="page-heading"><h1><span class="fa fa-home"></span> New Time Sheet</h1></div>
						</div>
						<form method="POST" name="" id="commonForm" action="<?php echo HTTP_ROOT.'new-timesheet.json' ?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-12">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Time Sheet Details</div>
												<div class="ui-form">
													<label>Project</label>
													<select id="pr-bg" name="project_id" class="required">
														<option value="">Select Project</option>
														<?php foreach($projects as $key => $project):?>
															<option value="<?php echo $project->id;?>"><?php echo $project->name;?></option>
														<?php endforeach;?>
													</select>
												</div>
												<div class="ui-form">
													<label>Worked As</label>
													<select name="worked_id" class="required">
														<?php foreach($getPosition as $key => $positionData):?>
															<option value="<?php echo $positionData->id; ?>"><?php echo $positionData->title;?></option>
														<?php endforeach;?>
													</select>
												</div>
												<div class="ui-form">
													<label>Description</label>
													<textarea name="reasons" class="required"></textarea>
												</div>
												<div class="ui-form">
													<label>Time Effort</label>
													<input type="number" class="required" name="duration" value="" placeholder="">
												</div>
												<div class="clearfix rangedatetimepicker">
													<div class="ui-form fl">
														<label>Start Time</label>
														<div class="input-group date lg" >
															<input type="text" class="form-control required" id="statt_date" name="start_time" value="" placeholder="Start Date">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</div>
													<div class="ui-form fr">
														<label>End Time</label>
														<div class="input-group date lg">
															<input type="text" class="form-control required" id="end_date" name="end_time" placeholder="End Date">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</div>
												</div>												
											</div>
										</div>
									</div>
									<div class="optional-button top-margin clearfix">
										<div class="right-buttons">
											<button  type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save Timesheet</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'timesheet' ?>"><span class="fa fa-ban"></span> Cancel Timesheet</a>
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