				<div class="friendList-widget-container">
                	<div class="title">
                    	<div class="txt">
                        	<?php __('Manage Friends');?>
                        </div>
                    </div>
                    <div class="detail">

                    	<?php if(empty($friends)): ?>
                    		<div> 
                    			<?php __('You currently have no friends');?>,
								<?php
									echo $this->Js->link(
										__('Find New Friends.',true)
										,'/users/widget_search_community' 
										,array(
											'update' => '#mid-container-left-panel'
										)
									); 
								?>                     			 
                    		</div>
                    	<?php endif;?>
                    
                    	<?php 
                    		$removeRight=0;
                    		foreach($friends as $friend){
                    			$removeRight++;
                    	?>
                    
                    	<div  class="friendBox" <?php ($removeRight&1 == 1) ? 'b-remove':'';?>>
                        	<div class="img">
                            	<?php
                            		if(!empty($friend['User']['Picture'])){
	                            		echo $this->Html->image(
	                            			$this->Picturescomponent->getPathToPicture($friend['User']['Picture'][0]['uuidtag'], Configure::read('PictureTags.TinyPicture'))
	                            			,array(
	                            				'alt' => $friend['User']['fullname'] . "'s picture"
	                            				,'border' => 0 
	                            			)
	                            		); 
                            		}
                            	?>
                            </div>
                            <div class="title" id="<?php echo $friend['User']['id'];?>">
                            	<?php
                            		echo $friend['User']['fullname']; 
                            	?>
                            </div>
                            <div class="action" id="friend-<?php echo $friend['User']['id'];?>">
                                <div class="deleteBtn">
                                	<span id="<?php echo $friend['User']['id'];?>" type="delete"><?php __('Unfriend');?></span>
                                </div>                            	
                            </div>
                        </div>
                        <?php
                    		} 
                        ?>
						<script>
							$(document).ready(function() {
								$(".friendBox .action .deleteBtn").children().first().click(function(){
	
									if($(this).attr("type") == "delete"){
										var varConfirm = confirm('<?php __('Are you sure you want to unfriend this friend?');?>'); 
										if(true == varConfirm)
										{
											$.get('/friends/unfriend/' + $(this).attr('id'));
											$("#friend-" + $(this).attr('id')).html('<?php __('Removed.');?>');
										}
									}
								});

								$(".friendBox .title").click(function(){
									jQuery("#manage-friends-profile-view-container").fadeToggle("slow", "linear");

							  		jQuery.get('/users/widget_profile/' + jQuery(this).attr("id"), function(markup){
							  	  		jQuery("#manage-friends-profile-view-container").html(markup);
							  	  		jQuery("#manage-friends-profile-view-container").fadeToggle("slow", "linear");
								  	});
								});
							});
						</script>
						<?php
							echo $this->Js->writeBuffer(); 
						?>                                            
                    </div>
					<div id="manage-friends-profile-view-container" style="display:block">
					<!--  Profile Loads here -->
					</div>                    
                </div>