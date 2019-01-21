<?php $this->load->view('sales/customers/customers_navigation'); ?>

<?php if(empty($customers)){ ?>

<p class="has-text-centered">There are currently no customers in the system.  <?php echo anchor('sales/customers/form','Click here to create one.'); ?></p>

<?php }else{ ?>

<table class="table is-striped is-narrow is-hoverable is-fullwidth datatable">
	<thead>
		<tr>
			<th>Customer</th>
			<th>Project Manager</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($customers as $row){
				$link='sales/customers/view/'.$row['customer_id'];
		?>
		<tr>
			<td><?php echo anchor($link, $row['customer_name']); ?></td>
			<td><?php echo anchor($link, $this->Employee_model->get_by_employee_id($row['customer_project_manager'])['employee_name']); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

<?php } ?>
