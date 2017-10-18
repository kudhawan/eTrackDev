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
						<form method="POST" name="" id="newProject" action="<?php echo HTTP_ROOT.'Projects/create.json' ?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Projects Details</div>
												<div class="ui-form"><label>Project Name</label>
													<input type="text" name="name" class="required" value="">
												</div>
												<div class="ui-form">
													<label>Project Description</label>
													<textarea name="description" class="required"></textarea>
												</div>
												<div class="clearfix formdatetimepicker">
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
												<div class="clearfix">&nbsp;</div>
												<div class="clearfix">
													<div class="ui-form fl"><label>Total Effort <small>(In hours)</small></label>
														<input type="number" name="total_effort" class="required" value="">
													</div>
													<div class="ui-form fr"><label>Designer Estimation <small>(In hours)</small></label>
														<input type="number" name="designer_hrs" class="required" value="">
													</div>
												</div>
												<div class="clearfix">
													<div class="ui-form fl"><label>Developer Estimation <small>(In hours)</small></label>
														<input type="number" name="developer_hrs" class="required" value="">
													</div>
													<div class="ui-form fr"><label>Tester Estimation <small>(In hours)</small></label>
														<input type="number" name="tester_hrs" class="required" value="">
													</div>
												</div>
												<div class="clearfix">
													<div class="ui-form fl">
														<label>Project Access</label>
														<input type="radio" name="project_access" value="0" checked><span>Public</span> 
														<input type="radio" name="project_access" value="1"><span>Private</span>
													</div>
												</div>
                                                <div class="clearfix">
                                                
                                                 <div class="ui-form">
												<label>Attachment</label>
												<input type="file" name="file_name">
											</div>
                                           </div>
                                           <div class="clearfix"> 
                                     <div class="ui-form">
													<label>Comments</label>
													<textarea name="comments" class="required"></textarea>
								    </div>
                                    
                                    </div>
                                    
                                    
											</div>
										</div>
										<div class="col-lg-6">
											<div class="top-margin addMoreWrapper">
												<div class="inner-box-heading line-bottom">Manage Team <a class="btn-sm corner blue pull-right addMoreButton" href=""><span class="fa fa-plus"></span></a></div>
												<input type="hidden" value="1" name="addMoreCount" class="addMoreCount">
												<?php /* foreach($designationsList as $designationsData): ?>
												<div class="ui-form">
													<label><?php echo $designationsData->name; ?></label><span class="hints">(<?php echo $designationsData->name; ?> of this project's</span>
													<select class="chosen  usersList required" multiple="true">
														<?php foreach($usersList as $key => $val):?>
															<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
													<input type="hidden" value="" name="<?php echo $designationsData->name; ?>" class="users">
												</div>
												<?php endforeach; */ ?>
												<div class="ui-form">
													<label>Member #1 <a class="btn-sm corner red pull-right removeMoreButton" href=""><span class="fa fa-remove"></span></a></label>
													<input type="hidden" class="positionField" value="position1" />
													<select class="chosen usersList required" name="user_id1">
														<option value=''>---Select User---</option>
														<?php foreach($usersList as $key => $val):?>
															<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
													<select class="chosen designationlist rolesList required" name="designation_id1">
														<option value=''>---Select Role---</option>
														<?php foreach($designationsList as $key => $val):?>
															<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
												</div>
                                                
                                               
                                            
                                            
											</div>
										</div>
                                    
                                    
                                               
									</div>	
									
									
									<div class="optional-button top-margin clearfix">
										<div class="center-buttons" align="center">
											<button  type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'dashboard' ?>"><span class="fa fa-ban"></span> Cancel</a>
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