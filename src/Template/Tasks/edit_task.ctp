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
					<div class="page-heading"><h1><span class="fa fa-bullhorn"></span> Edit Task of <?php echo ucwords($projectDetail->name); ?></h1></div>
				</div>
				<form method="POST" id="newProject" action="<?php echo HTTP_ROOT.'Tasks/editTask/'.base64_encode(convert_uuencode($taskDetail->id)).'.json' ?>" enctype="multipart/form-data">
					<input type="hidden" name="id" value="<?php echo $taskDetail->id?>">
					<div class="col-lg-12">
						<div class="box-dashboard">
							<div class="row">
								<div class="col-lg-12">
									<div class="top-margin">
										<div class="inner-box-heading line-bottom">Task Details</div>
										<div class="ui-form">
											<label>Title</label>
											<input type="text" name="title" class="required" value="<?php echo $taskDetail->title?>">
										</div>
										<div class="ui-form">
											<label>Description</label>
											<textarea name="description" class="required"><?php echo $taskDetail->description?></textarea>
										</div>
										<input type="hidden" name="project_id" id="P-id" value="<?php echo $taskDetail->project_id?>">
										<div class="clearfix">
											<div class="ui-form fl">
												<label>Worker Designation</label>
												<select id="sb_designation" name="designation" class="required">
													<option value="">Select</option>
													<?php foreach($WorkerDesignations as $k=>$WorkerDesignation):?>
													<option <?php echo $k == $taskDetail->designation ? 'selected' :''?> value="<?php echo $k?>"><?php echo $WorkerDesignation?></option>
													<?php endforeach;?>
												</select>
											</div>
											<div class="ui-form fr">
												<label>Assign To</label>
												<select name="user_id" class="required" id="tm-mem">
													<option value="<?php echo $taskDetail->user->id?>"><?php echo ucwords($taskDetail->user->name)?></option>
												</select>
											</div>
										</div>
										<div class="clearfix">
											<div class="ui-form fl">
												<label>Start Date</label>
												<div class="input-group date lg" data-provide="datepicker">
													<input type="text" class="form-control required" name="start_date" placeholder="Start Date" value="<?php echo date_format($taskDetail->start_date , 'm/d/Y')?>">
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-th"></span>
													</div>
												</div>
											</div>
											<div class="ui-form fr">
												<label>End Date</label>
												<div class="input-group date lg" data-provide="datepicker">
													<input type="text" name="end_date" class="form-control required" placeholder="End Date" value="<?php echo date_format($taskDetail->end_date , 'm/d/Y')?>">
													<div class="input-group-addon">
														<span class="glyphicon glyphicon-th"></span>
													</div>
												</div>
											</div>
										</div>
										

<div class="clearfix">&nbsp;</div>
<div class="ui-form">
											<label>Total Effort</label>
											<input type="number" name="total_effort" class="required" value="<?php echo $taskDetail->total_effort; ?>">
										</div>
										<div class="clearfix">
											<div class="ui-form fl">
												<label>Task Status</label>
												<label class="pull-left"><input type="radio" name="status" value="1" <?php echo $taskDetail->status == 1 ? 'checked' : ''?>> Open &nbsp;</label> &nbsp;
												<label class="pull-left"><input type="radio" name="status" value="2" <?php echo $taskDetail->status == 2 ? 'checked' : ''?>> Close &nbsp;</label> &nbsp;
												<label class="pull-left"><input type="radio" name="status" value="3" <?php echo $taskDetail->status == 3 ? 'checked' : ''?>> Working &nbsp;</label> &nbsp;
											</div>
											<div class="ui-form fr">
												<label>Attachment</label>
												<input type="file" name="file_name">
												<?php /* if(isset($featureDetail->file_name) && $featureDetail->file_name):?>
												<div style="display:inline-block">
													<p><?php echo $featureDetail->file_name ?></p>
													<a href="#"></a>
												</div>
												<?php endif; */?>
											</div>
										</div>
									</div>
								</div>
							</div>	
                            <div class="ui-form">
											<label>Task Priority</label>
											<select id="priority" name="priority" class="required">
												<option value="">Select</option>
                                                <option value="3" <?php  if ($taskDetail->priority=='3'){ echo "selected='selected'"; } ?>>High</option>
                                                <option value="2" <?php  if ($taskDetail->priority=='2'){ echo "selected='selected'"; } ?>>Medium</option>
                                                <option value="1" <?php  if ($taskDetail->priority=='1'){ echo "selected='selected'"; } ?>>Low</option>
												
											</select>
										</div>					
							<div class="optional-button top-margin clearfix">
								<div class="right-buttons">
									<button  type="submit" class="btn corner blue">
										<span class="fa fa-save"></span> Save
									</button>
									<a class="btn corner grey" href="<?php echo HTTP_ROOT.'task-list' ?>">
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