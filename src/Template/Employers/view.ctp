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
						<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-long-arrow-left"></span> Dashboard</a>
					</div>
					 <?php echo $this->element('topbar');?>
				</div>
				<!-- //////// Content Part START ///////// -->
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> Member's</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="optional-button top-margin clearfix">
									<div class="left-buttons">
										<button form="deleteAll" class="btn corner"><span class="fa fa-trash"></span> Delete</button>
										<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
									</div>
									<div class="right-buttons">
										<button class="btn corner blue" data-toggle="modal" data-target="#invite-members"><span class="fa fa-plus"></span> Invite Members</button>
									</div>
								</div>
							</div>
						</div>
		<?php 
		//foreach($getTeams as $key => $val):
			// pr($val['designation_id']);
		?>				<form method="POST" name="deleteAll" id="deleteAll" action="<?php echo HTTP_ROOT.'employers/delete-all.json' ?>">
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="inner-box-heading">Admin Member's</div>
								<div class="table-common">
									<table class="table table-bordered">
										<thead>
											<tr>
											  <th>#</th>	
											  <th>Name</th>
											  <th>Role <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Owner &amp; Manage Alberta Tech Works INC"></span></th>
											  <th>Projects</th>
											  <th>Actions</th>
											</tr>
										  </thead>
										  <tbody>
									<?php 
									if(!empty($getOwnerManager)):
									foreach($getOwnerManager as $owner =>$manager):?>	  	
											<tr>
											  <td>
												<div class="checkbox">
												  <label>
												  <?php if($manager['employer_id'] == $authUser['id']): ?>
													<input type="checkbox" value="<?php echo $manager['id']; ?>" name="deleteAll[]">
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													<?php endif; ?>
												  </label>
												</div>
											  </td>
											  <td class="project-name">
												<div class="user-block"><img class="img-circle img-bordered-sm" src="images/user-icon.png"> <span><?php echo $manager['user']['name']?></span> </div>
											  </td>
											  <td><?php echo $manager['designation']['name']?></td>							  
											  <td class="project-name">
												<div>
													<?php $projectlist = explode(',',$manager['projects']);
													foreach($getProjects as $get => $project):
													  if(in_array($project['id'],$projectlist)): ?>
													<span class="project-int" data-original-title="<?php echo $project['name']; ?>" data-toggle="tooltip" data-placement="bottom" data-container="body" ><?php echo substr($project['name'],0,1)?></span>
													<?php
														endif;
													 endforeach; ?>
												</div>
											  </td>
											  <td>
											  <?php if($manager['employer_id'] == $authUser['id']): ?>
												<button type="button" onClick='window.location.href="<?php echo HTTP_ROOT.'members/edit/'.base64_encode(convert_uuencode($manager['id'])); ?>"' class="btn orange corner" data-original-title="Edit Users" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Edit Users"><span class="fa fa-pencil-square-o"></span></button>
												<a class="btn red corner" href="<?php echo HTTP_ROOT.'members/delete/'.base64_encode(convert_uuencode($manager['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" data-placement="bottom" onclick="return confirm('Are you sure you want to delete this?');"><span class="fa fa-trash"></span></a>
												<?php endif; ?>
											  </td>
											</tr>
										<?php 
										endforeach;
										endif;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="inner-box-heading">Work Member's</div>
								<div class="table-common">
									<table class="table table-bordered">
										<thead>
											<tr>
											  <th>#</th>	
											  <th>Name</th>
											  <th>Role <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Owner &amp; Manage Alberta Tech Works INC"></span></th>
											  <th>Position</th>
											  <th>Projects</th>
											  <th>Actions</th>
											</tr>
										  </thead>
										  <tbody>
									<?php 
									
									if(!empty($getWorker)):
									foreach($getWorker as $get => $worker):
										
										?>
											<tr>
											  <td>
												<div class="checkbox">
												  <label>
												  <?php if($worker['employer_id'] == $authUser['id']): ?>
													<input type="checkbox" value="<?php echo $worker['id']; ?>" name="deleteAll[]">
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													<?php endif; ?>
												  </label>
												</div>
											  </td>
											  <td class="project-name">
												<div class="user-block"><img class="img-circle img-bordered-sm" src="images/user-icon.png"> <span><?php echo $worker['user']['name'] ?></span> </div>
											  </td>
											  <td><?php echo $worker['designation']['name'] ?> </td>
											  <td><?php echo $worker['position']['title']; ?></td>							  
											  <td class="project-name">
												<div>
													<?php $projectlist = explode(',',$worker['projects']);
													foreach($getProjects as $get => $project):
													  if(in_array($project['id'],$projectlist)): ?>
													<span class="project-int" data-original-title="<?php echo $project['name']; ?>" data-toggle="tooltip" data-placement="bottom" data-container="body" ><?php echo substr($project['name'],0,1)?></span>
													<?php
														endif;
													 endforeach; ?>
												</div>
											  </td>
											  <td>
											  <?php if($worker['employer_id'] == $authUser['id']): ?>
												<button type="button" onClick='window.location.href="<?php echo HTTP_ROOT.'members/edit/'.base64_encode(convert_uuencode($worker['id'])); ?>"' class="btn orange corner" data-original-title="Edit Users" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Edit Users"><span class="fa fa-pencil-square-o"></span></button>
												<a class="btn red corner" href="<?php echo HTTP_ROOT.'members/delete/'.base64_encode(convert_uuencode($worker['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" data-placement="bottom" onclick="return confirm('Are you sure you want to delete this?');"><span class="fa fa-trash"></span></a>
												<?php endif; ?>
											  </td>
											</tr>
									<?php endforeach;
										  endif;	
									?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="inner-box-heading">Client / Viewer's</div>
								<div class="table-common">
									<table class="table table-bordered">
										<thead>
											<tr>
											  <th>#</th>	
											  <th>Name</th>
											  <th>Role <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Viewer can only view"></span></th>
											  <th>Projects</th>
											  <th>Actions</th>
											</tr>
										  </thead>
										  <tbody>
										  	<?php 
										  	if(!empty($getClientViewer)):
										  	foreach($getClientViewer as $client => $viewer):
										  	?>
											<tr>
											  <td>
												<div class="checkbox">
												  <label>
												  <?php if($viewer['employer_id'] == $authUser['id']): ?>
													<input type="checkbox" value="<?php echo $viewer['id']; ?>" name="deleteAll[]">
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													<?php endif; ?>
												  </label>
												</div>
											  </td>
											  <td class="project-name">
												<div class="user-block"><img class="img-circle img-bordered-sm" src="images/user-icon.png"> <span><?php echo $viewer['user']['name']?></span> </div>
											  </td>
											  <td><?php echo $viewer['designation']['name']?></td>							  
											  <td class="project-name">
												<div>
													<?php $projectlist = explode(',',$viewer['projects']);
													foreach($getProjects as $get => $project):
													  if(in_array($project['id'],$projectlist)): ?>
													<span class="project-int" data-original-title="<?php echo $project['name']; ?>" data-toggle="tooltip" data-placement="bottom" data-container="body" ><?php echo substr($project['name'],0,1)?></span>
													<?php
														endif;
													 endforeach; ?>
												</div>
											  </td>
											  <td>
											  <?php if($viewer['employer_id'] == $authUser['id']): ?>
												<button type="button" onClick='window.location.href="<?php echo HTTP_ROOT.'members/edit/'.base64_encode(convert_uuencode($viewer['id'])); ?>"' class="btn orange corner" data-original-title="Edit Users" data-toggle="tooltip" data-placement="bottom" data-container="body" title="Edit Users"><span class="fa fa-pencil-square-o"></span></button>
												<a class="btn red corner" href="<?php echo HTTP_ROOT.'members/delete/'.base64_encode(convert_uuencode($viewer['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" data-placement="bottom" onclick="return confirm('Are you sure you want to delete this?');"><span class="fa fa-trash"></span></a>
												<?php endif; ?>
											  </td>
											</tr>
										<?php endforeach; endif;?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						</form>
		<?php 
		//endforeach;
		?>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->
  </body>
  <style>
  .search-field input{
  	width:200px !important; 
  }
  </style>
