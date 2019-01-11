<?php $this->load->view('admin/systems/systems_navigation'); ?>

<?php if(empty($systems)){ ?>

<p class="has-text-centered">There are currently no systems available.  <?php echo anchor('admin/systems/form','Click here to create one.'); ?></p>

<?php }else{ ?>

<table class="table is-striped is-narrow is-hoverable is-fullwidth">
	<thead>
		<tr>
			<th>Systems</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($systems as $row){
				$link='admin/systems/form/'.$row['system_id'];
		?>
		<tr>
			<td><?php echo anchor($link, $row['system_name']); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

<?php } ?>
