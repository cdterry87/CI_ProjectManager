<?php echo form_open('admin/employees/action'); ?>
<?php echo form_hidden('employee_id'); ?>

<?php
if ($employee_id!='') {
    ?>
<p class="align-right"><?php echo form_submit('action', 'Reset Password', 'class="button is-primary"'); ?></p>
    <?php
}
?>

<div class="field">
    <?php echo form_label('Employee Name:', 'employee_name', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('employee_name', '', 'class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Username:', 'employee_username', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('employee_username', '', 'class="input is-small" maxlength="20" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Email:', 'employee_email', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('employee_email', '', 'class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field is-grouped">
    <div class="control">
        <?php echo form_checkbox('employee_admin'); ?>
        <?php echo form_label('Admin Priveleges', 'employee_admin', 'class="checkbox"'); ?>
    </div>
    <div class="control">
        <?php echo form_checkbox('employee_sales'); ?>
        <?php echo form_label('Sales Employee', 'employee_sales', 'class="checkbox"'); ?>
    </div>
</div>

<hr/>

<div class="field">
    <div class="control">
        <?php echo form_label('Employee Department(s):', '');  ?>
        <?php echo form_checkbox('all_departments'); ?>
        <?php echo form_label('All Departments', 'all_departments'); ?>
    </div>
</div>


<div class="columns is-multiline">
    <?php
    if (!empty($departments)) {
        foreach ($departments as $row) {
            ?>
    <div class="column is-one-quarter assigned_departments">
            <?php echo form_checkbox('department['.$row['department_id'].']', $row['department_id']); ?>
            <?php echo form_label($row['department_name'], 'department['.$row['department_id'].']'); ?>
    </div>
            <?php
        }
    } else {
        ?>
    <p class="has-text-centered">
        There are currently no departments in the system.  <?php echo anchor('admin/departments/form', 'Click here to add one.'); ?>
    </p>
        <?php
    }
    ?>
</div>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action', 'Save', 'class="button is-info"'); ?></p>
    <?php
    if ($employee_id!='') {
        ?>
    <p class="control"><?php echo form_submit('action', 'Delete', 'class="button is-danger" data-confirm="Are you sure you want to delete this record?"'); ?></p>
        <?php
    }
    ?>
    <p class="control"><?php echo anchor('admin/employees', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>
