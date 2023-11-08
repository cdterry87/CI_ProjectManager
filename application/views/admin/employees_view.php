<?php echo anchor('admin/employees/form/'.$employee['employee_id'],'Edit Employee','class="btn btn-block btn-lg btn-primary"'); ?>

<h1><?php echo $employee['employee_name']; ?></h1>

<table class="table table-condensed">
	<tr>
		<td width="10%"><strong>Username:</strong></td>
		<td>
			<?php echo $employee['employee_username']; ?>
			<?php
				if($employee['employee_admin']=="CHECKED"){
					echo '<span class="label label-success">admin</span>';
				}
			?>
		</td>
	</tr>
	<tr>
		<td><strong>Email:</strong></td>
		<td><?php echo $employee['employee_email']; ?></td>
	</tr>
</table>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Departments</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($departments)){
				?>
				<tr>
					<td>Employee is not currently in any departments.</td>
				</tr>
				<?php
					}else{
						foreach($departments as $row){
							$link='admin/departments/view/'.$row['department_id'];
				?>
				<tr>
					<td><?php echo anchor($link, $row['department_name']); ?></td>
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
		<h2 class="panel-title">Projects</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('projects/incomplete','Incomplete'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($projects_incomplete)){
				?>
				<tr>
					<td>There are currently no incomplete projects for this employee.</td>
				</tr>
				<?php
					}else{
						foreach($projects_incomplete as $row){
							$link='projects/form/'.$row['project_id'];
				?>
				<tr>
					<td><?php echo anchor($link, $row['project_name']); ?></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>
		
		<hr/>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('projects/complete','Complete'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($projects_complete)){
				?>
				<tr>
					<td>There are currently no complete projects for this employee.</td>
				</tr>
				<?php
					}else{
						foreach($projects_complete as $row){
							$link='projects/form/'.$row['project_id'];
				?>
				<tr>
					<td><?php echo anchor($link, $row['project_name']); ?></td>
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
		<h2 class="panel-title">Support</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('support/open','Open'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($support_open)){
				?>
				<tr>
					<td>There are currently no open support issues for this employee.</td>
				</tr>
				<?php
					}else{
						foreach($support_open as $row){
							$link='support/form/'.$row['support_id'];
				?>
				<tr>
					<td><?php echo anchor($link, $row['support_name']); ?></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>
		
		<hr/>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('support/closed','Closed'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($support_closed)){
				?>
				<tr>
					<td>There are currently no closed support issues for this employee.</td>
				</tr>
				<?php
					}else{
						foreach($support_closed as $row){
							$link='support/form/'.$row['support_id'];
				?>
				<tr>
					<td><?php echo anchor($link, $row['support_name']); ?></td>
				</tr>
				<?php
						}
					}
				?>
			</tbody>
		</table>
	</div>
</div>
