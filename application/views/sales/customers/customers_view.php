<h1 class="title is-3">
    <?php echo $customer['customer_name']; ?>
    <?php echo anchor('sales/customers/form/'.$customer['customer_id'], '<i class="fas fa-edit"></i> Edit Customer', 'class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="customer-details"><a href="#customer-details-tab"><i class="fas fa-clipboard-list "></i>Details</a></li>
        <li class="tab" data-target="customer-projects"><a href="#customer-projects-tab"><i class="fas fa-project-diagram"></i>Projects</a></li>
        <li class="tab" data-target="customer-support"><a href="#customer-support-tab"><i class="fas fa-bug"></i> Support</a></li>
        <li class="tab" data-target="customer-contacts"><a href="#customer-contacts-tab"><i class="fas fa-users"></i> Contacts</a></li>
        <li class="tab" data-target="customer-notes"><a href="#customer-notes-tab"><i class="fas fa-edit"></i> Notes</a></li>
        <li class="tab" data-target="customer-reminders"><a href="#customer-reminders-tab"><i class="fas fa-clock"></i> Reminders</a></li>
        <li class="tab" data-target="customer-files"><a href="#customer-files-tab"><i class="fas fa-paperclip"></i> Files</a></li>
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

    <div class="columns">
        <?php
        if (empty($contacts)) {
            ?>

        <div class="column is-full">Customer does not currently have any contacts.</div>

            <?php
        } else {
            foreach ($contacts as $contact) {
                ?>
        <div class="column is-one-third">
            <div class="card">
                <div class="card-content">
                    <h4 class="has-text-weight-bold is-size-4"><?php echo $this->format->shorten($contact['contact_name'], 20, true); ?></h4>
                    <h5 class="has-text-weight-semibold is-size-5"><?php echo $this->format->shorten($contact['contact_title'], 25, true); ?></h5>
                    <h6 class="is-size-7"><?php echo "Email: " . $contact['contact_email']; ?></h6>
                    <div class="is-size-7">
                        <?php echo "Phone: " . $this->format->phone($contact['contact_phone']); ?>
                        <?php
                        if ($contact['contact_phone_type'] != '') {
                            echo "<strong>[ " . $contact['contact_phone_type'] . " ]</strong>";
                        }
                        ?>
                    </div>
                    <div class="is-size-7">
                        <?php echo "Phone: " . $this->format->phone($contact['contact_phone_alt']); ?>
                        <?php
                        if ($contact['contact_phone_alt_type'] != '') {
                            echo "<strong>[ " . $contact['contact_phone_alt_type'] . " ]</strong>";
                        }
                        ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                        echo anchor('sales/customers/edit_contact/'.$contact['customer_contact_id'], '<i class="fas fa-edit" title="Edit Contact"></i> Edit', 'data-modal="contact-form" ajax-populate="contacts-form" class="card-footer-item has-text-link"');
                        echo anchor('sales/customers/delete_contact/'.$contact['customer_id'].'/'.$contact['customer_contact_id'], '<i class="fas fa-trash" title="Delete Contact"></i> Delete', 'class="card-footer-item has-text-danger"');
                    ?>
                </div>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
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

    <div class="columns is-multiline">
        <?php
        if (empty($notes)) {
            ?>

        <div class="column is-full">Customer does not currently have any notes.</div>

            <?php
        } else {
            foreach ($notes as $note) {
                ?>
        <div class="column is-mobile is-half-tablet is-one-third-fullhd">
            <div class="card">
                <div class="card-content">
                    <p>
                        <i class="fas fa-quote-left"></i>
                        <?php echo $note['note']; ?>
                        <i class="fas fa-quote-right"></i>
                    </p>
                    <br>
                    <p class="is-size-7 has-text-right">
                        <?php
                            echo $this->Employee_model->get_by_employee_id($note['employee_id'])['employee_name'] . ' - ' . $note['datetime'];
                        ?>
                    </p>
                </div>
                <div class="card-footer">
                    <?php
                        echo anchor('sales/customers/delete_note/' . $customer['customer_id'] . '/' . $note['customer_note_id'], '<i class="fas fa-trash-alt"></i>', 'class="card-footer-item has-text-danger"');
                    ?>
                </div>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<div id="customer-reminders" class="tab-panel">
    <h3 class="title is-4">
        Customer Reminders
        <a data-modal="reminders-form" class="button is-info is-small"><i class="fas fa-plus-square"></i> Add Reminder</a>    
    </h3>

    <div id="reminders-form" class="modal">
        <?php $this->load->view('sales/customers/customers_reminders_form'); ?>
        <button class="modal-close is-large" data-modal="reminders-form" aria-label="close"></button>
    </div>

    <div class="columns is-multiline">
    <?php

    if (empty($reminders)) {
        echo "<div class='column'>No reminders available at this time.</div>";
    }

    foreach ($reminders as $row) {
        ?>
    <div class="column is-half">
        <div class="card">
            <header class="card-header">
                <div class="card-header-title">Remind on <?php echo $this->format->date($row['reminder_date']); ?></div>
                <a href="<?php echo base_url('sales/customers/delete_reminder/' . $customer['customer_id'] . '/' . $row['customer_reminder_id']); ?>" class="card-header-icon" aria-label="more options">
                    <span class="icon">
                        <i class="fas fa-trash has-text-danger" aria-hidden="true"></i>
                    </span>
                </a>
            </header>
            <div class="card-content">
                <div class="content">
                    <?php echo $this->format->shorten($row['reminder'], 100); ?>
                    <hr>
                    <div class="is-size-7">
                        <strong>Remind:</strong>
                        <?php
                        $reminders_employees = '';
                        foreach ($this->Customer_model->get_reminders_employees($row['customer_reminder_id']) as $row_reminder_employee) {
                            $reminders_employees .= $this->Employee_model->get_by_employee_id($row_reminder_employee['employee_id'])['employee_name'].', ';
                        }
                        $reminders_employees = substr($reminders_employees, 0, -2);

                        if (trim($reminders_employees) != '') {
                            echo $reminders_employees;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <?php
    }
    ?>
    </div>
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

    <div class="columns is-multiline">
        <?php
        if (empty($files)) {
            ?>

        <div>Customer does not currently have any attached files.</div>

            <?php
        } else {
            foreach ($files as $row) {
                ?>
        <div class="column is-one-quarter">
            <div class="notification is-<?php echo $this->theme_colors[array_rand($this->theme_colors)]; ?>">
                <?php echo anchor('sales/customers/delete_file/'.$row['customer_id'].'/'.$row['file_id'], '', 'class="delete"'); ?>
                <?php echo anchor('public/files/customers/'.$row['customer_id']."/".$row['file_name'], '<i class="fas fa-download"></i> ' . $this->format->shorten($row['file_name'], 20), 'target="_blank"'); ?>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<?php echo form_close(); ?>
