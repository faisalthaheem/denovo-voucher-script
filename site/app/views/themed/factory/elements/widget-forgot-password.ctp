	
	<div class="forgot-password-widget-container" id="forgot-password-widget-container">
    	
        <div class="forgot-password-widget-txt-2">
        	<?php if(isset($result) && $result == true){?>
        	
        		<?php __('An email has been sent to your email address, please check it for instructions on how to continue from here.');?>
        	
        	<?php }else if(isset($result) && $result == false){?>
        	
        		<?php __('We could not reset your password at this time, please confirm your email address.');?>
        	
        	<?php }else if(!isset($result)){?>
        	
        		
        	
        	<?php }?>
        </div>
        
        <?php 
			echo $this->Form->create('User', 
					array(
						'url' => '/users/forgot_password',
						'method'=>'post',
						'inputDefaults' => array(
							'label' => false,
							'div' => false
						)
					)
				); 
        ?>
        
				<!-- RESET PASSWORD Widget START -->
            	<div class="left-panel resetPassword-widget-container">
                    <div class="resetPassword-widget-container title">
                        <div class="title txt1">
                            <?php __('Enter Your Registered Email address to Reset your Password');?>
                        </div>
                        <div class="title txt2">
                            
                        </div>
                    </div>
    
                    <div class="resetPassword-widget-container detail">
                        <form action="">
                            <div class="detail inputRow">
                                <div class="inputRow txtField">
                                    <?php __('Email');?>
                                </div>
		                    	<?php 
		                    		echo $this->Form->input(
		                    			'email', 
		                    			array(
		                    				'class' => 'inputRow inputField', 
		                    				'onfocus' => 'this.value = "";', 
		                    				'value' => 'Your Email Address'
		                    			)
		                    		);
		                    	?>
                                
                            </div>
                            <div class="detail actionRow">
		                    	<?php 
									echo $this->Js->submit(__('Submit',true),
												array(
													'url' => '/users/forgot_password',
													'update' => '#mid-container-left-panel',
													'before' => 'forgot_password_ajaxLoad();',
													'div' => false,
													'class' => 'actionRow btn'
												)
										); 
		                    	?>                                
                            </div>
                        </form>
                    </div>
                </div>
                <!-- RESET PASSWORD Widget END -->
                

			<?php 
				echo $this->Js->writeBuffer();
			?>
		<script>

		function forgot_password_ajaxLoad()
		{
		}
		</script>
	
	</div>
    <?php
		echo $this->element('widget-ajax-loading-signup', array('div_dom_id'=>'widget-forgot-password-loading')); 
	?>
	