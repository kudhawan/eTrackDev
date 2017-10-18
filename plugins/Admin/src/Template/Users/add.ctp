<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
			echo $this->Form->input('level_id', array('options' => $levels, 'label' => 'Authority Level'));
            echo $this->Form->input('name', array('label' => 'Name'));
            echo $this->Form->input('email');
            echo $this->Form->input('duration', ['class'=>'timepicker']);
            echo $this->Form->input('password');
            echo $this->Form->input('phone');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
