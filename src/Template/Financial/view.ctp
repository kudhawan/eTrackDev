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
							<div class="page-heading"><h1><span class="fa fa-home"></span> Financial</h1></div>
						</div>
						
						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="optional-button top-margin clearfix">
									<div class="right-buttons">
										<a href="" role="button" class="btn corner blue">Reset</a>
										<button class="btn corner blue addrow" ><span class="fa fa-plus"></span> Add</button>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-12">
							<div class="box-dashboard">
								<div class="inner-box-heading">Project Budget Calculator</div>
								<div class="table-common">
									<table class="table table-bordered">
										<thead>
											<tr>
											  <th>#</th>	
											  <th>Employee type</th>
											  <th>No of person</th>
											  <th>Hours required/person</th>
											  <th>Dollars/hr</th>
											  <th>Total Cost</th>
											</tr>
										  </thead>
										  <tbody>
									
										</tbody>
										<tfoot>
											<tr>
											  <td colspan="5" class="text-right">Sub Total</td>	
											  <td><input type="number" min="0" step="any" class="form-control" id="sub_total" name="sub_total" readonly></td>
											  <td><div class="arbox" ><span  class="addrow glyphicon glyphicon-plus" aria-hidden="true" style="cursor: pointer;" ></span></div></td>
											</tr>
										  </tfoot>
									</table>
								</div>
							</div>
						</div>
						</div>

		</div>
		<!-- /#wrapper -->
  </body>

<script>
    var counter2 = 1;

 	function addrow(){
 		 $('table tbody').append( 
          '<tr><td>' + counter2 + '<input type="hidden" data-id="' + counter2 + '" class="form-control recordno" id="recordno_' + counter2 + '" name="recordno_' + counter2 + '" value=""  required></td><td><select class="form-control et" id="et_' + counter2 + '" name="et_' + counter2 + '"><option>Developer</option><option>Designer</option><option>Tester</option></select></td><td><input type="text" min="0" class="form-control nop" id="nop_' + counter2 + '" name="nop_' + counter2 + '"></td><td><input type="number" min="0" step="any" class="form-control hrsr" id="hrsr_' + counter2 + '" name="hrsr_' + counter2 + '"></td><td><input type="number" min="0" step="any" class="form-control dph" id="dph_' + counter2 + '" name="dph_' + counter2 + '" required></td><td><input type="number" min="0" step="any" class="form-control tc" id="tc_' + counter2 + '" name="tc_' + counter2 + '" readonly></td></tr>');
        counter2++;
 	}
 	
 	function updatevalue(){
		var totalcost=0;
		$('tr .recordno').each(function () {
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
    });
    $('body').on('change','.nop, .hrsr, .dph', function(){
       updatevalue();
    });
</script>
