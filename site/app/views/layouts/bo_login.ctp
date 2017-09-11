<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 5.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php __('Welcome to Back Office'); ?>
	</title>
	
	<?php
		echo $this->Html->meta('icon', $html->url('/backoffice-favicon.ico')); 
		echo $this->Html->css('backoffice/backoffice-style');
		echo $this->Html->css('backoffice/jquery-ui-1.8.20.custom');
		echo $this->Html->script('jquery-1.7.2.min');
		echo $this->Html->script('jquery-ui-1.8.20.custom.min');
	?>
	
</head>
<body>
	<div id="main-container">
		<!-- HEADER START -->
		<div class="header">
	    	<div class="topBar-container">
	        	<div class="img">
	        		<?php
	        			if(true == Configure::read('site.adminLoginCredits')): 
	        		?>	        	
		            	<a href="http://www.computedsynergy.com/" target="_blank">
							<?php 
					        	echo $html->image('backoffice/cs-link-img.png',array('alt'=>'Computed Synergy', 'border'=>'0'));
					        ?>
		            	</a>
		            <?php endif; ?>
	            </div>
	            <div class="img">
	        		<?php
	        			if(true == Configure::read('site.adminLoginCredits')): 
	        		?>
		            	<a href="http://www.voucherscript.com/" target="_blank">
							<?php 
					        	echo $html->image('backoffice/dvs-link-img.png', array('alt'=>'Denovo Voucher Codes', 'border'=>'0'));
					        ?>
		            	</a>
		            <?php endif; ?>	
	            </div>
	        </div>
	        <div class="logo-container">
        		<?php
        			if(true == Configure::read('site.adminLoginCredits')): 
        		?>	        
		        	<div class="img">
					<?php 
						echo $html->image('backoffice/dvs-logo-img.png', array('alt'=>'DVS Admin Panel', 'border'=>'0'));
		            ?>
		            </div>
		        <?php endif; ?>
	        </div>
	        <div class="accoutInfo-container"></div>
	    </div>
		<!-- HEADER END -->

		<!-- MID CONTAINER START -->
	    <div class="mid-container">
	    
	    	<?php 
	    		$flash = $this->Session->flash();	
	    	if(!empty($flash)):?>
	    	<div class="flash">
		    	<?php echo $flash; ?>
	    	</div>
	    	<?php endif;?>
		
	        <!-- SITE SETTTING START -->
	        <div class="siteSetting-widget-container">
	        	<?php echo $content_for_layout; ?>
			</div>
			<!-- SITE SETTINGS CONTAINER -->
		</div>
		<!-- Mid CONTAINER END -->
		
		<!-- FOOTER START -->
		<div class="footer">
        <?php
        	if(true == Configure::read('site.adminLoginCredits')): 
        ?>	        
	    	<div class="copyright">
		    	<?php echo __("Copyright") . " &copy; " . date('Y') . " http://www.computedsynergy.com"; ?>
	        </div>
	    <?php endif; ?>
	    </div>
	    <!-- FOOTER END -->
	</div>
	
	<div style = "clear: both;"></div>
	
	<?php
		echo $this->Js->writeBuffer(); // Write cached scripts
		echo $this->element('sql_dump'); 
	?>	
</body>
</html>