<?php if(empty($employees)){ ?>

<p>There are currently no employees in the system.  <?php echo anchor('admin/employees/form','Click here to create one.'); ?></p>

<?php }else{ ?>

<p><?php echo anchor('admin/employees/form', 'New Employee', 'class="btn btn-primary btn-block btn-lg"'); ?></p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Employees</th>
			<th>Department(s)</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($employees as $row){
				$employee_departments='';
				$departments=$this->Employee_model->get_departments($row['employee_id']);
				if(!empty($departments)){
					foreach($departments as $row_dept){
						$employee_departments.=$row_dept['department_name'].", ";
					}
					$employee_departments=substr($employee_departments,0,-2);
				}
				$link='admin/employees/view/'.$row['employee_id'];
		?>
		<tr>
			<td><?php echo anchor($link, $row['employee_name']); ?></td>
			<td><?php echo anchor($link, $employee_departments); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>

<?php } ?>
