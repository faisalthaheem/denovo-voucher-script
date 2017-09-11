<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 5.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
		<?php echo ' : ' .$sitename; ?>		
	</title>
	
	<?php
		echo $this->Html->meta('icon', $html->url('/backoffice-favicon.ico')); 
		echo $this->Html->css('backoffice/backoffice-style');
		echo $this->Html->css('backoffice/jquery-ui-1.8.20.custom');
		echo $this->Html->css('backoffice/jquery-ui-1.8.11.custom.dialog-box');
		echo $this->Html->css('jquery.cleditor');
		echo $this->Html->css('jquery.sb');
		echo $this->Html->css('codemirror/codemirror');
		echo $this->Html->css('codemirror/twilight');
		
		
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery-ui-1.8.20.custom.min');
		echo $this->Html->script('jquery.cleditor.min');
		echo $this->Html->script('jquery.sb.min');
		echo $this->Html->script('jquery.ui.timepicker.addon');
		echo $this->Html->script('jquery.jfeed.pack');
		//echo $this->Html->script('codemirror-compressed-3.01');
		echo $this->Html->script('codemirror/codemirror');
		echo $this->Html->script('codemirror/css/css');
		echo $this->Html->script('codemirror/javascript/javascript');
		echo $this->Html->script('codemirror/xml/xml');
		echo $this->Html->script('codemirror/htmlmixed/htmlmixed');
		echo $scripts_for_layout;
	?>
	
	<script>
		//async load external scripts for best performance...
		(function() {
		    function async_load(){
		        var s = document.createElement('script');
		        s.type = 'text/javascript';
		        s.async = true;
		        s.src = 'http://maps.google.com/maps/api/js?sensor=true';
		        var x = document.getElementsByTagName('script')[0];
		        x.parentNode.insertBefore(s, x);       
		    }
		    if (window.attachEvent)
		        window.attachEvent('onload', async_load);
		    else
		        window.addEventListener('load', async_load, false);
		})();
	</script>

	<script type="text/javascript">
		$.ajaxSetup ({
	    	cache: false
		});
	</script>
</head>
<body>

	<div id="main-container">
	
		<!-- HEADER START -->
		<?php 
			echo $this->element('widget-backoffice-header');
		?>	
		<!-- HEADER END -->

		
		<!-- NAVIGATION START -->
		<?php 
			echo $this->element('widget-backoffice-main-menu');
		?>
		<!-- NAVIGATION END -->

		
		<!-- DASHBOARD START -->
		<?php 
			echo $this->element('widget-backoffice-dashboard-menu');
		?>
		<!-- DASHBOARD END -->


		<!-- CONTENT AREA START -->
		<?php 					
			echo $content_for_layout; 
		?>
		<!-- CONTENT AREA END -->


		<!-- FOOTER START -->	
		<?php 
			echo $this->element('widget-backoffice-footer');
		?>
		<!-- FOOTER END -->
	
	</div>
	
	<div style = "clear: both;"></div>
	
	<?php
		echo $this->Js->writeBuffer(); // Write cached scripts
		echo $this->element('sql_dump'); 
	?>

</body>

</html>