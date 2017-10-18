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
				<div class="page-heading"><h1><span class="fa fa-tasks"></span> <?php echo ucwords($projectDetail->name); ?></h1></div>
			</div>
			
			<div class="col-lg-12">
				<div class="box-dashboard">
					<div class="optional-button clearfix">
						<div class="right-buttons">
							<?php 
							
							$addnewoption = false;
							$editoption = false;
							$viewdetailsoption = true;
							$deleteoption = false;
							
							if(count($ownTeam)>0):
								foreach($ownTeam as $teamkey => $teamval):
									if(($teamval->member_id == $authUser['id'] && (in_array($teamval->position_id, [3]) || in_array($teamval->designation_id, [1,2,5]))) || $teamval->employer_id == $authUser['id']): 
										$addnewoption = true;
										$editoption = true;
										$viewdetailsoption = true;
										$deleteoption = true;
									endif; 
								endforeach;
							endif;
							if($projectDetail['user_id'] == $authUser['id']):
								$addnewoption = true;
								$editoption = true;
								$viewdetailsoption = true;
								$deleteoption = true;
							endif;
							?>
							<?php if($addnewoption): ?>
								<a href="<?php echo HTTP_ROOT.'new-feature/'.$id; ?>" class="btn corner blue"><span class="fa fa-plus"></span>Add New Feature</a>
							<?php endif; ?>
						</div>
					</div>
					<ul class="nav nav-tabs top-margin" role="tablist">
						<li role="presentation" class="active"><a href="#act-projects" aria-controls="act-projects" role="tab" data-toggle="tab">Active Features</a></li>
						<li role="presentation"><a href="#arc-projects" aria-controls="arc-projects" role="tab" data-toggle="tab">Closed Features</a></li>
						<li role="presentation"><a href="#dra-projects" aria-controls="dra-projects" role="tab" data-toggle="tab">Working Features</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="act-projects">
							<div class="table-design">
								<table class="table table-hover">
								  <thead>
									<tr>
									  <th>#</th>	
									  <th>Title</th>
									  <th>Description <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
									  <th>Worker</th>
									  <th>Start Date</th>
									  <th>End Date</th>
									  <th>Total Effort</th>
									  <th>Status</th>
									  <th>Actions</th>
									</tr>
								  </thead>
								  <tbody>
									<?php 
									if(!empty($openFeatures)):
										foreach($openFeatures as $key=>$val):
									?>
									<tr>	
										<td>
											<div class="checkbox">
											  <label>
												<input type="checkbox" value="">
												<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											  </label>
											</div>
										</td>	
										<td><?php echo $val->title?></td>
										<td><?php echo substr($val->description, 0,50).'...';?></td>
										<td><?php echo ucwords($val->user['name'])?></td>
										<td><?php echo $val->start_date;?></td>
										<td><?php echo $val->end_date;?></td>
										<td><?php echo $val->total_effort; ?></td>
										<td>
											<?php if($val->status == 1):?>
											<label class="status blue">Open<label>
											<?php elseif($val->status == 2): ?>
											<label class="status red">Close<label>
											<?php else: ?>
											<label class="status green">Working<label>
											<?php endif; ?>
										</td>
										<td>
											<?php if($editoption): ?>
											<a class="btn orange corner" href="<?php echo HTTP_ROOT.'edit-feature/'.base64_encode(convert_uuencode($val['id']))?>">
												<span class="fa fa-pencil-square-o"></span>
											</a>
											<?php endif; ?>
											<?php if($deleteoption): ?>
											<a class="btn red corner" href="<?php echo HTTP_ROOT.'delete/Features/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete Bug" onclick="return confirm('Are you sure you want to delete this Project?');">
												<span class="fa fa-trash"></span>
											</a>
											<?php endif; ?>
											<?php if($viewdetailsoption): ?>
											<a class="btn green corner" href="<?php echo HTTP_ROOT.'featurechat/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="Chat">
												<span class="fa fa-eye"></span>
											</a>
											<?php endif; ?>
											<?php if($val->file_name != ''): ?>
											<a class="btn blue corner" data-toggle="tooltip" data-original-title="Download Attachment" href="<?php echo HTTP_ROOT.'features/file-download/'.base64_encode(convert_uuencode($val['id']))?>">
												<span class="fa fa-download"></span>
											</a>
											<?php endif; ?>
										</td>
									</tr>
									<?php endforeach; endif;?>
								  </tbody>
								</table>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="arc-projects">
							<div class="table-design">
								<table class="table table-hover">
								  <thead>
									<tr>
									  <th>#</th>	
									  <th>Title</th>
									  <th>Description <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
									  <th>Worker</th>
									  <th>Start Date</th>
									  <th>End Date</th>
									  <th>Status</th>
									  <th>Actions</th>
									</tr>
								  </thead>
								  <tbody>
									<?php 
									if(!empty($closeFeatures)):
										foreach($closeFeatures as $key=>$val):
									?>
									<tr>	
										<td>
											<div class="checkbox">
											  <label>
												<input type="checkbox" value="">
												<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											  </label>
											</div>
										</td>	
										<td><?php echo $val->title?></td>
										<td><?php echo substr($val->description, 0,50).'...';?></td>
										<td><?php echo ucwords($val->user->name)?></td>
										<td><?php echo $val->start_date;?></td>
										<td><?php echo $val->end_date;?></td>
										<td>
											<?php if($val->status == 1):?>
											<label class="status blue">Open<label>
											<?php elseif($val->status == 2): ?>
											<label class="status red">Close<label>
											<?php else: ?>
											<label class="status green">Working<label>
											<?php endif; ?>
										</td>
										<td>
											<a class="btn orange corner" href="<?php echo HTTP_ROOT.'edit-bug/'.base64_encode(convert_uuencode($val['id']))?>">
												<span class="fa fa-pencil-square-o"></span>
											</a>
											
											<a class="btn red corner" href="<?php echo HTTP_ROOT.'delete/Features/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete Bug" onclick="return confirm('Are you sure you want to delete this Project?');">
												<span class="fa fa-trash"></span>
											</a>
											
											<a class="btn green corner" href="<?php echo HTTP_ROOT.'chat/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="Chat">
												<span class="fa fa-eye"></span>
											</a>
										</td>
									</tr>
									<?php endforeach; endif;?>
								  </tbody>
								</table>
							</div>
						
						</div>
						<div role="tabpanel" class="tab-pane" id="dra-projects">
							<div class="table-design">
								<table class="table table-hover">
								  <thead>
									<tr>
									  <th>#</th>	
									  <th>Title</th>
									  <th>Description <span class="fa fa-info-circle" data-toggle="tooltip" data-placement="bottom" title="Time in parenthesis is in user's time zone"></span></th>
									  <th>Worker</th>
									  <th>Start Date</th>
									  <th>End Date</th>
									  <th>Status</th>
									  <th>Actions</th>
									</tr>
								  </thead>
								  <tbody>
									<?php 
									if(!empty($workingFeatures)):
										foreach($workingFeatures as $key=>$val):
									?>
									<tr>	
										<td>
											<div class="checkbox">
											  <label>
												<input type="checkbox" value="">
												<span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
											  </label>
											</div>
										</td>	
										<td><?php echo $val->title?></td>
										<td><?php echo substr($val->description, 0,50).'...';?></td>
										<td><?php echo ucwords($val->user->name)?></td>
										<td><?php echo $val->start_date;?></td>
										<td><?php echo $val->end_date;?></td>
										<td>
											<?php if($val->status == 1):?>
											<label class="status blue">Open<label>
											<?php elseif($val->status == 2): ?>
											<label class="status red">Close<label>
											<?php else: ?>
											<label class="status green">Working<label>
											<?php endif; ?>
										</td>
										<td>
											<a class="btn orange corner" href="<?php echo HTTP_ROOT.'edit-bug/'.base64_encode(convert_uuencode($val['id']))?>">
												<span class="fa fa-pencil-square-o"></span>
											</a>
											
											<a class="btn red corner" href="<?php echo HTTP_ROOT.'delete/Features/'.base64_encode(convert_uuencode($val['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete Bug" onclick="return confirm('Are you sure you want to delete this Project?');">
												<span class="fa fa-trash"></span>
											</a>
											
											<a class="btn green corner" href="<?php echo HTTP_ROOT.'chat/'.base64_encode(convert_uuencode($val['id']))?>" alt="detail" data-toggle="tooltip"  data-original-title="Chat">
												<span class="fa fa-eye"></span>
											</a>
										</td>
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
