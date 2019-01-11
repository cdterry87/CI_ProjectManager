<?php
	$active=array(
		'settings'		=> '',
		'password'		=> '',
    );
    
	$active[$this->current_page]='is-active';
?>

<div class="tabs is-centered">
    <ul>
        <li class="<?php echo $active['settings']; ?>"><?php echo anchor('user/settings','<span class="icon is-small"><i class="fas fa-cogs" aria-hidden="true"></i></span> Edit Settings'); ?></li>
        <li class="<?php echo $active['password']; ?>"><?php echo anchor('user/password','<span class="icon is-small"><i class="fas fa-key" aria-hidden="true"></i></span> Change Password'); ?></li>
    </ul>
</div>


<br/>
