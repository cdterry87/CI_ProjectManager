<?php echo form_open('admin/departments/action'); ?>
<?php echo form_hidden('department_id'); ?>

<div><?php echo form_label('Department Name:','department_name'); ?></div>
<p><?php echo form_input('department_name','','class="form-control" maxlength="50" data-required'); ?></p>

<br/>

<p><?php echo form_submit('action','Save','class="btn btn-lg btn-primary btn-block"'); ?></p>
<?php
if($department_id!=''){
?>
<p><?php echo form_submit('action','Delete','class="btn btn-lg btn-danger btn-block" data-confirm="Are you sure you want to delete this record?"'); ?></p>
<?php
}
?>
<p><?php echo anchor('admin/departments', 'Cancel', 'class="btn btn-lg btn-warning btn-block"'); ?></p>

<?php echo form_close(); ?>
