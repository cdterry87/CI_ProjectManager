<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        
        <title><?php echo $this->config->item('title'); ?></title>
        
        <!-- Bootstrap -->
        <link href="<?php echo base_url('public/bootstrap/3.3.4/css/bootstrap.min.css'); ?>" rel="stylesheet" />
        
        <!-- Styles -->
        <link href="<?php echo base_url('public/styles/main.css'); ?>" rel="stylesheet" />
        
        <!-- jQuery -->
        <script src="<?php echo base_url('public/jquery/1.11.2/jquery.min.js'); ?>"></script>
        
        <script>
            var base_url='<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <!-- Header -->
        <div id="header" class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle collapsed" data-target=".navbar-collapse" data-toggle="collapse" type="button">
                        <span class="sr-only">Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php echo anchor('/', 'HOME', 'alt="HOME" title="HOME" class="navbar-brand active"'); ?>
                </div>
                <?php $this->load->view('navigation'); ?>
            </div>
        </div>
        
        <!-- Content -->
        <div id="content">
            <div class="container">
                <div id="messages"></div>
                
                <?php $this->load->view($page); ?>
            </div>
        </div>
        
        <!-- Footer -->
        <div id="footer">
            <div class="container center">
                <hr/>
                Application Data Systems, Inc.
            </div>
        </div>
        
        <div class="clear"></div>
        
        <br/>
        
        <!-- Bootstrap -->
        <script src="<?php echo base_url('public/bootstrap/3.3.4/js/bootstrap.min.js'); ?>"></script>
        
        <!-- TinyMCE -->
        <script src="<?php echo base_url('public/tinymce/2.1/jquery.tinymce.min.js'); ?>"></script>
        <script src="<?php echo base_url('public/tinymce/2.1/tinymce.min.js'); ?>"></script>
        
        <!-- Javascript -->
        <script src="<?php echo base_url('public/scripts/main.js'); ?>"></script>
        <script src="<?php echo base_url('public/scripts/search.js'); ?>"></script>
    </body>
    
    <!-- Created by Chase Terry (2015) -->
</html>
