				<div class="pending-widget-container">
                	<div class="title">
                    	<div class="txt">
                        	<?php __('Pending My Approval');?>
                        </div>
                    </div>
                    <div class="detail">
                    
                    	<?php if(empty($requests)): ?>
                    		<div> <?php __('There are no pending requests.');?> </div>
                    	<?php endif;?>
                    
                    	<?php 
                    		$removeRight=0;
                    		foreach($requests as $request){
                    			$removeRight++;
                    	?>
                    	<div  class="pendingBox" <?php ($removeRight&1 == 1) ? 'b-remove':'';?>>
                        	<div class="img">
                            	<?php
                            		if(!empty($request['User']['Picture'])){
	                            		echo $this->Html->image(
	                            			$this->Picturescomponent->getPathToPicture($request['User']['Picture'][0]['uuidtag'], Configure::read('PictureTags.TinyPicture'))
	                            			,array(
	                            				'alt' => $request['User']['fullname'] . "'s picture"
	                            				,'border' => 0 
	                            			)
	                            		); 
                            		}
                            	?>
                            </div>
                            <div class="title">
                            	<?php
                            		echo $request['User']['fullname']; 
                            	?>
                            </div>
                            <div class="action" id="friend-requested-<?php echo $request['User']['id'];?>">
                            	<span class="btn" id="<?php echo $request['User']['id'];?>" type="accept"><?php __('Accept');?></span>
                            	<span class="btn" id="<?php echo $request['User']['id'];?>" type="reject"><?php __('Reject');?></span>
                            </div>
                        </div>
                        <?php
                    		} 
                        ?>
					<script>
						$(document).ready(function() {
							$(".pendingBox .action .btn").button().click(function(){

								if($(this).attr("type") == "accept"){
									$.get('/friends/approve/' + $(this).attr('id'));
									$("#friend-requested-" + $(this).attr('id')).html('<?php __('Accepted.');?>');
								}else{
									$.get('/friends/reject/' + $(this).attr('id'));
									$("#friend-requested-" + $(this).attr('id')).html('<?php __('Rejected.');?>');
								}
							});
						});
					</script>
                </div>
             </div>