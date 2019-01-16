<h1 class="title is-3">
    <?php echo $project['project_name']; ?>
    <?php echo anchor('projects/form/'.$project['project_id'], '<i class="fas fa-edit"></i> Edit Project', 'class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="project-details"><a><i class="fas fa-clipboard-list "></i>Details</a></li>
        <li class="tab" data-target="project-tasks"><a><i class="fas fa-tasks"></i>Tasks</a></li>
        <li class="tab" data-target="project-notes"><a><i class="fas fa-edit"></i> Notes</a></li>
        <li class="tab" data-target="project-reminders"><a><i class="fas fa-clock"></i> Reminders</a></li>
        <li class="tab" data-target="project-files"><a><i class="fas fa-paperclip"></i>Files</a></li>
    </ul>
</div>

<div id="project-details" class="tab-panel tab-panel-init">
    <progress class="progress is-primary" value="<?php echo $project['project_percentage_completed']; ?>" max="100"><?php echo $project['project_percentage_completed']; ?>% Complete</progress>
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
</div>

<div id="project-tasks" class="tab-panel">
    <div id="task-form" class="modal">
        <?php $this->load->view('projects/projects_tasks_form'); ?>
        <button class="modal-close is-large" data-modal="task-form" aria-label="close"></button>
    </div>

    <div class="field is-grouped is-grouped-centered">
        <p class="control">
            <a data-modal="task-form" class="button is-info">Add Task</a>    
        </p>
    </div>

    <hr>

    <table class="table is-striped is-narrow is-fullwidth">
        <tr>
            <th>Task</th>
            <th width="15%">Date</th>
            <th width="10%">Delete</th>
        </tr>
        <tbody>
            <?php
            if (empty($tasks)) {
                ?>
            <tr>
                <td colspan="3">Project does not currently have any tasks.</td>
            </tr>
                <?php
            } else {
                $task_num=0;
                foreach ($tasks as $row) {
                    $task_num++;
                    ?>
            <tr>
                <td><?php echo $row['task']; ?></td>
                <td><?php echo $this->format->date($row['task_date']); ?></td>
                <td width="10%"><?php echo anchor('projects/delete_task/'.$row['project_id'].'/'.$row['project_task_id'], '<i class="fas fa-trash"></i>', 'class="button is-danger is-fullwidth"'); ?></td>
            </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<div id="project-notes" class="tab-panel">
    <?php echo form_open('projects/action', 'id="notes-form"'); ?>
    <?php echo form_hidden('project_id', $project['project_id']); ?>
    <div class="field is-grouped">
        <div class="control is-expanded">
            <?php echo form_textarea('note', '', 'class="textarea" placeholder="Enter notes here" data-required rows="3"'); ?>
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
            foreach ($notes as $key => $note) {
                $employee = $this->Employee_model->get_by_employee_id($note['employee_id']);
                ?>
            <tr>
                <td><?php echo $note['note']; ?></td>
                <td><?php echo $note['datetime']; ?></td>
                <td><?php echo $employee['employee_name']; ?></td>
                <td>
                <?php echo anchor('projects/delete_note/' . $project['project_id'] . '/' . $note['project_note_id'], '<i class="fas fa-trash-alt"></i>', 'class="button is-danger"'); ?>
                </td>
            </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>

<div id="project-reminders" class="tab-panel">
    <?php echo form_open('projects/action', 'id="reminders-form"'); ?>
    <?php echo form_hidden('project_id', $project['project_id']); ?>   
    
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
            <?php echo form_textarea('reminder', '', 'class="textarea" placeholder="Enter reminder here" data-required rows="3"'); ?>
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

    <hr>

    <table class="table is-narrow is-fullwidth">
        <tbody>
            <?php
                $file_num=0;
            if (empty($files)) {
                ?>
            <tr>
                <td colspan="2">Project does not currently have any attached files.</td>
            </tr>
                <?php
            } else {
                foreach ($files as $row) {
                    $file_num++;
                    ?>
            <tr>
                <td><?php echo anchor('public/files/projects/'.$row['project_id']."/".$row['file_name'], $file_num.". ".$row['file_name'], 'target="_blank"'); ?></td>
                <td width="10%"><?php echo anchor('projects/delete_file/'.$row['project_id'].'/'.$row['file_id'], '<i class="fas fa-trash"></i>', 'class="button is-danger is-fullwidth"'); ?></td>
            </tr>
                    <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>

<br>

<div class="field is-grouped is-grouped-centered">
<?php
switch ($project['project_status']) {
    case "A":
        echo '<div class="control">'.form_submit('action', 'Restore Project', 'class="button is-success" data-confirm="Are you sure you want to restore this project?"').'</div>';
        break;
    case "C":
        echo '<div class="control">'.form_submit('action', 'Incomplete Project', 'class="button is-danger" data-confirm="Are you sure you want to incomplete this project?"').'</div>';
        echo '<div class="control">'.form_submit('action', 'Archive Project', 'class="button is-warning" data-confirm="Are you sure you want to archive this project?"').'</div>';
        break;
    case "I":
        if ($_SESSION['employee_admin'] == "CHECKED") {
            echo '<div class="control">'.form_submit('action', 'Approve Project', 'class="button is-success" data-confirm="Are you sure you want to approve this project?"').'</div>';
        }
        echo '<div class="control">'.form_submit('action', 'Complete Project', 'class="button is-info" data-confirm="Are you sure you want to complete this project?"').'</div>';
        echo '<div class="control">'.form_submit('action', 'Archive Project', 'class="button is-warning" data-confirm="Are you sure you want to archive this project?"').'</div>';
        break;
}
?>
</div>
