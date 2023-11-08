<?php
	$active=array(
		'settings'		=> '',
		'password'		=> '',
	);
	
	$active[$this->current_page]='active';
?>

<ul class="nav nav-tabs">
	<li class="<?php echo $active['settings']; ?>"><?php echo anchor('user/settings','Edit Settings'); ?></li>
	<li class="<?php echo $active['password']; ?>"><?php echo anchor('user/password','Change Password'); ?></li>
</ul>

<br/>
