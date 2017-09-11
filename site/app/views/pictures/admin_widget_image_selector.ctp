	<?php 
		$this->Paginator->options(
					array(	'update' => "#$container", 
							'evalScripts' => true));
	?>
	
	<div class="siteSetting-widget-container">
    	<div class="content2-widget-container">
        	<div class="title">
            	<div class="txt"><?php __('Select Image');?> &raquo;</div>
            </div>
            
            <div class="detail">
            	
            	<div class="menuBar">
	                <div class="searchBar">
						
						<div class="title">
	                    	<?php __('Search');?>
	                    </div>
						<?php
							echo $this->Form->create('Picture', array(
											'method'=>'post',
											'inputDefaults' => array(
																'label' => false,
																'div' => false
														)
												)
										);
								echo $this->Form->input('search', array('class' => 'input', 'label'=>false));
								
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/pictures/widget_image_selector/{$type}/{$hiddenFieldId}/{$container}/{$uuidTag}",
											'method'=> 'post',
											'update' => "#{$container}",
											'div' => false,
											'value' => 0,
											'class' => 'btn')
										);
								
								echo $this->Form->end();
								echo $this->Js->writeBuffer();
						?>
					</div>                    
              	</div>
                
                <div class="bannerView-container">
                	<div class="banner-widget-container line">
						<?php foreach($pictures as $Picture):?>
	                    	
                    		<?php 
                    			if(
                    				$Picture['Picture']['tag2'] == Configure::read('PictureTags.Logo') 
                    			):
                    		?>
	                    	<div class="right">
	                        	<input type="radio" name="images" value="<?php echo $Picture['Picture']['uuidtag'];?>" filename="<?php echo $Picture['Picture']['filename'];?>">
	                            <label><?php echo $Picture['Picture']['tag2'] .  " [{$Picture['Picture']['title']}]";?></label>
	                            <div class="img">
                      				<img border=0 src="/files/pictures/<?php echo $Picture['Picture']['filename'];?>"/>
								</div>
							</div>
							<?php endif;?>
						<?php endforeach;?>
                    	
					</div>
                	<div class="banner-widget-container">
                    	    
						<?php foreach($pictures as $Picture):?>
                    		<?php 
                    			if(
                    				$Picture['Picture']['tag2'] == Configure::read('PictureTags.Banner')||
                    				$Picture['Picture']['tag2'] == Configure::read('PictureTags.Voucher')
                    			):
                    		?>
                        
                        <div class="left">
                        	<input type="radio" name="images" value="<?php echo $Picture['Picture']['uuidtag'];?>" filename="<?php echo $Picture['Picture']['filename'];?>">
                            <label><?php echo $Picture['Picture']['tag2'] . " [{$Picture['Picture']['title']}]";?></label>
                            <div class="img">
                      			<img border=0 src='/files/pictures/<?php echo $Picture['Picture']['filename'];?>'/>
							</div>
                            <div class="info-Div"></div>
						</div>
							<?php endif;?>
						<?php endforeach;?>
					</div>
				</div>
			</div>
			<div class="action">
                <?php echo $this->element('widget-backoffice-pagination');?>
			</div>
		</div>
        <div class="action">
        	<a class="btn" href="javascript:void(0);" id="btn-ok"><?php __('OK');?></a>
            <a class="btn" href="javascript:void(0);" id="btn-cancel"><?php __('Cancel');?></a>
        </div>		
	</div>
    <script type="text/javascript">
		$(document).ready(function(){
			$(".btn").button();

			$("#btn-ok").click(function(){

				var uuid = $('input[type="radio"]:checked').val();
				var filename = $('input[type="radio"]:checked').attr('filename');

				if(null == uuid){
					alert("image not selected.");
					return false;
				}
				
				$("#<?php echo $hiddenFieldId;?>").val(uuid); 
				$('#<?php echo $container;?> .general-widget-container .mid .img img').attr('src', '/files/pictures/' + filename);
				$('#widget-image-selector-dialog').dialog('close');
			});

			$("#btn-cancel").click(function(){
				$('#widget-image-selector-dialog').dialog('close');
			});
		});
    </script>	
	<?php echo $this->Js->writeBuffer();?>

