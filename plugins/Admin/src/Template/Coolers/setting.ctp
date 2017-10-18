<div class="index large-9 medium-8 columns content">
    <h2>
		<?php echo $cooler->name?>
    </h2>
    <?= $this->Form->create(null, array('id' =>'st-form-validate' , 'action'=>'setTemp')) ?>
		<!--table class="table table-striped ">
			<tbody>
				<tr valign="middle">
					<td>
						<?php echo $this->Form->input('from', array('label' => 'From' ,'class'=>'timepicker' ,'id'=>'fromTmpck' , 'required'));?>
					</td>
					<td>
						<?php echo $this->Form->input('to', array('label' => 'To','class'=>'timepicker','id'=>'toTmpck', 'required'));?>
						<?php echo $this->Form->input('cooler_id', array('type' => 'hidden' , 'value'=>"{$cooler->id}",'id'=>'clId'));?>
					</td>
					<td>
						<?php echo $this->Form->input('temperature', array('label' => 'Temperature (in celsius)', 'required'));?>
					</td>
					<td>
						<?= $this->Form->button(__('Submit') , ['class' =>'btn btn-success mr-b-tp']) ?>
					</td>
				</tr>
			</tbody>
		</table-->
	<?= $this->Form->end() ?>
	<table id="Coolers" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        <thead>
            <tr>
				<th><?= $this->Paginator->sort('created' , 'Date') ?></th>
                <th><?= $this->Paginator->sort('from', 'From') ?></th>
                <th><?= $this->Paginator->sort('to' , 'To') ?></th>
                <th><?= $this->Paginator->sort('temperature' , 'Temperature') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach ($tempSettings as $tempSetting):?>
            <tr>
                <td><?= h(date_format($tempSetting->created , "Y-m-d"));?></td>
                <td><?= h(date_format($tempSetting->from_duration,"H:i")) ?></td>
                <td><?= h(date_format($tempSetting->to_duration,"H:i")) ?></td>
                <td><?= h($tempSetting->temperature) ?></td>
                <td class="actions">
					<?php 
					//~ $endTime = date_format($tempSetting->to_duration, "H:i");
					//~ $createDate = date_format($tempSetting->created, "Y-m-d");
					
					//if(($createDate > date_format($currentDate, "Y-m-d") || $createDate == date_format($currentDate, "Y-m-d")) && ($endTime > date_format($currentDate, "H:i") || $endTime == date_format($currentDate, "H-i"))):
					?>
						<?php //echo $this->Html->link(__('Edit'), ['action' => 'settingEdit', $tempSetting->id]); ?>
						
					<?php //endif;?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'settingDelete', $tempSetting->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tempSetting->id)]) ?>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>    
</div>
<?php //echo $this->element('pagination')?>
