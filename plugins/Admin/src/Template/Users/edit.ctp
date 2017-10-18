<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user , ['class' =>'form-validate']) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
			//echo $this->Form->input('level_id', array('options' => $levels, 'label' => 'Authority Level'));
			echo $this->Form->input('name', array('label' => 'Name'));
            echo $this->Form->input('email');
            echo $this->Form->input('phone');
            echo $this->Form->input('password', array('label' => 'New Password', 'value' => '', 'required' => false));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit') ,['class' => 'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
