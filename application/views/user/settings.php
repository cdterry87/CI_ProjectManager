<?php $this->load->view('user/navigation'); ?>

<?php echo form_open('user/action'); ?>

<div><?php echo form_label('Username:','employee_username'); ?></div>
<p><?php echo form_input('employee_username','','class="form-control" maxlength="20" data-required'); ?></p>

<div><?php echo form_label('Email:','employee_email'); ?></div>
<p><?php echo form_input('employee_email','','class="form-control" maxlength="100" data-required'); ?></p>

<p><?php echo form_submit('action','Update Settings','class="btn btn-lg btn-primary btn-block"'); ?></p>

<?php echo form_close(); ?>