<?php echo anchor('admin/departments/form/'.$department['department_id'],'Edit Department','class="btn btn-block btn-lg btn-primary"'); ?>

<h1><?php echo $department['department_name']; ?></h1>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h2 class="panel-title">Employees</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($employees)){
				?>
				<tr>
					<td>There are currently no employees in this department.</td>
				</tr>
				<?php
					}else{
						foreach($employees as $row){
							$link='admin/employees/form/'.$row['employee_id'];
				?>
				<tr>
					<td><?php echo anchor($link, $row['employee_name']); ?></td>
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
		<h2 class="panel-title">Quotes</h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('projects/quotes','Quotes'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($projects_quotes)){
				?>
				<tr>
					<td>There are currently no quotes for this department.</td>
				</tr>
				<?php
					}else{
						foreach($projects_quotes as $row){
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
					<td>There are currently no incomplete projects for this department.</td>
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
					<td>There are currently no complete projects for this department.</td>
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
		
		<hr/>

		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('projects/archive','Archived'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($projects_archived)){
				?>
				<tr>
					<td>There are currently no archived projects for this department.</td>
				</tr>
				<?php
					}else{
						foreach($projects_archived as $row){
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
					<td>There are currently no open support issues for this department.</td>
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
					<td>There are currently no closed support issues for this department.</td>
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
		
		<hr/>
		
		<table class="table table-striped">
			<thead>
				<tr>
					<th><?php echo anchor('support/archive','Archived'); ?></th>
				</tr>
			</thead>
			<tbody>
				<?php
					if(empty($support_archived)){
				?>
				<tr>
					<td>There are currently no archived support issues for this department.</td>
				</tr>
				<?php
					}else{
						foreach($support_archived as $row){
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
