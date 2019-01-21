<?php echo form_open('projects/action', 'id="tasks-form"'); ?>
<?php echo form_hidden('project_id', $project['project_id']); ?>
<div class="modal-background" data-modal="task-form" ></div>
<div class="modal-card">
    <div class="modal-card-head">
        <h2 class="title is-4">Add Task</h2>
    </div>
    <div class="modal-card-body">
        <div id="ajax-messages"></div>
        <br>
        <div class="content">
            <div class="columns">
                <div class="column is-half">
                    <?php echo form_label('Start Date:', 'task_start_date_mo', 'class="label"'); ?>
                    <div class="field is-grouped">
                        <p class="control">
                            <?php echo form_input('task_start_date_mo', '', 'class="input is-small" maxlength="2" size="2" data-required data-month data-autotab data-label="Start Date Month"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_start_date_day', '', 'class="input is-small" maxlength="2" size="2" data-required data-day data-autotab data-label="Start Date Day"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_start_date_yr', date('Y'), 'class="input is-small" maxlength="4" size="4" data-required data-year data-label="Start Date Year"'); ?>
                        </p>
                    </div>
                </div>
                <div class="column is-half">
                    <?php echo form_label('Assign Date:', 'task_assigned_date_mo', 'class="label"'); ?>
                    <div class="field is-grouped">
                        <p class="control">
                            <?php echo form_input('task_assigned_date_mo', date('m'), 'class="input is-small" maxlength="2" size="2" data-month data-autotab data-label="Assigned Date Month"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_assigned_date_day', date('d'), 'class="input is-small" maxlength="2" size="2" data-day data-autotab data-label="Assigned Date Day"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_assigned_date_yr', date('Y'), 'class="input is-small" maxlength="4" size="4" data-year data-label="Assigned Date Year"'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="columns">
                <div class="column is-half">
                    <?php echo form_label('Due Date:', 'task_due_date_mo', 'class="label"'); ?>
                    <div class="field is-grouped">
                        <p class="control">
                            <?php echo form_input('task_due_date_mo', '', 'class="input is-small" maxlength="2" size="2" data-month data-autotab data-label="Due Date Month"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_due_date_day', '', 'class="input is-small" maxlength="2" size="2" data-day data-autotab data-label="Due Date Day"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_due_date_yr', '', 'class="input is-small" maxlength="4" size="4" data-year data-label="Due Date Year"'); ?>
                        </p>
                    </div>
                </div>
                <div class="column is-half">
                    <?php echo form_label('Completed Date:', 'task_completed_date_mo', 'class="label"'); ?>
                    <div class="field is-grouped">
                        <p class="control">
                            <?php echo form_input('task_completed_date_mo', '', 'class="input is-small" maxlength="2" size="2" data-month data-autotab data-label="Completed Date Month"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_completed_date_day', '', 'class="input is-small" maxlength="2" size="2" data-day data-autotab data-label="Completed Date Day"'); ?>
                        </p>
                        <p class="control slash">/</p>
                        <p class="control">
                            <?php echo form_input('task_completed_date_yr', '', 'class="input is-small" maxlength="4" size="4" data-year data-label="Completed Date Year"'); ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <?php echo form_label('Task Information:', 'task_title', 'class="label"'); ?>
                    <?php echo form_input('task_title', '', 'class="input is-small" data-required placeholder="Enter task title"'); ?>
                </div>
            </div>
            <div class="field">
                <div class="control">
                    <?php echo form_textarea('task_description', '', 'class="textarea is-small" placeholder="Enter task description" rows="3"'); ?>
                </div>
            </div>
            <hr>
            <div class="field">
                <div class="control">
                    <?php echo form_label('Assigned Employee(s):', '', 'class="label"');  ?>
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
        <div class="field is-grouped is-grouped-centered">
            <p class="control"><button type="submit" value='save task' class="button is-info ajax-btn">Save Task</button></p>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
