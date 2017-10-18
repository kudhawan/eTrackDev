<option value="">Select</option>
<?php foreach($teamMembers as $teamMember):?>
<option value="<?php echo $teamMember->user->id?>"><?php echo $teamMember->user->name?></option>
<?php endforeach;?>
