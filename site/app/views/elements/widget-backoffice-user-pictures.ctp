	<?php 	
		$this->Paginator->options(
				array('update' => '#widget-user-pictures-container', 
					'evalScripts' => true)); 
	?>	
	<div class="userManagement-widget-container">
    	
    	<div class="title">
			
			<div class="links-Div">
            	
            	<div class="txt1">
                	<a href="#"><?php __('Select All');?></a>
                </div>
                
                <span> | </span>
                
                <div class="txt1">
                	<a href="#"><?php __('Remove');?></a>
				</div>
			
			</div>
		
		</div>
        
        <div class="action">
			
			<?php echo $this->element('widget-backoffice-pagination');?>
        
        </div>
        
        <div class="detail">
        	<div class="allPicture-widget-container">
            	
            	<?php foreach($pictures as $Picture):?>
            	
            	<!-- PICTURE START -->
                <div class="picture-widget-container">
                	<div class="title">
                    	<input type="checkbox" id="<?php echo $Picture['Picture']['id'];?>">
                        <label for="picture1"><?php echo $Picture['Picture']['title'];?></label>
					</div>
                    <div class="detail">
                    	<div class="img">
							<img alt="picture" src="/files/pictures/<?php echo $Picture['Picture']['filename'];?>">
                        </div>
                        
                        <div class="txt">
                        	<span>
                        		<?php echo $Picture['User']['fullname'];?>
                        	</span>
                        </div>
                    </div>
                    
                    <div class="action">
						<div class="ignore">
                        	<?php 
                        		//echo $this->element('widget-backoffice-abused-picture', array('PicId' => $Picture['Picture']['id']));
                        	?>
                        	<a href="#"><?php __('Ignore');?></a>
						</div>
                        
                        <span> | </span>
                        
                        <div class="remove">
                        	<?php 
                        		echo $this->Html->link(
                        							__("Remove",true)
                        							,"javascript:void(0);",
                        							array('filename' => $Picture));
                        		
                        	?>	
                        	<a href="#"><?php __('Remove');?></a>
						
						</div>
					</div>
				</div>
                <!-- PICTURE END -->
                <?php endforeach;?>
			</div>
		</div>
		<div class="action">
        	<?php echo $this->element('widget-backoffice-pagination');?>
		</div>
	</div>
	<?php echo $this->Js->writeBuffer(); ?>