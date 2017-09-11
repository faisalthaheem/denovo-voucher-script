<?php
if(isset($loginerror) && !$loginerror)
{
?>		
	<script>
		window.open('<?php echo $loginpath; ?>', '_self'); 
	</script>
	
<?php
}else if(isset($loginerror) && $loginerror){
?>

	<script>
		alert("Invalid credentials. Please try again.");
	</script>
	
<?php		
	unset($loginerror); //unset so following can work
}
	
if(!isset($loginerror))	
{		
	echo $this->Form->create('User', 
		array(
			'method'=>'post',
			'action'=>'widget_signin',
			'inputDefaults' => array(
				'label' => false,
				'div' => false
			)
		)
	); 
?>

				<!-- Login Widget START -->
            	<div class="left-panel login-widget-container">
                    <div class="login-widget-container title">
                        <div class="title txt1">
                            <?php __('Login');?>
                        </div>
                        <div class="title txt2">
                            <a href="javascript:void(0);" class="whiteLINK" id="forgot-password"><?php __('Forgot password');?>?</a>
                        </div>
                    </div>
    
                    <div class="login-widget-container detail">
                        <form action="">
                        <div class="login-widget-container detail left">
                            <div class="detail left inputRow">
                                <div class="inputRow txtField">
                                    <?php __('Email address');?>
                                </div>
								<?php
							    	echo $this->Form->input('email', 
							    		array(
							    			'class'=>'inputRow inputField', 
							    		)
							    	); 
								?>
                            </div>
                            <div class="detail left inputRow">
                                <div class="inputRow txtField">
                                    <?php __('Password');?>
                                </div>
								<?php
							    	echo $this->Form->input('pass', 
							    		array(
							    			'class'=>'inputRow inputField', 
							    			'type' => 'password'
							    		)
							    	); 
								?>
                            </div>
                            <div class="detail left actionRow">
								<?php
									echo $this->Form->submit(__('Log in',true),
										array(
											'url' => '/users/widget_signin',
											'method'=> 'post',
											//'update' => '#mid-container-left-panel',
											'div' => false,
											'class' => 'actionrow btn',
											'id' => 'login-button'
										)
									); 
								?>
								 <a class="btn2" href="https://www.facebook.com/dialog/oauth?client_id=<?php echo $siteInfo['fbappid'];?>&redirect_uri=<?php echo Router::url('/users/fbauth',true);?>&scope=email"></a>
                            </div>
                        </div>

                        <div class="login-widget-container detail right">
                            <div class="detail right instructionImg">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- Login Widget END -->
                
<script type="text/javascript">

	jQuery("#login-button").button();

	jQuery(document).ready(function(){

		jQuery("#forgot-password").click(function(){
			// Loading forgot password in place of sign up form
			jQuery.get('/users/widget_forgot_password/', function(markup){
				jQuery('#mid-container-left-panel').html(markup);
			});			

		});
		
	});


</script>

<?php
	echo $this->Form->end(); 
	echo $this->Js->writeBuffer();
	
	}//end if
?>		
