<?php echo form_open('admin/employees/action'); ?>
<?php echo form_hidden('employee_id'); ?>

<?php
	if($employee_id!=''){
?>
<p class="align-right"><?php echo form_submit('action','Reset Password','class="btn btn-warning"'); ?></p>
<?php
	}
?>

<div><?php echo form_label('Employee Name:','employee_name'); ?></div>
<p><?php echo form_input('employee_name','','class="form-control" maxlength="100" data-required'); ?></p>

<div><?php echo form_label('Username:','employee_username'); ?></div>
<p><?php echo form_input('employee_username','','class="form-control" maxlength="20" data-required'); ?></p>

<div><?php echo form_label('Email:','employee_email'); ?></div>
<p><?php echo form_input('employee_email','','class="form-control" maxlength="100" data-required'); ?></p>

<p>
	<?php echo form_checkbox('employee_admin'); ?>
	<?php echo form_label('Admin Priveleges','employee_admin'); ?>
</p>

<hr/>

<p>
	<?php echo form_label('Employee Department(s):','');  ?>
	<?php
		if(!empty($departments)){
			foreach($departments as $row){
	?>
	<div class="col-sm-3">
		<?php echo form_checkbox('department['.$row['department_id'].']',$row['department_id']); ?>
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
</p>

<div class="clear"></div>

<p><?php echo form_submit('action','Save','class="btn btn-lg btn-primary btn-block"'); ?></p>
<?php
if($employee_id!=''){
?>
<p><?php echo form_submit('action','Delete','class="btn btn-lg btn-danger btn-block" data-confirm="Are you sure you want to delete this record?"'); ?></p>
<?php
}
?>
<p><?php echo anchor('admin/employees', 'Cancel', 'class="btn btn-lg btn-warning btn-block"'); ?></p>

<?php echo form_close(); ?>
