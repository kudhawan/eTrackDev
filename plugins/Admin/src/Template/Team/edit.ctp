<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($team, array('type' => 'file', 'class' =>'form-validate')) ?>
    <fieldset>
        <legend><?= __('Edit Team Member') ?></legend>
        <?php
			echo $this->Form->input('name', array('label' => 'Name'));
            echo $this->Form->input('designation');
            echo "<div class='input text'><label for='description'>Description</label>".$this->Form->textarea('description', array('label' => 'Description'))."</div>";
            echo $this->Form->input('image', array('type' => 'file'));
            echo '<img class="img-st" src="'.((isset($team->image) && $team->image) ? HTTP_ROOT."team_img/".$team->image : HTTP_ROOT.'team_img/defaultTeamImg.jpg').'">';
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit') , ['class' =>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
