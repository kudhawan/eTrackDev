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
<!-- Project Payment Modal -->
<div class="modal fade" id="projectAddPayment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 class="modal-title" id="myModalLabel">Add Payment</h4>
	  </div>
	  <form method="post" id="projectPaymentForm" action="<?php echo HTTP_ROOT.'financial/add-payment.json'; ?>">
	  <div class="modal-body">
		<div class="input-text-box">
			<input type="text" class="form-control" required name="company_name" placeholder="Company Name">
		</div>
		<div class="input-text-box">
			<input type="text" class="form-control" required name="client_name" placeholder="Client Name">
		</div>
		<div class="input-text-box">
			<input type="email" class="form-control" required name="email" placeholder="Email Address (Invoice will send to this address.)">
		</div>
		<div class="input-text-box">
			<label>Address</label>
			<input type="text" class="form-control" required name="address1" placeholder="Address will be printed in invoice">
		</div>
		<div class="input-text-box">
			<input type="text" class="form-control" required name="address2" placeholder="">
		</div>
		<div class="input-text-box">
			<input type="text" class="form-control" required name="address3" placeholder="">
		</div>
		<div class="input-text-box">
			<input type="number" class="form-control" min="1" required name="amt" placeholder="Add amount">
		</div>
		<div class="input-text-box">
			<textarea class="form-control" required name="particulars" placeholder="Invoice Particulars Content"></textarea>
		</div>
		<div class="input-text-box">
			<textarea class="form-control" required name="notes" placeholder="Add your comments"></textarea>
		</div>
		<input type="hidden" name="project_id" value="<?= $projectId; ?>" />
	  </div>
	  <div class="modal-footer">
		<div class="input-text-box">
			<button type="submit" class="btn corner blue l-width"><span class="fa fa-save"></span> Confirm</button>
		</div>
	  </div>
	  </form>
	</div>
  </div>
</div>
<?php
$total_budget = $total_payment = 0;
foreach($budgetDetails as $budgetDetailsData):
	$total_budget += $budgetDetailsData->no_of_resource * ($budgetDetailsData->hrs * $budgetDetailsData->cost_per_hr);
endforeach;

foreach($paymentDetails as $paymentDetailsData):
	if($paymentDetailsData->status == 3):
		$total_payment += $paymentDetailsData->amt;
	endif;
endforeach;

if(($total_budget - $total_payment) > 0)
	$balance_payment = ($total_budget - $total_payment);
else
	$balance_payment = 0;
	
?>
<?php if($balance_payment > 0){ ?>
<a class="btn corner btn-success pull-right" data-toggle="modal" data-target="#projectAddPayment" alt="Add new payment" data-original-title="Add new payment"><span class="fa fa-plus"></span> Add Invoice</a>
<?php } ?>
<table class="table table-bordered">
	<thead>
		<tr>
		  <th>Date</th>
		  <th>Invoice Code</th>
		  <th>Added By</th>
		  <th>Amount</th>
		  <th>Status</th>
		  <th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php $total_invoice = $totalPayment = 0; foreach($paymentDetails as $recordData): 
	if($recordData->status <= 3):
		$total_invoice += $recordData->amt;
	endif;
	
	if($recordData->status == 3):
		$totalPayment += $recordData->amt;
	endif;
	$currentState = '';
	if($recordData->status == 1):
		$currentState = 'Invoice Prepared';
	elseif($recordData->status == 2):
		$currentState = 'Invoice Sent';
	elseif($recordData->status == 3):
		$currentState = 'Paid';
	elseif($recordData->status == 4):
		$currentState = 'Invoice Cancelled';
	endif;
	 ?>
		<tr>
		  <td class="text-left"><?= $recordData->created; ?></td>
		  <td class="text-left"><?= $recordData->code; ?></td>
		  <td><?= $recordData->user['name']; ?></td>
		  <td class="text-right"><?= $recordData->amt; ?></td>
		  <td class="text-right statusText"><?= $currentState; ?></td>
		  <td class="text-center">
		  <!--<a class="btn btn-primary corner" href="<?php echo HTTP_ROOT; ?>financial/view-pdf/<?= base64_encode(convert_uuencode($recordData->id)); ?>.pdf" target="_blank" alt="View Invoice" data-toggle="tooltip" data-original-title="View Invoice"><span class="fa fa-eye"></span></a>-->
		  <?php	if($recordData->status < 3): ?>
		  <a class="btn blue corner sendBtn sendInvoice" data-id="<?= base64_encode(convert_uuencode($recordData->id)); ?>" alt="Task List">Send Invoice</a>
		  <?php endif; ?>
		  <?php	if($recordData->status < 3): ?>
		  <a class="btn green corner payBtn payInvoice" data-id="<?= base64_encode(convert_uuencode($recordData->id)); ?>" alt="Task List">Paid</a>
		  <?php endif; ?>
		  <?php	if($recordData->status < 3): ?>
		  <a class="btn orange corner cancelBtn cancelInvoice" data-id="<?= base64_encode(convert_uuencode($recordData->id)); ?>" alt="Task List">Cancel</a>
		  <?php endif; ?>
		  <?php	if($recordData->status < 3 || $recordData->status == 4): ?>
		  <a data-project-id="<?= base64_encode(convert_uuencode($recordData->project_id)); ?>" data-id="<?= $recordData->id; ?>" class="btn red corner removePayment" style="cursor: pointer;" alt="Delete Invoice" data-toggle="tooltip" data-original-title="Delete Invoice"><span class="fa fa-remove"></span></a>
		  <?php endif; ?>
		</tr>
	<?php endforeach; ?>
	</tbody>
	<tfoot>
		<tr>
		  <td colspan="3" class="text-right">Total Invoiced</td>	
		  <td class="text-right"><?= $total_invoice; ?></td>
		  <td colspan="2"></td>
		</tr>
		<tr>
		  <td colspan="3" class="text-right">Total Paid</td>	
		  <td class="text-right"><?= $totalPayment; ?></td>
		  <td colspan="2"></td>
		</tr>
		<tr>
		  <td colspan="3" class="text-right">Project Budget</td>	
		  <td class="text-right"><?= $total_budget; ?></td>
		  <td colspan="2"></td>
		</tr>
		<tr>
		  <td colspan="3" class="text-right">Balance Payment</td>	
		  <td class="text-right"><?= $balance_payment; ?></td>
		  <td colspan="2"></td>
		</tr>
	 </tfoot>
</table>
<script>

	$(document).ready(function(){
		
		$('#projectPaymentForm').validate();	
		$('#projectPaymentForm').ajaxForm({
			beforeSubmit: function(arr){
				btton = $('#projectPaymentForm').find('button[type="submit"]');
				btton.after('<i class="fa fa-spinner fa-spin"></i>');
				btton.attr('disabled', 'disabled')
			},
			success: function(resp){
				showFlashMsg(resp.message);
				if(resp.url){
					setTimeout(function(){
						location.href = ajax_url + resp.url;
					}, 2000);
				}
			},
			complete: function(){
				button = $('#projectPaymentForm').find('button[type="submit"]');
				button.attr('disabled', false);
				button.siblings('i.fa-spinner').remove();
			}
			
		});
		
	});
	
	
</script>