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
					<div class="top-bar-right">
						<div class="organization">Organization : <span class="intial-organization">Alberta Tech Works</span> </div>
					</div>
				</div>				
				<!-- //////// Content Part START ///////// -->
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> New Document</h1></div>
						</div>
						
						<?php echo $this->Form->create($user_documents,['novalidate'=>true,'class'=>'powermail_form powermail_form_2  form-horizontal powermail_morestep',"type"=>"file"]) ?>
							<div class="col-lg-6">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Documents Details</div>
												<div class="ui-form"><label>Upload File</label>
													
													<?php echo $this->Form->input("user_document.upload_file", ["required" => false,"placeholder"=>"Image","type"=>"file","label"=>false,"class"=>"required"]); ?>	
													
													</div>
												
												
											</div>
										</div>
						
										</div>
									</div>
									<div class="optional-button top-margin clearfix">
										
										<div class="right-buttons">
										<?php echo $this->Form->button('<span class="fa fa-save"></span> Save Project',['type'=>'submit','class'=>'btn corner blue']) ?>
										
										</div>
									</div>
								</div>
								<?php echo $this->Form->end() ?>
							</div>
						</form>
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
  </body>
