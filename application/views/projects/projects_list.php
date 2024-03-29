<table class="table is-striped is-narrow is-hoverable is-fullwidth datatable">
	<thead>
		<tr>
			<th>Project</th>
			<th>Date</th>
			<th>Customer</th>
			<th>Department(s)</th>
			<th>Employee(s)</th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach($projects as $row){
				
				$projects_departments='';
				$departments=$this->Project_model->get_departments($row['project_id']);
				if(!empty($departments)){
					foreach($departments as $row_dept){
						$projects_departments.=$row_dept['department_name'].", ";
					}
					$projects_departments=substr($projects_departments,0,-2);
				}
				
				$projects_employees='';
				$employees=$this->Project_model->get_employees($row['project_id']);
				if(!empty($employees)){
					foreach($employees as $row_emp){
						$projects_employees.=$row_emp['employee_name'].", ";
					}
					$projects_employees=substr($projects_employees,0,-2);
				}
				
				$link='projects/view/'.$row['project_id'];
				
				$request='';
				if($row['project_type']=='R' and $this->uri->segment(2)=='all'){
					$request='<b>(R)</b> ';
				}
		?>
		<tr>
			<td><?php echo anchor($link, $request.$row['project_name']); ?></td>
			<td><?php echo anchor($link, $this->format->date($row['project_date'])); ?></td>
			<td><?php echo anchor($link, $customers[$row['customer_id']]); ?></td>
			<td><?php echo anchor($link, $projects_departments); ?></td>
			<td><?php echo anchor($link, $projects_employees); ?></td>
		</tr>
		<?php
			}
		?>
	</tbody>
</table>
