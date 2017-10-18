<?php
?>
<div class="table-responsive">
	<table class="table table-hover">
		<thead>
			<tr><th>Title</th><th>Value</th></tr>
		<thead>
		<tbody>
			<tr><td>User Name</td><td><?php echo $timeSheets->user->name; ?></td></tr>
			<tr><td>Project</td><td><?php echo $timeSheets->project->name; ?></td></tr>
			<tr><td>Designation</td><td><?php if(isset($getTeam->designation->name)){ echo $getTeam->designation->name; } ?></td></tr>
			<tr><td>Position</td><td><?php if(isset($getTeam->position->title)){echo $getTeam->position->title;} ?></td></tr>
			<tr><td>Worked As</td><td><?php if(isset($timeSheets->work['title'])){echo $timeSheets->work['title'];} ?></td></tr>
			<tr><td>Time Sheet Description</td><td><?php echo $timeSheets->reasons; ?></td></tr>
			<tr><td>Submited On</td><td><?php echo $timeSheets->created->format('M, d Y, H:i a'); ?></td></tr>
		<tbody>
	</table>
</div>