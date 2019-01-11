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
            <?php echo anchor('admin/systems','<span class="icon is-small"><i class="fas fa-cogs" aria-hidden="true"></i></span> Systems'); ?>
        </li>
        <li class="<?php echo $active['form']; ?>">
            <?php echo anchor('admin/systems/form','<span class="icon is-small"><i class="fas fa-plus-square" aria-hidden="true"></i></span> New System'); ?>
        </li>
	</ul>
</div>