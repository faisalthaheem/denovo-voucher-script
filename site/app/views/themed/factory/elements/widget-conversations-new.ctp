<div id="widget-conversations-new">
	
	<div id="message-form-content">
		<div class="newMessage-widget-container">
                    <div class="title">
                        <div class="title txt">
                            <?php __('Compose Message');?>
                        </div>
                    </div>
                    <div class="detail">
                    	<div class="composeForm">
                        	<div class="row">
                            	<div class="txtField">
                                	<?php __('To');?> :
                                </div>
                                <div class="btn2">
                                	<a href="#" id="message-to" recipient="0"><?php __('Select');?></a>
                                </div>
                            </div>
                            <div class="row">
                            	<div class="txtField">
                                	<?php __('Subject');?> :
                                </div>
                                <?php
                                	echo $this->Form->input(
	                                		'subject', 
	                                		array(
	                                			'class' => 'inputField', 
	                                			'id' => 'subject', 
	                                			'label' => false, 
	                                			'div' => false
	                                		)
                                		); 
                                ?>
                            </div>
                            <div class="row">
                            	<div class="txtField">
                                	<?php __('Message');?> :
                                </div>
                                <?php
                                	echo $this->Form->input(
	                                		'message', 
	                                		array(
	                                			'type' => 'textarea',
	                                			'class' => 'messageField', 
	                                			'id' => 'message', 
	                                			'label' => false, 
	                                			'div' => false
	                                		)
                                		); 
                                ?>
                            </div>
                            <div class="row">
                            	<input type="submit" name="submit" class="btn" value="<?php __('Send');?>" id="send-message" />
                            </div>
                        </div>
                    </div>
				</div>
	</div>
</div>
	
	<?php 	
			echo $this->Js->writeBuffer();
	?>
	<!-- SEND MSG POP UP END -->		
	
	<script type="text/javascript">


		jQuery(document).ready(function(){

			//Choose recipient dialog
			if(jQuery("#widget-conversations-new-select-recipient").length == 0)
			{
				jQuery("#widget-conversations-new").append("<div id='widget-conversations-new-select-recipient' style='display: none;' title='Message'></div>");
			}
			jQuery("#widget-conversations-new-select-recipient").dialog({
				autoOpen: false,
				width: 400,
				height:300,
				resizable:false,
				buttons: {
					"Ok": function() {
						//when #message-to, the contents of the div #widget-conversations-new-select-recipient are updated
						//via an ajax load
						if($("input[name=selected-friend-id]").length > 0)
						{
							var selectedRecipient = $("input[name=selected-friend-id]:checked").val();
							jQuery("#message-to").attr(
									'recipient',
									selectedRecipient
							);

							//set name of the recipient as button label
							//getFriendNameFromId defined in widget-friends-radioselect which is loaded via ajax below
							jQuery("#message-to").text(getFriendNameFromId(selectedRecipient));
						}						
						jQuery(this).dialog("close"); 
					},
					"Cancel": function(){
						jQuery(this).dialog("close");
					}
				}
			});

			//choose recipient button
			jQuery("#message-to").button().click(function(){
				jQuery("#widget-conversations-new-select-recipient").html('');
				jQuery("#widget-conversations-new-select-recipient").load('/friends/radioselector');
				jQuery("#widget-conversations-new-select-recipient").dialog("open");
			});			
			
			//send message button
			jQuery("#send-message").button().click(function(){

				jQuery.ajaxSetup ({cache: false});
				
				if(validateForm())
				{
					sendMessage();
				}
			});


		});

		function validateForm(){

			if(jQuery("#message-to").attr('recipient') == 0)
			{
				alert("<?php __('Please select a recipient.');?>");
				jQuery("#message-to").focus();
				return false;
			}
			
			if(jQuery("input[id=subject]").val() == ''){
				
				alert("<?php __('Please enter subject of the message');?>.");
				jQuery("#subject").focus();
				return false;
			}

			if(jQuery("textarea[id=message]").val() == ''){

				alert("<?php __('Please enter your message.');?>");
				jQuery("textarea[id=message]").focus();
				return false;
			}

			return true;
		}
		
		function sendMessage(){

			var msgSent = false;
			var reciever = jQuery("#message-to").attr('recipient');
			var subject	= jQuery("input[id=subject]").val();
			var message	= jQuery("textarea[id=message]").val();

			jQuery.ajax({
				  url: '/conversations/new_conversation/',
				  type: 'POST',
				  data: ({	'data[Conversation][user_id]' : reciever,
  							'data[Conversation][subject]': subject,
  							'data[Conversation][message]': message
				  	}),
				  success: function(data){
				  		$("#mid-container-left-panel").html(data);
			 		}
			});
		}
	</script>



