 <span id='cmd-send-message'>Send Message</span>	
	<!-- SEND MSG POP UP START -->
	<div id="message-form-content" style="display:none;">
		<div class="popup-videos-widget-container">	    
	    	<div class="popup-videos-widget-detail">
	        	<table width="540" height="120" border="0" cellpadding="0" cellspacing="0">
	          		<tr>
	            		<th width="125" height="38">To:</th>
	            		<td width="409" align="left">
	            			<div class="popup-send-message-widget-text">
	            				<?php echo $user['User']['fullname'];?>
	            			</div>
	            		</td>
					</tr>
	          		<tr>
	            		<th width="125" height="38"><?php __('Subject');?>:</th>
	            		<td width="409">
	            			<?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value' => $toId, 'id' => 'user_id', 'label' => false, 'div' => false));?>
	            			<?php echo $this->Form->input('sender_id', array('type' => 'hidden', 'value' => $fromId, 'id' => 'sender_id', 'label' => false, 'div' => false));?>
	            			<?php echo $this->Form->input('subject', array('class' => 'input-field-type-7', 'id' => 'subject', 'label' => false, 'div' => false));?>
	            		</td>
					</tr>
	          		<tr>
	            		<th width="125" height="38"><?php __('Message');?>:</th>
	            		<td width="409">
	            			<?php echo $this->Form->input('message', array('type' => 'textarea','class' => 'input-field-type-8', 'id' => 'message', 'label' => false, 'div' => false));?>
	            		</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<?php 	echo $this->Form->end();
			echo $this->Js->writeBuffer();
	?>
	<!-- SEND MSG POP UP END -->		
	
	<script type="text/javascript">

		jQuery(document).ready(function(){

			jQuery(".popup-send-message-widget-btn").button();

			if(jQuery("#<?php echo 'send-message-dialog-to-'.$toId.'-from-'.$fromId;?>").length == 0)
			{
				jQuery("#send-message-container").append("<div id='<?php echo 'send-message-dialog-to-'.$toId.'-from-'.$fromId;?>' style='display: none;' title='Message' class='popup-pictures-widget-container'></div>");
				jQuery.ajaxSetup ({cache: false});

				// loading form
				var formContent = jQuery("#message-form-content").contents();
				jQuery("#<?php echo 'send-message-dialog-to-'.$toId.'-from-'.$fromId;?>").append(formContent);
				jQuery("#message-form-content").hide();
				
				// Dialog
				jQuery("#<?php echo 'send-message-dialog-to-'.$toId.'-from-'.$fromId;?>").dialog({
					autoOpen: false,
					width: 580,
					height:'auto',
					resizable:true,
					buttons: {
						"Send": function() {

							var isDataValid = validateForm(); 
							var messageSent = false;

							if(isDataValid){
								sendMessage();
								jQuery(this).dialog("close");
							}
						},
						"Cancel": function(){
							jQuery(this).dialog("close");
						}
					}
				});
			}

			jQuery("#cmd-send-message").click(function(){
				jQuery("#<?php echo 'send-message-dialog-to-'.$toId.'-from-'.$fromId;?>").dialog("open");
			});
			
		});

		function validateForm(){

			if(jQuery("input[id=subject]").val() == ''){
				
				alert("<?php __('Please enter subject of the message.');?>");
				return false;
			}

			if(jQuery("textarea[id=message]").val() == ''){

				alert("<?php __('Please enter body of the Message.');?>");
				return false;
			}

			return true;
		}
		
		function sendMessage(){

			var msgSent = false;
			var sender = jQuery("input[id=sender_id]").val();
			var reciever = jQuery("input[id=user_id]").val();
			var subject	= jQuery("input[id=subject]").val();
			var message	= jQuery("textarea[id=message]").val();

			jQuery.ajax({
				  url: '/conversations/new_conversation/',
				  type: 'POST',
				  data: ({	'data[Conversation][user_id]' : jQuery("input[id=user_id]").val(),
  							'data[Conversation][sender_id]': jQuery("input[id=sender_id]").val(),
  							'data[Conversation][subject]': jQuery("input[id=subject]").val(),
  							'data[Conversation][message]': jQuery("textarea[id=message]").val()
				  	}),
				  success: function(){
			 			}
			});
		}
	</script>



