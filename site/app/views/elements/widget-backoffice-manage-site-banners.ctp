<?php 
	$this->Paginator->options(
				array(	'update' => '#widget-main-mid-top-container', 
						'evalScripts' => true)); 
?>
<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		<div class="title">
    		
    		<div class="txt"><?php __('Manage Banners');?> &raquo;</div>
    		<div class="txt2">
				<?php
					if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['sites'])){
						echo $this->Js->link(
									__("Back",true)
									,"{$_SESSION['backurls']['sites']}"
									,array(
										'update' => '#widget-main-mid-top-container'
									)
								);
						} 
				?>
    		</div>
		</div>
		
		<div class="detail">
        
        	<div class="bannerView-container">
			
				<?php foreach($banners as $Banner):?>
            	
            	<div class="banner-widget-container">
					
					<div class="left">
                    	
						<label>
							<?php echo $Banner['Banner']['tag'];?>
	                    	<span>
	                    		<a href="javascript:void(0);" name="edit" bannerid="<?php echo $Banner['Banner']['id'];?>"><?php __('Edit');?></a>
	                    	</span>
                    	</label>
                    	<div class="img-Div">
	                        <div class="img">
	                        	
	                        	<div class="action-Div">
	                            	<div class="close-btn">
	                                	<a href="javascript:void(0);" bannerid="<?php echo $Banner['Banner']['id'];?>">X</a>
	                                </div>
								</div>
	                            
	                    		<?php if(isset($Banner['Picture']['uuidtag'])){?>
	                                <img border='0' src="<?php echo $this->Picturescomponent->getPathToPicture($Banner['Picture']['uuidtag'], Configure::read('PictureTags.Banner'), '.'.$this->Picturescomponent->getFileExtension($Banner['Picture']['filename']));?>">
								<?php }else{?>
	                                <img border='0' src="/img/backoffice/ad-1.jpg">
								<?php }?>
							
							</div>
                        </div>
                        <div class="info-Div">
                        	
                        	<?php if(!empty($Banner['Banner']['accountingmethod'])){?>
	                        	
	                        	<div class="txt">
	                            	<?php __('Accounting Method');?>: <span><?php echo $Banner['Banner']['accountingmethod'];?></span>
								</div>
							
                        	<?php }?>
							
							<?php if($Banner['Banner']['accountingmethod'] == "clicks"){?>
                            
	                            <div class="txt">
	                            	<?php __('Total Clicks');?>: <span><?php echo $Banner['Banner']['clicksdone'];?></span>
	                            </div>
	                            <div class="txt">
	                            	<?php __('Max Clicks');?>: <span><?php echo $Banner['Banner']['maxclicks'];?></span>
	                            </div>
                            
							<?php }else if($Banner['Banner']['accountingmethod'] == "impressions"){?>
                            
	                            <div class="txt">
	                            	<?php __('Total Clicks');?>: <span><?php echo $Banner['Banner']['impressionsdone'];?></span>
	                            </div>
	                            <div class="txt">
	                            	<?php __('Max Clicks');?>: <span><?php echo $Banner['Banner']['maximpressions'];?></span>
	                            </div>
                            
                            <?php }else if($Banner['Banner']['accountingmethod'] == "date"){?>
                            
	                            <div class="txt">
	                            	<?php __('Started');?>: <span><?php echo $Banner['Banner']['created'];?></span>
	                            </div>
                            
                            <?php } ?>
                            
                            <?php if(!empty($Banner['Banner']['url'])){?>
	                            <div class="txt">
	                            	<?php __('Link Url');?>: 
	                            	<span>
		                            	<a href="<?php echo $Banner['Banner']['url'];?>" target="_blank">
		                            		<?php echo $Banner['Banner']['url'];?>
		                            	</a>
	                            	</span>
	                            </div>
	                        <?php }?>
	                        
						</div>
					</div>
				</div>
				<?php endforeach;?>
			</div>
		</div>		
	</div>
	<script type="text/javascript">

		$(document).ready(function(){

			$(".banner-widget-container .left label span a[name=edit]").click(function(){

				var id = $(this).attr('bannerid');
				$.get('<?php echo "/{$this->params['prefix']}/banners/edit/";?>' + id, function(data){
					$("#widget-main-mid-top-container").html('');
					$("#widget-main-mid-top-container").html(data);
				});
			});

			$(".banner-widget-container .left .img .action-Div .close-btn a").click(function(){

				var res = confirm("<?php __('Do you realy want to remove banner image?');?>");
				if(!res){
					return false;
				}
				
				var bannerid = $(this).attr('bannerid');
				$.get('<?php echo "/{$this->params['prefix']}/banners/remove_image/";?>' + bannerid, function(data){
					
					<?php if(isset($_SESSION['backurls']['sites'])){?>
						$.get('<?php echo "{$_SESSION['backurls']['sites']}"; ?>', function(html){
							$("#widget-main-mid-top-container").html('');
							$("#widget-main-mid-top-container").html(html);

						});
					<?php }?>

				});
			});
		});
	</script>
</div>
<?php echo $this->Js->writeBuffer();?>