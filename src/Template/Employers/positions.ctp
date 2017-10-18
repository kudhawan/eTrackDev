<?php if(count($datas) > 0): 
if($positionField == ''):
	$positionField = 'position';
endif;
?>
<dummy class="position">
<select class="chosen required" name="<?php echo $positionField; ?>"><option value="">-- Select Position --</option>
<?php foreach($datas as $data):
		if($selectedposition == $data['id']):
			$selected = 'selected';
		else:
			$selected = '';
		endif;
?>
<option <?php echo $selected; ?> value="<?php echo $data->id; ?>"><?php echo $data->title; ?></option>
<?php endforeach;?>
</select>
</dummy>
<?php endif; ?>