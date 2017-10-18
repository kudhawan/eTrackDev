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
							<div class="page-heading"><h1><span class="fa fa-home"></span> New Document</h1></div>
						</div>
						
						<form method="POST" id="dropzoneFileForm" enctype="multipart/form-data" class="powermail_form powermail_form_2  form-horizontal powermail_morestep dropzone" novalidate="novalidate" action="<?php echo HTTP_ROOT.'activity/screenshot-create.json' ?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="inner-box-heading line-bottom">Documents Details</div>
									<div class="row top-margin">
										<div class="col-lg-12">
											<div class="ui-form">
												<label>Project</label>
												<select name="project_id" class="required">
													<option value="">Select Project</option>
													<?php foreach($projects as $key => $project):?>
														<option value="<?php echo $project->id;?>"><?php echo $project->name;?></option>
													<?php endforeach;?>
												</select>
											</div>
											<div class="ui-form">
												<style>
													#dropzonePreview{
														width: 100%;  
														min-height: 150px;
														border: 2px solid rgba(0, 0, 0, 0.3);
														background: white;
														padding: 20px 20px;
													}
												</style>
												<label>Upload File</label>
												<div id="dropzonePreview">
													<div class="dz-default dz-message"><span>Drop files here to upload</span></div>
												</div>
												<input type="file" style="display:none;" name="upload_file[]" />
											</div>
										</div>
						
										</div>
									</div>
									<div class="optional-button top-margin clearfix">
										
										<div class="right-buttons">
											<?php echo $this->Form->button('<span class="fa fa-save"></span> Save',['type'=>'submit','class'=>'btn corner blue','id'=>'dropzoneSubmit']) ?>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'screenshots' ?>"><span class="fa fa-ban"></span> Cancel</a>
										</div>
									</div>
								</div>
								</form>
							</div>
						</form>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
  </body>
