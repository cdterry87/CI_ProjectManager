<h1 class="title is-3">
    <?php echo $customer['customer_name']; ?>
    <?php echo anchor('sales/customers/form/'.$customer['customer_id'], '<i class="fas fa-edit"></i> Edit Customer', 'class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="customer-details"><a><i class="fas fa-clipboard-list "></i>Details</a></li>
        <li class="tab" data-target="customer-projects"><a><i class="fas fa-project-diagram"></i>Projects</a></li>
        <li class="tab" data-target="customer-support"><a><i class="fas fa-bug"></i> Support</a></li>
        <li class="tab" data-target="customer-contacts"><a><i class="fas fa-users"></i> Contacts</a></li>
        <li class="tab" data-target="customer-notes"><a><i class="fas fa-edit"></i> Notes</a></li>
        <li class="tab" data-target="customer-reminders"><a><i class="fas fa-clock"></i> Reminders</a></li>
        <li class="tab" data-target="customer-files"><a><i class="fas fa-paperclip"></i> Files</a></li>
    </ul>
</div>

<div id="customer-details" class="tab-panel tab-panel-init">
    <h2 class="title is-4">Customer Details</h2>
    <div>
        <?php
        $status_color = 'success';
        switch ($customer['customer_status']) {
            case "prospect":
                $status_color = 'link';
                break;
            case "pending":
                $status_color = 'primary';
                break;
            case "archive":
                $status_color = 'warning';
                break;
        }
        echo '<strong>' . $customer['customer_city']. ' ' . $customer['customer_state'] . ' <span class="tag is-'.$status_color.'">'.$customer['customer_status'].'</span></strong>';
        ?>
    </div>

    <?php if (strlen($customer['customer_phone']) == 10) { ?>
    <div>
        <strong>Phone: </strong>
        <?php echo $this->format->phone($customer['customer_phone']); ?>
    </div>
    <?php } ?>

    <?php
    if (trim($project_manager)!='') {
        ?>
    <div>
        <strong>Project Manager: </strong>
        <?php echo $project_manager; ?>
    </div>
        <?php
    }
    ?>

    <br>

    <div>
        <strong>Systems Owned:</strong>
    </div>
    <div class="tags">
        <?php
        foreach ($systems as $key => $system) {
            echo '<div class="tag is-link">'.$system['system_name'].'</div>';
        }
        ?>
    </div>

    <?php echo $customer['customer_details']; ?>
</div>

<div id="customer-projects" class="tab-panel">
    <h2 class="title is-4">Incomplete Projects</h2>
    <?php $this->load->view('projects/projects_incomplete'); ?>
</div>

<div id="customer-support" class="tab-panel">
    <h2 class="title is-4">Open Support</h2>
    <?php $this->load->view('support/support_open'); ?>
</div>

<div id="customer-contacts" class="tab-panel">
    <h3 class="title is-4">
        Customer Contacts
        <a data-modal="contact-form" class="button is-info is-small"><i class="fas fa-plus-square"></i> Add Contact</a>    
    </h3>
    <div id="contact-form" class="modal">
        <?php $this->load->view('sales/customers/customers_contacts_form'); ?>
        <button class="modal-close is-large" data-modal="contact-form" aria-label="close"></button>
    </div>

    <table class="table is-striped is-narrow is-fullwidth">
        <thead>
            <tr>
                <th width="20%">Name</th>
                <th width="20%">Title</th>
                <th width="20%">Email</th>
                <th width="15%">Phone</th>
                <th width="15%">Phone</th>
                <th width="10%">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($contacts as $key => $contact) {
                ?>
            <tr>
                <td><?php echo $contact['contact_name']; ?></td>
                <td><?php echo $contact['contact_title']; ?></td>
                <td><?php echo $contact['contact_email']; ?></td>
                <td><?php echo $this->format->phone($contact['contact_phone']); ?></td>
                <td><?php echo $this->format->phone($contact['contact_phone_alt']); ?></td>
                <td>
                    <?php echo anchor('sales/customers/delete_contact/' . $customer['customer_id'] . '/' . $contact['customer_contact_id'], '<i class="fas fa-trash-alt"></i>', 'class="button is-danger"'); ?>
                </td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div id="customer-notes" class="tab-panel">
    <?php echo form_open('sales/customers/action', 'id="notes-form"'); ?>
    <?php echo form_hidden('customer_id', $customer['customer_id']); ?>
    <h2 class="title is-4">Customer Notes</h2>
    <div class="field is-grouped">
        <div class="control is-expanded">
            <?php echo form_textarea('note', '', 'class="textarea is-small" placeholder="Enter notes here" data-required rows="3"'); ?>
        </div>
        <div class="control">
            <?php echo form_submit('action', 'Add Note', 'class="button is-info is-fullwidth"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>

    <hr>

    <table class="table is-striped is-narrow is-fullwidth">
        <thead>
            <tr>
                <th>Note</th>
                <th width="20%">Date</th>
                <th width="20%">Employee</th>
                <th width="10%">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($notes)) {
            ?>
            <tr>
                <td colspan="3">Customer does not currently have any notes.</td>
            </tr>
            <?php
            } else {
                foreach ($notes as $key => $note) {
                    $employee = $this->Employee_model->get_by_employee_id($note['employee_id']);
            ?>
            <tr>
                <td><?php echo $note['note']; ?></td>
                <td><?php echo $note['datetime']; ?></td>
                <td><?php echo $employee['employee_name']; ?></td>
                <td>
                <?php echo anchor('sales/customers/delete_note/' . $customer['customer_id'] . '/' . $note['customer_note_id'], '<i class="fas fa-trash-alt"></i>', 'class="button is-danger"'); ?>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div id="customer-reminders" class="tab-panel">
    <?php echo form_open('sales/customers/action', 'id="reminders-form"'); ?>
    <?php echo form_hidden('customer_id', $customer['customer_id']); ?>
    <h2 class="title is-4">Customer Reminders</h2>

    <?php echo form_label('Reminder Date:', 'reminder_date_mo', 'class="label"'); ?>
    <div class="field is-grouped">
        <p class="control">
            <?php echo form_input('reminder_date_mo', '', 'class="input is-small" maxlength="2" size="2" data-required data-month data-autotab data-label="Reminder Date Month"'); ?>
        </p>
        <p class="control slash">/</p>
        <p class="control">
            <?php echo form_input('reminder_date_day', '', 'class="input is-small" maxlength="2" size="2" data-required data-day data-autotab data-label="Reminder Date Day"'); ?>
        </p>
        <p class="control slash">/</p>
        <p class="control">
            <?php echo form_input('reminder_date_yr', date('Y'), 'class="input is-small" maxlength="4" size="4" data-required data-year data-label="Reminder Date Year"'); ?>
        </p>
    </div>

    <div class="field is-grouped">
        <div class="control is-expanded">
            <?php echo form_textarea('reminder', '', 'class="textarea is-small" placeholder="Enter reminder here" data-required rows="3"'); ?>
        </div>
        <div class="control">
            <?php echo form_submit('action', 'Add Reminder', 'class="button is-info is-fullwidth"'); ?>
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
    <?php echo form_close(); ?>

    <br>

    <table class="table is-striped is-narrow is-fullwidth">
        <thead>
            <tr>
                <th>Reminder</th>
                <th width="20%">Reminder Date</th>
                <th width="10%">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (empty($reminders)) {
            ?>
            <tr>
                <td colspan="3">Customer does not currently have any reminders.</td>
            </tr>
            <?php
            } else {
                foreach ($reminders as $key => $reminder) {
            ?>
            <tr>
                <td><?php echo $reminder['reminder']; ?></td>
                <td><?php echo $this->format->date($reminder['reminder_date']); ?></td>
                <td>
                <?php echo anchor('sales/customers/delete_reminder/' . $customer['customer_id'] . '/' . $reminder['customer_reminder_id'], '<i class="fas fa-trash-alt"></i>', 'class="button is-danger"'); ?>
                </td>
            </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div id="customer-files" class="tab-panel">
<?php echo form_open_multipart('sales/customers/action', 'id="files-form"'); ?>
    <?php echo form_hidden('customer_id', $customer['customer_id']); ?>
    <h3 class="title is-4">Attached Files</h3>
    <div class="field is-grouped">
        <div class="control is-expanded">
            <div class="file has-name is-fullwidth">
                <label class="file-label">
                    <input class="file-input" type="file" name="userfile" id="file-attachment">
                    <span class="file-cta">
                        <span class="file-icon"><i class="fas fa-upload"></i></span>
                        <span class="file-label">Choose a file…</span>
                    </span>
                    <span id="file-name" class="file-name"></span>
                </label>
            </div>
        </div>
        <div class="control">
            <?php echo form_submit('action', 'Add File', 'class="button is-info is-fullwidth"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>

    <hr>

    <table class="table is-narrow is-fullwidth">
        <tbody>
            <?php
                $file_num=0;
            if (empty($files)) {
                ?>
            <tr>
                <td colspan="2">Customer does not currently have any attached files.</td>
            </tr>
                <?php
            } else {
                foreach ($files as $row) {
                    $file_num++;
                    ?>
            <tr>
                <td><?php echo anchor('public/files/customers/'.$row['customer_id']."/".$row['file_name'], $file_num.". ".$row['file_name'], 'target="_blank"'); ?></td>
                <td width="10%"><?php echo anchor('customers/delete_file/'.$row['customer_id'].'/'.$row['file_id'], '<i class="fas fa-trash"></i>', 'class="button is-danger is-fullwidth"'); ?></td>
            </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<?php echo form_close(); ?>
