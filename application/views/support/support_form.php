<?php echo form_open('support/action'); ?>
<?php echo form_hidden('support_id'); ?>

<div class="field">
    <?php echo form_label('Support Name:','support_name', 'class="label"'); ?>
    <div class="control">
        <?php echo form_input('support_name','','class="input is-small" maxlength="100" data-required'); ?>
    </div>
</div>

<div class="field">
    <?php echo form_label('Customer:','customer_id', 'class="label"'); ?>
    <div class="control">
        <div class="select is-small is-fullwidth">
            <?php echo form_dropdown('customer_id',$customers,'','data-required data-label="Requesting Customer"'); ?>
        </div>
    </div>
</div>

<div class="field">
    <?php echo form_label('Support Status:','support_status', 'class="label"'); ?>
    <div class="control">
        <div class="select is-small is-fullwidth">
            <?php echo form_dropdown('support_status',['O' => 'Open', 'C' => 'Closed'],'','data-required data-label="Support Status"'); ?>
        </div>
    </div>
</div>

<div class="field">
    <?php echo form_label('Support Details:','support_details', 'class="label"'); ?>
    <div class="control">
        <?php echo form_textarea('support_details', '', 'class="tinymce"'); ?>
    </div>
</div>

<div class="columns">
    <div class="column is-half">
        <?php echo form_label('Support Date/Time:','support_date_mo', 'class="label"'); ?>
        <div class="field is-grouped">
            <p class="control">
                <?php echo form_input('support_date_mo','','class="input is-small" maxlength="2" size="2" data-required data-month data-autotab data-label="Support Date Month"'); ?>
            </p>
            <p class="control slash">/</p>
            <p class="control">
                <?php echo form_input('support_date_day','','class="input is-small" maxlength="2" size="2" data-required data-day data-autotab data-label="Support Date Day"'); ?>
            </p>
            <p class="control slash">/</p>
            <p class="control">
                <?php echo form_input('support_date_yr',date('Y'),'class="input is-small" maxlength="4" size="4" data-required data-year data-label="Support Date Year"'); ?>
            </p>
            <p class="control">
                <?php echo form_input('support_time_hr','','class="input is-small" maxlength="2" size="2" data-required data-hour data-autotab'); ?> 
            </p>
            <p class="control slash">:</p>
            <p class="control">
                <?php echo form_input('support_time_mn','','class="input is-small" maxlength="2" size="2" data-required data-minutes'); ?> 
            </p>
        </div>
    </div>
    <div class="column is-half">
        <?php echo form_label('Completed Date/Time:','support_complete_date_mo', 'class="label"'); ?>
        <div class="field is-grouped">
            <p class="control">
                <?php echo form_input('support_complete_date_mo','','class="input is-small" maxlength="2" size="2" data-month data-autotab'); ?>
            </p>
            <p class="control slash">/</p>
            <p class="control">
                <?php echo form_input('support_complete_date_day','','class="input is-small" maxlength="2" size="2" data-day data-autotab '); ?>
            </p>
            <p class="control slash">/</p>
            <p class="control">
                <?php echo form_input('support_complete_date_yr','','class="input is-small" maxlength="4" size="4" data-year'); ?>
            </p>
            <p class="control">
                <?php echo form_input('support_complete_time_hr','','class="input is-small" maxlength="2" size="2" data-hour data-autotab'); ?>
            </p>
            <p class="control slash">:</p>
            <p class="control">
                <?php echo form_input('support_complete_time_mn','','class="input is-small" maxlength="2" size="2" data-minutes'); ?> 
            </p>
        </div>
    </div>
</div>

<div><?php echo form_label('Support Duration:', 'support_duration_days', 'class="label"'); ?></div>
<div class="columns">
    <div class="column is-one-third">
        <div class="field has-addons is-fullwidth">
            <div class="control is-expanded">
                <?php echo form_input('support_duration_days','','class="input is-small" maxlength="2" size="3" data-numeric data-autotab'); ?>
            </div>
            <div class="control">
                <a class="button is-small is-static">Days</a>
            </div>
        </div>
    </div>

    <div class="column is-one-third">
        <div class="field has-addons is-fullwidth">
            <div class="control is-expanded">
                <?php echo form_input('support_duration_hours','','class="input is-small" maxlength="2" size="3" data-numeric data-autotab'); ?>
            </div>
            <div class="control">
                <a class="button is-small is-static">Hours</a>
            </div>
        </div>
    </div>

    <div class="column is-one-third">
        <div class="field has-addons is-fullwidth">
            <div class="control is-expanded">
                <?php echo form_input('support_duration_minutes','','class="input is-small" maxlength="2" size="3" data-numeric data-autotab'); ?>
            </div>
            <div class="control">
                <a class="button is-small is-static">Minutes</a>
            </div>
        </div>
    </div>
</div>

<hr/>


<div class="field">
	<div class="control">
		<?php echo form_label('Assigned Department(s):', '', 'class="label"');  ?>
		<?php echo form_checkbox('all_departments'); ?>
		<?php echo form_label('All Departments','all_departments'); ?>
	</div>
</div>

<div class="columns is-multiline">
	<?php
		if(!empty($departments)){
			foreach($departments as $row){
				$checked="";
				if(isset($_SESSION['employee_departments'][$row['department_id']])){
					if($_SESSION['employee_departments'][$row['department_id']]==$row['department_name']){
						$checked="CHECKED";
					}
				}
	?>
	<div class="column is-one-quarter assigned_departments">
		<?php echo form_checkbox('department['.$row['department_id'].']',$row['department_id'], $checked); ?>
		<?php echo form_label($row['department_name'],'department['.$row['department_id'].']'); ?>
	</div>
	<?php
			}
		}else{
	?>
	There are currently no departments in the system.  <?php echo anchor('admin/departments/form','Click here to add one.'); ?>
	<?php
		}
	?>
</div>

<hr/>

<div class="field">
	<div class="control">
		<?php echo form_label('Assigned Employee(s):', '', 'class="label"');  ?>
		<?php echo form_checkbox('all_employees'); ?>
		<?php echo form_label('All Employees','all_employees'); ?>
	</div>
</div>

<div class="columns is-multiline">
	<?php
		if(!empty($employees)){
			foreach($employees as $row){
				$checked="";
				if($_SESSION['employee_id']==$row['employee_id']) $checked="CHECKED";
	?>
	<div class="column is-one-quarter assigned_employees">
		<?php echo form_checkbox('employee['.$row['employee_id'].']',$row['employee_id'], $checked); ?>
		<?php echo form_label($row['employee_name'],'employee['.$row['employee_id'].']'); ?>
	</div>
	<?php
			}
		}else{
	?>
	There are currently no employees in the system.  <?php echo anchor('admin/employees/form','Click here to add one.'); ?>
	<?php
		}
	?>
</div>

<hr/>

<div class="field is-grouped is-grouped-centered">
    <p class="control"><?php echo form_submit('action','Save','class="button is-info"'); ?></p>
    <p class="control"><?php echo anchor('projects', 'Cancel', 'class="button is-warning"'); ?></p>
</div>

<?php echo form_close(); ?>
