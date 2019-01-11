<?php $this->load->view('admin/departments_navigation'); ?>

<?php echo form_open('admin/departments/action'); ?>
<?php echo form_hidden('department_id'); ?>

<div class="field">
    <?php echo form_label('Department Name:','department_name', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('department_name','','class="input" maxlength="50" data-required'); ?>
    </div>
</div>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action','Save','class="button is-info"'); ?></p>
    <?php
    if($department_id!=''){
    ?>
    <p class="control"><?php echo form_submit('action','Delete','class="button is-danger" data-confirm="Are you sure you want to delete this record?"'); ?></p>
    <?php
    }
    ?>
    <p class="control"><?php echo anchor('admin/departments', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>
