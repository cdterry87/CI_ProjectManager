<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
			
		<title><?php echo $this->config->item('title'); ?></title>
		
		<!-- Bootstrap -->
		<link href="<?php echo base_url('public/bootstrap/3.3.4/css/bootstrap.min.css'); ?>" rel="stylesheet" />
		
		<!-- Styles -->
		<link href="<?php echo base_url('public/styles/login.css'); ?>" rel="stylesheet" />
		
		<!-- jQuery -->
		<script src="<?php echo base_url('public/jquery/1.11.2/jquery.min.js'); ?>"></script>
		
		<script>
			var base_url='<?php echo base_url(); ?>';
		</script>
	</head>
	<body>
		<div class="container">
			<div id="content">
				<h3 class="center"><strong><?php echo $this->config->item('title'); ?></strong></h3>
				
				<hr/>
				
				<div id="messages"></div>
				
				<?php echo form_open('employee/authenticate'); ?>

				<div><?php echo form_label('Username:','employee_username'); ?></div>
				<p><?php echo form_input('employee_username','','class="form-control"'); ?></p>
				
				<div><?php echo form_label('Password:','employee_password'); ?></div>
				<p><?php echo form_password('employee_password','','class="form-control"'); ?></p>
				
				<p><?php echo form_checkbox('remember')." ".form_label('Remember Me', 'remember'); ?></p>
				
				<p><?php echo form_submit('action','Sign In','class="btn btn-lg btn-primary btn-block"'); ?></p>
				
				<?php echo form_close(); ?>
				
				<hr/>
				
				<p class="center">&copy; Chase Terry 2015</p>
			</div>
		</div>
		
		<!-- Bootstrap -->
        <script src="<?php echo base_url('public/bootstrap/3.3.4/js/bootstrap.min.js'); ?>"></script>
		
		<!-- Javascript -->
		<script src="<?php echo base_url('public/scripts/main.js'); ?>"></script>
	</body>
	
	<!-- Created by Chase Terry (2015) -->
</html>