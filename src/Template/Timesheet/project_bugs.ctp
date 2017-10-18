<?php if(isset($ownTeam->position_id)){if($ownTeam->position_id != 3): ?>
	<select id="pr-bugs" name="bug_id" class="">
		<option value="">Select Bug</option>
		<?php foreach($bugs as $key=>$bug):?>
		<option value="<?php echo $key;?>"><?php echo $bug;?></option>
		<?php endforeach;?>
	</select>
<?php endif; }?>