		<?php
		use Cake\ORM\TableRegistry;
				$client_visible = '';
				$admin_visible = '';
				$worker_visible = '';
				$superadmin_visible = '';
				$user=$authUser['id'];
		        $team_tb = TableRegistry::get('Teams');
				$users_tb = TableRegistry::get('Users');
				
				$sadmin = $users_tb->find('all')->where(['Users.id' => $user,'Users.is_admin' => 3])->all();
				$wadmin = $users_tb->find('all')->where(['Users.id' => $user,'Users.is_admin' => 1])->all();
				$employer_visible= count($wadmin);
				
				$superadmin_visible= count($sadmin);
				$ownTeam = $team_tb->find('all')->where(['Users.status' => 1,'Teams.employer_id' => $user])->contain(['Users','Designations'])->all();
				
				//echo json_encode($ownTeam);
				foreach($ownTeam as $teamkey => $teamval):
				//echo $teamval->is_employer.",";
				//echo $teamval->designation_id.",";
							 if((in_array($teamval->designation_id, [1,4,5]))){
									   $client_visible = 1;
								  }
							  elseif((in_array($teamval->designation_id, [2]))){
									  $admin_visible = 1;
							  }
							  elseif((in_array($teamval->designation_id, [3]))){
									  $worker_visible = 1;
							  }
							  
						  endforeach;
														
														
					/*echo "client_".$client_visible."<br>";
					echo "admin_".$admin_visible."<br>";
					echo "worker_".$worker_visible."<br>";
					echo "superadmin_".$superadmin_visible."<br>";*/
														
				
		
		?>	
            
            
            
			<div id="sidebar-wrapper">
				<div class="logo-dashboard">
					<div class="logo"><a href="<?php echo HTTP_ROOT.'dashboard'?>">e Track</a></div>
				</div>
				<div id="MainMenu">
					<ul class="side-menu">
						
                        
                        <li class="<?php echo (in_array($this->request->controller , ['Dashboard']) && in_array($this->request->action , ['view'])) ? 'active' : '';?>">
							<a href="<?php echo HTTP_ROOT.'dashboard'?>"><span class="fa fa-dashboard"></span> Dashboard</a>
						</li>
                        <?php  if(($superadmin_visible==1)||($admin_visible==1)||($worker_visible==1)||($employer_visible==1)){ ?>
					  <li class="<?php echo (in_array($this->request->controller , ['Projects']) && in_array($this->request->action , ['create' , 'view' , 'edit'])) ? 'active' : ''; ?>">
						  <a href="#demo1"  data-toggle="collapse" data-parent="#MainMenu" aria-expanded=""><span class="fa fa-tasks"></span> Projects <i class="fa fa-caret-down pull-right"></i></a>
						  <ul class="collapse <?php echo (in_array($this->request->controller , ['Projects']) && in_array($this->request->action , ['create' , 'view', 'edit'])) ? 'in' : ''; ?>" id="demo1">
							<?php if($employer_visible!=1){ ?>
                            <li class="<?php echo (in_array($this->request->controller , ['Projects']) && in_array($this->request->action , ['create'])) ? 'active' : ''; ?>"><a href="<?php echo HTTP_ROOT.'projects/create'?>" >New Projects</a></li>
                            <?php }  ?>
                            
							<li class="<?php echo (in_array($this->request->controller , ['Projects']) && in_array($this->request->action , ['view'])) ? 'active' : ''; ?>"><a href="<?php echo HTTP_ROOT.'projects'?>" >View Projects</a></li>
						  </ul>
					  </li>
                      <?php }  ?>
                       <?php  if(($superadmin_visible==1)||($admin_visible==1)){ ?>
					  <li class="<?php echo (in_array($this->request->controller , ['Financial']) && in_array($this->request->action , ['budgetCalculation' , 'projectBudget'])) ? 'active' : ''; ?>">
						  <a href="#financeMenu"  data-toggle="collapse" data-parent="#financeMainMenu" aria-expanded=""><span class="fa fa-line-chart"></span> Financial <i class="fa fa-caret-down pull-right"></i></a>
						  <ul class="collapse <?php echo (in_array($this->request->controller , ['Financial']) && in_array($this->request->action , ['budgetCalculation' , 'projectBudget'])) ? 'in' : ''; ?>" id="financeMenu">
							<li class="<?php echo (in_array($this->request->controller , ['Financial']) && in_array($this->request->action , ['budgetCalculation'])) ? 'active' : ''; ?>"><a href="<?php echo HTTP_ROOT.'financial/budget-calculation'?>" >Budget Calculation</a></li>
							<li class="<?php echo (in_array($this->request->controller , ['Financial']) && in_array($this->request->action , ['projectBudget'])) ? 'active' : ''; ?>"><a href="<?php echo HTTP_ROOT.'financial/project-budget'?>" >Project Budget</a></li>
						  </ul>
					  </li>
                       <?php }  ?>
					  </li>
                      <?php  if(($superadmin_visible==1)||($admin_visible==1)){ ?>
					  <li class="<?php echo (in_array($this->request->controller , ['Employers']) && in_array($this->request->action , ['view', 'edit'])) ? 'active' : '';?>"><a href="<?php echo HTTP_ROOT.'members'?>"><span class="fa fa-users"></span> Members</a>
						  <!--<ul class="collapse" id="demo5">
							<li><a href="employee-dash-screenshots.html" >Admin</a></li>
							<li><a href="employee-dash-documents.html" >Workers</a></li>
							<li><a href="employee-dash-activities.html" >Viewer/Clients</a></li>
						  </ul>-->
					  </li>
                      <?php }  ?>
					  <li class="<?php echo (in_array($this->request->controller , ['Activity']) && (in_array($this->request->action , ['documentView' , 'documentCreate']) || in_array($this->request->action , ['screenshotView' , 'screenshotCreate']))) ? 'active' : ''; ?>"><a href="#demo2"  data-toggle="collapse" data-parent="#MainMenu"><span class="fa fa-briefcase"></span> Activity  <i class="fa fa-caret-down pull-right"></i></a>
						  <ul class="collapse <?php echo (in_array($this->request->controller , ['Activity']) && (in_array($this->request->action , ['documentView' , 'documentCreate']) || in_array($this->request->action , ['screenshotView' , 'screenshotCreate']))) ? 'in' : ''; ?>" id="demo2">
							<li class="<?php echo (in_array($this->request->controller , ['Activity']) && (in_array($this->request->action , ['screenshotView']) || in_array($this->request->action , ['screenshotCreate']))) ? 'active' : ''; ?>"><a href="<?php echo HTTP_ROOT.'screenshots'?>" >Screenshots</a></li>
							<li class="<?php echo (in_array($this->request->controller , ['Activity']) && (in_array($this->request->action , ['documentView']) || in_array($this->request->action , ['documentCreate']))) ? 'active' : ''; ?>"><a href="<?php echo HTTP_ROOT.'documents'?>" >Documents</a></li>
							<li><a href="<?php echo HTTP_ROOT.'activites'?>" >Activities</a></li>
							<li><a href="<?php echo HTTP_ROOT.'description'?>" >Description</a></li>
						  </ul>
					  </li>
                       <?php  if(($superadmin_visible==1)||($admin_visible==1)||($worker_visible==1)||($employer_visible==1)){ ?>
					  <li class="<?php echo ($this->request->action == 'timesheet') ? 'active' : '';?>"><a href="<?php echo HTTP_ROOT.'timesheet'?>" ><span class="fa fa-clock-o"></span> Timesheet </a>
					  </li>
					<?php }  ?>
                      
                       <li class="<?php echo ($this->request->action == 'brands') ? 'active' : '';?>"><a href="<?php echo HTTP_ROOT.'brands'?>" ><span class="fa fa-bar-chart"></span> bTrack </a>
					  </li>
                       <?php  if(($superadmin_visible==1)){ ?>
                       <li class="<?php echo ($this->request->action == 'clients') ? 'active' : '';?>"><a href="<?php echo HTTP_ROOT.'clients'?>" ><span class="fa fa-user"></span> Manage Users </a>
					  </li>
                       <?php }  ?>
                      
					</ul>
				</div>
				<div class="user-profile">
					<div class="notify">
						<a href="#" id="notification">
						  <i class="fa fa-bell-o"></i>
						  <span class="label label-warning">10</span>
						  Notification
						</a>
					</div>
					<div style="display:none" class="alert_list">
					  <ul class="unstyled">
						<li><a href="#">change the wireframe design</a> </li>
						<li><a href="#">New task to accomplish this week...</a> </li>
						<li><a href="#">client has sent you feedback</a> </li>
					  </ul>
					</div>
					<div class="user-panel">
						<div class="pull-left image">
						  <img src="<?php echo HTTP_ROOT.'images/user-icon.png'; ?>" class="img-circle" alt="User Image">
						</div>
						<div class="pull-left info">
						  <p><?php echo $authUser['name']?>
						  </p>

						  <a href="#"><i class="fa fa-circle user-online"></i> Online</a>
						
						  <a data-target="#changePassword" data-toggle="modal" href="#"><i class="fa fa-key"></i>Change Password</a>

						  <a href="<?php echo HTTP_ROOT.'logout'?>"><i class="fa fa-power-off"></i> Sign out</a>
						</div>
					 </div>
				</div>
		</div>


	