	<!-- Change Password Widget Start -->
    <div id="widget-users-change-password">
        
		<?php 
	
		if(!isset($widget_users_change_password_res)) 
		{
		
			echo $this->Form->create('User', 
									array(
										'method' => 'post',
										'inputDefaults' => array(
														'label' => false,
														'div' => false
														)
												)
										); 
					?>	
      	
				<div class="form-container">
                    <div class="form-container title">
                        <div class="title txt1">
                            <?php __('Change Password');?>
                        </div>
                    </div>
    
                    <div class="form-container detail">

                        <div class="form-container detail left">
                            <div class="detail left inputRow">
                                <div class="inputRow txtField">
                                    <?php __('Current Password');?>
                                </div>
								<?php
							    	echo $this->Form->input('oldpass',
							    		array(
							    			'class'=>'inputRow inputField',
							    			'type' => 'password'
							    		)
							    	); 
								?>
                            </div>
                            
                           <div class="detail left inputRow">
                                <div class="inputRow txtField">
                                    <?php __('New Password');?>
                                </div>
								<?php
							    	echo $this->Form->input('newpass',
							    		array(
							    			'class'=>'inputRow inputField',
							    			'type' => 'password'
							    		)
							    	); 
								?>
                            </div>
                            
                            <div class="detail left inputRow">
                                <div class="inputRow txtField">
                                    <?php __('Confirm Password');?>
                                </div>
								<?php
							    	echo $this->Form->input('confpass',
							    		array(
							    			'class'=>'inputRow inputField',
							    			'type' => 'password'
							    		)
							    	); 
								?>
                            </div>
                            
                            <div class="detail left actionRow">
                    			<?php
									echo $this->Js->submit(__('Change',true),
										array(
											'url' => '/users/changepassword',
											'method'=> 'post',
											'update' => '#widget-users-change-password',
											'div' => false,
											'class' => 'actionrow btn',
											'id' => 'login-button'
										)
									); 
								?>
 
                            </div>
                        </div>

                    </div>
                </div>
                
                      	
        	
        
        
        <?php 
        	echo $this->Form->end();
        	echo $this->Js->writeBuffer();	
        ?>

		<script>
			jQuery(document).ready(function() {
				jQuery(".btn").button();
			});
		</script>
<?php 
		}
		else if($widget_users_change_password_res == false)
		{
?>
		<!-- Error -->
		<div class="errorMsg-widget-container" style="margin-top: 5px;">
	    	<ul>
	    		<?php foreach($errors as $Error){?>
	            
	            <li><?php echo $Error;?></li>
	            
	    		<?php }?>
			</ul>
		</div>
<?php 	
		}
		else
		{
?>	
		<!-- Success Message -->
		<div class="successMsg-widget-container" style="margin-top: 5px;">
	    	<ul>
	            <li><?php __('Password has been changed successfully.');?></li>
			</ul>
		</div>
<?php 	}?>

	
	</div>	
    <!-- Change Password Widget Start -->
