<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="shortcut icon" href="<?php echo base_url('public/favicon.ico'); ?>" type="image/x-icon">
		
		<title><?php echo $this->config->item('title'); ?> - <?php echo $report_title; ?></title>
		
		<!-- Bootstrap -->
		<link href="<?php echo base_url('public/bootstrap/3.3.4/css/bootstrap.min.css'); ?>" rel="stylesheet" />
		
		<!-- Styles -->
        <link href="<?php echo base_url('public/styles/main.css'); ?>" rel="stylesheet" />
        
        <style>
            h1{font-size: 22px !important;}
            h2{font-size: 19px !important;}
            h3{font-size: 16px !important;}
            ul li.headers{list-style-type: none; }
            
        </style>

	</head>
	<body onload="print();">
		<!-- Content -->
		<div id="content">
			<div class="container">
				<?php echo $data; ?>
			</div>
		</div>
		
		<!-- Bootstrap -->
        <script src="<?php echo base_url('public/bootstrap/3.3.4/js/bootstrap.min.js'); ?>"></script>
	</body>
</html>