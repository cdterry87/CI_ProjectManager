
<h1 class="title is-3">
    <?php echo $department['department_name']; ?> 
    <?php echo anchor('admin/departments/form/'.$department['department_id'],'<i class="fas fa-edit"></i> Edit Department','class="button is-info is-small"'); ?>
</h1>


<div class="panel">
	<div class="panel-heading has-background-warning has-text-dark">
		<h2><i class="fas fa-user-tie"></i>Employees</h2>
    </div>
    <?php
        if(empty($employees)){
    ?>
    <div class="panel-block">
        There are currently no employees in this department.
	</div>
    <?php
        }else{
            foreach($employees as $row){
                $link='admin/employees/form/'.$row['employee_id'];
    ?>
    <div class="panel-block">
        <?php echo anchor($link, $row['employee_name']); ?>
	</div>
    <?php
            }
        }
    ?>
</div>

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
