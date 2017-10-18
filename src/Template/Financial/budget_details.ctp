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
	  	<?php $i = 0; $total_cost = 0; foreach($budgetDetails as $records): 
			$total_cost += ($records->no_of_resource * ($records->hrs * $records->cost_per_hr));
			$i++;
		?>
				<tr class="budgetRecord" data-id="<?= $i; ?>">
					<td><?= $records->position['title']; ?></td>
					<td><input type="hidden" min="0" class="form-control nop" id="nop_<?= $i; ?>" value="<?= $records->no_of_resource; ?>"><?= $records->no_of_resource; ?></td>
					<td><input type="hidden" min="0" class="form-control hrsr" id="hrsr_<?= $i; ?>" value="<?= $records->hrs; ?>"><?= $records->hrs; ?></td>
					<td><input type="hidden" min="0" class="form-control dph" id="dph_<?= $i; ?>" value="<?= $records->cost_per_hr; ?>"><?= $records->cost_per_hr; ?></td>
					<td><input type="number" min="0" step="any" value="<?= ($records->no_of_resource * ($records->hrs * $records->cost_per_hr)); ?>" class="form-control tc" readonly></td>
					<td><div class="arbox" ><span data-id="<?= $records->id; ?>" class="removerow glyphicon glyphicon-remove" aria-hidden="true" style="cursor: pointer;" ></span>&nbsp;&nbsp;
                    <a class="btn orange corner" href="<?php echo HTTP_ROOT.'Financial/edit/'.base64_encode(convert_uuencode($records->id))?>" alt="Edit" data-toggle="tooltip"  data-original-title="Edit "><span class="fa fa-pencil-square-o"></span></a>
                    
                    
                   </div>
                    
                    
                    </td>
				</tr>
		<?php endforeach; ?>
		</tbody>
	<tfoot>
		<tr>
		  <td colspan="4" class="text-right">Sub Total</td>	
		  <td><input type="number" min="0" step="any" class="form-control" value="<?= $total_cost; ?>" id="sub_total" name="sub_total" readonly></td>
		  <td><div class="arbox" ><span  class="addrow glyphicon glyphicon-plus" aria-hidden="true" style="cursor: pointer;" ></span></div></td>
		</tr>
	 </tfoot>
</table>