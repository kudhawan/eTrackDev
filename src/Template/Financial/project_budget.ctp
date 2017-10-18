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
							<div class="page-heading"><h1><span class="fa fa-line-chart"></span> Project Budget</h1></div>
						</div>

						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="ui-form">
									<label>Project</label>
									<select id="project_estimation" name="project_id" class="required" data-requestfor="budgetpie_chart">
										<option value="">Select Project</option>
										<?php foreach($projects as $key => $project):?>
											<option value="<?= base64_encode(convert_uuencode($project->id)); ?>"><?php echo $project->name;?></option>
										<?php endforeach;?>
									</select>
								</div>
								<div class="top-margin row">
									<?php /* ?>
									<div class="col-lg-6">
										<div id="chart-view">
											<center> Please select any one project to view Details. </center>
										</div>
									</div>
									<?php */ ?>
									<div class="col-lg-12">
										<div id="payment-view">
											<center> Please select any one project to view Payment Details. </center>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>

		</div>
		<!-- /#wrapper -->
  </body>
