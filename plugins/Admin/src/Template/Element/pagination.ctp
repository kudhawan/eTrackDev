<div class="paginator">
	<strong>
	<?php
	echo $this->Paginator->counter('Page {{page}} of {{pages}}, showing {{current}} records out of
     {{count}} total, starting on record {{start}}, ending on {{end}}');
	?>
	</strong>
	<ul class="pagination" style="float:right">
		<?= $this->Paginator->prev('< ' . __('previous')) ?>
		<?= $this->Paginator->numbers() ?>
		<?= $this->Paginator->next(__('next') . ' >') ?>
	</ul>
</div>
