<div class="users form large-9 medium-8 columns content"> 
	<div class="col-sm-12">
		<?= $this->Form->create(null, array('action' => 'change_password' , 'class' =>'form-validate')) ?>
		<fieldset>
			<legend><?= __('Change Password') ?></legend>
			<?php
				echo $this->Form->input('old_password', array('required' => true, 'type' => 'password'));
				echo $this->Form->input('new_password', array('required' => true, 'type' => 'password'));
				echo $this->Form->input('confirm_password', array('required' => true, 'type' => 'password'));
			?>
		</fieldset>
		<?= $this->Form->button(__('Submit'),array('class' => 'btn btn-success')) ?>
		<?= $this->Form->end()?>
	</div>
</div>
