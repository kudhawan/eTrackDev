<div class="index large-9 medium-8 columns content">
    <h2><?= __('Users') ?></h2>
    <form class="filter">
		<table class="table table-striped ">
		<tbody><tr valign="middle">
			<td><input type="text" name="name" placeholder="Name" value="<?php echo $this->request->query('name')?>"></td>
			<td><input type="text" name="email" placeholder="Email" value="<?php echo $this->request->query('email')?>"></td>
			<td>
				<select name="status">
					<option value="">Status</option>
					<option <?php echo $this->request->query('status') == '1' ? 'selected' :''?> value="1">Active</option>
					<option <?php echo $this->request->query('status') == '0' ? 'selected' :''?> value="0">Inactive</option>
				</select>
			</td>
			<td><input class="btn btn-success" type="submit" value="Submit"></td>
			<td><?php echo $this->Html->link('Reset', array('controller' => $this->request->controller, 'action' => $this->request->action), array('style' => 'btn'));?></a></td>
		</tr>
		</tbody></table>
	</form>
	<table id="Users" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', 'Name') ?></th>
                <th><?= $this->Paginator->sort('email') ?></th>
                <th><?= $this->Paginator->sort('phone') ?></th>
                <!--th><?= $this->Paginator->sort('level') ?></th-->
                <th><?= $this->Paginator->sort('status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user):?>
            <tr>
                <td><?= h($user->name) ?></td>
                <td><?= h($user->email) ?></td>
                <td><?= h($user->phone) ?></td>
                <!--td><?= $this->Form->input('level_id', array('options' => $levels, 'data-id' => $user->id, 'label' => false, 'value' => $user->level_id, 'templates' => array('inputContainer' => '{{content}}'))); ?></td-->
                <td>
					<div class="switch">
					  <input id="cmn-toggle-<?php echo $user->id?>" class="cmn-toggle cmn-toggle-round" name="status" data-id="<?php echo $user->id?>" type="checkbox" <?php echo $user->status ? 'checked' :''?>>
					  <label for="cmn-toggle-<?php echo $user->id?>"></label>
					</div>
                </td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
</div>
<?php echo $this->element('pagination')?>
