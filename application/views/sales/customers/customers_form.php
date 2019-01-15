<?php $this->load->view('sales/customers/customers_navigation'); ?>

<?php echo form_open('sales/customers/action'); ?>
<?php echo form_hidden('customer_id'); ?>

<div class="field">
    <?php echo form_label('Customer Name:', 'customer_name', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('customer_name', '', 'class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Customer Status:', 'customer_status', 'class="label"'); ?>
    <div class="control">
        <div class="select is-small is-fullwidth">
            <?php echo form_dropdown('customer_status', ['' => '', 'prospect' => 'Prospect', 'pending' => 'Pending', 'live' => 'Live', 'archive' => 'Archive'], '', 'data-required data-label="Customer Status"'); ?>
        </div>
    </div>
</div>

<div class="field">
    <?php echo form_label('Project Manager:', 'customer_adsi_project_manager', 'class="label"'); ?>
    <div class="control">
        <div class="select is-small is-fullwidth">
            <?php echo form_dropdown('customer_adsi_project_manager', $employees, '', 'data-required data-label="Project Manager"'); ?>
        </div>
    </div>
</div>

<div class="columns">
    <div class="column is-two-third">
        <div class="field">
            <?php echo form_label('City:', 'customer_city', 'class="label"'); ?>
            <div class="control">
                <?php echo form_input('customer_city', '', 'class="input is-small" maxlength="30" data-required'); ?>
            </div>
        </div>
    </div>
    <div class="column is-one-third">
        <div class="field">
            <?php echo form_label('State:', 'customer_state', 'class="label"'); ?>
            <div class="control">
                <div class="select is-small is-fullwidth">
                    <?php echo form_dropdown('customer_state', $states, '', 'data-required data-label="Customer State"'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo form_label('Phone:', 'customer_phone_1', 'class="label"'); ?>
<div class="field is-grouped">
    <p class="control"><?php echo form_input('customer_phone_1', '', 'class="input is-small" maxlength="3" size="3" data-numeric data-autotab'); ?></p>
    <p class="control slash">-</p>
    <p class="control"><?php echo form_input('customer_phone_2', '', 'class="input is-small" maxlength="3" size="3" data-numeric data-autotab'); ?></p>
    <p class="control slash">-</p>
    <p class="control"><?php echo form_input('customer_phone_3', '', 'class="input is-small" maxlength="4" size="4" data-numeric'); ?></p>
</div>

<div class="field">
    <?php echo form_label('Customer Details:', 'customer_details', 'class="label"'); ?>
    <div class="control">
        <?php echo form_textarea('customer_details', '', 'class="tinymce"'); ?>
    </div>
</div>

<hr>

<div class="field">
    <div class="control">
        <?php echo form_label('Systems Owned:', '', 'class="label"');  ?>
        <?php echo form_checkbox('all_systems'); ?>
        <?php echo form_label('All Systems', 'all_systems'); ?>
    </div>
</div>

<div class="columns is-multiline is-gapless">
    <?php
    if (!empty($systems)) {
        foreach ($systems as $row) {
            $checked="";
            ?>
    <div class="column is-one-quarter all_systems">
            <?php echo form_checkbox('system['.$row['system_id'].']', $row['system_id'], $checked); ?>
            <?php echo form_label($row['system_name'], 'system['.$row['system_id'].']'); ?>
    </div>
            <?php
        }
    } else {
        ?>
    There are currently no systems available.  <?php echo anchor('sales/systems/form', 'Click here to add one.'); ?>
        <?php
    }
    ?>
</div>

<hr>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action', 'Save', 'class="button is-info"'); ?></p>
    <?php
    if ($customer_id!='') {
        ?>
    <p class="control"><?php echo form_submit('action', 'Delete', 'class="button is-danger" data-confirm="Are you sure you want to delete this record?"'); ?></p>
        <?php
    }
    ?>
    <p class="control"><?php echo anchor('sales/customers', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>
