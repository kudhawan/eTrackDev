 <style>
.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
    background-color: #eee;
    opacity: 1;
    background: none;
    border: 0px;
    box-shadow: none;
}
.form-control {
    border-radius: 0px;
    box-shadow: none;
    border: 1px solid rgba(204, 204, 204, 0.42);
}
</style>
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
							<div class="page-heading"><h1><span class="fa fa-line-chart"></span> Budget Calculator</h1></div>
						</div>

						<div class="col-lg-12">
							<div class="box-dashboard">								
								<form method="post" id="commonForm" action="<?php echo HTTP_ROOT.'financial/budget-calculation.json'; ?>">
									
									<div class="ui-form">
										<label>Project</label>
										<select id="project_budget" name="project_id" class="required">
											<option value="">Select Project</option>
											<?php foreach($projects as $key => $project):?>
												<option value="<?php echo $project->id;?>"><?php echo $project->name;?></option>
											<?php endforeach;?>
										</select>
									</div>
									<div class="table-common" id="budget_calculation" style="display:none;">
										<table class="table table-bordered">
											<thead>
												<tr>
												  <th>Employee type</th>
												  <th>No of person</th>
												  <th>Hours required/person</th>
												  <th>Dollars/hr</th>
												  <th>Total Cost</th>
												  <th>Action</th>
												</tr>
											  </thead>
											  <tbody>
												</tbody>
											<tfoot>
												<tr>
												  <td colspan="4" class="text-right">Sub Total</td>	
												  <td><input type="number" min="0" step="any" class="form-control" id="sub_total" name="sub_total" readonly></td>
												  <td><div class="arbox" ><span  class="addrow glyphicon glyphicon-plus" aria-hidden="true" style="cursor: pointer;" ></span></div></td>
												</tr>
											 </tfoot>
										</table>
									</div>
									<div class="optional-button top-margin clearfix">
										<div class="center-buttons">
											<button type="submit" class="btn corner blue"><span class="fa fa-save"></span> Save</button>
											<a class="btn corner grey" href="<?php echo HTTP_ROOT.'financial/budget-calculation'; ?>"><span class="fa fa-ban"></span> Cancel</a>
                                            
										</div>
									</div>
								</form>
							</div>
						</div>
						</div>

		</div>
		<!-- /#wrapper -->
  </body>

<script>
    var counter2 = 1;
	
 	function addrow(){
		var removeButton = '';
		
		counter2 = $('#budget_calculation').find('table>tbody>tr').length;
		
	
		if(counter2 == 0)
			counter2 = 1;
		else
			counter2++;			
			
		if(counter2>1){
			removeButton = '<div class="arbox" ><span  class="removerow glyphicon glyphicon-remove" aria-hidden="true" style="cursor: pointer;" ></span></div>';
		}
 		 $('table tbody').append( 
          '<tr class="budgetRecord" data-id="'+counter2+'"><td><select class="form-control required et" id="et_' + counter2 + '" name="position_id[]"><option value="">-- Please Select --</option><option value="1">Designer</option><option value="2">Developer</option><option value="3">Tester</option></select></td><td><input type="text" min="0" class="form-control nop" id="nop_' + counter2 + '" name="no_of_resource[]" required></td><td><input type="number" min="0" step="any" class="form-control hrsr" id="hrsr_' + counter2 + '" name="hrs[]" required></td><td><input type="number" min="0" step="any" class="form-control dph" id="dph_' + counter2 + '" name="cost_per_hr[]" required></td><td><input type="number" min="0" step="any" class="form-control tc" id="tc_' + counter2 + '" name="totalamt[]" readonly></td><td>'+removeButton+'</td></tr>');
        counter2++;
 	}
	
 	function removerow(e){
		var budgetId = e.data('id');
		if(confirm('Are you sure you want to delete this Budget?')){
			if(budgetId){
				$.ajax({			
					type :'POST',
					data : {budgetId:budgetId},
					url:ajax_url+'financial/budgetDelete.json',
					beforeSend: function(){
					},
					success:function(resp){
						showFlashMsg(resp.message);
						if(resp.status == 'success'){
							e.parents('tr').remove();
							updatevalue();
						}
					}
				});
			} else {
				e.parents('tr').remove();
				counter2--;
				updatevalue();
			}
		}
 	}
	
 	function updatevalue(){
		var totalcost=0;
		$('tr.budgetRecord').each(function () {
			var id=$(this).data('id');
			var nop=Number($('#nop_'+id).val());
			var hrsr=Number($('#hrsr_'+id).val());
			var dph=Number($('#dph_'+id).val());
			if(nop>0&&hrsr>0&&dph>0){
				var tc=Number(nop*hrsr*dph);
				totalcost+=tc;
				$('#tc_'+id).val(tc);
			}else{
				$('#tc_'+id).val('');
			}
		});
		if(totalcost>0){
			$('#sub_total').val(totalcost);
		}else{
			$('#sub_total').val('');
		}
	}
	addrow();
	$('body').on('click','.addrow', function(){
       addrow();
       updatevalue();
    });
	$('body').on('click','.removerow', function(){
       removerow($(this));
    });
    $('body').on('change','.nop, .hrsr, .dph', function(){
       updatevalue();
    });
	$('body').on('click','.updaterow', function(){
       var id=$(this).data('id');
	   alert(id);
    });
	
</script>