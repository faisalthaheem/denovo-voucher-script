	<?php 
		$this->Paginator->options(
					array(	'update' => '#widget-main-mid-top-container', 
							'evalScripts' => true));
	?>
	
	<div class="siteSetting-widget-container">
    	<div class="content2-widget-container">
        	<div class="title">
            	<div class="txt"><?php __('Banners &amp; Logos');?> &raquo;</div>
            </div>
            
            <div class="detail">
            	
            	<div class="menuBar">
                	<div class="item">
                		<a href="javascript:void(0);" id="upload-banner"><?php __('New Banner');?></a>
                	</div>
                    <div class="item">
                    	<a href="javascript:void(0);" id="upload-logo"><?php __('New Logo');?></a>
                    </div>
                    <div class="item">
                    	<a href="javascript:void(0);" id="upload-voucher"><?php __('New Voucher');?></a>
                    </div>
                    <div class="item">
                    	<a href="javascript:void(0);" id="remove-images"><?php __('Remove');?></a>
                    </div>
                    <div class="item last">
                    	<a href="javascript:void(0);" id="refresh-images"><?php __('Refresh');?></a>
                    </div>
                    
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
								echo $this->Form->input('search', array('class' => 'input'));
								
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/pictures/index",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
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
	                        	<input type="checkbox" value="<?php echo $Picture['Picture']['uuidtag'];?>">
	                            <label><?php echo $Picture['Picture']['tag2'] .  " [{$Picture['Picture']['title']}]";?></label>
	                            <div class="img">
	                            	<div class="action-Div">
	                                	<div class="close-btn">
	                                    	<a href="javascript:void(0);" uuid="<?php echo $Picture['Picture']['uuidtag'];?>">X</a>
	                                    </div>
	                                </div>
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
                        	<input type="checkbox" value="<?php echo $Picture['Picture']['uuidtag'];?>">
                            <label><?php echo $Picture['Picture']['tag2'] . " [{$Picture['Picture']['title']}]";?></label>
                            <div class="img">
                            	<div class="action-Div">
                                	<div class="close-btn">
                                    	<a href="javascript:void(0);" uuid="<?php echo $Picture['Picture']['uuidtag'];?>">X</a>
                                    </div>
                                </div>
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
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
	
			$("#upload-banner").click(function(){

				$.get('<?php echo "/{$this->params['prefix']}/pictures/widget_site_images/banner";?>', function(data){
					$("#widget-main-mid-bottom-container").html(data);
				});
			});
	
			$("#upload-logo").click(function(){

				$.get('<?php echo "/{$this->params['prefix']}/pictures/widget_site_images/logo";?>', function(data){
					$("#widget-main-mid-bottom-container").html(data);
				});
			});

			$("#upload-voucher").click(function(){

				$.get('<?php echo "/{$this->params['prefix']}/pictures/widget_site_images/voucher";?>', function(data){
					$("#widget-main-mid-bottom-container").html(data);
				});
			});
			
			$(".img .action-Div .close-btn a").click(function(data){

				var uuidtag = $(this).attr('uuid');

				var res = confirm("<?php __('Are you sure to remove image?');?>");
				if(!res){
					return false;
				}

				removeImage(uuidtag);

				$.get('<?php echo "/{$this->params['prefix']}/pictures/index";?>', function(data){
					$("#widget-main-mid-bottom-container").html('');
					$("#widget-main-mid-top-container").html('');
					$("#widget-main-mid-top-container").html(data);
				});	
			});

			$("#remove-images").click(function(){
				var i = 0;
				$('input[type="checkbox"]:checked').each(function(){
					i++;
				});

				if(i == 0){

					alert("<?php __('image not selected');?>");

				}else{

					var res = confirm('<?php __('are you sure to remove selected image(s)?');?>');
					if(!res){
						return false;
					}
				}

				$('input[type="checkbox"]:checked').each(function(){
					removeImage($(this).val());
				});

				$.get('<?php echo "/{$this->params['prefix']}/pictures/index";?>', function(data){
					$("#widget-main-mid-bottom-container").html('');
					$("#widget-main-mid-top-container").html('');
					$("#widget-main-mid-top-container").html(data);
				});	
			});

			$("#refresh-images").click(function(){

				$.get('<?php echo $this->Paginator->url(); ?>', function(data){
					$("#widget-main-mid-bottom-container").html('');
					$("#widget-main-mid-top-container").html('');
					$("#widget-main-mid-top-container").html(data);
				});
			});
		});

		function removeImage(uuidTag){

			$.get('<?php echo "/{$this->params['prefix']}/pictures/remove_picture/"; ?>/' + uuidTag, function(data){
				return;
			});
		}
	</script>

	<?php echo $this->Js->writeBuffer();?>