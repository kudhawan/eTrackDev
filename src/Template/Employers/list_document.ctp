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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Daily Report</h1></div>
						</div>
						
						
						<div class="col-lg-6 top-margin">
							<div class="box-dashboard">
								
								<div class="table-design">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th>Id</th>
										  <th>File</th>
										  
										</tr>
									  </thead>
									  <tbody>
									  <?php 
									if(!empty($document)):
									foreach($document as $key => $value):
										?>
									  
									  
										<tr>
										<td><?php echo $value->id ?></td>	
										  <td class="project-name">
											<div class="user-block" ><span><?php echo $value->upload_file ?></span> </div>
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
				
				
				<!--- //////// Content Part END ///////// --->
				
				
			</div>
			<!-- /#page-content-wrapper -->

		</div>
		<!-- /#wrapper -->
  </body>
