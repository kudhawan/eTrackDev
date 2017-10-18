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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Create New User</h1></div>
						</div>
						<form method="POST" name="" id="newUser" action="<?php echo HTTP_ROOT.'Users/create.json' ?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												
                                              <input type="hidden" name="employer_id" value="">
                                              <input type="hidden" name="designation_id" value="">
                                              <input type="hidden" name="position" value="">
                                              <input type="hidden" name="projects" value="">
                                              <input type="hidden" name="is_employer" value="0">
                                                <div class="input-text-box">
                                                    <input required type="text" name="name" value="" placeholder="Name">
                                                </div>
                                                <div class="input-text-box">
                                                    <input required  type="email" name="email" value="" placeholder="E-mail Address">
                                                </div>
                                                <div class="input-text-box">
                                                    <input required type="text" name="phone" placeholder="Phone">
                                                </div>
                                                <div class="input-text-box">
                                                    <input required type="password" name="password" placeholder="Password">
                                                </div>
                                                <div class="input-text-box">
                                                    <input required type="password" name="confirm" placeholder="Repeat Password">
                                                </div>
                                                                                   
                                    
											</div>
										</div>
										
                                    
                                    
                                               
									</div>	
									
									
									<div class="optional-button top-margin clearfix">
										<div class="center-buttons" align="center">
											<button  type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'users/create' ?>"><span class="fa fa-ban"></span> Cancel</a>
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