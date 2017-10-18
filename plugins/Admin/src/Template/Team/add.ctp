<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($team, array('type' => 'file', 'class' =>'form-validate')) ?>
    <fieldset>
        <legend><?= __('Add Team Member') ?></legend>
        <?php
            echo $this->Form->input('name', array('label' => 'Name'));
            echo $this->Form->input('designation');
            echo "<div class='input text'><label for='description'>Description</label>".$this->Form->textarea('description')."</div>";
            echo $this->Form->input('image', array('type' => 'file'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit') , ['class' =>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
