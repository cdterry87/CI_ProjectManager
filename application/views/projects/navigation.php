<?php
	$active=array(
		''				=> '',
		'all'			=> '',
		'quotes'		=> '',
		'requests'		=> '',
		'complete'		=> '',
		'archive'		=> '',
	);
	
	$active[$this->current_page]='active';
?>

<ul class="nav nav-tabs">
	<li class="<?php echo $active['']; ?>"><?php echo anchor('projects','Incomplete'); ?></li>
	<li class="<?php echo $active['complete']; ?>"><?php echo anchor('projects/complete','Complete'); ?></li>
	<li class="<?php echo $active['quotes']; ?>"><?php echo anchor('projects/quotes','Quotes'); ?></li>
	<li class="<?php echo $active['requests']; ?>"><?php echo anchor('projects/requests','Requests'); ?></li>
	<li class="<?php echo $active['archive']; ?>"><?php echo anchor('projects/archive','Archived'); ?></li>
	<li class="<?php echo $active['all']; ?>"><?php echo anchor('projects/all','All Projects'); ?></li>
</ul>

<br/>
