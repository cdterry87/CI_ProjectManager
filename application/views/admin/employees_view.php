<h1 class="title is-3">
    <?php echo $employee['employee_name']; ?>
    <?php echo anchor('admin/employees/form/'.$employee['employee_id'],'<i class="fas fa-edit"></i> Edit Employee','class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="department-details"><a><i class="fas fa-clipboard-list"></i>Details</a></li>
        <li class="tab" data-target="department-projects"><a><i class="fas fa-project-diagram"></i>Projects</a></li>
        <li class="tab" data-target="department-support"><a><i class="fas fa-bug"></i> Support</a></li>
    </ul>
</div>

<div id="department-details" class="tab-panel tab-panel-init">
    <h2 class="title is-4">Details</h2>
    <div>
        <span class="tags">
            <strong>Username: </strong>
            <?php echo " ".$employee['employee_username']; ?> 
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
    </div>    
    <div>
        <strong>Email: </strong>
        <?php echo $employee['employee_email']; ?>
    </div>    
    <br>
    <div>
        <strong>Departments: </strong>
    </div>    
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
</div>

<div id="department-projects" class="tab-panel">
    <h2 class="title is-4">Incomplete Projects</h2>
    <?php $this->load->view('projects/projects_incomplete'); ?>
</div>

<div id="department-support" class="tab-panel">
    <h2 class="title is-4">Open Support</h2>
    <?php $this->load->view('support/support_open'); ?>
</div>
