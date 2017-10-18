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
				
				
				
				<!-- //////// Content Part START ///////// -->
				
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> Projects</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
							
								<div class="optional-button clearfix">
									<div class="left-buttons">
										<button form="deleteAll" class="btn corner"><span class="fa fa-trash"></span> Delete</button>
										<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
									</div>
									<div class="right-buttons">
										<a href="<?php echo HTTP_ROOT.'projects/create'?>" class="btn corner blue"><span class="fa fa-plus"></span> New Project</a>
									</div>
								</div>
							
								<ul class="nav nav-tabs top-margin" role="tablist">
									<li role="presentation" class="active"><a href="#act-projects" aria-controls="act-projects" role="tab" data-toggle="tab">Active Projects</a></li>
									<li role="presentation"><a href="#arc-projects" aria-controls="arc-projects" role="tab" data-toggle="tab">Archived Projects</a></li>
									<li role="presentation"><a href="#dra-projects" aria-controls="dra-projects" role="tab" data-toggle="tab">Draft Projects</a></li>
								</ul>
								
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="act-projects">
									
										<form method="POST" name="deleteAll" id="deleteAll" action="<?php echo HTTP_ROOT.'projects/delete-all.json' ?>">
										<div class="table-design">
											<table class="table table-hover">
											  <thead>
												<tr>
												  <th>#</th>	
												  <th>Name</th>
												  <th>Total Effort <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
												  <th>Members</th>
												  <th>Start Date</th>
												  <th>End Date</th>
												  <th>Status</th>
												  <th>%</th>
												  <th>Actions</th>
												</tr>
											  </thead>
											  <tbody>
												
												<?php 
												$superadmin_visible= count($superadminCheck);
												
												if(!empty($Projects)):
												foreach($Projects as $key=>$val):
													
													?>
												<tr>
													
												  <td>
													<div class="checkbox">
													  <label>
                                                      
													  <?php if($val['user_id'] == $authUser['id']):?>
														<input type="checkbox" value="<?php echo $val['id']; ?>" name="deleteAll[]">
														<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
														<?php endif; ?>
													  </label>
													</div>
												  </td>	
												  <td class="project-name">
													<div><span class="project-int"><?php echo ucwords(substr($val['name'], 0, 1)); ?></span><a href="#"><?php echo ucwords($val['name']); ?></a>
													</div>
												  </td>
												  <td><?php echo $val['total_effort'].' in hours'; ?></td>
												  <td class="project-name">
													<?php 
													foreach($ownTeam as $teamkey => $teamval): 
														if($teamval->employer_id == $authUser['id'] || $teamval->member_id == $authUser['id']):
															if(in_array($val->id,explode(',',$teamval->projects))):
															?>
																<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Vinoth SN" data-toggle="tooltip" data-placement="bottom" data-container="body" title="<?php echo $teamval->user->name; ?>"></div>
															<?php 
															endif;
														endif;
													endforeach;
													?>
												  </td>
												  <td><?php echo date("d-m-Y", strtotime($val['start_date'])); ?></td>
												  <td><?php echo date("d-m-Y", strtotime($val['end_date'])); ?></td>
												  <td>
												  	<?php if($val['status'] == 1):?>
												  	<label class="status blue">Active<label>
												  	<?php elseif($val['status'] == 2): ?>
												  	<label class="status green">Completed<label>
												  	<?php else: ?>
												  	<label class="status red">On hold<label>
												  <?php endif; ?>
												  	</td>
												  <td>
													<div class="progress" data-original-title="70% Projects Completed" data-toggle="tooltip" data-placement="bottom" data-container="body" title="70% Projects Completed">
													  <div class="progress-bar green" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">
														<span class="sr-only">70% Complete</span>
													  </div>
													</div>
												  </td>
												  <td>
												  <?php if(($val['user_id'] == $authUser['id'])||($superadmin_visible==1)):?>
													<a class="btn orange corner" href="<?php echo HTTP_ROOT.'projects/edit/'.base64_encode(convert_uuencode($val['id']))?>" alt="Edit" data-toggle="tooltip"  data-original-title="Edit project"><span class="fa fa-pencil-square-o"></span></a>
													<a class="btn red corner" href="<?php echo HTTP_ROOT.'projects/delete/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" onclick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash"></span></a>
												  <?php endif; ?>
													<?php 
													$visible_bugsheet = false;
													if(count($ownTeam)>0):
														foreach($ownTeam as $teamkey => $teamval):
															if(in_array($val->id,explode(',',$teamval->projects))): 
																if(($teamval->member_id == $authUser['id'] && (in_array($teamval->position_id, [3]) || in_array($teamval->designation_id, [1,2]))) || $teamval->employer_id == $authUser['id'] || $val->user_id == $authUser['id'])
																	$visible_bugsheet = true;
															endif;
														endforeach;
													endif;
													if(($val['user_id'] == $authUser['id'])||($superadmin_visible==1)):
														$visible_bugsheet = true;
													endif;
													if($visible_bugsheet):
													?>
														<a class="btn blue corner" href="<?php echo HTTP_ROOT.'bug-sheet/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="bug sheet"><span class="fa fa-bug"></span></a>
														<a class="btn blue corner" href="<?php echo HTTP_ROOT.'feature-list/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="Feature List"><span class="fa fa-bullhorn"></span></a>
													<?php 
													endif;
													?>
                                                    <a class="btn green corner" href="<?php echo HTTP_ROOT.'task-list/'.base64_encode(convert_uuencode($val['id']))?>" alt="Task List" data-toggle="tooltip"  data-original-title="Task List"><span class="fa fa-tasks"></span></a>
                                                    
                                                    
													<a class="btn green corner" href="<?php echo HTTP_ROOT.'chat/'.base64_encode(convert_uuencode($val['id']))?>" alt="conversation" data-toggle="tooltip"  data-original-title="conversation project"><span class="fa fa-eye"></span></a>
													<a class="btn corner blue projectdetails" data-requestfor="columnbar_chart" data-project-id="<?php echo base64_encode(convert_uuencode($val['id'])); ?>" data-toggle="modal" data-target="#project-detail" alt="Project Details"   data-original-title="Project Details"><span class="fa fa-info"></span></a>
												  </td>
												</tr>
												<?php endforeach; 
												else: ?>
												<tr>
												  <td colspan="9">
													No Draft projects
												  </td>	
												</tr>
												<?php endif; ?>
											  </tbody>
											</table>
										</div>
											</form>
									
									</div>
									<div role="tabpanel" class="tab-pane" id="arc-projects">
									
										<div class="table-design">
											<table class="table table-hover">
											  <thead>
												<tr>
												  <th>#</th>	
												  <th>Name</th>
												  <th>Description <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
												  <th>Members</th>
												  <th>Start Date</th>
												  <th>End Date</th>
												  <th>Status</th>
												  <th>%</th>
												  <th>Actions</th>
												</tr>
											  </thead>
											  <tbody>
												<tr>
												  <td colspan="9">
													No projects
												  </td>	
												</tr>
											  </tbody>
											</table>
										</div>
									
									</div>
									<div role="tabpanel" class="tab-pane" id="dra-projects">
										<div class="table-design">
											<table class="table table-hover">
											  <thead>
												<tr>
												  <th>#</th>	
												  <th>Name</th>
												  <th>Description <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
												  <th>Members</th>
												  <th>Start Date</th>
												  <th>End Date</th>
												  <th>Status</th>
												  <th>%</th>
												  <th>Actions</th>
												</tr>
											  </thead>
											  <tbody>
												<tr>
												  <td colspan="9">
													No Draft projects
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
  </body>