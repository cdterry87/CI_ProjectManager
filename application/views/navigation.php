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
            <a href="<?php echo base_url('projects'); ?>" class="navbar-item <?php echo ($this->current_system == "projects" ? 'is-active' : '') ?>"><i class="fas fa-project-diagram"></i> Project</a>
            <a href="<?php echo base_url('support'); ?>" class="navbar-item <?php echo ($this->current_system == "support" ? 'is-active' : '') ?>"><i class="fas fa-bug"></i> Support</a>
            <a href="<?php echo base_url('reports'); ?>" class="navbar-item <?php echo ($this->current_system == "reports" ? 'is-active' : '') ?>"><i class="fas fa-chart-pie"></i> Reports</a>
        </div>
        <div class="navbar-end">
            <a href="<?php echo base_url('projects/form'); ?>" class="navbar-item <?php echo ($this->current_system == "projects" && $this->current_page == "form" ? 'is-active' : '') ?>"><i class="fas fa-plus-square"></i> New Project</a>
            <a href="<?php echo base_url('support/form'); ?>" class="navbar-item <?php echo ($this->current_system == "support" && $this->current_page == "form" ? 'is-active' : '') ?>"><i class="fas fa-plus-square"></i> New Support</a>
            <div class="navbar-item">
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
    </div>
</nav>