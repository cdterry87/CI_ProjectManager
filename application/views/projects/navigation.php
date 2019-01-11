<?php
	$active=array(
		''				=> '',
		'all'			=> '',
		'complete'		=> '',
		'archive'		=> '',
	);
	
	$active[$this->current_page]='is-active';
?>

<div class="tabs is-centered">
	<ul>
		<li class="<?php echo $active['']; ?>"><?php echo anchor('projects','<span class="icon is-small"><i class="fas fa-exclamation-circle" aria-hidden="true"></i></span> Incomplete'); ?></li>
		<li class="<?php echo $active['complete']; ?>"><?php echo anchor('projects/complete','<span class="icon is-small"><i class="fas fa-check" aria-hidden="true"></i></span> Complete'); ?></li>
		<li class="<?php echo $active['archive']; ?>"><?php echo anchor('projects/archive','<span class="icon is-small"><i class="fas fa-archive" aria-hidden="true"></i></span> Archived'); ?></li>
		<li class="<?php echo $active['all']; ?>"><?php echo anchor('projects/all','<span class="icon is-small"><i class="fas fa-list" aria-hidden="true"></i></span> All Projects'); ?></li>
		<li><?php echo anchor('projects/form','<span class="icon is-small"><i class="fas fa-plus-square" aria-hidden="true"></i></span> New Project'); ?></li>
	</ul>
</div>

