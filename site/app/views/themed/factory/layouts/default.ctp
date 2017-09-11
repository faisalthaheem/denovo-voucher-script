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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
<?php 
		if(isset($meta_title) && !empty($meta_title))
		{
			echo $meta_title;
		}else{
			echo $title_for_layout;
			echo ' : ' .$sitename;
		}
?>	
	</title>
	
	<?php
echo "\n";	
		echo $this->Html->meta('icon','/theme/factory/favicon.ico');

		if(isset($meta_kws))
		{
echo "\n";
			echo $this->Html->meta('keywords', $meta_kws);
		}
		if(isset($meta_desc))
		{
echo "\n";
			echo $this->Html->meta('description', $meta_desc);
		}		

echo "\n";		
		echo $this->Html->css('jquery.ui.theme');
echo "\n";		
		echo $this->Html->css('jquery-ui-1.8.11.dvs.dialog');
echo "\n";		
		echo $this->Html->css('jquery.treeview');
echo "\n";		
		echo $this->Html->css('slider-style');
echo "\n";		
		echo $this->Html->css('jquery.rating');
echo "\n";		
		echo $this->Html->css('jquery.mbTooltip');
echo "\n";		
		echo $this->Html->css('tab-style');
echo "\n";		
		echo $this->Html->css('jquery.jscrollpane');
echo "\n";		
		echo $this->Html->css('style');
echo "\n";		
		echo $this->Html->css('dvs-community');
echo "\n";		
		echo $this->Html->css('tags');
		
echo "\n";				
		echo $this->Html->script('jquery-1.5.1.min');
echo "\n";		
		echo $this->Html->script('jquery.treeview');
echo "\n";		
		echo $this->Html->script('jquery.ui.widget');
echo "\n";		
		echo $this->Html->script('jquery.ui.button');
echo "\n";		
		echo $this->Html->script('jquery-ui-1.8.11.custom.min');
echo "\n";		
		echo $this->Html->script('slider.script');
echo "\n";		
		echo $this->Html->script('jquery.timers');
echo "\n";		
		echo $this->Html->script('jquery.dropshadow');
echo "\n";		
		echo $this->Html->script('jquery.rating.pack');
echo "\n";		
		echo $this->Html->script('jquery.mbTooltip');
echo "\n";		
		echo $this->Html->script('tabs.js');
echo "\n";		
		echo $scripts_for_layout;
	?>

	<?php if(!empty($siteInfo) && $siteInfo['fbconfigured']): ?>
	<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
	<script type="text/javascript">FB.init("<?php echo $siteInfo['fbapikey'];?>","/receiver/xd_receiver.htm");</script>
	<?php endif;?>
	
	<?php
		if(!empty($siteInfo['headerinserts']))
		{
			echo $siteInfo['headerinserts'];
		} 
	?>
	
	<?php
		if(isset($ogInfo) && !empty($ogInfo))
		{
			echo "<meta property=\"og:title\" content=\"{$ogInfo['title']}\"/> \n";
		    echo "<meta property=\"og:type\" content=\"{$ogInfo['type']}\"/> \n";
		    echo "<meta property=\"og:url\" content=\"{$ogInfo['url']}\"/> \n";
		    echo "<meta property=\"og:image\" content=\"{$ogInfo['image']}\"/> \n";
		    echo "<meta property=\"og:description\" content=\"{$ogInfo['desc']}\"/> \n";
		} 
	?>
</head>
<body>

    <div id="main-container">

        <!-- HEADER START -->
        <?php
        	echo $this->element('widget-header'); 
        ?>
        <!-- HEADER END -->

		<!-- MID CONTAINER START -->
        <div class="mid-container">

			<!-- InstanceBeginEditable name="Content Area" -->
            <!-- MID LEFT PANEL START -->
            <div class="left-panel">
            	<div>
<!--            		loader-->
            	</div>
            	<div id="mid-container-left-panel">
					<?php //echo $this->Session->flash(); ?>
				
					<?php echo $content_for_layout; ?>
            	</div>
            </div>
            <!-- MID LEFT PANEL END -->
            <!-- InstanceEndEditable -->

			<!-- MID RIGHT PANEL START -->
			<div class="right-panel">

                <!-- Browse Shop START -->
                <?php
                	echo $this->element('widget-merchants-browse'); 
                ?>
                <!-- Browse Shop END -->


                <!-- Search Widget START -->
                <?php
                	echo $this->element('widget-search-codes-and-merchants'); 
                ?>
                <!-- Search Widget END -->


                <!-- Subscribe Voucher Widget START -->
                <?php
                	echo $this->element('widget-subscriptions-subscribe-top'); 
                ?>
                <!-- Subscribe Voucher Widget END -->


                <!-- All Categories Widget START -->
                <?php
                	echo $this->element('widget-categories-vouchers-deals'); 
                ?>
                <!-- All Categories Widget END -->


				<!-- Top Vouchers Widget START -->
                <?php
                	echo $this->element('widget-vouchers-top'); 
                ?>
				<!-- Top Vouchers Widget END -->


				<!-- What's New Widget START -->
                <?php
                	//todo: formulate a worth while widget
                	//echo $this->element('widget-vouchers-what-new'); 
                ?>
				<!-- What's New Widget END -->


                <!-- MOST Popular Retailer Widget START -->
                <?php
                	echo $this->element('widget-merchants-most-popular'); 
                ?>
				<!-- MOST Popular Retailer Widget END -->


                <!-- Top Retailer Widget START -->
                <?php
                	echo $this->element('widget-merchants-top'); 
                ?>
				<!-- Top Retailer Widget END -->

          </div>
            <!-- MID RIGHT PANEL END -->

      </div>
        <!-- MID CONTAINER END -->

        <!-- BANNER CONTAINER START -->
        <div class="banner-widget-container">
        <?php
        	echo $this->element('widget-advertisements-bottom'); 
        ?>
        </div>
        <!-- BANNER CONTAINER END -->

        <!-- FOOTER CONTAINER START -->
        <div class="footer">
        <?php
        	echo $this->element('widget-footer'); 
        ?>
        </div>
        <!-- FOOTER CONTAINER END -->
</div>

	<?php
		if(!empty($siteInfo['footerinserts']))
		{
			echo $siteInfo['footerinserts'];
		} 
	?>
	
	<br />
	<?php
		echo $this->Js->writeBuffer(); // Write cached scripts
		echo $this->element('sql_dump'); 
	?>	
</body>
<!-- InstanceEnd -->
</html>