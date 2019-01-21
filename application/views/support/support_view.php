

<h1 class="title is-3">
    <?php echo $support['support_name']; ?>
    <?php echo anchor('support/form/'.$support['support_id'], '<i class="fas fa-edit"></i> Edit Support', 'class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="support-details"><a><i class="fas fa-clipboard-list "></i> Details</a></li>
        <li class="tab" data-target="support-tasks"><a><i class="fas fa-tasks"></i> Tasks</a></li>
        <li class="tab" data-target="support-files"><a><i class="fas fa-paperclip"></i> Files</a></li>
        <li class="tab" data-target="support-history"><a><i class="fas fa-history"></i> History</a></li>
    </ul>
</div>

<div id="support-details" class="tab-panel tab-panel-init">
    <h3 class="title is-4">Support Details</h3>
    <div>
        <strong>Support Date: </strong>
        <?php echo $this->format->date($support['support_date'])." ".$this->format->time($support['support_time']); ?>
    </div>

    <div>
        <strong>Support Duration:</strong>
        <?php echo $support['support_duration_days']." days ".$support['support_duration_hours']." hours ".$support['support_duration_minutes']." minutes"; ?>
    </div>

    <?php if (trim($support['support_details']) != '') { ?>
    <div>
        <strong>Support Details:</strong>
    </div>

    <div>
        <?php echo $support['support_details']; ?>  
    </div>
    <?php } ?>

    <br>

    <div class="columns">
        <div class="column is-one-third">
            <div class="box notification is-warning has-text-dark">
                <div class="heading">Customer</div>
                <?php
                if (empty($customer)) {
                    ?>
                <div class="title is-5">N/A</div>
                    <?php
                } else {
                    $list_customers='';
                    foreach ($customer as $row) {
                        $list_customers.=$row['customer_name'].", ";
                    }
                    $list_customers=substr($list_customers, 0, -2);
                    ?>
                <div class="title is-5"><?php echo $list_customers; ?></div>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="column is-one-third">
            <div class="box notification is-danger has-text-white">
            <div class="heading">Assigned Department(s)</div>
            <?php
            if (empty($departments)) {
                ?>
            <div class="title is-5">N/A</div>
                <?php
            } else {
                $list_departments='';
                foreach ($departments as $row) {
                    $list_departments.=$row['department_name'].", ";
                }
                $list_departments=substr($list_departments, 0, -2);
                ?>
            <div class="title is-5"><?php echo $list_departments; ?></div>
                <?php
            }
            ?>
            </div>
        </div>
        <div class="column is-one-third">
            <div class="box notification is-info has-text-white">
                <div class="heading">Assigned Employee(s)</div>
                <?php
                if (empty($employees)) {
                    ?>
                <div class="title is-5">N/A</div>
                    <?php
                } else {
                    $list_employees='';
                    foreach ($employees as $row) {
                        $list_employees.=$row['employee_name'].", ";
                    }
                    $list_employees=substr($list_employees, 0, -2);
                    ?>
                <div class="title is-5"><?php echo $list_employees; ?></div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>

    <?php echo form_open('support/action'); ?>
    <?php echo form_hidden('support_id', $support['support_id']); ?>

    <div class="field is-grouped is-grouped-centered">
    <?php
    switch ($support['support_status']) {
        case "A":
            echo '<div class="control">'.form_submit('action', 'Restore Issue', 'class="button is-success" data-confirm="Are you sure you want to restore this support issue?"').'</div>';
            break;
        case "C":
            echo '<div class="control">'.form_submit('action', 'Open Issue', 'class="button is-danger" data-confirm="Are you sure you want to open this support issue?"').'</div>';
            echo '<div class="control">'.form_submit('action', 'Archive Issue', 'class="button is-warning" data-confirm="Are you sure you want to archive this support issue?"').'</div>';
            break;
        case "O":
            echo '<div class="control">'.form_submit('action', 'Close Issue', 'class="button is-info" data-confirm="Are you sure you want to complete this support issue?"').'</div>';
            echo '<div class="control">'.form_submit('action', 'Archive Issue', 'class="button is-warning" data-confirm="Are you sure you want to archive this support issue?"').'</div>';
            break;
    }
    ?>
    </div>


    <?php echo form_close(); ?>
</div>

<div id="support-tasks" class="tab-panel">
    <?php echo form_open('support/action'); ?>
    <?php echo form_hidden('support_id', $support['support_id']); ?>
    <h3 class="title is-4">Support Tasks</h3>
    <div class="field is-grouped">
        <p class="control">
            <?php echo form_label('Date:', 'task_date_mo'); ?>
        </p>
        <p class="control">
            <?php echo form_input('task_date_mo', '', 'class="input is-small" maxlength="2" size="2" data-required data-month data-autotab data-label="Date Month"'); ?>
        </p>
        <p class="control slash">/</p>
        <p class="control">
            <?php echo form_input('task_date_day', '', 'class="input is-small" maxlength="2" size="2" data-required data-day data-autotab data-label="Date Day"'); ?>
        </p>
        <p class="control slash">/</p>
        <p class="control">
            <?php echo form_input('task_date_yr', date('Y'), 'class="input is-small" maxlength="4" size="4" data-required data-year data-label="Date Year"'); ?>
        </p>
        <div class="control is-expanded">
            <?php echo form_input('task', '', 'placeholder="Enter notes here..." class="input is-small" maxlength="250" data-required'); ?>
        </div>
        <div class="control">
            <?php echo form_submit('action', 'Add Task', 'class="button is-info is-fullwidth is-small"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>

    <hr>

    <div class="columns is-multiline">
        <?php
        if (empty($tasks)) {
        ?>

        <div class="column is-full">Issue does not currently have any tasks.</div>

        <?php
        } else {
            foreach ($tasks as $row) {
        ?>
        <div class="column is-half">
            <div class="card">
                <div class="card-content">
                    <p>
                        <i class="fas fa-quote-left"></i>
                        <?php echo $row['task']; ?>
                        <i class="fas fa-quote-right"></i>
                    </p>
                    <br>
                    <p class="is-size-7 has-text-right">
                        <?php 
                            echo $this->Employee_model->get_by_employee_id($row['employee_id'])['employee_name'] . ' - ' . $this->format->date($row['task_date']);
                        ?>
                    </p>
                </div>
                <div class="card-footer">
                    <?php
                        if (trim($row['task_completed']) != '0000-00-00 00:00:00') {
                            echo '<div class="card-footer-item has-text-centered has-text-success is-size-7">Completed ' . $row['task_completed'] . ' by ' . $this->Employee_model->get_by_employee_id($row['task_completed_by'])['employee_name'] . ' </div>';
                        } else {
                            echo anchor('support/complete_task/'.$row['support_id'].'/'.$row['task_id'], '<i class="fas fa-check" title="Complete Task"></i>', 'class="card-footer-item has-text-success"');
                            // echo anchor('support/edit_task/'.$row['support_id'].'/'.$row['task_id'], '<i class="fas fa-edit" title="Edit Task"></i>', 'class="card-footer-item has-text-link"');
                            echo anchor('support/delete_task/'.$row['support_id'].'/'.$row['task_id'], '<i class="fas fa-trash" title="Delete Task"></i>', 'class="card-footer-item has-text-danger"');
                        }
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

<div id="support-files" class="tab-panel">
    <h3 class="title is-4">Attached Files</h3>
    <?php echo form_open_multipart('support/action'); ?>
    <?php echo form_hidden('support_id', $support['support_id']); ?>
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

        <div>Issue does not currently have any attached files.</div>

        <?php
        } else {

            foreach ($files as $row) {
        ?>
        <div class="column is-one-quarter">
            <div class="notification is-<?php echo $this->theme_colors[array_rand($this->theme_colors)]; ?>">
                <?php echo anchor('support/delete_file/'.$row['support_id'].'/'.$row['file_id'], '', 'class="delete"'); ?>
                <?php echo anchor('public/files/support/'.$row['support_id']."/".$row['file_name'], $row['file_name'], 'target="_blank"'); ?>
            </div>
        </div>
        <?php
            }
        }
        ?>
    </div>
</div>

<div id="support-history" class="tab-panel">
    <h3 class="title is-4">Support History</h3>
    <?php
        if (empty($history)) {
    ?>
    <p>There is currently no history for this project.</p>
    <?php
        } else {
    ?>
    <table class="table is-narrow is-fullwidth datatable">
        <thead>
            <tr>
                <th>Action</th>
                <th>Employee</th>
                <th>Date/Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($history as $row) {
            ?>
            <tr>
                <td><?php echo $row['history_action']; ?></td>
                <td><?php echo $this->Employee_model->get_by_employee_id($row['history_employee_id'])['employee_name']; ?></td>
                <td><?php echo $row['history_datetime']; ?></td>
            </tr>
            <?php
                }
            ?>
        </tbody>
    </table>
    <?php
        }
    ?>
</div>
