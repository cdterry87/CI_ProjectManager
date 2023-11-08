<?php $this->load->view('user/navigation'); ?>

<?php echo form_open('user/action'); ?>

<div><?php echo form_label('Password:','employee_password'); ?></div>
<p><?php echo form_password('employee_password','','class="form-control" data-required'); ?></p>

<div><?php echo form_label('Password Confirm:','employee_password_confirm'); ?></div>
<p><?php echo form_password('employee_password_confirm','','class="form-control" data-required'); ?></p>

<p><?php echo form_submit('action','Update Password','class="btn btn-lg btn-primary btn-block"'); ?></p>

<?php echo form_close(); ?>