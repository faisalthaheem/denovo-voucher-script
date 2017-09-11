
	<div class="userManagement-widget-container">
    	<div class="title">
        	<div class="links-Div">
            	<div class="txt1"><?php __('Profile Information');?></div>
			</div>
		</div>
        
        <div class="action"></div>
		<div class="detail">
        	<div class="userProfile-widget-container">
            	<div class="left">
            	
                	<div class="img">
						<div class="remove-btn">
							<a href="javascript:void(0);" id="remove-picture" uuidtag="<?php echo $profile_picture['Picture']['uuidtag']?>">X</a>
						</div>
                      	<img class="profileFix-img" id="user-profile-pic" src="<?php echo $this->Picturescomponent->getPathToPicture($profile_picture['Picture']['uuidtag'], Configure::read('PictureTags.ProfileView')); ?>" border=0 />
					</div>
							
					<div class="link">
                        <?php 
                           	echo $this->element('widget-backoffice-activate-user', 
                           						array("isActive" => "{$user['User']['active']}",
                           								"user_id" => "{$user['User']['id']}"));
                        ?>
					</div>
                            
	                <div class="link">
						<?php 
					    	echo $this->Html->link(
					        					"Remove Profile", 
					        					"javascript:void(0);", 
					        					array('userid' => "{$user['User']['id']}",
					        							'id' => 'remove-user'));
						?>		            	
					</div>
	                
	                <div class="link">
						<?php 
					    	echo $this->Html->link(
					        					"Edit Information", 
					        					"javascript:void(0);", 
					        					array('userid' => "{$user['User']['id']}",
					        							'id' => 'edit-user'));
						?>		            	
					</div>
				
				</div>
                        
                <div class="right">
                   	<table height="190" cellspacing="0" cellpadding="0" border="0" width="730">
						<tr>
                           	<td width="243"><?php __('Name');?>:<span><?php echo $user['User']['fullname'];?></span></td>
                            <td width="243"><?php __('Email');?>:<span><?php echo $user['User']['email'];?></span></td>
                            <td width="244"><?php __('Age');?>:<span><?php echo $user['User']['age'];?></span></td>
						</tr>
                        <tr>
                        	<td colspan="2"><?php __('Website');?>: <span><?php echo $user['User']['webaddress'];?></span></td>
                            <td><?php __('Nationality');?>: <span><?php echo $user['User']['nationality'];?></span></td>
						</tr>
                        <tr>
                        	<td colspan="2"><?php __('Facebook');?>: <span><?php echo $user['User']['facebookurl'];?></span></td>
                            <td><?php __('Phone #');?>: <span><?php echo $user['User']['phone']?></span></td>
						</tr>
                        <tr>
                        	<td colspan="2"><?php __('My Space');?>: <span><?php echo $user['User']['myspaceurl'];?></span></td>
                            <td><?php __('Language');?>: <span></span></td>
						</tr>
                            
                        <tr>
                           	<td colspan="2"><?php __('Twitter');?>: <span><?php echo $user['User']['twitterurl'];?></span></td>
                        	<td><?php __('Education');?>: <span><?php echo $user['User']['education'];?></span></td>
						</tr>
                        <tr>
                        	<td colspan="3"><?php __('Address');?>: <span><?php echo $user['User']['address'];?></span></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
            
	<script type="text/javascript">
		$(document).ready(function(){

			if($("#widget-dailog-container").length <= 0)
			{
				$("#widget-user-profile-info-container").append('<div class="popup-container" title="User Operations" id="widget-dailog-container"></div>');
			}

			// Dialog			
			$('#widget-dailog-container').dialog({
				autoOpen: false,
				width: 650,
				modal: true,
				resizable: false,
				buttons: {}
			});
			
			
			$("#remove-user").click(function(){
				var userid;
				if($(this).attr('userid').length == 0)
				{
					return false;
				}else{
					userid = $(this).attr('userid');
				}

				var res = confirm("<?php __('Are you sure to delete this profile?');?>");
				if(!res){
					return false;
				}

				$.get("/<?php echo $this->params['prefix'];?>/users/remove_user/" + userid, function(data){
				<?php if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['users'])){?>
					$.get("<?php echo $_SESSION['backurls']['users'];?>", function(view){
						$("#widget-main-mid-top-container").html('');
						$("#widget-main-mid-top-container").html(view);
					});	
				<?php }?>
				});
			});

			$("#edit-user").click(function(){

				var userid;

				if($(this).attr('userid').length == 0)
				{
					return false;
				}else{
					userid = $(this).attr('userid');
				}

				$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/users/profile_data_edit/' + userid);		
				$('#widget-dailog-container').dialog('open');
			});

			$("#remove-picture").click(function(){

				var res = confirm("<?php __('Are you sure to remove user picture?');?>");
				if(!res){
					return false;
				}
				
				var uuid = $(this).attr('uuidtag');
				$.get('/<?php echo $this->params['prefix'];?>/pictures/remove_picture/' + uuid, function(data){
					$(".remove-btn").remove();
					$("#user-profile-pic").attr('src', '');
				});

			});
		});
	</script>
