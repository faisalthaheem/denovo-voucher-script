<?php
switch($_SESSION['Auth']['User']['category']){
	case "user":
		echo $this->element('widget-pictures-edit',array('title'=>'Pictures'));
		break;
}
?>