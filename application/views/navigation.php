<nav class="navbar is-transparent" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item <?php echo ($this->current_system == "" ? 'is-active' : '') ?>" href="<?php echo base_url('/'); ?>"><i class="fas fa-home"></i> Home</a>
        <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
            <?php if ($_SESSION['employee_admin'] == 'CHECKED') { ?>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link"><i class="fas fa-lock"></i> Admin</a>
                <div class="navbar-dropdown">
                    <a href="<?php echo base_url('admin/departments'); ?>" class="navbar-item">Departments</a>
                    <a href="<?php echo base_url('admin/employees'); ?>" class="navbar-item">Employees</a>
                    <a href="<?php echo base_url('admin/systems'); ?>" class="navbar-item">Systems</a>
                </div>
            </div>
            <?php } ?>

            <?php if ($_SESSION['employee_admin'] == 'CHECKED' or $_SESSION['employee_sales'] == 'CHECKED') { ?>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link"><i class="fas fa-coins"></i> Sales</a>
                <div class="navbar-dropdown">
                    <a href="<?php echo base_url('sales/customers'); ?>" class="navbar-item">Customers</a>
                </div>
            </div>
            <?php } ?>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link"><i class="fas fa-project-diagram"></i> Projects</a>
                <div class="navbar-dropdown">
                    <a href="<?php echo base_url('projects/form'); ?>" class="navbar-item">New Project</a>
                    <hr class="navbar-divider" />
                    <a href="<?php echo base_url('projects'); ?>" class="navbar-item">Incomplete</a>
                    <a href="<?php echo base_url('projects/complete'); ?>" class="navbar-item">Complete</a>
                    <a href="<?php echo base_url('projects/archive'); ?>" class="navbar-item">Archived</a>
                    <a href="<?php echo base_url('projects/all'); ?>" class="navbar-item">All Projects</a>
                </div>
            </div>
            <?php if ($_SESSION['employee_sales'] != 'CHECKED') { ?>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link"><i class="fas fa-bug"></i> Support</a>
                    <div class="navbar-dropdown">
                        <a href="<?php echo base_url('support/form'); ?>" class="navbar-item">New Support</a>
                        <hr class="navbar-divider" />
                        <a href="<?php echo base_url('support'); ?>" class="navbar-item">Incomplete</a>
                        <a href="<?php echo base_url('support/closed'); ?>" class="navbar-item">Complete</a>
                        <a href="<?php echo base_url('support/archive'); ?>" class="navbar-item">Archived</a>
                        <a href="<?php echo base_url('support/all'); ?>" class="navbar-item">All Projects</a>
                    </div>
                </div>
            <?php } ?>

            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link" href="<?php echo base_url('files'); ?>"><i class="fas fa-paperclip"></i> Files</a>
                <div class="navbar-dropdown">
                    <a href="<?php echo base_url('files/forms'); ?>" class="navbar-item">Forms</a>
                    <a href="<?php echo base_url('files/documentation'); ?>" class="navbar-item">Documentation</a>
                </div>
            </div>
            <a href="<?php echo base_url('reports'); ?>" class="navbar-item <?php echo ($this->current_system == "reports" ? 'is-active' : '') ?>"><i class="fas fa-chart-pie"></i> Reports</a>
        </div>
        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link"><i class="fas fa-cogs"></i> Settings</a>
                <div class="navbar-dropdown">
                    <a href="<?php echo base_url('user/settings'); ?>" class="navbar-item">Settings</a>
                    <hr class="navbar-divider" />
                    <a href="<?php echo base_url('employee/logout'); ?>" class="navbar-item">Log Out</a>
                </div>
            </div>
        </div>
    </div>
</nav>
