<?php
	echo $this->element('widget-pictures-edit', array(
		'title' => 'Change Profile Picture',
		'userid' => $_SESSION['Auth']['User']['id']
	));
?>