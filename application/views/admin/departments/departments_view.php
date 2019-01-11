
<h1 class="title is-3">
    <?php echo $department['department_name']; ?> 
    <?php echo anchor('admin/departments/form/'.$department['department_id'],'<i class="fas fa-edit"></i> Edit Department','class="button is-info is-small"'); ?>
</h1>

<div class="tabs is-centered">
    <ul>
        <li class="tab tab-init" data-target="department-employees"><a><i class="fas fa-user-tie"></i>Employees</a></li>
        <li class="tab" data-target="department-projects"><a><i class="fas fa-project-diagram"></i>Projects</a></li>
        <li class="tab" data-target="department-support"><a><i class="fas fa-bug"></i> Support</a></li>
    </ul>
</div>

<div id="department-employees" class="tab-panel tab-panel-init">
    <h2 class="title is-4">Employees</h2>
    <?php $this->load->view('admin/employees/employees_list'); ?>
</div>

<div id="department-projects" class="tab-panel">
    <h2 class="title is-4">Incomplete Projects</h2>
    <?php $this->load->view('projects/projects_incomplete'); ?>
</div>

<div id="department-support" class="tab-panel">
    <h2 class="title is-4">Open Support</h2>
    <?php $this->load->view('support/support_open'); ?>
</div>
