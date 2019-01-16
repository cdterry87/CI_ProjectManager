<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
            
        <title><?php echo $this->config->item('title'); ?></title>
        <link href="<?php echo base_url('public/bulma/bulma.min.css'); ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
        <link href="<?php echo base_url('public/datatables/datatables.min.css'); ?>" rel="stylesheet" />
        <link href="<?php echo base_url('public/styles/login.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('public/jquery/3.3.1/jquery.min.js'); ?>"></script>
        
        <script>
            var base_url='<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <div class="container">
            <div id="content">
                <h3 class="center title is-4"><strong><?php echo $this->config->item('title'); ?></strong></h3>
                
                <hr/>
                
                <div id="messages"></div>
                
                <?php echo form_open('employee/authenticate'); ?>
                    <div class="field">
                        <div><?php echo form_label('Username:', 'employee_username', 'class="label"'); ?></div>
                        <p class="control"><?php echo form_input('employee_username', '', 'class="input"'); ?></p>
                    </div>
                    
                    <div class="field">
                        <div><?php echo form_label('Password:', 'employee_password', 'class="label"'); ?></div>
                        <p class="control"><?php echo form_password('employee_password', '', 'class="input"'); ?></p>
                    </div>

                    <div class="field">
                        <p class="control"><label for="remember" class="checkbox"><?php echo form_checkbox('remember') ?> Remember Me</label></p>
                    </div>
                    
                    <div class="field">
                        <p><?php echo form_submit('action', 'Sign In', 'class="button is-info is-fullwidth"'); ?></p>
                    </div>
                <?php echo form_close(); ?>
                
                <hr/>
                
                <p class="center"><?php echo $this->config->item('company'); ?></p>
            </div>
        </div>
        
        <script src="<?php echo base_url('public/scripts/main.js'); ?>"></script>
    </body>
    
    <!-- Created by Chase Terry (2015 - 2019) -->
</html>
