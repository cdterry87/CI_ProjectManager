<div id="home">
	<div class="col-md-6">
		<?php echo anchor('projects/form', 'New Project', 'class="btn btn-primary btn-block btn-lg"'); ?>
	</div>
	<div class="col-md-6">
		<?php echo anchor('support/form', 'New Support', 'class="btn btn-primary btn-block btn-lg"'); ?>
	</div>
	<div class="col-md-3" id="sidebar">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo anchor('admin/customers', 'Customers'); ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<tbody>
						<?php
							if(empty($customers)){
						?>
						<tr>
							<td colspan="2">No customers at this time.</td>
						</tr>
						<?php
							}else{
								foreach($customers as $row){
									$link='admin/customers/view/'.$row['customer_id'];
						?>
						<tr>
							<td><?php echo anchor($link, $row['customer_name']); ?></td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-9">
		<div class="panel panel-info">
			<div class="panel-heading">
				<h3 class="panel-title"><?php echo anchor('projects', 'Incomplete Projects'); ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Project</th> 
							<th>Customer</th> 
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(empty($projects_incomplete)){
						?>
						<tr>
							<td colspan="2">No incomplete projects at this time.</td>
						</tr>
						<?php
							}else{
								foreach($projects_incomplete as $row){
									$link='projects/view/'.$row['project_id'];
						?>
						<tr>
							<td><?php echo anchor($link, $row['project_name']); ?></td>
							<td><?php echo anchor($link, $this->Customer_model->get_customer_name($row['customer_id'])); ?></td>
							<td><?php echo anchor($link, $this->format->date($row['project_date'])); ?></td>
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
				<h3 class="panel-title"><?php echo anchor('support', 'Open Support'); ?></h3>
			</div>
			<div class="panel-body">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Support</th>
							<th>Customer</th>
							<th>Date</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if(empty($support_open)){
						?>
						<tr>
							<td colspan="2">No open support at this time.</td>
						</tr>
						<?php
							}else{
								foreach($support_open as $row){
									$link='support/view/'.$row['support_id'];
						?>
						<tr>
							<td><?php echo anchor($link, $row['support_name']); ?></td>
							<td><?php echo anchor($link, $this->Customer_model->get_customer_name($row['customer_id'])); ?></td>
							<td><?php echo anchor($link, $this->format->date($row['support_date'])." ".$this->format->time($row['support_time'])); ?></td>
						</tr>
						<?php
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
