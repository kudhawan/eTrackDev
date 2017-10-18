<div class="ui-form top-margin">
	<label>Member #<?php echo $memberCount; ?> <a class="btn-sm corner red pull-right removeMoreButton" href=""><span class="fa fa-remove"></span></a></label>
	<input type="hidden" class="positionField" value="position<?php echo $memberCount; ?>" />
	<select class="chosen usersList required" name="user_id<?php echo $memberCount; ?>">
		<option value=''>---Select User---</option>
		<?php foreach($usersList as $key => $val):?>
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
		<?php endforeach;?>
	</select>
	<select class="chosen designationlist rolesList required" name="designation_id<?php echo $memberCount; ?>">
		<option value=''>---Select Role---</option>
		<?php foreach($designationsList as $key => $val):?>
			<option value="<?php echo $val['id'] ?>"><?php echo $val['name'] ?></option>
		<?php endforeach;?>
	</select>
</div>