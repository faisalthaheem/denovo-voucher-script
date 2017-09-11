<?php __('Last Login time ');?>:
<span>
<?php 
	echo date_format(date_create($_SESSION['Auth']['User']['lastlogintime']),'h:i A')
?>
</span>
|
<span>
<?php 
	echo date_format(date_create($_SESSION['Auth']['User']['lastlogintime']),'m.d.Y');
?>
</span>
