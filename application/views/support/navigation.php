<?php
	$active=array(
		''			=> '',
		'all'		=> '',
		'closed'	=> '',
		'archive'	=> '',
	);
	
	$active[$this->current_page]='is-active';
?>

<div class="tabs is-centered">
	<ul>
		<li class="<?php echo $active['']; ?>"><?php echo anchor('support','<span class="icon is-small"><i class="fas fa-exclamation-circle" aria-hidden="true"></i></span> Open'); ?></li>
		<li class="<?php echo $active['closed']; ?>"><?php echo anchor('support/closed','<span class="icon is-small"><i class="fas fa-check" aria-hidden="true"></i></span> Closed'); ?></li>
		<li class="<?php echo $active['archive']; ?>"><?php echo anchor('support/archive','<span class="icon is-small"><i class="fas fa-archive" aria-hidden="true"></i></span> Archived'); ?></li>
		<li class="<?php echo $active['all']; ?>"><?php echo anchor('support/all','<span class="icon is-small"><i class="fas fa-list" aria-hidden="true"></i></span> All Support'); ?></li>
		<li><?php echo anchor('support/form','<span class="icon is-small"><i class="fas fa-plus-square" aria-hidden="true"></i></span> New Support'); ?></li>
	</ul>
</div>