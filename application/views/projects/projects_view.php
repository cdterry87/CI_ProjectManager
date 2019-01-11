<?php echo form_open_multipart('projects/action'); ?>
<?php echo form_hidden('project_id',$project['project_id']); ?>

<h1 class="title is-3">
    <?php echo $project['project_name']; ?>
    <?php echo anchor('projects/form/'.$project['project_id'],'<i class="fas fa-edit"></i> Edit Project','class="button is-info is-small"'); ?>
</h1>

<div>
    <strong>Project Date: </strong>
    <?php echo $this->format->date($project['project_date']); ?>
</div>

<div>
    <strong>Project Details:</strong>
</div>

<div>
    <?php echo $project['project_details']; ?>  
</div>

<hr/>

<div class="columns">
    <div class="column is-one-third">
        <div class="box notification is-warning has-text-dark">
            <div class="heading">Customer</div>
            <?php
                if(empty($customer)){
            ?>
            <div class="title is-5">N/A</div>
            <?php
                }else{
                    $list_customers='';
                    foreach($customer as $row){
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
			if(empty($departments)){
		?>
		<div class="title is-5">N/A</div>
		<?php
			}else{
				$list_departments='';
				foreach($departments as $row){
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
                if(empty($employees)){
            ?>
            <div class="title is-5">N/A</div>
            <?php
                }else{
                    $list_employees='';
                    foreach($employees as $row){
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

<hr/>

<h3 class="title is-4">Project Notes</h3>
<div class="field is-grouped">
	<p class="control">
		<?php echo form_label('Date:','task_date_mo'); ?>
	</p>
	<p class="control">
		<?php echo form_input('task_date_mo','','class="input" maxlength="2" size="2" data-required data-month data-autotab data-label="Date Month"'); ?>
	</p>
	<p class="control slash">/</p>
	<p class="control">
		<?php echo form_input('task_date_day','','class="input" maxlength="2" size="2" data-required data-day data-autotab data-label="Date Day"'); ?>
	</p>
	<p class="control slash">/</p>
	<p class="control">
		<?php echo form_input('task_date_yr',date('Y'),'class="input" maxlength="4" size="4" data-required data-year data-label="Date Year"'); ?>
	</p>
	<div class="control is-expanded">
		<?php echo form_input('task','','placeholder="Enter notes here..." class="input" maxlength="250" data-required'); ?>
	</div>
	<div class="class">
		<?php echo form_submit('action','Add Note','class="button is-info is-fullwidth"'); ?>
	</div>
</div>

<table class="table is-striped is-narrow is-fullwidth">
	<tbody>
		<?php
			if(empty($tasks)){
		?>
		<tr>
			<td colspan="3">Project does not currently have any notes.</td>
		</tr>
		<?php
			}else{
				$task_num=0;
				foreach($tasks as $row){
					$task_num++;
		?>
		<tr>
			<td><?php echo $task_num.". ".$this->format->date($row['task_date'])." - ".$row['task']; ?></td>
			<td width="10%"><?php echo anchor('projects/delete_task/'.$row['project_id'].'/'.$row['task_id'],'<i class="fas fa-trash"></i>','class="button is-danger is-fullwidth"'); ?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>

<hr/>

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
		<?php echo form_submit('action','Add File','class="button is-info is-fullwidth"'); ?>
	</div>
</div>

<table class="table is-narrow is-fullwidth">
	<tbody>
		<?php
			$file_num=0;
			if(empty($files)){
		?>
		<tr>
			<td colspan="2">Project does not currently have any attached files.</td>
		</tr>
		<?php
			}else{
				foreach($files as $row){
					$file_num++;
		?>
		<tr>
			<td><?php echo anchor('public/files/projects/'.$row['project_id']."/".$row['file_name'],$file_num.". ".$row['file_name'],'target="_blank"'); ?></td>
			<td width="10%"><?php echo anchor('projects/delete_file/'.$row['project_id'].'/'.$row['file_id'],'<i class="fas fa-trash"></i>','class="button is-danger is-fullwidth"'); ?></td>
		</tr>
		<?php
				}
			}
		?>
	</tbody>
</table>

<div class="field is-grouped is-grouped-centered">
<?php
switch($project['project_status']){
	case "A":
		echo '<div class="control">'.form_submit('action','Restore Project','class="button is-success" data-confirm="Are you sure you want to restore this project?"').'</div>';
        break;
	case "C":
		echo '<div class="control">'.form_submit('action','Incomplete Project','class="button is-danger" data-confirm="Are you sure you want to incomplete this project?"').'</div>';
		echo '<div class="control">'.form_submit('action','Archive Project','class="button is-warning" data-confirm="Are you sure you want to archive this project?"').'</div>';
        break;
	case "I":
		echo '<div class="control">'.form_submit('action','Complete Project','class="button is-info" data-confirm="Are you sure you want to complete this project?"').'</div>';
		echo '<div class="control">'.form_submit('action','Archive Project','class="button is-warning" data-confirm="Are you sure you want to archive this project?"').'</div>';
        break;
	
}
?>
</div>

<?php echo form_close(); ?>
