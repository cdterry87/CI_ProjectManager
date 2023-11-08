<?php if(empty($departments)){ ?>

<p>There are currently no departments in the system.  <?php echo anchor('admin/departments/form','Click here to create one.'); ?></p>

<?php }else{ ?>

<p><?php echo anchor('admin/departments/form', 'New Department', 'class="btn btn-primary btn-block btn-lg"'); ?></p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Departments</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($departments as $row){
				$link='admin/departments/view/'.$row['department_id'];
		?>
		<tr>
			<td><?php echo anchor($link, $row['department_name']); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

<?php } ?>
