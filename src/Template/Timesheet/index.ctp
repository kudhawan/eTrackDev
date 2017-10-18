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
								<div class="optional-button clearfix inner-box-heading">
									<div class="left-buttons">
										Quick Search
									</div>
									<div class="right-buttons">
										<a href="<?php echo HTTP_ROOT.'new-timesheet'?>" class="btn corner blue"><span class="fa fa-plus"></span> New Timesheet</a>
									</div>
								</div>		
								<div class="search-input top-margin">
									<div class="row">
										<!--div class="col-lg-6">
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
										</div-->
										
										<!--<div class="col-lg-2">
											<div class="input-text-box margin-0"><input type="text" value="" placeholder="All Projects"></div>
										</div>-->
                                        
                                        
                       <div class="row">
						<div class="col-lg-12">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="optional-button clearfix">
										<div class="right-buttons right-side" style="margin-right:20px;">
											<form method="post" name="choose-project" action="<?php echo HTTP_ROOT.'timesheet'?>" id="choose_project">
												<label>Sort By : </label>
												<select name="timesheetProject" id="timesheetProject" class="timesheetSearch">
													<option value="">All Projects</option>
													<?php foreach($Projects as $project): ?>
													<option value="<?php echo $project->id; ?>"><?php echo $project->name; ?></option>
													<?php endforeach; ?>
												</select>
												<select name="timesheetUser" id="timesheetUser" class="timesheetSearch">
													<option value="">All User</option>
													<?php foreach($allUsers as $users): ?>
													<option value="<?php echo $users->id; ?>"><?php echo $users->name; ?></option>
													<?php endforeach; ?>
												</select>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
                                        
                                        
                                        
                                        
                                        
										
										<!--div class="col-lg-2">
											<div class="input-text-box margin-0"><input type="text" value="" placeholder="Select"></div>
										</div>
										<div class="col-lg-2">
											<div class="input-text-box margin-0"><input type="text" value="" placeholder="Select"></div>
										</div-->
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="table-design" id="timesheet_div">
									<table class="table table-hover" id="timesheet_table">
									  <thead>
										<tr>
										  <th>Project / Task</th>
										  <th>Start Time <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
										  <th>Stop Time <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
										  <th>Duration</th>
										  <th>User Name</th>
										  <th>Actions</th>
										</tr>
									  </thead>
									  <tbody id="timesheet_body">
										<?php foreach($timeSheets as $timeSheet):?>
										<tr>
										  <td class="project-name">
											<div><span class="project-int"><?php echo substr($timeSheet->project['name'] , 0 , 1)?></span> <?php echo $timeSheet->project['name'] . " - " .(strlen($timeSheet->bug['title']) > 10 ? substr($timeSheet->bug['title'] , 0 , 10).'..' : $timeSheet->bug['title']) ?> </div>
										  </td>
										  <td><?php echo date_format($timeSheet->start_time , 'Y-M-d H:i')?></td>
										  <td><?php echo date_format($timeSheet->end_time , 'Y-M-d H:i')?></td>
										  <td><?php echo $timeSheet->duration?> <span>Hours</span></td>
										  <td><?php echo $timeSheet->user->name; ?></td>
										  <td>
												<a  class="btn corner blue common-modaldetail" data-modal-title="Time Sheet Detail" data-url="timesheet/timesheet-details" data-id="<?php echo base64_encode(convert_uuencode($timeSheet->id)); ?>" data-toggle="modal" data-target="#common-modal-detail" data-tooltip="tooltip"  data-original-title="View Details"><span class="fa fa-info"></span></a>
												
                                              <?php 
													$visible_bugsheet = false;
													if(count($ownTeam)>0):
														foreach($ownTeam as $teamkey => $teamval):
															if(in_array($timeSheet->id,explode(',',$teamval->projects))): 
																if(($teamval->member_id == $authUser['id'] && (in_array($teamval->position_id, [3]) || in_array($teamval->designation_id, [1,2]))) || $teamval->employer_id == $authUser['id'] || $timeSheet->user_id == $authUser['id'] || $timeSheet->project->user_id == $authUser['id'])
																	$visible_bugsheet = true;
															endif;
														endforeach;
													endif;
													if($timeSheet->user_id == $authUser['id'] || $timeSheet->project->user_id == $authUser['id']):
														$visible_bugsheet = true;
													endif;
													if($visible_bugsheet):
													?>
														
													
                                                
                                                <a class="btn orange corner" href="<?php echo HTTP_ROOT.'edit-timesheet?timesheetId='.base64_encode(convert_uuencode($timeSheet->id))?>"><span class="fa fa-pencil-square-o"></span></a>
												
												<a class="btn red corner" href="<?php echo HTTP_ROOT.'delete/Timesheet/'.base64_encode(convert_uuencode($timeSheet->id)); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete Timesheet" onclick="return confirm('Are you sure you want to delete this Timesheet?');"><span class="fa fa-trash"></span></a>
                                                
                                                <?php 
													endif;
													?> 
                                                
                                                
                                                
										  </td>
										</tr>
										<?php endforeach;?>
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