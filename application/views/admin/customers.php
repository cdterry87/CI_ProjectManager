<?php if(empty($customers)){ ?>

<p>There are currently no customers in the system.  <?php echo anchor('admin/customers/form','Click here to create one.'); ?></p>

<?php }else{ ?>

<p><?php echo anchor('admin/customers/form', 'New Customer', 'class="btn btn-primary btn-block btn-lg"'); ?></p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Customers</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($customers as $row){
				$link='admin/customers/view/'.$row['customer_id'];
		?>
		<tr>
			<td><?php echo anchor($link, $row['customer_name']); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

<?php } ?>
