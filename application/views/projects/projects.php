<?php $this->load->view('projects/navigation'); ?>

<?php if(empty($projects)){ ?>

<p>No projects found.</p>

<?php }else{
	
	$this->load->view('projects/projects_list');
	
}