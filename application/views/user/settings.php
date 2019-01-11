<?php $this->load->view('user/navigation'); ?>

<?php echo form_open('user/action'); ?>

<div class="field">
    <?php echo form_label('Name:','employee_name', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('employee_name','','class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Username:','employee_username', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('employee_username','','class="input is-small" maxlength="20" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Email:','employee_email', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('employee_email','','class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action','Update Settings','class="button is-info"'); ?></p>
    <p class="control"><?php echo anchor('/', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>