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
            <?php echo anchor('admin/departments','<span class="icon is-small"><i class="fas fa-building" aria-hidden="true"></i></span> Departments'); ?>
        </li>
        <li class="<?php echo $active['form']; ?>">
            <?php echo anchor('admin/departments/form','<span class="icon is-small"><i class="fas fa-plus-square" aria-hidden="true"></i></span> New Department'); ?>
        </li>
	</ul>
</div>