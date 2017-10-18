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
							<div class="page-heading"><h1><span class="fa fa-pencil"></span> Edit Project</h1></div>
						</div>
						<form method="POST" name="" id="editMember" action="<?php echo HTTP_ROOT.'Employers/edit.json' ?>">
							<input type="hidden" name="id" value="<?php echo $datas['id'];?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Member Details</div>
												<div class="ui-form">
													<label>Member Name</label>
													<input type="text" readonly name="name" class="required" value="<?php echo $datas['user']['name'];?>">
												</div>
												<div class="ui-form">
													<label>Role</label>
													<input type="hidden" readonly name="selectedposition" class="selectedposition" value="<?php echo $datas['position_id'];?>">
													<select class="designation_id required" name="designation_id">
														<option value="">-- Select --</option>
														<?php foreach($getDesignations as $designation => $value):?>
															<option <?php if($value['id'] == $datas['designation']['id']){ echo 'selected'; }?> value="<?php echo $value['id']; ?>"><?php echo $value['name'] ?></option>
														<?php endforeach;?>
													</select>
												</div>
											</div>
										</div>
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Projects</div>
												<div class="ui-form">
													<label>Projects</label>
													<?php $getProjects = explode(',',$datas['projects']); ?>
													<select class="chosen  projectList required" multiple="true">
														<?php foreach($userProjects as $key => $val):?>
															<option <?php if(in_array($val['id'],$getProjects)){ echo 'selected'; }?> value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
													<input type="hidden" value="<?php echo $datas['projects']; ?>" name="projects" class="projects">
												</div>
											</div>
										</div>
									</div>	
									
									
									<div class="optional-button top-margin clearfix">
										<div class="left-buttons">
											<button class="btn corner"><span class="fa fa-trash"></span> Delete</button>
											<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
										</div>
										<div class="right-buttons">
											<button  type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'dashboard'?>"><span class="fa fa-ban"></span> Cancel</a>
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
