	<?php 	
		$this->Paginator->options(
				array('update' => '#widget-user-conversation-container', 
					'evalScripts' => true)); 
	?>	
	<div class="userManagement-widget-container">
    	<div class="title">
        	<div class="links-Div">
            	<div class="txt1"><?php __('Conversations');?></div>
			</div>
		</div>
        
        <div class="action">
        	<?php echo $this->element('widget-backoffice-pagination');?>
        </div>        
        
        <div class="detail">
        	<div class="userAllConversation-widget-container">
            	
				<?php foreach($conversations as $Conversation):?>
                
                <div class="userConversation-widget-container">
                	<div class="subject"><?php echo $Conversation['Conversation']['subject'];?></div>
                    <div class="description">
                    	
						<?php foreach($Conversation['Message'] as $Message):?>
                    	
                    	<div class="message-Div">
                        	
                        	<div class="img">
                        		
								<?php if(isset($Message['User']['Picture'][0]['uuidtag'])){?>
                            	
                            	<img class="tinyFix-img" alt='<?php echo "{$Message['User']['fullname']}";?>' src="<?php echo $this->Picturescomponent->getPathToPicture($Message['User']['Picture'][0]['uuidtag'], Configure::read('PictureTags.TinyPicture')); ?>">
                            	
                        		<?php }else{?>
                            	
                            	<img class="tinyFix-img" alt="<?php echo "{$Message['User']['fullname']}";?>" src="img/user-img3.png">
                            	
                        		<?php }?>
							</div>
                            
                            <div class="txt">
                            	<span><?php echo $Message['User']['fullname'];?></span>
                            	<br>
                            	<?php echo $Message['messagebody'];?>
							</div>
                            
                            <div class="action">
                            	<div class="btn-row">
                                	<div class="close-btn">
                                    	<?php 
											echo $this->Html->link(
																"X", 
																"javascript:void(0);", 
																array('escape' => false,
																	'messageid' => $Message['id']
																)
															);                                    	
                                    	?>
									</div>
									
									<div class="edit-btn">
                                    	<?php 
											echo $this->Html->link(
																$this->Html->image("backoffice/edit-icon.png"), 
																"javascript:void(0);", 
																array('escape' => false,
																	'messageid' => $Message['id'],
																	'userid' => $Conversation['User']['id']));                                    	
                                    	?>
									</div>
								</div>
                                <div class="timeTxt">
                                	<?php echo date_format(date_create($Message['created']), "m-d-Y h:i A"); ?>	
								</div>
							</div>
						
						</div>
                        
                        <?php endforeach;?>
					
					</div>
				
				</div>
				
                <?php endforeach;?>
			
			</div>
		
		</div>
		<div class="action">
        	<?php echo $this->element('widget-backoffice-pagination');?>
		</div>
	</div>
	<?php echo $this->Js->writeBuffer();?>
	<script>
		$(document).ready(function(){

			if($("#widget-dailog-container").length <= 0)
			{
				$("#widget-user-conversation-container").append('<div class="popup-container" title="User Operations" id="widget-dailog-container"></div>');
			}

			// Dialog			
			$('#widget-dailog-container').dialog({
				autoOpen: false,
				width: 650,
				modal: true,
				resizable: false,
				buttons: {}
			});

			$(".message-Div .action .btn-row .edit-btn a").click(function(){

				var msgid = $(this).attr('messageid');
				
				$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/messages/edit/' + msgid);		
				$('#widget-dailog-container').dialog('open');
			});

			$(".message-Div .action .btn-row .close-btn a").click(function(){

				var res = confirm("<?php __('Are you sure to remove user conversation?');?>");
				if(!res){
					return false;
				}

				var msgid = $(this).attr('messageid');
				$.get("/<?php echo $this->params['prefix'];?>/messages/remove/" + msgid, function(res){
					<?php if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['conversations'])){?>
						$.get("<?php echo $_SESSION['backurls']['conversations'];?>", function(data){
							$("#widget-user-conversation-container").html('');
							$("#widget-user-conversation-container").html(data);		
						});
					
					<?php }?>
				});
			});
		});
	</script>