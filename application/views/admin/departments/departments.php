<?php $this->load->view('admin/departments/departments_navigation'); ?>

<?php if(empty($departments)){ ?>

<p class="has-text-centered">There are currently no departments in the system.  <?php echo anchor('admin/departments/form','Click here to create one.'); ?></p>

<?php }else{ ?>

<table class="table is-striped is-narrow is-hoverable is-fullwidth">
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
