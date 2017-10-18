<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($tempSetting, array('id' =>'st-form-validate')) ?>
    <fieldset>
        <legend><?= __('Edit '.$tempSetting->cooler->name.' Setting') ?></legend>
        <?php
			$startTime = date_format($tempSetting->from_duration, "H:i");
			if(($startTime > date_format($currentTime, "H:i") || $startTime == date_format($currentTime, "H:i"))):
				echo $this->Form->input('from', array('label' => 'From' ,'class'=>'timepicker','id'=>'fromTmpck', 'value'=>"{$fromDuration}", 'required'));
			else:
				echo $this->Form->input('from', array('label' => 'From','disabled','value'=>"{$fromDuration}"));
				echo $this->Form->input('from', array('type'=>'hidden','value'=>"{$fromDuration}"));
			endif;
			echo $this->Form->input('to', array('label' => 'To','class'=>'timepicker','id'=>'toTmpck', 'value'=>"{$toDuration}", 'required'));
			echo $this->Form->input('temperature', array('label' => 'Temperature (in celsius)', 'required'));
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit') , ['class' =>'btn btn-success']) ?>
    <?= $this->Form->end() ?>
</div>
