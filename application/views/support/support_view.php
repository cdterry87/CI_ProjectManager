<?php echo anchor('support/form/'.$support['support_id'],'Edit Support','class="btn btn-block btn-lg btn-primary"'); ?>

<?php echo form_open_multipart('support/action'); ?>
<?php echo form_hidden('support_id',$support['support_id']); ?>

<h1><?php echo $support['support_name']; ?></h1>

<table class="table table-condensed">
	<tr>
		<td width="10%"><strong>Support Date:</strong></td>
		<td><?php echo $this->format->date($support['support_date'])." ".$this->format->time($support['support_time']); ?></td>
	</tr>
	<tr>
		<td><strong>Duration:</strong></td>
		<td><?php echo $support['support_duration_days']." days ".$support['support_duration_hours']." hours ".$support['support_duration_minutes']." minutes"; ?></td>
	</tr>
	<tr>
		<td colspan="2"><strong>Details:</strong></td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $support['support_details']; ?></td>
	</tr>
	<tr>
		<td><strong>Support Tag(s):</strong></td>
		<td><?php echo $support['support_tags']; ?></td>
	</tr>
</table>

<hr/>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Customer</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($customer)){
				?>
				<tr>
					<td>Support issue is not currently assigned to a customer.</td>
				</tr>
				<?php
					}else{
						foreach($customer as $row){
				?>
				<tr>
					<td><?php echo $row['customer_name']; ?></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Assigned Department(s)</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($departments)){
				?>
				<tr>
					<td>Support issue is not currently assigned to any departments.</td>
				</tr>
				<?php
					}else{
						foreach($departments as $row){
				?>
				<tr>
					<td><?php echo $row['department_name']; ?></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Assigned Employee(s)</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($employees)){
				?>
				<tr>
					<td>Support issue is not currently assigned to any employees.</td>
				</tr>
				<?php
					}else{
						foreach($employees as $row){
				?>
				<tr>
					<td><?php echo $row['employee_name']; ?></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>

<hr/>

<h3>Attached Files</h3>
<table class="table table-striped">
	<thead>
		<tr>
			<td>
				<?php echo form_upload('userfile'); ?>
			</td>
			<td width="10%">
				<?php echo form_submit('action','Add File','class="btn btn-block btn-primary"'); ?>
			</td>
		</tr>
	</thead>
	<tbody>
		<?php
			$file_num=0;
			if(empty($files)){
		?>
		<tr>
			<td colspan="2">Support issue does not currently have any attached files.</td>
		</tr>
		<?php
			}else{
				foreach($files as $row){
					$file_num++;
		?>
		<tr>
			<td><?php echo anchor('public/files/support/'.$row['support_id']."/".$row['file_name'],$file_num.". ".$row['file_name'],'target="_blank"'); ?></td>
			<td><?php echo anchor('support/delete_file/'.$row['support_id'].'/'.$row['file_id'],'','class="btn btn-danger glyphicon glyphicon-trash"'); ?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>

<?php
switch($support['support_status']){
	case "A":
		echo form_submit('action','Restore Issue','class="btn btn-lg btn-success btn-block" data-confirm="Are you sure you want to restore this support issue?"');
		break;
	case "C":
		echo form_submit('action','Open Issue','class="btn btn-lg btn-success btn-block" data-confirm="Are you sure you want to open this support issue?"');
		echo form_submit('action','Archive Issue','class="btn btn-lg btn-warning btn-block" data-confirm="Are you sure you want to archive this support issue?"');
		break;
	case "O":
		echo form_submit('action','Close Issue','class="btn btn-lg btn-success btn-block" data-confirm="Are you sure you want to complete this support issue?"');
		echo form_submit('action','Archive Issue','class="btn btn-lg btn-warning btn-block" data-confirm="Are you sure you want to archive this support issue?"');
		break;
}
?>

<?php echo form_close(); ?>