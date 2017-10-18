<div class="row top-margin">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<h1><?= $paymentDetails->company_name; ?></h1>
		<p><b><?= $paymentDetails->client_name; ?></b></p>
		<p><?= $paymentDetails->address1; ?><br/>
		<?= $paymentDetails->address2; ?><br/>
		<?= $paymentDetails->address3; ?></p>
		<p><b>Email : </b><?= $paymentDetails->email; ?></p>
	</div>
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
		<h1 class="">Invoice</h1>
		<p>Invoice #: <?= $paymentDetails->code; ?></p>
		<p>Date: <?= $paymentDetails->created; ?></p>
	</div>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
		  <th>Particular</th>
		  <th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<tr>
		  <td><?= $paymentDetails->particulars; ?></td>
		  <td class="text-right"><?= $this->Number->precision($paymentDetails->amt, 2) ?></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
		  <td colspan="" class="text-right">Sub Total</td>	
		  <td class="text-right"><?= $this->Number->precision($paymentDetails->amt, 2); ?></td>
		</tr>
		<tr>
		  <td colspan="" class="text-right">Grand Total</td>	
		  <td class="text-right"><?= $this->Number->precision($paymentDetails->amt, 2); ?></td>
		</tr>
	 </tfoot>
</table>
<div class="row top-margin">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<p><b>Notes :</b></p>
		<p><?= $paymentDetails->notes; ?></p>
	</div>
</div>