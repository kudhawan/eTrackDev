 <body class="dashboard-bg">
    
	    <div id="wrapper">

			<!-- Sidebar -->
				<?php echo $this->element('sidebar')?>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="dashboard-top-bar">
					<div class="top-bar-left">
						<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-long-arrow-left"></span> User Management</a>
					</div>
					 <?php echo $this->element('topbar');?>
				</div>
				
				
				
				<!-- //////// Content Part START ///////// -->
				
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> Users</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
							
								<div class="optional-button clearfix">
									
									<div class="right-buttons">
										<a href="<?php echo HTTP_ROOT.'clients/create'?>" class="btn corner blue"><span class="fa fa-plus"></span> Create User</a>
									</div>
								</div>
							
								
								
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane active" id="act-projects">
									
										<form method="POST" name="deleteAll" id="deleteAll" action="<?php echo HTTP_ROOT.'clients/delete-all.json' ?>">
										<div class="table-design">
											<table class="table table-hover">
											  <thead>
												<tr>
												 	
												  <th>Name</th>
												  
												  <th>Email</th>
												  <th>Actions</th>
												</tr>
											  </thead>
											  <tbody>
												
												<?php 
												
												
												if(!empty($getUsers)):
												foreach($getUsers as $key=>$val):
													
													?>
												<tr>
													
												 
												  <td class="project-name">
													<div><span class="project-int"><?php echo ucwords(substr($val['name'], 0, 1)); ?></span><a href="#"><?php echo ucwords($val['name']); ?></a>
													</div>
												  </td>
												  <td><?php echo $val['email']; ?></td>
												 
												  <td>
												  <?php ?>
													<!--<a class="btn orange corner" href="<?php //echo HTTP_ROOT.'clients/edit/'.base64_encode(convert_uuencode($val['id']))?>" alt="Edit" data-toggle="tooltip"  data-original-title="Edit User"><span class="fa fa-pencil-square-o"></span></a>-->
													<a class="btn red corner" href="<?php echo HTTP_ROOT.'clients/delete/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete User" onclick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash"></span></a>
												  <?php  ?>
													
												  </td>
												</tr>
												<?php endforeach; 
												else: ?>
												<tr>
												  <td colspan="9">
													No Users
												  </td>	
												</tr>
												<?php endif; ?>
											  </tbody>
											</table>
										</div>
											</form>
									
									</div>
									
									
								</div>
							</div>
						</div>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
  </body>