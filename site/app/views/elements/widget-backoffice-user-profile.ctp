	<div class="siteSetting-widget-container">
    	<div class="content1-widget-container">
        	
        	<div class="title">
            	<div class="txt"><?php __('User Management');?> &raquo;</div>
				<div class="txt2">
					<?php 
						if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['users'])){
					
							echo $this->Js->link(__("Back",true),
												"{$_SESSION['backurls']['users']}",
												array("update" => "#widget-main-mid-top-container"));
						}		
					?>
				</div>
			</div>
			
            <div class="detail">
            		
            	<div id='widget-user-profile-info-container'>	
					<?php echo $this->element('widget-backoffice-profile-info');?>
            	</div>
            
            	<div id='widget-user-conversation-container'>
            		<?php //echo $this->element('widget-backoffice-user-conversations');?>
            	</div>
				
				<!--
				TODO: Picture widget is obsolete for DVS Community             	
            	<div id='widget-user-pictures-container'>
            		<?php //echo $this->element('widget-backoffice-user-pictures');?>
            	</div>
            	 -->
			
			</div>		
		
		</div>
	
	<script type="text/javascript">
		$(document).ready(function(){

			// get user conversations
			$.get('/<?php echo $this->params['prefix'];?>/conversations/user_conversations/<?php echo $user['User']['id'];?>', function(res){
				$('#widget-user-conversation-container').html(res);
			});
		});
	</script>	
	</div>
	<?php echo $this->Js->writeBuffer();?>