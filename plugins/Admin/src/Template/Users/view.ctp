<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->name)?></h3>
    <table id="Users" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        
        <tr>
            <th><?= __('Status') ?></th>
             <td><div class="switch">
			  <input id="cmn-toggle-<?php echo $user->id?>" class="cmn-toggle cmn-toggle-round" name="status" data-id="<?php echo $user->id?>" type="checkbox" <?php echo $user->status ? 'checked' :''?>>
			  <label for="cmn-toggle-<?php echo $user->id?>"></label>
			</div> </td>
        </tr>
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Email') ?></th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th><?= __('Phone') ?></th>
            <td><?= h($user->phone) ?></td>
        </tr>
		<tr>
            <th><?= __('Registered At') ?></th>
            <td><?= h($user->created) ?></td>
        </tr>
        
        <tr>
            <th><?= __('Modified At') ?></th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
