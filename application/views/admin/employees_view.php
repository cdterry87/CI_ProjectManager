<h1 class="title is-3">
    <?php echo $employee['employee_name']; ?>
    <?php echo anchor('admin/employees/form/'.$employee['employee_id'],'<i class="fas fa-edit"></i> Edit Employee','class="button is-info is-small"'); ?>
</h1>

<table class="table is-fullwidth is-narrow">
    <thead>
        <tr>
            <td colspan="2"><h2 class="title is-5">Details:</h2></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="15%">
                <p><strong>Username:</strong></p>
                <p><strong>Email:</strong></p>
                <p><strong>Department(s)</strong></p>
            </td>
            <td>
                <p>
                    
                    <span class="tags">
                        <?php echo $employee['employee_username']; ?> 
                        &nbsp;&nbsp;&nbsp;
                        <?php 
                            if ($employee['employee_admin'] == "CHECKED") {
                                echo '<span class="tag is-success">admin</span>';
                            }
                            if ($employee['employee_sales'] == "CHECKED") {
                                echo '<span class="tag is-warning">sales</span>';
                            }
                        ?>
                    </span>
                </p>
                <p><?php echo $employee['employee_email']; ?></p>
                <p>
                    <div class="tags">
                        <?php
                            if(empty($departments)){
                        ?>
                        <p>Employee is not currently in any departments.</p>
                        <?php
                            }else{
                                foreach($departments as $row){
                                    $link='admin/departments/view/'.$row['department_id'];
                        ?>
                        <?php echo anchor($link, '<span>' . $row['department_name'] . '</span>', 'class="tag is-link"'); ?>
                        <?php
                                }
                            }
                        ?>
                    </div>
                </p>
            </td>
        </tr>
    </tbody>
</table>

<hr>

<div class="panel">
	<div class="panel-heading has-background-info has-text-white">
		<h2><i class="fa fa-project-diagram"></i> Incomplete Projects</h2>
    </div>
    <div class="panel-block">
        <?php $this->load->view('projects/projects_incomplete'); ?>
    </div>
</div>

<div class="panel">
	<div class="panel-heading has-background-danger has-text-white">
		<h2><i class="fas fa-bug"></i> Open Support</h2>
    </div>
    <div class="panel-block">
        <?php $this->load->view('support/support_open'); ?>
    </div>
</div>
