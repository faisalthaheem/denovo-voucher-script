<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		<div class="title">
			<div class="txt">
				<?php __('Change Password');?> &raquo;
			</div>
		</div>
		
		<div class="detail">
		<?php	
			if(isset($widget_change_pass_result) && !$widget_change_pass_result)
			{
		?>
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td>
						<?php
							if(isset($errors))
							{
								foreach($errors as $error):
									echo '*'.$error.'<br/>'; 
								endforeach;
							}
						?>
					</td>
				</tr>
			</table>	
		<?php
			
			}
			else if(isset($widget_change_pass_result) && $widget_change_pass_result)
			{
		?>
				<script>
					alert("<?php __('Password changed successfully');?>.");
					$('#widget-main-mid-top-container').html('');
				</script>
		<?php 
			}
					echo $this->Form->create('User', array(
										'method'=>'post',
										'inputDefaults' => array(
															'label' => false,
															'div' => false
													)
										)
							);
			?>
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
					
				<tr>
					<td colspan="3"></td>
				</tr>
					
				<tr>
					<td><?php __('Current Password');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('id', array('type' => 'hidden'));?>
						<?php echo $this->Form->input('oldpass', array('type' => 'password', 'class'=>'input-field-large')); ?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('New Password');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('newpass', array('type' => 'password', 'class'=>'input-field-large'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Confirm New Password');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('confpass', array('type' => 'password', 'class'=>'input-field-large'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td colspan="3">
						<?php
								echo $this->Js->submit(__('Change',true), array(
											'url' => "/{$this->params['prefix']}/users/widget_change_password",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'class' => 'btn'
											)
									); 
						?>
						<?php
								echo $this->Html->link(__('Cancel',true), 
														'javascript:void(0);', array(
																				'id' => 'lnk-widget-change-pass-cancel',
																				'class' => 'btn')); 
						?>
					</td>
				</tr>
			</table>
			<?php
				echo $this->Form->end(); 
				echo $this->Js->writeBuffer();                  
		    ?>
		</div>  
	
	</div>

</div>  

<script>
	$(document).ready(function(){
		$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();
		$("#lnk-widget-change-pass-cancel").click(function(){
			$("#widget-main-mid-top-container").html('');
		});
	});
</script>