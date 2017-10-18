<body class="dashboard-bg">
    
	    <div id="wrapper">

			<!-- Sidebar -->
			<?php echo $this->element('sidebar'); ?>
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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Documents</h1></div>
						</div>
						
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="optional-button clearfix">
									<div class="left-buttons">
										<button form="deleteAll" class="btn corner"><span class="fa fa-trash"></span> Delete</button>
										<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
									</div>
									<div class="right-buttons">
										<a href="<?php echo HTTP_ROOT.'activity/document-create'?>" class="btn corner blue"><span class="fa fa-plus"></span> New Document</a>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
							<form method="POST" name="deleteAll" id="deleteAll" action="<?php echo HTTP_ROOT.'activity/document-delete-all.json' ?>">
								<div class="table-design">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th></th>
										  <th>File</th>
										  <th>Project</th>
										  <th>User</th>
										  <th>Designation</th>
										  <th>Action</th>
										</tr>
									  </thead>
									  <tbody>
									  <?php 
									 // print_r($document);
									if(!empty($document)):
									foreach($document as $key => $value):
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
										<tr>
													
											  <td>
												<div class="checkbox">
												  <label>
												  <?php if($download_visible == true):?>
													<input type="checkbox" value="<?php echo $value['id']; ?>" name="deleteAll[]">
													<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
													<?php endif; ?>
												  </label>
												</div>
											  </td>	
											  <td class="project-name">
												<div class="user-block"><span><a href="javascript:void(0);"><?php echo $value->upload_file ?></span></a></div>
											  </td>
											<td class="project-name">
												<div><span class="project-int"><?php echo ucwords(substr($value->project->name, 0, 1)); ?></span><a href="javascript:void(0);"><?php echo ucwords($value->project->name); ?></a></div>
											</td>	
											<td><?php echo $value->user->name; ?></td>
											<td><?php echo $designations; ?></td>
											<td>
												<a class="btn green corner" target="_blank" href="<?php echo HTTP_ROOT.'activity/document-download/'.$value->id; ?>"><span class="fa fa-download"></span></a>
												<?php if($download_visible == true): ?>
													<a class="btn red corner" href="<?php echo HTTP_ROOT.'activity/document-delete/'.base64_encode(convert_uuencode($value['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" onclick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash"></span></a>
												<?php endif; ?>
											</td>
										</tr>
										<?php 
										endforeach;
										endif;?>
									
									  </tbody>
									</table>
								</div>
								</form>
							</div>
						</div>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->
  </body>