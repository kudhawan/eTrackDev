	<body class="dashboard-bg"> 
	    <div id="wrapper">
			<!-- Sidebar -->
			<?php echo $this->element('sidebar');?>
			<!-- /#sidebar-wrapper -->
			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="dashboard-top-bar">
					<div class="top-bar-left">
						<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-bars"></span> Menu</a>
					</div>
					 <?php echo $this->element('topbar');?>
				</div>
				<!-- //////// Content Part START ///////// -->
				<div class="col-lg-12">
					<div class="page-heading"><h1><span class="fa fa-bullhorn"></span> New Task of <?php echo ucwords($projectDetail->name); ?></h1></div>
				</div>
				<form method="POST" id="newProject" action="<?php echo HTTP_ROOT.'Tasks/newTask.json' ?>" enctype="multipart/form-data">
					<div class="col-lg-12">
						<input type="hidden" id="P-id" name="project_id" value="<?php echo $projectDetail->id?>">
						<div class="box-dashboard">
							<div class="row">
								<div class="col-lg-12">
									<div class="top-margin">
										<div class="inner-box-heading line-bottom">Task Details</div>
										<div class="ui-form">
											<label>Title</label>
											<input type="text" name="title" class="required" value="">
										</div>
										<div class="ui-form">
											<label>Description</label>
											<textarea name="description" class="required"></textarea>
										</div>
										<div class="clearfix">
											<div class="ui-form fl">
												<label>Worker Designation</label>
												<select id="sb_designation" name="designation" class="required">
													<option value="">Select</option>
													<?php foreach($WorkerDesignations as $k=>$WorkerDesignation):?>
													<option value="<?php echo $k?>"><?php echo $WorkerDesignation?></option>
													<?php endforeach;?>
												</select>
											</div>
											<div class="ui-form fr">
												<label>Assign To</label>
												<select name="user_id" class="required" id="tm-mem">
													<option value="">Select</option>
												</select>
											</div>
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
													<input type="text" name="end_date" class="form-control required" placeholder="End Date">
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-th"></span>
													</div>
												</div>
											</div>
										</div>
										
<div class="clearfix">&nbsp;</div>

<div class="ui-form">
											<label>Total Effort</label>
											<input type="number" name="total_effort" class="required" value="">
										</div>
										<div class="clearfix">
											<div class="ui-form fl">
												<label>Task Status</label>
												<label class="pull-left"><input type="radio" name="status" value="1" checked> Open &nbsp;</label> &nbsp;
												<label class="pull-left"><input type="radio" name="status" value="2"> Close &nbsp;</label> &nbsp;
												<label class="pull-left"><input type="radio" name="status" value="3"> Working &nbsp;</label> &nbsp;
											</div>
											<div class="ui-form fr">
												<label>Attachment</label>
												<input type="file" name="file_name">
											</div>
										</div>
									</div>
								</div>
							</div>	
                            <div class="ui-form">
											<label>Task Priority</label>
											<select id="priority" name="priority" class="required">
												<option value="">Select</option>
                                                <option value="3" >High</option>
                                                <option value="2" >Medium</option>
                                                <option value="1">Low</option>
												
											</select>
										</div>
                                        					
							<div class="optional-button top-margin clearfix">
								<div class="right-buttons">
									<button  type="submit" class="btn corner blue">
										<span class="fa fa-save"></span> Save
									</button>
									<a class="btn corner grey" href="<?php echo HTTP_ROOT.'task-list/'.$id ?>">
										<span class="fa fa-ban"></span> Cancel
									</a>
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