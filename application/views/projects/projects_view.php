<h1 class="title is-3">
    <?php echo $project['project_name']; ?>
    <?php echo anchor('projects/form/'.$project['project_id'], '<i class="fas fa-edit"></i> Edit Project', 'class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="project-details"><a href="#project-details-tab"><i class="fas fa-clipboard-list "></i> Details</a></li>
        <li class="tab" data-target="project-tasks"><a href="#project-tasks-tab"><i class="fas fa-tasks"></i> Tasks</a></li>
        <li class="tab" data-target="project-notes"><a href="#project-notes-tab"><i class="fas fa-edit"></i> Notes</a></li>
        <li class="tab" data-target="project-reminders"><a href="#project-reminders-tab"><i class="fas fa-clock"></i> Reminders</a></li>
        <li class="tab" data-target="project-files"><a href="#project-files-tab"><i class="fas fa-paperclip"></i> Files</a></li>
        <li class="tab" data-target="project-history"><a href="#project-history-tab"><i class="fas fa-history"></i> History</a></li>
    </ul>
</div>

<div id="project-details" class="tab-panel tab-panel-init">
    <h3 class="title is-4">Project Details</h3>
    <progress class="progress is-primary" value="<?php echo $project['project_percentage_completed']; ?>" max="100"><?php echo $project['project_percentage_completed']; ?>% Complete</progress>
    <div>
        <strong>Project Lead: </strong>
        <?php echo $this->Employee_model->get_by_employee_id($project['project_lead'])['employee_name']; ?>
    </div>
    <div class="columns">
        <div class="column is-one-third">
            <strong>Project Date: </strong>
            <?php echo $this->format->date($project['project_date']); ?>
        </div>
        <div class="column is-one-third">
            <strong>Estimated Completion: </strong>
            <?php echo $this->format->date($project['project_estimated_completion_date']); ?>
        </div>
        <?php if ($project['project_completed_date'] != '') { ?>
            <div class="column is-one-third">
                <strong>Completed: </strong>
                <?php echo $this->format->date($project['project_completed_date']); ?>
            </div>
        <?php } ?>
    </div>

    <?php if ($project['project_details'] != '') { ?>
    <div>
        <strong>Project Details:</strong>
    </div>

    <div>
        <?php echo $project['project_details']; ?>  
    </div>
    <?php } ?>

    <hr/>

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

    <?php echo form_open('projects/action', 'id="details-form"'); ?>
    <?php echo form_hidden('project_id', $project['project_id']); ?>
    <div class="field is-grouped is-grouped-centered">
    <?php
    if ($_SESSION['employee_admin'] == 'CHECKED' or $_SESSION['employee_id'] == $project['project_lead']) {
        if ($project['project_approved'] != 'Y') {
            switch ($project['project_status']) {
                case "A":
                    echo '<div class="control">'.form_submit('action', 'Restore Project', 'class="button is-success" data-confirm="Are you sure you want to restore this project?"').'</div>';
                    break;
                case "C":
                    if ($_SESSION['employee_admin'] == "CHECKED") {
                        echo '<div class="control">'.form_submit('action', 'Approve Project', 'class="button is-success" data-confirm="Are you sure you want to approve this project?"').'</div>';
                    }
                    echo '<div class="control">'.form_submit('action', 'Incomplete Project', 'class="button is-danger" data-confirm="Are you sure you want to incomplete this project?"').'</div>';
                    echo '<div class="control">'.form_submit('action', 'Archive Project', 'class="button is-warning" data-confirm="Are you sure you want to archive this project?"').'</div>';
                    break;
                case "I":
                    if ($_SESSION['employee_admin'] == "CHECKED") {
                        echo '<div class="control">'.form_submit('action', 'Approve Project', 'class="button is-success" data-confirm="Are you sure you want to approve this project?"').'</div>';
                    } else {
                        echo '<div class="control">'.form_submit('action', 'Complete Project', 'class="button is-info" data-confirm="Are you sure you want to complete this project?"').'</div>';
                    }
                    echo '<div class="control">'.form_submit('action', 'Archive Project', 'class="button is-warning" data-confirm="Are you sure you want to archive this project?"').'</div>';
                    break;
            }
        }
    }
    ?>
    </div>
    <?php echo form_close(); ?>
</div>

<div id="project-tasks" class="tab-panel">
    <h3 class="title is-4">
        Project Tasks
        <a data-modal="task-form" class="button is-info is-small"><i class="fas fa-plus-square"></i> Add Task</a>    
    </h3>

    <div id="task-form" class="modal">
        <?php $this->load->view('projects/projects_tasks_form'); ?>
        <button class="modal-close is-large" data-modal="task-form" aria-label="close"></button>
    </div>

    <div class="columns is-multiline is-mobile">
        <?php
        if (empty($tasks)) {
            ?>

        <div class="column is-full">Project does not currently have any tasks.</div>

            <?php
        } else {
            foreach ($tasks as $row) {
                ?>
        <div class="column is-full-mobile is-full-tablet is-one-third-fullhd">
            <div class="card">
                <?php
                if (trim($row['task_completed_date']) != '') {
                    echo '<div class="message is-success"><div class="message-body"><i class="fas fa-check"></i> Task Completed ' . $this->format->date($row['task_completed_date']) . ' by ' . $this->Employee_model->get_by_employee_id($row['task_completed_by'])['employee_name'] . '</div></div>';
                } elseif (trim($row['task_due_date']) != '' and date('Ymd') > $row['task_due_date']) {
                    echo '<div class="message is-danger"><div class="message-body"><i class="fas fa-exclamation-triangle"></i> Task is Past Due!</div></div>';
                } else {
                    echo '<div class="message is-warning"><div class="message-body"><i class="fas fa-tasks"></i> Task is Incomplete</div></div>';
                }
                ?>
                <div class="card-content">
                    <div class="columns is-size-7 is-multiline">
                        <div class="column is-full">
                            <h5 class="is-size-5"><?php echo ucfirst($row['task_title']); ?></h5>
                            <?php if (trim($row['task_description']) != '') { ?>
                            <p>
                                <i class="fas fa-quote-left"></i>
                                <?php echo $row['task_description']; ?>
                                <i class="fas fa-quote-right"></i>
                            </p>
                            <?php } ?>
                        </div>
                        <div class="column is-full">
                            <div><strong>Assigned:</strong></div>
                            <div>
                                <?php
                                    $assigned_to = $this->Project_model->get_task_assigned_to($row['project_task_id']);
                                if (!empty($assigned_to)) {
                                    $task_assigned = '';
                                    foreach ($assigned_to as $assigned) {
                                        $task_assigned .= $assigned['employee_name'].", ";
                                    }
                                    $task_assigned = substr($task_assigned, 0, -2);

                                    echo "<strong>" . $this->format->date($row['task_assigned_date']) . "</strong> by <strong>" . $this->Employee_model->get_by_employee_id($row['task_assigned_by'])['employee_name'] . "</strong>";
                                    if (trim($task_assigned) != '') {
                                        echo " to <strong>" . $task_assigned . "</strong>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="column is-half">
                            <div><strong>Start Date:</strong></div>
                            <div><?php echo $this->format->date($row['task_start_date']); ?></div>
                        </div>
                        <div class="column is-half">
                            <?php if (trim($row['task_due_date']) != '') { ?>
                            <div><strong>Due Date:</strong></div>
                            <div><?php echo $this->format->date($row['task_due_date']); ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <?php
                    if (trim($row['task_completed_date']) == '') {
                        if ($_SESSION['employee_admin'] == 'CHECKED' or $_SESSION['employee_id'] == $project['project_lead']) {
                            echo anchor('projects/complete_task/'.$row['project_id'].'/'.$row['project_task_id'], '<i class="fas fa-check" title="Complete Task"></i>', 'class="card-footer-item has-text-success"');
                            echo anchor('api/projects/get_task/' . $row['project_task_id'], '<i class="fas fa-edit"></i>', 'class="card-footer-item" ajax-populate="#task-form" data-modal="task-form"');
                            echo anchor('projects/delete_task/'.$row['project_id'].'/'.$row['project_task_id'], '<i class="fas fa-trash" title="Delete Task"></i>', 'class="card-footer-item has-text-danger"');
                        }
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

<div id="project-notes" class="tab-panel">
    <h3 class="title is-4">Project Notes</h3>
    <?php echo form_open('projects/action', 'id="notes-form"'); ?>
    <?php echo form_hidden('project_id', $project['project_id']); ?>
    <div class="field is-grouped">
        <div class="control is-expanded">
            <?php echo form_textarea('note', '', 'class="textarea is-small" placeholder="Enter notes here" data-required rows="3"'); ?>
        </div>
    </div>
    <div class="field is-grouped is-grouped-centered">
        <div class="control">
            <?php echo form_submit('action', 'Save Note', 'class="button is-info"'); ?>
            <?php echo form_submit('action', 'Clear Note', 'class="button is-warning"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>

    <hr>

    <div class="columns is-multiline is-mobile">
        <?php
        if (empty($notes)) {
            ?>

        <div class="column is-full">Project does not currently have any notes.</div>

            <?php
        } else {
            foreach ($notes as $note) {
                ?>
        <div class="column is-full-mobile is-half-tablet is-half-desktop is-one-third-fullhd">
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
                    <a href="<?php echo base_url('api/projects/get_note/' . $note['project_note_id']); ?>" ajax-populate="#notes-form" class="card-footer-item"><i class="fas fa-edit"></i></a>
                    <?php
                    if ($_SESSION['employee_admin'] == 'CHECKED' or $_SESSION['employee_id'] == $project['project_lead']) {
                        echo anchor('projects/delete_note/' . $project['project_id'] . '/' . $note['project_note_id'], '<i class="fas fa-trash-alt"></i>', 'class="card-footer-item has-text-danger"');
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

<div id="project-reminders" class="tab-panel">
    <h3 class="title is-4">Project Reminders</h3>
    <?php echo form_open('projects/action', 'id="reminders-form"'); ?>
    <?php echo form_hidden('project_id', $project['project_id']); ?>   
    <?php echo form_hidden('tab_target', '#project-reminders'); ?>   
    
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
    <div class="field is-grouped is-grouped-centered">
        <div class="control">
            <?php echo form_submit('action', 'Add Reminder', 'class="button is-info"'); ?>
        </div>
    </div>
    <?php echo form_close(); ?>

    <hr>

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
            foreach ($reminders as $key => $reminder) {
                ?>
            <tr>
                <td><?php echo $reminder['reminder']; ?></td>
                <td><?php echo $this->format->date($reminder['reminder_date']); ?></td>
                <td>
                <?php echo anchor('projects/delete_reminder/' . $project['project_id'] . '/' . $reminder['project_reminder_id'], '<i class="fas fa-trash-alt"></i>', 'class="button is-danger"'); ?>
                </td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div id="project-files" class="tab-panel">
    <?php echo form_open_multipart('projects/action', 'id="files-form"'); ?>
    <?php echo form_hidden('project_id', $project['project_id']); ?>
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

        <div>Project does not currently have any attached files.</div>

            <?php
        } else {
            foreach ($files as $row) {
                ?>
        <div class="column is-one-quarter">
            <div class="notification is-<?php echo $this->theme_colors[array_rand($this->theme_colors)]; ?>">
                <?php echo anchor('projects/delete_file/'.$row['project_id'].'/'.$row['file_id'], '', 'class="delete"'); ?>
                <?php echo anchor('public/files/projects/'.$row['project_id']."/".$row['file_name'], '<i class="fas fa-download"></i> ' . $this->format->shorten($row['file_name'], 20), 'target="_blank"'); ?>
            </div>
        </div>
                <?php
            }
        }
        ?>
    </div>
</div>

<div id="project-history" class="tab-panel">
    <h3 class="title is-4">Project History</h3>
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
        foreach ($history as $row) {
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

<br>

<?php
if ($project['project_approved'] == "Y") {
    ?>
<p class="has-text-centered">
    This project was approved by <u><?php echo $this->Employee_model->get_by_employee_id($project['project_approved_by'])['employee_name']; ?></u> on <u><?php echo $this->format->date($project['project_approved_date']); ?></u>.
</p>
<br>
    <?php
}
?>
