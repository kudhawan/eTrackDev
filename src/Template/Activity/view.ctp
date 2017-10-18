<body class="dashboard-bg">    
	<div id="wrapper">
		<!-- Sidebar -->
			<?php echo $this->element('sidebar')?>
		<!-- /#sidebar-wrapper -->

		<!-- Page Content -->
		<div id="page-content-wrapper">
			<div class="dashboard-top-bar">
				<div class="top-bar-left">
					<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-bars"></span> Menu</a>
				</div>
				 <?php echo $this->element('topbar');?>
			</div>			
			<!-- //////// Content Part START ///////// -->
				
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> User Activities</h1></div>
						</div>
				
			
			
			<div class="col-lg-12">
				<div class="box-dashboard">
					<div class="optional-button clearfix">
                   
                                                <div style="float:right">
                             <select name="user_id" id="user_id" class="act_search">
													<option value="">Select User</option>
                                                    <?php foreach($usersList as $key => $val):?>
															<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													
												</select>&nbsp;&nbsp;
                                                
                                                  <select name="action" id="action" class="act_search">
													<option value="">Select Activity</option>
													<?php foreach($actionsList as $key => $val):?>
															<option value="<?php echo $val['action'] ?>"><?php echo $val['action'] ?></option>
														<?php endforeach;?>
												</select>
                                                </div>
						
					</div>
					
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="act-projects">
							<div class="table-design" id="activity_div">
								<table class="table table-hover" id="activity_table">
								  <thead>
									<tr>
									  <th width="10%">User</th>
									  <th width="15%">Action </th>
                                      <th>Activity</th>
                                      <th>Date Time</th>
									 
									</tr>
								  </thead>
								  <tbody>
									<?php 
									use Cake\ORM\TableRegistry;

									if(!empty($openActivities)):
										foreach($openActivities as $key=>$val):
										$user_id = $val->user_id;
										$users_tb = TableRegistry::get('Users');
										$getUser= $users_tb->find()->where(['Users.id' => $user_id])->first();
										$username= $getUser->name;

									?>
									<tr>	
											
										<td><?php echo $username; ?></td>
										<td><?php echo $val->action; ?></td>
                                        <td><?php echo $val->description; ?></td>
                                        <td><?php echo date_format($val->created, 'g:ia \o\n l jS F Y');    ?></td>
										
										
									</tr>
									<?php endforeach; endif;?>
								  </tbody>
								</table>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>				
			<!--- //////// Content Part END ///////// --->
		</div>
		<!-- /#page-content-wrapper -->
	</div>
</body>