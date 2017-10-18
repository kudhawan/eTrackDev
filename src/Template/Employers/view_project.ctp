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
										<button class="btn corner"><span class="fa fa-trash"></span> Delete</button>
										<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
									</div>
									<div class="right-buttons">
										<a href="<?php echo HTTP_ROOT.'new-project'?>" class="btn corner blue"><span class="fa fa-plus"></span> New Project</a>
									</div>
								</div>
							
								<ul class="nav nav-tabs top-margin" role="tablist">
									<li role="presentation" class="active"><a href="#act-projects" aria-controls="act-projects" role="tab" data-toggle="tab">Active Projects</a></li>
									<li role="presentation"><a href="#arc-projects" aria-controls="arc-projects" role="tab" data-toggle="tab">Archived Projects</a></li>
									<li role="presentation"><a href="#dra-projects" aria-controls="dra-projects" role="tab" data-toggle="tab">Draft Projects</a></li>
								</ul>
								
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="act-projects">
									
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
												
												<?php 
												if(!empty($ownProjects)):
												foreach($ownProjects as $key=>$val):
													
													?>
												<tr>
													
												  <td>
													<div class="checkbox">
													  <label>
														<input type="checkbox" value="">
														<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													  </label>
													</div>
												  </td>	
												  <td class="project-name">
													<div><span class="project-int"><?php echo substr($val['name'], 0, 1)?></span><a href="#"><?php echo $val['name']; ?></a>
													</div>
												  </td>
												  <td><?php echo substr($val['description'], 0,50).'...';?></td>
												  <td class="project-name">
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Vinoth SN" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Vinoth SN"></div>
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Kunal" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Kunal"></div>
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Badri" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Badri "></div>
												  </td>
												  <td><?php echo $val['start_date'];?></td>
												  <td><?php echo $val['end_date'];?></td>
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
													<a class="btn orange corner" href="<?php echo HTTP_ROOT.'edit-project/'.base64_encode(convert_uuencode($val['id']))?>"><span class="fa fa-pencil-square-o"></span></a>
													<!-- <a class="btn red cornerprojectDel_<?php echo $val['id'] ?>" rel ="<?php echo $val['id'] ?>" data-toggle="tooltip" data-original-title="delete Project"  title="" ><span class="fa fa-trash"></span>
													</a> -->
													  <a class="btn red corner" href="<?php echo HTTP_ROOT.'delete/Projects/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" onclick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash"></span></a>

													   <a class="btn green corner" href="<?php echo HTTP_ROOT.'chat/'.base64_encode(convert_uuencode($val['id']))?>" alt="conversation" data-toggle="tooltip"  data-original-title="conversation project"><span class="fa fa-eye"></span></a>
													     <a class="btn blue corner" href="<?php echo HTTP_ROOT.'bug-sheet/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="bug sheet"><span class="fa fa-bug"></span></a>
												  </td>
												</tr>
												<?php endforeach; endif;?>
												<?php if(!empty($otherProjects)):
												foreach ($otherProjects as $key=>$val):
													?>
												<tr>
													
												  <td>
													<div class="checkbox">
													  <label>
														<input type="checkbox" value="">
														<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													  </label>
													</div>
												  </td>	
												  <td class="project-name">
													<div><span class="project-int"><?php echo substr($val['name'], 0, 1)?></span><a href="#"><?php echo $val['name']; ?></a>
													</div>
												  </td>
												  <td><?php echo substr($val['description'], 0,50).'...';?></td>
												  <td class="project-name">
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Vinoth SN" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Vinoth SN"></div>
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Kunal" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Kunal"></div>
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Badri" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Badri "></div>
												  </td>
												  <td><?php echo $val['start_date'];?></td>
												  <td><?php echo $val['end_date'];?></td>
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
													<!-- <a class="btn orange corner" href="<?php echo HTTP_ROOT.'edit-project/'.base64_encode(convert_uuencode($val['id']))?>"><span class="fa fa-pencil-square-o"></span></a> -->
													<!-- <a class="btn red cornerprojectDel_<?php echo $val['id'] ?>" rel ="<?php echo $val['id'] ?>" data-toggle="tooltip" data-original-title="delete Project"  title="" ><span class="fa fa-trash"></span>
													</a> -->
													  <!-- <a class="btn red corner" href="<?php echo HTTP_ROOT.'delete/Projects/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" onclick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash"></span></a> -->
													   <a class="btn green corner" href="<?php echo HTTP_ROOT.'chat/'.base64_encode(convert_uuencode($val['id']))?>" alt="conversation" data-toggle="tooltip"  data-original-title="conversation project"><span class="fa fa-eye"></span></a>
													     <a class="btn blue corner" href="<?php echo HTTP_ROOT.'bug-sheet/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="bug sheet"><span class="fa fa-bug"></span></a>
												  </td>
												</tr>
												<?php
											    endforeach;		
												endif;
												 ?>
												
											<!-- 	<tr>
												  <td>
													<div class="checkbox">
													  <label>
														<input type="checkbox" value="">
														<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													  </label>
													</div>
												  </td>	
												  <td class="project-name">
													<div><span class="project-int">C</span> CW Banks </div>
												  </td>
												  <td></td>
												  <td class="project-name">
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Kunal" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Kunal"></div>
												  </td>
												  <td>02-02-2017</td>
												  <td>02-28-2017</td>
												  <td><label class="status green">Completed<label></td>
												  <td>
													<div class="progress" data-original-title="Completed" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Completed">
													  <div class="progress-bar blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
														<span class="sr-only">100% Complete</span>
													  </div>
													</div>
												  </td>
												  <td>
													<button class="btn orange corner" data-original-title="Edit Projects" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Edit Projects"><span class="fa fa-pencil-square-o"></span></button>
													<button class="btn red corner" data-original-title="Delete Projects" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Delete Projects"><span class="fa fa-trash"></span></button>
												  </td>
												</tr>
												<tr>
												  <td>
													<div class="checkbox">
													  <label>
														<input type="checkbox" value="">
														<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													  </label>
													</div>
												  </td>	
												  <td class="project-name">
													<div><span class="project-int">M</span> Mentor 4 U </div>
												  </td>
												  <td></td>
												  <td class="project-name">
													<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" data-original-title="Kunal" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Kunal"></div>
												  </td>
												  <td>02-02-2017</td>
												  <td>02-28-2017</td>
												  <td><label class="status red">On hold<label></td>
												  <td>
													<div class="progress" data-original-title="Completed" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Completed">
													  <div class="progress-bar orange" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
														<span class="sr-only">100% Complete</span>
													  </div>
													</div>
												  </td>
												  <td>
													<button class="btn orange corner" data-original-title="Edit Projects" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Edit Projects"><span class="fa fa-pencil-square-o"></span></button>
													<button class="btn red corner" data-original-title="Delete Projects" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Delete Projects"><span class="fa fa-trash"></span></button>
												  </td>
												</tr> -->
											  </tbody>
											</table>
										</div>
									
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
