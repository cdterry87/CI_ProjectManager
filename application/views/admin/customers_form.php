<?php echo form_open('admin/customers/action'); ?>
<?php echo form_hidden('customer_id'); ?>

<div><?php echo form_label('Customer Name:','customer_name'); ?></div>
<p><?php echo form_input('customer_name','','class="form-control" maxlength="50" data-required'); ?></p>

<div><?php echo form_label('City:','customer_city'); ?></div>
<p><?php echo form_input('customer_city','','class="form-control" maxlength="30" data-required'); ?></p>

<div><?php echo form_label('State:','customer_state'); ?></div>
<p><?php echo form_input('customer_state','','class="form-control" maxlength="2" data-required'); ?></p>

<div><?php echo form_label('Phone:','customer_phone_1'); ?></div>
<p>
	<?php echo form_input('customer_phone_1','','class="form-control" maxlength="3" size="3" data-numeric data-autotab'); ?> -
	<?php echo form_input('customer_phone_2','','class="form-control" maxlength="3" size="3" data-numeric data-autotab'); ?> -
	<?php echo form_input('customer_phone_3','','class="form-control" maxlength="4" size="4" data-numeric'); ?>
</p>

<br/>

<p><?php echo form_submit('action','Save','class="btn btn-lg btn-primary btn-block"'); ?></p>
<?php
if($customer_id!=''){
?>
<p><?php echo form_submit('action','Delete','class="btn btn-lg btn-danger btn-block" data-confirm="Are you sure you want to delete this record?"'); ?></p>
<?php
}
?>
<p><?php echo anchor('admin/customers', 'Cancel', 'class="btn btn-lg btn-warning btn-block"'); ?></p>

<?php echo form_close(); ?>
