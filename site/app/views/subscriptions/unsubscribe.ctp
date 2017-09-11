<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />

<center>

<?php
	if($result): 
?>
	<p>
		<?php __('You will no longer receive any emails at') . " <b>$emailaddress</b> " . __('for') .  " <b>$sitename</b>"; ?>
	</p>
<?php 
	else:
?>
	<p>
		<?php __('Sorry, but we could not process your request at this moment for your address') .  " <b>$emailaddress</b>"; ?>
	</p>
<?php 
	endif;
?>
</center>