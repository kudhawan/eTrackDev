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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Edit Project</h1></div>
						</div>
						<form method="POST" name="" id="editProject" action="<?php echo HTTP_ROOT.'Projects/edit.json' ?>">
							<input type="hidden" name="id" value="<?php echo $getProject['id'];?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Projects Details</div>
												<div class="ui-form"><label>Project Name</label>
													<input type="text" name="name" class="required" value="<?php echo $getProject['name'];?>"></div>
												<div class="ui-form">
													<label>Project Description</label>
													<textarea name="description" class="required"><?php echo $getProject['description']?></textarea>
												</div>
												<div class="clearfix">
													<div class="ui-form fl">
														<label>Start Date</label>
														<div class="input-group date lg" data-provide="datepicker">
															<input type="text" class="form-control required" name="start_date" placeholder="Start Date" value="<?php echo date('m/d/Y',strtotime($getProject['start_date'])) ?>">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</div>
													<div class="ui-form fr">
														<label>End Date</label>
														<div class="input-group date lg" data-provide="datepicker">
															<input type="text" name="end_date"
															class="form-control required" placeholder="End Date" value="<?php echo date('m/d/Y',strtotime($getProject['end_date']))?>">
															<div class="input-group-addon">
																<span class="glyphicon glyphicon-th"></span>
															</div>
														</div>
													</div>
												</div>
												
	<div class="clearfix">&nbsp;</div>											
												<div class="clearfix">
													<div class="ui-form fl"><label>Total Effort <small>(In hours)</small></label>
														<input type="number" name="total_effort" class="required" value="<?php echo $getProject['total_effort'];?>">
													</div>
													<div class="ui-form fr"><label>Designer Estimation <small>(In hours)</small></label>
														<input type="number" name="designer_hrs" class="required" value="<?php echo $getProject['designer_hrs'];?>">
													</div>
												</div>
												<div class="clearfix">
													<div class="ui-form fl"><label>Developer Estimation <small>(In hours)</small></label>
														<input type="number" name="developer_hrs" class="required" value="<?php echo $getProject['developer_hrs'];?>">
													</div>
													<div class="ui-form fr"><label>Tester Estimation <small>(In hours)</small></label>
														<input type="number" name="tester_hrs" class="required" value="<?php echo $getProject['tester_hrs'];?>">
													</div>
												</div>
												<div class="clearfix">
													<div class="ui-form">
														<label>Project Access</label>
														<input type="radio" name="access" value="0" <?php echo $getProject['access'] == 0 ? 'checked' : ''?>><span>Public</span> 
														<input type="radio" name="access" value="1"  <?php echo $getProject['access'] == 1 ? 'checked' : ''?>><span>Private</span>
													</div>
												</div>
                                                
                                                
                                                <div class="clearfix">
                                                
                                                 <div class="ui-form">
												<label>Attachment</label>
												<input type="file" name="file_name">
                                                <?php  if(isset($getProject['file_name']) && $getProject['file_name']):?>
												<div style="display:inline-block">
													<p style="color:green;"><?php echo $getProject['file_name'] ?></p>
													<a href="#"></a>
												</div>
												<?php endif; ?>
											</div>
                                           </div>
                                           <div class="clearfix"> 
                                     <div class="ui-form">
													<label>Comments</label>
													<textarea name="comments" class="required"><?php echo $getProject['comments'];?></textarea>
								    </div>
                                    
                                    </div>
                                    
                                    

											</div>
										</div>
										<?php  ?><div class="col-lg-6">
											<div class="top-margin addMoreWrapper">
												<div class="inner-box-heading line-bottom">Manage Team <a class="btn-sm corner blue pull-right addMoreButton" href=""><span class="fa fa-plus"></span></a></div>
												<input type="hidden" value="<?php echo count($teamsList); ?>" name="addMoreCount" class="addMoreCount">
												<?php /* foreach($designationsList as $designationsData): ?>
												<div class="ui-form">
													<label><?php echo $designationsData->name; ?></label><span class="hints">(<?php echo $designationsData->name; ?> of this project's</span>
													<select class="chosen  usersList required" multiple="true">
														<?php 
														$designations = '';
														foreach($usersList as $key => $val):
															$selected = '';
															foreach($teamsList as $team):
																if($team->designation_id == $designationsData->id):
																	if($team->member_id == $val['id']):
																		$selected = 'selected';
																		$designations .= $team->member_id.',';
																	endif;
																endif;
															endforeach;
														?>
															<option <?php echo $selected; ?> value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
													<input type="hidden" value="<?php echo substr($designations, 0, strlen($designations)-1); ?>" name="<?php echo $designationsData->name; ?>" class="users">
												</div>
												<?php endforeach; */ ?>
												<?php $team_count = 0; foreach($teamsList as $teamsData): $team_count++; ?>
												<div class="ui-form top-margin">
													<label>Member #<?php echo $team_count; ?> <a class="btn-sm corner red pull-right" href="<?php echo HTTP_ROOT.'members/delete/'.base64_encode(convert_uuencode($teamsData['id'])); ?>" onClick="return confirm('Are you sure you want to delete this?');"><span class="fa fa-remove"></span></a></label>
													<input type="hidden" name="team_id<?php echo $team_count; ?>" value="<?php echo $teamsData->id; ?>" />
													<input type="hidden" class="positionField" value="position<?php echo $team_count; ?>" />
													<select class="chosen usersList required" name="user_id<?php echo $team_count; ?>">
														<option value=''>---Select User---</option>
														<?php foreach($usersList as $key => $val):?>
															<option <?php echo ($val['id'] == $teamsData->member_id) ? 'selected': ''; ?> value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
													<select class="chosen designationlist rolesList required" name="designation_id<?php echo $team_count; ?>">
														<option value=''>---Select Role---</option>
														<?php foreach($designationsList as $key => $val):?>
															<option <?php echo ($val['id'] == $teamsData->designation_id) ? 'selected': ''; ?> value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
														<?php endforeach;?>
													</select>
													<?php if($teamsData->position_id != ''): ?>
													<dummy class="position">
														<select class="chosen required" name="position<?php echo $team_count; ?>">
															<option value="">-- Select Position --</option>
															<?php foreach($positionList as $positionListdata):?>
																<option <?php echo ($positionListdata['id'] == $teamsData->position_id) ? 'selected': ''; ?> value="<?php echo $positionListdata['id']; ?>"><?php echo $positionListdata['title']; ?></option>
															<?php endforeach;?>
														</select>
													</dummy>
													<?php endif; ?>
												</div>
												<?php endforeach; ?>
											</div>
										</div><?php  ?>
									</div>	
									
									
									<div class="optional-button top-margin clearfix">
										<div class="left-buttons">
											<a class="btn red corner" href="<?php echo HTTP_ROOT.'projects/delete/'.base64_encode(convert_uuencode($getProject['id'])); ?>" alt="Delete" data-toggle="tooltip"  data-original-title="Delete project" onClick="return confirm('Are you sure you want to delete this Project?');"><span class="fa fa-trash"></span> Delete</a>
											<button class="btn corner"><span class="fa fa-archive"></span> Archived</button>
										</div>
										<div class="center-buttons" align="center">
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