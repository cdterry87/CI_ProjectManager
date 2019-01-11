<?php $this->load->view('support/navigation'); ?>

<?php if(empty($support)){ ?>

<p>No support issues found.</p>

<?php }else{
	
	$this->load->view('support/support_list');
	
}
