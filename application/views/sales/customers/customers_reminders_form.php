<?php echo form_open('sales/customers/action', 'id="reminders-form"'); ?>
<?php echo form_hidden('customer_id', $customer['customer_id']); ?>   
<?php echo form_hidden('tab_target', '#customer-reminders'); ?>   

<div class="modal-background" data-modal="reminders-form" ></div>
<div class="modal-card">
    <div class="modal-card-head">
        <h2 class="title is-4">Add Reminder</h2>
    </div>
    <div class="modal-card-body">
        <div class="ajax-messages"></div>
        <div class="content">
            <?php echo form_label('Reminder Date:', 'reminder_date_mo', 'class="label"'); ?>
            <div class="field is-grouped">
                <div class="control">
                    <?php echo form_input('reminder_date_mo', '', 'class="input is-small" maxlength="2" size="2" data-required data-month data-autotab data-label="Reminder Date Month"'); ?>
                </div>
                <div class="control slash">/</div>
                <div class="control">
                    <?php echo form_input('reminder_date_day', '', 'class="input is-small" maxlength="2" size="2" data-required data-day data-autotab data-label="Reminder Date Day"'); ?>
                </div>
                <div class="control slash">/</div>
                <div class="control">
                    <?php echo form_input('reminder_date_yr', date('Y'), 'class="input is-small" maxlength="4" size="4" data-required data-year data-label="Reminder Date Year"'); ?>
                </div>
            </div>

            <div class="field is-grouped">
                <div class="control is-expanded">
                    <?php echo form_textarea('reminder', '', 'class="textarea is-small" placeholder="Enter reminder here" data-required rows="3"'); ?>
                </div>
            </div>

            <div class="field">
                <div class="control">
                    <?php echo form_label('Remind Employee(s):', '', 'class="label"');  ?>
                    <?php echo form_checkbox('all_employees'); ?>
                    <?php echo form_label('All Employees', 'all_employees'); ?>
                </div>
            </div>

            <div class="columns is-multiline is-gapless">
                <?php
                if (!empty($employees)) {
                    foreach ($employees as $row) {
                        $checked="";
                        if ($_SESSION['employee_id']==$row['employee_id']) {
                            $checked="CHECKED";
                        }
                        ?>
                <div class="column is-one-quarter assigned_employees">
                        <?php echo form_checkbox('employee['.$row['employee_id'].']', $row['employee_id'], $checked); ?>
                        <?php echo form_label($row['employee_name'], 'employee['.$row['employee_id'].']'); ?>
                </div>
                        <?php
                    }
                } else {
                    ?>
                There are currently no employees in the system.  <?php echo anchor('sales/employees/form', 'Click here to add one.'); ?>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="modal-card-foot">
        <button type="submit" value='save reminder' class="button is-info ajax-btn">Save Reminder</button>
    </div>
</div>

<?php echo form_close(); ?>