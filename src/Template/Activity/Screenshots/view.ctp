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
										<div class="col-lg-2 pull-right">
											<a href="<?php echo HTTP_ROOT.'activity/screenshot-create'; ?>" class="btn corner blue"><span class="fa fa-plus"></span> New Screenshot</a>
										</div>
										<div class="col-lg-2 pull-right">
											<div class="ui-form">
												<select name="project_id" class="projectRelated required" data-url="<?php echo HTTP_ROOT.'screenshots' ?>">
													<option value="">Select Project</option>
													<?php foreach($projects as $key => $project):?>
														<option <?php echo (isset($currentId) && $currentId == $project->id) ? 'selected': ''; ?> value="<?php echo $project->id;?>" data-id="<?php echo base64_encode(convert_uuencode($project->id)); ?>"><?php echo $project->name;?></option>
													<?php endforeach;?>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="screenshot-list clearfix">
								 <?php 
									if(!empty($screenshot)):
									foreach($screenshot as $key => $value):
										$download_visible = false;
										foreach($getTeam as $teamdata):
											if(in_array($value->project_id, explode(',',$teamdata->projects)) && $teamdata->member_id == $value->user_id):
												$designations = $teamdata->designation->name;
											elseif(in_array($value->project_id, explode(',',$teamdata->projects)) && $teamdata->employer_id == $value->user_id):
												$designations = 'Employer';
											elseif($value->project->user_id == $value->user_id):
												$designations = 'Creator'; 
											endif;
											//if((in_array($value->project_id, explode(',',$teamdata->projects)) && ($teamdata->member_id == $value->user_id && in_array($teamdata->designation_id, [1,2]) || $teamdata->employer_id == $value->user_id || $teamdata->employer_id == $authUser['id'])) || $value['user_id'] == $authUser['id'])
											if((in_array($value->project_id, explode(',',$teamdata->projects)) && ($teamdata->member_id == $authUser['id'] && in_array($teamdata->designation_id, [1,2]))) ||  $value['user_id'] == $authUser['id']  || $value->project->user_id == $authUser['id'])
												$download_visible = true;
										endforeach; 
										?>
										<div class="col-lg-2 col-md-3 col-sm-4 col-xs-3">
											<div class="screenshot-box thumbnail" style="max-height:250px;min-height:250px">
											<a class="screenshotdetails"  data-screenshot-id="<?php echo base64_encode(convert_uuencode($value->id)); ?>" data-toggle="modal" data-target="#screenshot-detail" alt="Screen Shot"   data-original-title="Screenshot" style="cursor:pointer">
                                                
                                                <img style="max-height:200px;" src="<?php echo HTTP_ROOT.'webroot/uploads/activity/screenshots/'.$value->upload_file; ?>" alt="" >
                                                </a>
                                               
												<div class="hover_delete">
													
												<?php 
												$delete_visible = false;
													foreach($getTeam as $teamdata):
														if((in_array($value->project_id, explode(',',$teamdata->projects)) && ($teamdata->member_id == $authUser['id'] && in_array($teamdata->designation_id, [1,2]))) ||  $value['user_id'] == $authUser['id']  || $value->project->user_id == $authUser['id'])
															$delete_visible = true;
													endforeach;
													?>
												
												</div>
												<div class="project-name"><div><span class="project-int"><?php echo ucwords(substr($value->project->name, 0, 1)); ?></span><a><?php echo $value->project->name; ?></a></div></div>
												<p><?php echo $value->user->name; ?><small>(<?php echo date('D d m, Y' ,strtotime($value->created)); ?>)</small></p>
                                                <p>
                                                
                                              <a class="screenshotdetails"  data-screenshot-id="<?php echo base64_encode(convert_uuencode($value->id)); ?>" data-toggle="modal" data-target="#screenshot-detail" alt="Screen Shot"   data-original-title="Screenshot" style="cursor:pointer">
                                                
                                               <span class="fa fa-search"  style="color:green;"></span>
                                                </a>  
                                               &nbsp;&nbsp; 
                                                <a href="<?php echo HTTP_ROOT.'activity/screenshot-download/'.$value->id; ?>" alt="Download" data-toggle="tooltip"  data-original-title="Download Screenshot"><span class="fa fa-download"></span></a>
                                                 &nbsp;&nbsp; 
                                                <?php if($delete_visible): ?>
													<a href="<?php echo HTTP_ROOT.'activity/screenshot-delete/'.base64_encode(convert_uuencode($value['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete Screenshot" onclick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash" style="color:red;"></span></a>
												<?php endif; ?>
                                                
                                                </p>
											</div>
										</div>
										<?php 
										endforeach;
										endif;?>
								</div>
							</div>
						</div>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
  </body>