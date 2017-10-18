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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Weekly Report</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="inner-box-heading">Quick Search</div>
								<div class="search-input top-margin">
									<div class="row">
										<div class="col-lg-6">
											<div class="input-group date">
												<button class="btn grey corner"><span class="fa fa-arrow-left"></span></button>
											</div>
											
											<div class="input-group date">
												<button class="btn grey corner"><span class="fa fa-arrow-right"></span></button>
											</div>
											
											
											<div class="input-group date" data-provide="datepicker">
												<input type="text" class="form-control corner" placeholder="Feb 6 2017">
												<div class="input-group-addon corner">
													<span class="glyphicon glyphicon-th"></span>
												</div>
											</div>
										</div>
										
										<div class="col-lg-6">
											<div class="label-button text-right">
												<button class="btn blue corner "><span class="fa fa-paper-plane"></span> Send Report</button>
												<button class="btn blue corner "><span class="fa fa-file-pdf-o"></span> Download PDF</button>
												<button class="btn blue corner "><span class="fa fa-file-excel-o"></span> Download CSV</button>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						<div class="col-lg-12 top-margin">
							<div class="box-dashboard">
								<div class="inner-box-heading">Mon, February 06 2017 Sun, February 12 2017</div>
								<div class="table-design">
									<table class="table table-hover">
									  <thead>
										<tr>
										  <th>Member</th>
										  <th>Mon, Feb 06</th>
										  <th>Tue, Feb 07</th>
										  <th>Wed, Feb 08</th>
										  <th>Thu, Feb 09</th>
										  <th>Fri, Feb 10</th>
										  <th>Sat, Feb 11</th>
										  <th>Sun, Feb 12</th>
										  <th>Weekly</th>
										</tr>
									  </thead>
									  <tbody>
										<tr>
										  <td class="project-name">
											<div class="user-block" ><img class="img-circle img-bordered-sm" src="images/user-icon.png" > <span>Vinoth SN</span> </div>
										  </td>
										  <td>6:28:55</td>
										  <td>7:00:01</td>
										  <td>8:00:12</td>
										  <td>7:12:45</td>
										  <td>8:34:22</td>
										  <td>0:00:00</td>
										  <td>7:28:55</td>
										  <td class="number-bold ">44:45:10</td>
										</tr>
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
