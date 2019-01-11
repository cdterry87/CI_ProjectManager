<?php
	$active=array(
		''				=> '',
		'form'	        => '',
	);
	
	$active[$this->current_subpage]='is-active';
?>

<div class="tabs is-centered">
	<ul>
        <li class="<?php echo $active['']; ?>">
            <?php echo anchor('admin/customers','<span class="icon is-small"><i class="fas fa-users" aria-hidden="true"></i></span> Customers'); ?>
        </li>
        <li class="<?php echo $active['form']; ?>">
            <?php echo anchor('admin/customers/form','<span class="icon is-small"><i class="fas fa-plus-square" aria-hidden="true"></i></span> New Customer'); ?>
        </li>
	</ul>
</div>