<h1 class="title is-3">
    <?php echo $customer['customer_name']; ?>
    <?php echo anchor('admin/customers/form/'.$customer['customer_id'],'<i class="fas fa-edit"></i> Edit Customer','class="button is-info is-small"'); ?>
</h1>

<div>
    <?php 
    $status_color = 'success';
    switch ($customer['customer_status']) {
        case "prospect":
            $status_color = 'link';
            break;
        case "pending":
            $status_color = 'primary';
            break;
        case "archive":
            $status_color = 'warning';
            break;
    }

    echo '<strong>' . $customer['customer_city']. ' ' . $customer['customer_state'] . ' <span class="tag is-'.$status_color.'">'.$customer['customer_status'].'</span></strong>';
    ?>
</div>

<?php if (strlen($customer['customer_phone']) == 10) { ?>
<div>
    <strong>Phone: </strong>
    <?php echo $this->format->phone($customer['customer_phone']); ?>
</div>
<?php } ?>

<?php 
if (trim($project_manager)!='') {
?>
<div>
    <strong>Project Manager: </strong>
    <?php echo $project_manager; ?>
</div>
<?php
}
?>

<div>
    <strong>Systems Owned:</strong>
</div>
<div class="tags">
    <?php
        foreach($systems as $key=>$system) {
            echo '<div class="tag is-link">'.$system['system_name'].'</div>';
        }
    ?>
</div>

<hr>

<div class="tabs is-centered">
    <ul>
        <li class="tab" data-target="customer-details"><a><i class="fas fa-clipboard-list "></i>Details</a></li>
        <li class="tab" data-target="customer-projects"><a><i class="fas fa-project-diagram"></i>Projects</a></li>
        <li class="tab" data-target="customer-support"><a><i class="fas fa-bug"></i> Support</a></li>
        <li class="tab" data-target="customer-contacts"><a><i class="fas fa-users"></i> Contacts</a></li>
        <li class="tab" data-target="customer-notes"><a><i class="fas fa-edit"></i> Notes</a></li>
        <li class="tab" data-target="customer-reminders"><a><i class="fas fa-clock"></i> Reminders</a></li>
    </ul>
</div>

<div id="customer-details" class="tab-panel">
    <h2 class="title is-4">Details</h2>
    <?php echo $customer['customer_details']; ?>
</div>

<div id="customer-projects" class="tab-panel">
    <div class="panel">
        <div class="panel-heading has-background-info has-text-white">
            <h2><i class="fa fa-project-diagram"></i> Incomplete Projects</h2>
        </div>
        <div class="panel-block">
            <?php $this->load->view('projects/projects_incomplete'); ?>
        </div>
    </div>
</div>

<div id="customer-support" class="tab-panel">
    <div class="panel">
        <div class="panel-heading has-background-danger has-text-white">
            <h2><i class="fas fa-bug"></i> Open Support</h2>
        </div>
        <div class="panel-block">
            <?php $this->load->view('support/support_open'); ?>
        </div>
    </div>
</div>

<div id="customer-contacts" class="tab-panel">
    <h2 class="title is-4">Contacts</h2>

    <?php echo form_open('admin/customers/action'); ?>
    <?php echo form_hidden('customer_id'); ?>
    
    <div class="field">
        <?php echo form_label('Contact Name:','contact_name', 'class="label"'); ?>
        <div class="control">
            <?php echo form_input('contact_name','','class="input" maxlength="100" data-required'); ?>
        </div>
    </div>

    <div class="field">
        <?php echo form_label('Contact Title:','contact_title', 'class="label"'); ?>
        <div class="control">
            <?php echo form_input('contact_title','','class="input" maxlength="100" data-required'); ?>
        </div>
    </div>

    <div class="field">
        <?php echo form_label('Contact Email:','contact_email', 'class="label"'); ?>
        <div class="control">
            <?php echo form_input('contact_email','','class="input" maxlength="250" data-required'); ?>
        </div>
    </div>

    <div class="columns">
        <div class="column is-half">
            <?php echo form_label('Phone #1:','customer_phone_1', 'class="label"'); ?>
            <div class="field is-grouped">
                <p class="control"><?php echo form_input('customer_phone_1','','class="input" maxlength="3" size="3" data-numeric data-autotab'); ?></p>
                <p class="control slash">-</p>
                <p class="control"><?php echo form_input('customer_phone_2','','class="input" maxlength="3" size="3" data-numeric data-autotab'); ?></p>
                <p class="control slash">-</p>
                <p class="control"><?php echo form_input('customer_phone_3','','class="input" maxlength="4" size="4" data-numeric'); ?></p>
                <p class="control"><?php echo form_input('customer_phone_type','','class="input" maxlength="15" size="15" placeholder="Phone Type" data-numeric'); ?></p>
            </div>
        </div>
        <div class="column is-half">
            <?php echo form_label('Phone #2:','customer_phone2_1', 'class="label"'); ?>
            <div class="field is-grouped">
                <p class="control"><?php echo form_input('customer_phone2_1','','class="input" maxlength="3" size="3" data-numeric data-autotab'); ?></p>
                <p class="control slash">-</p>
                <p class="control"><?php echo form_input('customer_phone2_2','','class="input" maxlength="3" size="3" data-numeric data-autotab'); ?></p>
                <p class="control slash">-</p>
                <p class="control"><?php echo form_input('customer_phone2_3','','class="input" maxlength="4" size="4" data-numeric'); ?></p>
                <p class="control"><?php echo form_input('customer_phone2_type','','class="input" maxlength="15" size="15" placeholder="Phone Type" data-numeric'); ?></p>
            </div>
        </div>
    </div>

    <div class="field is-grouped is-grouped-centered">
        <p class="control"><?php echo form_submit('action','Save','class="button is-info"'); ?></p>
    </div>

    <?php echo form_close(); ?>

    <hr>

    <h2 class="title is-5">Contacts List</h2>
</div>

<div id="customer-notes" class="tab-panel">
    <h2 class="title is-4">Notes</h2>
</div>

<div id="customer-reminders" class="tab-panel">
    <h2 class="title is-4">Reminders</h2>
</div>




