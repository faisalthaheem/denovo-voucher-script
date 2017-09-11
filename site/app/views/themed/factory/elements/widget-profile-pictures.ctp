<?php
switch($user['User']['usertype']){
	case "user":
		echo $this->element('widget-pictures', array('title'=>'My Pictures','groupName'=>'profile-pictures','widgetPictures'=>$pictures));
		break;
}
?>