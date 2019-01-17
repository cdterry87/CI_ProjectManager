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
        <link href="<?php echo base_url('public/styles/mobile.css'); ?>" rel="stylesheet" />
        <script src="<?php echo base_url('public/jquery/3.3.1/jquery.min.js'); ?>"></script>
        <script>
            var base_url='<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <div id="header">
            <?php $this->load->view('navigation'); ?>
        </div>
        
        <div id="content">
            <div id="wrapper" class="columns is-mobile">
                <aside id="aside" class="column is-one-third-mobile is-one-quarter-tablet is-one-fifth-desktop">
                    <?php $this->load->view('sidebar'); ?>
                </aside>
                <main id="main" class="column is-two-thirds-mobile is-three-quarters-tablet is-four-fifths-desktop">
                    <div id="messages"></div>
                    <br>
                    <?php $this->load->view($page); ?>

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
