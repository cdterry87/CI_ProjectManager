<?php $this->load->view('admin/systems_navigation'); ?>

<?php echo form_open('admin/systems/action'); ?>
<?php echo form_hidden('system_id'); ?>

<div class="field">
    <?php echo form_label('System Name:', 'system_name', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('system_name', '', 'class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action', 'Save', 'class="button is-info"'); ?></p>
    <?php
    if ($system_id!='') {
        ?>
    <p class="control"><?php echo form_submit('action', 'Delete', 'class="button is-danger" data-confirm="Are you sure you want to delete this record?"'); ?></p>
        <?php
    }
    ?>
    <p class="control"><?php echo anchor('admin/systems', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>
