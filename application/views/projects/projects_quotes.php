<?php $this->load->view('projects/navigation'); ?>

<p><?php echo anchor('projects/form', 'New Project', 'class="btn btn-primary btn-block btn-lg"'); ?></p>

<?php if(empty($projects)){ ?>

<p>There are currently no quotes in the system.</p>

<?php }else{
	
	$this->load->view('projects/projects_list');
	
}