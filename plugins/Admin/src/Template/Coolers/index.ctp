<div class="index large-9 medium-8 columns content">
    <h2>
		<?= __('Coolers') ?>
		<a style="float:right" class="btn btn-success uppercase" href="<?php echo HTTP_ROOT.'administrator/coolers/add'?>">Add Cooler</a>
    </h2>
    
    <form class="filter">
		<table class="table table-striped ">
		<tbody><tr valign="middle">
			<td><input type="text" name="name" placeholder="Name" value="<?php echo $this->request->query('name')?>"></td>
			<td>
				<select name="user_id">
					<option value="">Users</option>
					<?php foreach($users as $userId=>$user):?>
					<option <?php echo $this->request->query('user_id') == $userId ? 'selected' :''?> value="<?php echo $userId?>"><?php echo $user?></option>
					<?php endforeach;?>
				</select>
			</td>
			<td><input class="btn btn-success" type="submit" value="Submit"></td>
			<td><?php echo $this->Html->link('Reset', array('controller' => $this->request->controller, 'action' => $this->request->action), array('style' => 'btn'));?></a></td>
		</tr>
		</tbody></table>
	</form>
	<table id="Coolers" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', 'Name') ?></th>
                <th><?= $this->Paginator->sort('user_id' , 'User') ?></th>
                <th><?= $this->Paginator->sort('max_temp' , 'Threshold Temprature (C)') ?></th>
                <th><?= $this->Paginator->sort('status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($coolers as $cooler):?>
            <tr>
                <td><?= h($cooler->name) ?></td>
                <td><?= h($cooler->user->name) ?></td>
                <td><?= h($cooler->max_temp) ?></td>
                <td>
					<div class="switch">
					  <input id="cmn-toggle-<?php echo $cooler->id?>" class="cmn-toggle cmn-toggle-round" name="status" data-id="<?php echo $cooler->id?>" type="checkbox" <?php echo $cooler->status ? 'checked' :''?>>
					  <label for="cmn-toggle-<?php echo $cooler->id?>"></label>
					</div>
                </td>
                <td class="actions">
					<?= $this->Html->link(__('Setting'), ['action' => 'setting', $cooler->id]) ?>
                    <?= $this->Html->link(__('View'), ['action' => 'view', $cooler->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cooler->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cooler->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cooler->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
</div>
<?php echo $this->element('pagination')?>
