	<?php
							$total_week_worked_hrs = 0;
							$comma='';
							 foreach($timeSheetsWeek as $timesheetWeekdata)
							 {
								 $comma=',';
								 $total_week_worked_hrs += $timesheetWeekdata->duration;
							  }
							 // $total_week_worked_hrs=20;
							$week_percent = 0;	
							foreach($Projects as $project)
							 {
								 if($project->total_effort > 0):
							$week_percent +=  round(($total_week_worked_hrs/$project->total_effort)*100);
								else:
									$week_percent = 0;
								endif;
							  }
							  
							$day_percent = 0;
							$total_day_worked_hrs = 0;
							$comma='';
							 foreach($timeSheetsDay as $timesheetDaydata)
							 {
								 $comma=',';
								   $total_day_worked_hrs += $timesheetDaydata->duration;
							  }  
							foreach($Projects as $project)
							 {
								 if($project->total_effort > 0):
							$day_percent += round(($total_day_worked_hrs/$project->total_effort)*100);
								else:
									$day_percent = 0;
								endif;
							  }
	?>
    
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
						<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-bars"></span> Menu</a>
					</div>
					 <?php echo $this->element('topbar');?>
				</div>
				<!--- //////// Content Part START ///////// --->
					<div class="col-lg-12">
						<div class="page-heading"><h1><span class="fa fa-line-chart"></span> Projects</h1></div>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<div class="col-lg-3 col-md-6">
								<div class="box-dashboard">
									<div class="box-heading">Total hours worked today</div>
									<div class="number-bold"><?php echo $total_day_worked_hrs; ?> <span class="fa fa-bar-chart pull-right"></span></div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="box-dashboard">
									<div class="box-heading">Average activity today</div>
									<div class="number-bold"><?php echo $day_percent ?>% <span class="fa fa-signal pull-right"></span></div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="box-dashboard">
									<div class="box-heading">Total hrs worked past 7 days</div>
									<div class="number-bold"><?php echo $total_week_worked_hrs; ?>:00:00 <span class="fa fa-line-chart pull-right"></span></div>
								</div>
							</div>
							<div class="col-lg-3 col-md-6">
								<div class="box-dashboard">
									<div class="box-heading">Average activity past 7 days</div>
									<div class="number-bold"><?php echo $week_percent; ?>% <span class="fa fa-pie-chart pull-right"></span></div>
								</div>
							</div>
						</div>
					</div>
                   <div class="col-lg-12 top-margin">
						<div class="page-heading"><h1><span class="fa fa-bar-chart"></span> Recent Activity</h1></div>
					</div>
                    <div class="col-lg-12 top-margin">
                    <p><?php if($recentAction!=''){ ?><?php echo $recentAction['description'];  ?> at <?= (isset($recentAction['created']) && $recentAction['created'] != '') ? date_format($recentAction['created'], 'g:ia \o\n l jS F Y') : '' ?><?php }else { ?> <?php  echo "No recent activities found ";}  ?></p>
                    </div>
                    
					<div class="col-lg-12 top-margin">
						<div class="page-heading"><h1><span class="fa fa-bar-chart"></span> Projects Chart</h1></div>
					</div>
					<div class="row">
						<div class="col-lg-20">
							<div class="col-lg-20">
								<div class="box-dashboard">
									<div class="optional-button clearfix">
										<div class="right-buttons right-side" style="margin-right:20px;">
											<form method="post" name="choose-project" action="<?php echo HTTP_ROOT.'dashboard'?>" id="choose_project">
												<select name="chooseProject" id="chooseProject">
													<!--<option value="">Select Project</option>-->
													<?php foreach($Projects as $project): ?>
													<option value="<?php echo base64_encode(convert_uuencode($project->id)); ?>"><?php echo $project->name; ?></option>
													<?php endforeach; ?>
												</select>
												<input type="hidden" name="requestfor" value="columnbar_chart" />
											</form>
										</div>
									</div>
									
                                    
                                    
								</div>
							</div>
						</div>
					</div>
                    
                    
                    
                    
                    
                   <div class="row">
							<div class="col-lg-14">
								<div class="box-dashboard">
									<div class="optional-button clearfix">
										<div class="">
									<div id="chart-view">
										<center> Please select any one project to view Details. </center>
									</div>
                                    <div id="comments_data" style="margin-left:20px;"></div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    

                    </div>
                    
                     <div class="col-lg-12 top-margin">
						<div class="page-heading"><h1><span class="fa fa-bar-chart"></span> Users Recent Activities</h1></div>
					</div>
                    
                    <div class="col-lg-12">
				<div class="box-dashboard">
					<div class="optional-button clearfix">
                   
                                                <div style="float:right">
                             <select name="user_id" id="user_id" class="act_search">
													<option value="">Select User</option>
                                                    <?php foreach($usersList as $key => $val):?>
															<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													
												</select>&nbsp;&nbsp;
                                                
                                                  <select name="action" id="action" class="act_search">
													<option value="">Select Activity</option>
													<?php foreach($actionsList as $key => $val):?>
															<option value="<?php echo $val['action'] ?>"><?php echo $val['action'] ?></option>
														<?php endforeach;?>
												</select>
                                                </div>
						
					</div>
					
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="act-projects">
							<div class="table-design" id="activity_div">
								<table class="table table-hover" id="activity_table">
								  <thead>
									<tr>
									  	
									  <th width="10%">User</th>
									  <th width="15%">Action </th>
                                      <th>Activity</th>
                                      <th>Date Time</th>
									 
									</tr>
								  </thead>
								  <tbody>
									<?php 
									use Cake\ORM\TableRegistry;

									if(!empty($openActivities)):
										foreach($openActivities as $key=>$val):
										$user_id = $val->user_id;
										$users_tb = TableRegistry::get('Users');
										$getUser= $users_tb->find()->where(['Users.id' => $user_id])->first();
										$username= $getUser->name;

									?>
									<tr>	
											
										<td><?php echo $username; ?></td>
										<td><?php echo $val->action; ?></td>
                                        <td><?php echo $val->description; ?></td>
                                        <td><?php echo date_format($val->created, 'g:ia \o\n l jS F Y');    ?></td>
										
										
									</tr>
									<?php endforeach; endif;?>
								  </tbody>
								</table>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
				<div class="col-lg-12 top-margin">
					<div class="box-dashboard">
                    
						<!-- Nav tabs -->
						<ul class="nav nav-tabs" role="tablist">
							<?php /* ?><li role="presentation"><a href="#members" aria-controls="members" role="tab" data-toggle="tab">Members</a></li><?php */ ?>
							<li role="presentation" class="active"><a href="#projects" aria-controls="projects" role="tab" data-toggle="tab">Projects</a></li>
                            <li style="float:right; width:300px;"><div style="float:right">
                            <b>Effort By Resource</b> <select name="resource" id="resource">
													<option value="">Select Resource</option>
													<?php foreach($usersList as $key => $val):?>
															<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
												</select>
                                                </div>
                            
                            </li>
						</ul>
						<div class="tab-content">
							<?php /* ?><div role="tabpanel" class="tab-pane active" id="members">
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
						</div><?php */ ?>
							<div role="tabpanel" class="tab-pane active" id="projects">								
								<div class="table-design top-margin">
									<table class="table table-hover" id="efforts_table">
									  <thead>
										<tr>
										  <th>Project / Last Worked</th>
										  <th>Total Effort</th>
										  <th>Activity</th>
										  <th class="text-right">Time worked</th>
										</tr>
									  </thead>
									  <tbody>
									  <?php foreach($Projects as $project): 
									  	$total_worked_hrs = 0;
										$last_worked = '';
										//echo $project->id;
										foreach($timeSheets as $timesheetdata):
											if($project->id == $timesheetdata->project_id){
												//echo $timesheetdata->project_id;
												$total_worked_hrs += $timesheetdata->duration;
												$last_worked = $timesheetdata->end_time;
											}
										endforeach;
										
										if($project->status == 1):
											$active_color = 'blue';
										elseif($project->status == 2):
											$active_color = 'green';
										elseif($project->status == 3):
											$active_color = 'orange';
										elseif($project->status == 4):
											$active_color = 'red';
										endif;
										
										if($project->total_effort > 0):
											$completed_percent = ($total_worked_hrs/$project->total_effort)*100;
										else:
											$completed_percent = 0;
										endif;
									  ?>
										<tr>
										  <td class="project-name">
											<div>
												<span class="project-int"><?php echo ucwords(substr($project['name'], 0, 1)); ?></span> 
												<a href="javascript:void(0);"><?php echo ucwords($project->name); ?></a> 
												<span class="label-hint grey" data-original-title="<?php echo $last_worked; ?>" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="<?php if($last_worked != ''){ echo $last_worked->format('M, d Y, H:i a'); } else { echo '-'; } ?>">Last Worked on <?php if($last_worked != ''){ echo $last_worked->timeAgoInWords(); } else { echo '-'; } ?></span></div>
										  </td>
										  <td class="">
											<div class="number-bold"><?php echo $project->total_effort.' hrs'; ?></div>
										  </td>
										  <td >
											<div class="progress progress-striped active" data-original-title="<?php echo $completed_percent.'%'; ?> Completed" data-toggle="tooltip" data-placement="bottom"  data-container="body" title="<?php echo $completed_percent.'%'; ?> Completed">
												<div class="progress-bar <?php echo $active_color; ?>" style="width: <?php echo $completed_percent.'%'; ?>">
													<span class="sr-only" id="percentage"><?php echo $completed_percent.'%'; ?></span>
												</div>
											</div>
										  </td>
										  <td class="text-right">
											<div class="number-bold"><span id="total_hrs"><?php echo $total_worked_hrs.' hrs'; ?></span> <span class="fa fa-clock-o"></span></div>
										  </td>
										</tr>
										<?php endforeach; ?>
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