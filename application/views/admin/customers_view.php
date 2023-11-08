<?php echo anchor('admin/customers/form/'.$customer['customer_id'],'Edit Customer','class="btn btn-block btn-lg btn-primary"'); ?>

<h1><?php echo $customer['customer_name']; ?></h1>

<div class="panel panel-danger">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('projects/incomplete','Projects - Incomplete'); ?></h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($projects_incomplete)){
				?>
				<tr>
					<td>There are currently no incomplete projects for this customer.</td>
				</tr>
				<?php
					}else{
						foreach($projects_incomplete as $row){
							$link='projects/view/'.$row['project_id'];
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

<div class="panel panel-success">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('projects/quotes','Projects - Quotes'); ?></h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($projects_quotes)){
				?>
				<tr>
					<td>There are currently no quotes for this customer.</td>
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
		
<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('projects/complete','Projects - Complete'); ?></h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($projects_complete)){
				?>
				<tr>
					<td>There are currently no complete projects for this customer.</td>
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
<div class="panel panel-warning">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('projects/archive','Projects - Archived'); ?></h2>
	</div>
	<div class="panel-body">	
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($projects_archived)){
				?>
				<tr>
					<td>There are currently no archived projects for this customer.</td>
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

<div class="panel panel-danger">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('support','Support - Open'); ?></h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($support_open)){
				?>
				<tr>
					<td>There are currently no open support issues for this customer.</td>
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
	</div>
</div>

<div class="panel panel-info">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('support/closed','Support - Closed'); ?></h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($support_closed)){
				?>
				<tr>
					<td>There are currently no closed support issues for this customer.</td>
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

<div class="panel panel-warning">
	<div class="panel-heading">
		<h2 class="panel-title"><?php echo anchor('support/archive','Support - Archived'); ?></h2>
	</div>
	<div class="panel-body">
		<table class="table table-striped">
			<tbody>
				<?php
					if(empty($support_archived)){
				?>
				<tr>
					<td>There are currently no archived support issues for this customer.</td>
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
