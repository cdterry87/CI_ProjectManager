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
            <?php echo anchor('admin/employees','<span class="icon is-small"><i class="fas fa-user-tie" aria-hidden="true"></i></span> Employees'); ?>
        </li>
        <li class="<?php echo $active['form']; ?>">
            <?php echo anchor('admin/employees/form','<span class="icon is-small"><i class="fas fa-plus-square" aria-hidden="true"></i></span> New Employee'); ?>
        </li>
	</ul>
</div>