<div class="users view large-9 medium-8 columns content">
    <h3><?= h($cooler->name)?></h3>
    <table id="Users" cellpadding="0" cellspacing="0" class="table table-striped table-hover table-bordered dataTable no-footer">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($cooler->name) ?></td>
        </tr>
        <tr>
            <th><?= __('User') ?></th>
            <td><?= h($cooler->user->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Threshold Temprature (C)') ?></th>
            <td><?= h($cooler->max_temp) ?></td>
        </tr>
    </table>
</div>
