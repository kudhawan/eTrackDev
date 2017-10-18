<body class="dashboard-bg">
    
	    <div id="wrapper">

			<!-- Sidebar -->
			<?php echo $this->element('sidebar');?>
			<!-- /#sidebar-wrapper -->

			<!-- Page Content -->
			<div id="page-content-wrapper">
				<div class="dashboard-top-bar">
					<div class="top-bar-left">
						<a href="#menu-toggle"  id="menu-toggle"><span class="fa fa-long-arrow-left"></span> Budget Calculator</a>
					</div>
					 <?php echo $this->element('topbar');?>
				</div>
				
				
				
				<!-- //////// Content Part START ///////// -->
				
						<div class="col-lg-12">
							<div class="page-heading"><h1><span class="fa fa-home"></span> Edit Budget</h1></div>
						</div>
						<form method="POST" name="" id="editBudget" action="<?php echo HTTP_ROOT.'financial/edit.json' ?>">
							<input type="hidden" name="id" value="<?php echo $getBudget['id'];?>">
							<div class="col-lg-12">
								<div class="box-dashboard">
									<div class="row">
										<div class="col-lg-6">
											<div class="top-margin">
												<div class="inner-box-heading line-bottom">Budget Details</div>
                                                
                                                <div class="ui-form"><label>No of Persons</label>
													<select class="chosen required" name="position_id">
															<option value="">-- Select Position --</option>
															<?php foreach($positionList as $positionListdata):?>
																<option <?php echo ($positionListdata['id'] == $getBudget['position_id']) ? 'selected': ''; ?> value="<?php echo $positionListdata['id']; ?>"><?php echo $positionListdata['title']; ?></option>
															<?php endforeach;?>
														</select></div>
                                                
                                                
                                                    
												<div class="ui-form"><label>No of Persons</label>
													<input type="number" name="no_of_resource" class="required nop" value="<?php echo $getBudget['no_of_resource'];?>"></div>
												<div class="ui-form">
													<label>Hours required/person</label>
													<input type="number" name="hrs" class="required hrsr" value="<?php echo $getBudget['hrs'];?>">
												</div>
                                                <div class="ui-form">
													<label>Dollars/hr</label>
													<input type="number" name="cost_per_hr" class="required dph" value="<?php echo $getBudget['cost_per_hr'];?>">
												</div>
                                                 <div class="ui-form">
													<label>Total Cost</label>
													<input type="number" id="sub_total" name="sub_total" class="required" readonly value="<?php echo $getBudget['no_of_resource']*$getBudget['hrs']*$getBudget['cost_per_hr'];?>">
												</div>
                                                
                                                
												
												
												
												
												<div class="optional-button top-margin clearfix">
										
										<div class="center-buttons" align="center">
											<button  type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'financial/budget-calculation'?>"><span class="fa fa-ban"></span> Cancel</a>
										</div>
									</div>
                                                
                                                
                                                
                                    

											</div>
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
    <script>
  function updatevalue(){
		var totalcost=0;
			var nop=Number($('.nop').val());
			var hrsr=Number($('.hrsr').val());
			var dph=Number($('.dph').val());
			if(nop>0&&hrsr>0&&dph>0){
				var tc=Number(nop*hrsr*dph);
				totalcost+=tc;
				$('#sub_total').val(tc);
			}else{
				$('#sub_total').val('');
			}
		if(totalcost>0){
			$('#sub_total').val(totalcost);
		}else{
			$('#sub_total').val('');
		}
	}
	$('body').on('change','.nop, .hrsr, .dph', function(){
       updatevalue();
    });
	
	</script>