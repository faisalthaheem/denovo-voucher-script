
<?php
	if(isset($usercreated) && $usercreated)
	{
		echo $this->element('widget-signup-success');
	}
	else
	{ 
		echo $this->element('widget-signup');
	}
?>