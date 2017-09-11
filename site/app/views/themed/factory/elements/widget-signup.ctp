
	<?php 
		if(isset($Errors))
		{
			# Display Errors	
	?>
		<div class="errorMsg-widget-container">
	    	<ul>
	            
				<?php 	foreach($Errors as $error){?>
	            
	            <li><?php  echo $error;?></li>
				
				<?php 	}?>
			
			</ul>
		</div>
	<?php
		}
	?>

<div class="left-panel signUp-widget-container">
                    <div class="signUp-widget-container title">
                        <div class="title txt1">
                            <?php __('Sign Up');?>
                        </div>
                    </div>
    
                    <div class="signUp-widget-container detail">
		
	<div class="sign-up-work-widget-container">
		
			<?php
				echo $this->Form->create('User', 
					array(
						'method'=>'post',
						'action'=>'widget_signup',
						'inputDefaults' => array(
							'label' => false,
							'div' => false
						)
					)
				); 
			?>        	
            	<div class="sign-up-work-widget-table-div">
                	<table width="368" height="306" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                        	<td width="128"><?php __('Full Name');?>:</td>
                      		<td colspan="3">
                        		<?php
                        			echo $this->Form->input('fullname', array('class'=>'input-field-type-3')); 
                        		?>
                        	</td>
                      	</tr>
                    	<tr>
                        	<td width="128"><?php __('Email');?>:</td>
                      		<td colspan="3">
                        		<?php
                        			echo $this->Form->input('email', array('class'=>'input-field-type-3')); 
                        		?>
                        	</td>
                      	</tr>
                      	<tr>
                        	<td><?php __('Password');?>:</td>
                        	<td colspan="3">
                        		<?php
                        			echo $this->Form->input('pass', array('class'=>'input-field-type-3', 'type' => 'password')); 
                        		?>
							</td>
                      	</tr>
                      	<tr>
                        	<td><?php __('Confirm Password');?>:</td>
                        	<td colspan="3">
                        		<?php
                        			echo $this->Form->input('passconf', array('class'=>'input-field-type-3', 'type' => 'password')); 
                        		?>
                        	</td>
                      	</tr>
                      
                      	<tr>
                        	<td valign="top"></td>
                        	<td colspan="3">
	                        	<div class="reCaptcha-div">
									<img id="captcha" src="<?php echo $html->url('/users/captcha_image');?>" alt="" /> 
	 								<a href="javascript:void(0);" onclick="javascript:document.images.captcha.src='<?php echo $html->url('/users/captcha_image');?>?' + Math.round(Math.random(0)*1000)+1">Reload image</a>                         	
								</div>
                        	</td>
                      	</tr>
                      	<tr>
                        	<td valign="top"><?php __('Enter shown code');?></td>
                        	<td colspan="3">
                        		<?php 
                        			echo $this->Form->input('usercaptchacode', array('class' => 'input-field-type-3'));
                        		?>
                        	</td>
                      	</tr>
                      	<tr>
                        	<td colspan="2"></td>
                        	<td width="140"></td>
                        	<td width="88">
                        		<div id="sign-up-btn">
	                        		<?php
	                        			echo $this->Js->submit(__('Sign Up',true),
	                        				array(
	                        					'url' => '/users/widget_signup',
	                        					'method'=> 'post',
	                        					'update' => '#mid-container-left-panel',
	                        					'before' => 'sign_up_container_loading();',
	                        					'div' => false,
	                        					'class' => 'sign-up-login-btn'
	                        				)
	                        				); 
	                        		?>              
                        		</div>
                        	</td>
                      	</tr>
					</table>
              	</div>
			
				<script type="text/javascript">
					jQuery(".sign-up-login-btn").button();
				</script>		

				<?php
					echo $this->Form->end(); 
					echo $this->Js->writeBuffer();
				?>

				<script type="text/javascript">

					function sign_up_container_loading()
					{
						//TODO: do something here
					}
				
				</script>

			</div>
		</div>
</div>