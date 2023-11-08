<p><?php echo form_input('search','','class="form-control" placeholder="Search..."'); ?></p>
<p class="align-right" id="search_num"></p>

<table class="table table-striped">
	<thead>
		<tr>
			<th>Support</th>
			<th>Date/Time</th>
			<th>Customer</th>
			<th>Department(s)</th>
			<th>Employee(s)</th>
			<th>Tag(s)</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($support as $row){
				
				$support_departments='';
				$departments=$this->Support_model->get_departments($row['support_id']);
				if(!empty($departments)){
					foreach($departments as $row_dept){
						$support_departments.=$row_dept['department_name'].", ";
					}
					$support_departments=substr($support_departments,0,-2);
				}
				
				$support_employees='';
				$employees=$this->Support_model->get_employees($row['support_id']);
				if(!empty($employees)){
					foreach($employees as $row_emp){
						$support_employees.=$row_emp['employee_name'].", ";
					}
					$support_employees=substr($support_employees,0,-2);
				}
				
				$link='support/view/'.$row['support_id'];
		?>
		<tr>
			<td><?php echo anchor($link, $row['support_name']); ?></td>
			<td><?php echo anchor($link, $this->format->date($row['support_date'])." ".$this->format->time($row['support_time'])); ?></td>
			<td><?php echo anchor($link, $customers[$row['customer_id']]); ?></td>
			<td><?php echo anchor($link, $support_departments); ?></td>
			<td><?php echo anchor($link, $support_employees); ?></td>
			<td><?php echo anchor($link, $row['support_tags']); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
