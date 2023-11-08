<?php $this->load->view('support/navigation'); ?>

<p><?php echo anchor('support/form', 'New Support', 'class="btn btn-primary btn-block btn-lg"'); ?></p>

<?php if(empty($support)){ ?>

<p>There are currently no open support issues in the system.</p>

<?php }else{
	
	$this->load->view('support/support_list');
	
}
