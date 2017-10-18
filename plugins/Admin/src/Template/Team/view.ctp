<div class="users view large-9 medium-8 columns content">
    <h3><?= h($team->name)?></h3>
    <table id="Users" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($team->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Designation') ?></th>
            <td><?= h($team->designation) ?></td>
        </tr>
        <tr>
            <th><?= __('Image') ?></th>
            <td><img class="img-st" src="<?php echo (isset($t->image) && $t->image) ? HTTP_ROOT.'team_img/'.$t->image : HTTP_ROOT.'team_img/defaultTeamImg.jpg'?>"></td>
        </tr>
        <tr>
            <th><?= __('Description') ?></th>
            <td><?= h($team->description) ?></td>
        </tr>
    </table>
</div>
