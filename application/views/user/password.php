<?php $this->load->view('user/navigation'); ?>

<?php echo form_open('user/action'); ?>

<div class="field">
    <?php echo form_label('Password:','employee_password'); ?>
    <div class="control">
        <?php echo form_password('employee_password','','class="input" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Password Confirm:','employee_password_confirm'); ?>
    <div class="control">
        <?php echo form_password('employee_password_confirm','','class="input" data-required'); ?>
    </div>
</div>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action','Update Password','class="button is-info"'); ?></p>
    <p class="control"><?php echo anchor('/', 'Cancel', 'class="button is-warning"'); ?></p>
</div>


<?php echo form_close(); ?>