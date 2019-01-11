<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="shortcut icon" href="<?php echo base_url('public/favicon.ico'); ?>" type="image/x-icon">
        <title><?php echo $this->config->item('title'); ?></title>
        <link href="<?php echo base_url('public/bulma/bulma.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="<?php echo base_url('public/datatables/datatables.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('public/styles/main.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('public/jquery/3.3.1/jquery.min.js'); ?>"></script>
        <script>
            var base_url='<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <div id="header">
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
                        <a href="<?php echo base_url('support/form'); ?>" class="navbar-item <?php echo ($this->current_system == "projects" && $this->current_page == "form" ? 'is-active' : '') ?>"><i class="fas fa-plus-square"></i> New Support</a>
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
        </div>
        
        <div id="content">
            <div id="wrapper" class="columns is-mobile">
                <aside id="aside" class="column is-one-third-mobile is-one-quarter-tablet is-one-fifth-desktop">
                    <?php $this->load->view('sidebar'); ?>
                </aside>
                <main id="main" class="column is-two-thirds-mobile is-three-quarters-tablet is-four-fifths-desktop">
                    <div class="container is-fluid">
                        <div id="messages"></div>
                        <br>
                        <?php $this->load->view($page); ?>
                    </div>

                    <div id="footer">
                        <div class="container center">
                            <hr/>
                            <?php echo $this->config->item('company'); ?>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        
        <script src="<?php echo base_url('public/tinymce/2.1/jquery.tinymce.min.js'); ?>"></script>
        <script src="<?php echo base_url('public/tinymce/2.1/tinymce.min.js'); ?>"></script>
        <script src="<?php echo base_url('public/datatables/datatables.min.js'); ?>"></script>
        <script src="<?php echo base_url('public/scripts/main.js'); ?>"></script>
    </body>
    
    <!-- Created by Chase Terry (2015 - 2019) !-->
</html>
