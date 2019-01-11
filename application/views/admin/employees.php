<?php $this->load->view('admin/employees_navigation'); ?>

<?php if(empty($employees)){ ?>

<p class="has-text-centered">There are currently no employees in the system.  <?php echo anchor('admin/employees/form','Click here to create one.'); ?></p>

<?php

} else {
    $this->load->view('admin/employees_list');
}

?>
