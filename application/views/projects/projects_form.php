<?php echo form_open('projects/action'); ?>
<?php echo form_hidden('project_id'); ?>

<div class="field">
	<?php echo form_label('Project Name:','project_name', 'class="label"'); ?>
	<div class="control">
		<?php echo form_input('project_name','','class="input" maxlength="100" data-required'); ?>
	</div>
</div>

<div class="field">
	<?php echo form_label('Requesting Customer:','customer_id', 'class="label"'); ?>
	<div class="control">
		<div class="select is-fullwidth">
			<?php echo form_dropdown('customer_id',$customers,'','class="input" data-required data-label="Requesting Customer"'); ?>
		</div>
	</div>
</div>

<div class="field">
	<?php echo form_label('Project Status:','project_status', 'class="label"'); ?>
	<div class="control">
		<div class="select is-fullwidth">
			<?php echo form_dropdown('project_status',['I' => 'Incomplete', 'C' => 'Complete'],'','class="input" data-required data-label="Support Status"'); ?>
		</div>
	</div>
</div>

<div class="field">
	<?php echo form_label('Project Details:','project_details', 'class="label"'); ?>
	<div class="control">
		<?php echo form_textarea('project_details', '', 'class="tinymce"'); ?>
	</div>
</div>

<div class="columns">
	<div class="column is-half">
		<?php echo form_label('Project Date:','project_date_mo', 'class="label"'); ?>
		<div class="field is-grouped">
			<p class="control">
				<?php echo form_input('project_date_mo','','class="input" maxlength="2" size="2" data-required data-month data-autotab data-label="Project Date Month"'); ?>
			</p>
			<p class="control slash">/</p>
			<p class="control">
				<?php echo form_input('project_date_day','','class="input" maxlength="2" size="2" data-required data-day data-autotab data-label="Project Date Day"'); ?>
			</p>
			<p class="control slash">/</p>
			<p class="control">
				<?php echo form_input('project_date_yr',date('Y'),'class="input" maxlength="4" size="4" data-required data-year data-label="Project Date Year"'); ?>
			</p>
		</div>
	</div>

	<div class="column is-half">
		<?php echo form_label('Project Completed Date:','project_completed_date_mo', 'class="label"'); ?>
		<div class="field is-grouped">
			<p class="control">
				<?php echo form_input('project_completed_date_mo','','class="input" maxlength="2" size="2" data-month data-autotab'); ?>
			</p>
			<p class="control slash">/</p>
			<p class="control">
				<?php echo form_input('project_completed_date_day','','class="input" maxlength="2" size="2" data-day data-autotab'); ?>
			</p>
			<p class="control slash">/</p>
			<p class="control">
				<?php echo form_input('project_completed_date_yr','','class="input" maxlength="4" size="4" data-year'); ?>
			</p>
		</div>
	</div>
</div>

<hr/>

<div class="field">
	<div class="control">
		<?php echo form_label('Assigned Department(s):','class="label"');  ?>
		<?php echo form_checkbox('all_departments'); ?>
		<?php echo form_label('All Departments','all_departments'); ?>
	</div>
</div>

<div class="columns is-multiline">
	<?php
		if(!empty($departments)){
			foreach($departments as $row){
				$checked="";
				if(isset($_SESSION['employee_departments'][$row['department_id']])){
					if($_SESSION['employee_departments'][$row['department_id']]==$row['department_name']){
						$checked="CHECKED";
					}
				}
	?>
	<div class="column is-one-quarter assigned_departments">
		<?php echo form_checkbox('department['.$row['department_id'].']',$row['department_id'], $checked); ?>
		<?php echo form_label($row['department_name'],'department['.$row['department_id'].']'); ?>
	</div>
	<?php
			}
		}else{
	?>
	There are currently no departments in the system.  <?php echo anchor('admin/departments/form','Click here to add one.'); ?>
	<?php
		}
	?>
</div>

<hr/>

<div class="field">
	<div class="control">
		<?php echo form_label('Assigned Employee(s):','class="label"');  ?>
		<?php echo form_checkbox('all_employees'); ?>
		<?php echo form_label('All Employees','all_employees'); ?>
	</div>
</div>

<div class="columns is-multiline">
	<?php
		if(!empty($employees)){
			foreach($employees as $row){
				$checked="";
				if($_SESSION['employee_id']==$row['employee_id']) $checked="CHECKED";
	?>
	<div class="column is-one-quarter assigned_employees">
		<?php echo form_checkbox('employee['.$row['employee_id'].']',$row['employee_id'], $checked); ?>
		<?php echo form_label($row['employee_name'],'employee['.$row['employee_id'].']'); ?>
	</div>
	<?php
			}
		}else{
	?>
	There are currently no employees in the system.  <?php echo anchor('admin/employees/form','Click here to add one.'); ?>
	<?php
		}
	?>
</div>

<hr/>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action','Save','class="button is-info"'); ?></p>
    <p class="control"><?php echo anchor('projects', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>
