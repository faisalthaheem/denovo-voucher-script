
	<div class="header">
    	
    	<div class="topBar-container">
        	
        	<div class="img">
            	<a href="http://www.computedsynergy.com/" target="_blank">
					<?php 
			        	echo $html->image('backoffice/cs-link-img.png',
			        					array('alt'=>'Computed Synergy', 
			        						'border'=>'0'));
			        ?>
            	</a>
            </div>
            
            <div class="img">
            	<a href="http://www.voucherscript.com/" target="_blank">
					<?php 
			        	echo $html->image('backoffice/dvs-link-img.png', 
			        					array('alt'=>'Denovo Voucher Codes', 
			        						'border'=>'0'));
			        ?>
            	</a>
            </div>
        </div>
        <div class="logo-container">
        	<div class="img">
				<a href="/<?php echo $this->params['prefix'];?>/dashboard">
				   	<?php 
						echo $html->image('backoffice/dvs-logo-img.png', 
										array('alt'=>'DVS Admin Panel', 
											'border'=>'0'));
		            ?>
	            </a>
            </div>
        </div>
        <div class="accoutInfo-container">
        	<div class="txt">
            	<?php __('Welcome');?> <span> <?php echo "{$_SESSION['Auth']['User']['fullname']}";?></span>
            </div>
            <div class="txt">
            	<span>
            		<a href="javascript:void(0);" id="header-change-password">
            			<?php __('Change Password');?>
            		</a>
            	</span>
            	|
            	<span>
            		<a href="/<?php echo $this->params['prefix'];?>/users/logout">
            		<?php __('Logout');?>
            		</a>
            	</span>
            </div>
            <div class="txt">
            	<?php echo $this->element('widget-backoffice-user-ip');?>
            </div>
            
            <div class="txt">
            	<?php echo $this->element('widget-backoffice-last-login-time');?>
            </div>
            <div class="txt">
            	<?php __('Version');?> : <span>4.6</span> CE
            </div>
        </div>
    </div>
    <script type="text/javascript">
	$(document).ready(function(){
		// Change Password
		$("#header-change-password").click(function(){
	
			$("#widget-main-mid-top-container").show();
			$("#widget-main-mid-top-container").empty();
			$("#widget-main-mid-bottom-container").empty();
			$("#widget-mid-loading").toggle();
			$.get('/<?php echo $this->params['prefix'];?>/users/change_password', function(data){
				$("#widget-mid-loading").toggle();
				$("#widget-main-mid-top-container").html(data);
			}); 
		});
	});
	
	</script>
    <!-- HEADER START -->