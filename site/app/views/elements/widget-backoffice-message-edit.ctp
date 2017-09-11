
	<?php
		if(isset($user_message_edit) && $user_message_edit){
	?>
	<div class="listItem-container">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="3"><div class="success"><?php __('Operation Complete');?>.</div></td>
			</tr>
		</table>
	</div>	
					
	<script>
		<?php if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['conversations'])){?>

				$.get("<?php echo $_SESSION['backurls']['conversations']?>", function(data){
					$("#widget-user-conversation-container").html('');
					$("#widget-user-conversation-container").html(data);		
				});
		
		<?php }?>
	</script>
	
	<?php 
		}else{
				echo $this->Form->create('Message', array(
											'method'=>'post',
											'inputDefaults' => array(
														'label' => false,
														'div' => false
												)));
	?>
	<div class="listItem-container">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td valign="top" width="238"><?php __('Message');?>:</td>
				<td colspan="2">
           			<?php 
           				echo $this->Form->input('messagebody', array('class' => 'input-field-textArea-extra-large'));
						echo $this->Form->input('id', array('type' => 'hidden')); 
					?>	                        
				</td>
			</tr>
			<tr>
				<td></td>
				<td colspan="2">
					<?php
							echo $this->Js->submit(__('Update',true), array(
										'url' => "/{$this->params['prefix']}/messages/edit",
										'method'=> 'post',
										'update' => '#widget-dailog-container',
										'div' => false,
										'class' => 'btn'
										)
								); 
					?>
				</td>
			</tr>
		</table>
	</div>
	
	<script>
		$(document).ready(function() {
			$(".listItem-container .btn").button();
		});
	</script>			
			
	<?php
		echo $this->Form->end(); 
		echo $this->Js->writeBuffer();                  
	?>
	<?php }?>