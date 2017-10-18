<div class="index large-9 medium-8 columns content">
    <h2>
		<?= __('Team') ?>
		<a style="float:right" class="btn btn-success uppercase" href="<?php echo HTTP_ROOT.'administrator/team/add'?>">Add Team Member</a>
    </h2>
    
    <form class="filter">
		<table class="table table-striped ">
		<tbody><tr valign="middle">
			<td><input type="text" name="name" placeholder="Name" value="<?php echo $this->request->query('name')?>"></td>
			<td><input type="text" name="designation" placeholder="Designation" value="<?php echo $this->request->query('designation')?>"></td>
			<td><input class="btn btn-success" type="submit" value="Submit"></td>
			<td><?php echo $this->Html->link('Reset', array('controller' => $this->request->controller, 'action' => $this->request->action), array('style' => 'btn'));?></a></td>
		</tr>
		</tbody></table>
	</form>
	<table id="Users" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('name', 'Name') ?></th>
                <th><?= $this->Paginator->sort('designation') ?></th>
                <th>Image</th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($team as $t):?>
            <tr>
                <td><?= h($t->name) ?></td>
                <td><?= h($t->designation) ?></td>
                <td><img class="img-st" src="<?php echo (isset($t->image) && $t->image) ? HTTP_ROOT.'team_img/'.$t->image : HTTP_ROOT.'team_img/defaultTeamImg.jpg'?>"></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $t->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $t->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $t->id], ['confirm' => __('Are you sure you want to delete # {0}?', $t->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>    
</div>
<?php echo $this->element('pagination')?>
