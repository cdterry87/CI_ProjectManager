<ul class="menu-list">
    <li><a class="<?php echo ($this->current_uri == "" ? 'is-active' : '') ?>" href="<?php echo base_url('/'); ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
</ul>
<?php
if ($this->session->userdata('employee_admin') == "CHECKED") {
?>
<p class="menu-label">Admin</p>
<ul class="menu-list">
    <li><a class="<?php echo ($this->current_page == "departments" ? 'is-active' : '')  ?>" href="<?php echo base_url('admin/departments'); ?>"><i class="fas fa-building"></i> Departments</a></li>
    <li><a class="<?php echo ($this->current_page == "employees" ? 'is-active' : '')  ?>" href="<?php echo base_url('admin/employees'); ?>"><i class="fas fa-user-tie"></i> Employees</a></li>
    <li><a class="<?php echo ($this->current_page == "customers" ? 'is-active' : '')  ?>" href="<?php echo base_url('admin/customers'); ?>"><i class="fas fa-users"></i> Customers</a></li>
    <li><a class="<?php echo ($this->current_page == "systems" ? 'is-active' : '')  ?>" href="<?php echo base_url('admin/systems'); ?>"><i class="fas fa-cogs"></i> Systems</a></li>
</ul>
<?php
}
?>

<p class="menu-label">Projects</p>
<ul class="menu-list">
    <li><a class="<?php echo ($this->current_system == "projects" && $this->current_page == "" ? 'is-active' : '')  ?>" href="<?php echo base_url('projects'); ?>"><i class="fas fa-exclamation-circle"></i> Incomplete</a></li>
    <li><a class="<?php echo ($this->current_system == "projects" && $this->current_page == "complete" ? 'is-active' : '')  ?>" href="<?php echo base_url('projects/complete'); ?>"><i class="fas fa-check"></i> Complete</a></li>
    <li><a class="<?php echo ($this->current_system == "projects" && $this->current_page == "archive" ? 'is-active' : '')  ?>" href="<?php echo base_url('projects/archive'); ?>"><i class="fas fa-archive"></i> Archived</a></li>
    <li><a class="<?php echo ($this->current_system == "projects" && $this->current_page == "all" ? 'is-active' : '')  ?>" href="<?php echo base_url('projects/all'); ?>"><i class="fas fa-list"></i> All Projects</a></li>
</ul>

<?php
if ($this->session->userdata('employee_sales') != "CHECKED") {
?>
<p class="menu-label">Support</p>
<ul class="menu-list">
    <li><a class="<?php echo ($this->current_system == "support" && $this->current_page == ""  ? 'is-active' : '')  ?>" href="<?php echo base_url('support'); ?>"><i class="fas fa-exclamation-circle"></i> Open</a></li>
    <li><a class="<?php echo ($this->current_system == "support" && $this->current_page == "closed" ? 'is-active' : '')  ?>" href="<?php echo base_url('support/closed'); ?>"><i class="fas fa-check"></i> Closed</a></li>
    <li><a class="<?php echo ($this->current_system == "support" && $this->current_page == "archive" ? 'is-active' : '')  ?>" href="<?php echo base_url('support/archive'); ?>"><i class="fas fa-archive"></i> Archived</a></li>
    <li><a class="<?php echo ($this->current_system == "support" && $this->current_page == "all" ? 'is-active' : '')  ?>" href="<?php echo base_url('support/all'); ?>"><i class="fas fa-list"></i> All Support</a></li>
</ul>
<?php
}
?>

<p class="menu-label">Reports</p>
<ul class="menu-list">
    <li><a href="<?php echo base_url('reports/open_projects_support'); ?>"><i class="fas fa-list"></i> Full List</a></li>
</ul>