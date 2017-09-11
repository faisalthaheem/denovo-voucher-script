    <div class="profile-info-widget-container">
        <div class="profile-info-widget-detail">
        
            <div class="profile-info-widget-row">
            	<table width="518" border="0" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td width="130" rowspan="4">
                      		<div class="profile-info-widget-img">
                      			<img src="<?php echo $this->Picturescomponent->getPathToPicture($profile_view_picture['Picture']['uuidtag'], Configure::read('PictureTags.ProfileView')); ?>" border=0 />
                      		</div>                                    
                    	</td>
                    	<th colspan="3">
                    		<?php
                    			echo $user['User']['fullname'];
                    		?>
                    	</th>
                  	</tr>
                  
                  	<tr>
                    	<td width="138">
                    		<?php if(!($_SESSION['Auth']['User']['id'] == $user['User']['id'])){?>
                    		<div class="send-message" style="color:#21aeea;">
                    			<?php
                    				echo $this->element('widget-conversations-send-message', array('toId' => $user['User']['id'], 'fromId' => $_SESSION['Auth']['User']['id'])); 
                    			?>
                    		</div>
							<div id="send-message-container" style="overflow:hidden;">
							</div>
							<?php }?>
                    	</td>
                    
                    	<td width="116">
                    		<div class="share">
                    			<?php 
                    				echo $this->element('widget-friends-add',array(
                    					'viewingProfile'=>$user['User']['id']
                    				));
                    			?>
                    		</div>
                    	</td>
                    	<td width="159">
                    		<div class="abuse-report">
                    			<?php 
                    				echo $this->element('widget-profile-report-abuse',array(
                    					'viewingProfile'=>$user['User']['id']
                    				));
                    			?>
                    		</div>
                    	</td>
                  	</tr>
                  <tr>
                    <td colspan="3"></td>
                  </tr>
                </table>
            </div>
        </div>
    </div>