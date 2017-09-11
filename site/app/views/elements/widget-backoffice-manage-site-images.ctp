<?php 
	$this->Paginator->options(
				array(	'update' => '#widget-main-mid-top-container', 
						'evalScripts' => true)); 
	//TODO: check if this is being used anywhere...
?>
<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		<div class="title">
    		
    		<div class="txt">Manage Banners &raquo;</div>
    		<div class="txt2">
				<?php
					if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['sites'])){
						echo $this->Js->link(
									"Back"
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
			
			<div class="menuBar">
				<div class="item">
					<a href="javascript:void(0);" id="upload-banner">
						Upload Banner
					</a>
				</div>
				<div class="item last">
					<a href="javascript:void(0);"  id="upload-logo">
						Upload Logo
					</a>
				</div>
			</div>
			
			<?php foreach($banners as $Banner):?>
            <div class="bannerView-container">
            	<div class="banner-widget-container">
                	
                	<div class="left">
                    	<input type="checkbox">
                    	<label><?php echo $Banner['Banner']['tag'];?></label>
                        
                        <div class="img">
                        	
                        	<div class="action-Div">
                            	<div class="close-btn">
                                	<a href="#">X</a>
                                </div>
							</div>
							
							<img width="474px" height="68px" src="/files/pictures/<?php echo $Banner['Picture']['filename'];?>">
						</div>
					</div>
                    
                    <div class="right">
                    	<div class="txt">
                        	URL:
                            <span>
                            	<a href="<?php echo $Banner['Banner']['url'];?>" target="_blank">
                            		<?php echo $Banner['Banner']['url'];?>
                            	</a>
                            </span>
						</div>
                        <div class="txt">
                        	Accounting Method:
							<span><?php echo $Banner['Banner']['accountingmethod'];?></span>
						</div>
						<?php if($Banner['Banner']['accountingmethod'] == 'clicks'){?>
                        <div class="txt">
                        	Max. Clicks:
							<span><?php echo $Banner['Banner']['maxclicks'];?></span>
						</div>
                        <div class="txt">
                        	Clicks Done:
                            <span><?php echo $Banner['Banner']['clicksdone'];?></span>
                 		</div>
                 		<?php }else if($Banner['Banner']['accountingmethod'] == 'impressions'){?>
                        <div class="txt">
                        	Max Impressions:
							<span><?php echo $Banner['Banner']['maximpressions'];?></span>
						</div>
                        <div class="txt">
                        	Impressions Done:
                            <span><?php echo $Banner['Banner']['impressionsdone'];?></span>
                 		</div>
                 		<?php }else if($Banner['Banner']['accountingmethod'] == 'date'){?>
                 		<div class="txt">
                 			Started From:
                 			<span><?php echo $Banner['Banner']['created'];?></span>
                 		</div>
                 		<?php }?>
                 		
                 		<div class="txt">
                 			<a href="javascript:void(0);" name="edit" itemid="<?php echo $Banner['Banner']['id'];?>">Edit</a>
                 		</div>
					
					</div>
				</div>
                
                 <?php endforeach;?>
                
				<div class="action">
                	<?php echo $this->element('widget-backoffice-pagination');?>
				</div>
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

			$(".banner-widget-container .right .txt a[name=edit]").click(function(){
				var id = $(this).attr('itemid');
				$.get('<?php echo "/{$this->params['prefix']}/banners/edit/}";?>' + id, function(data){
					$("#widget-main-mid-top-container").hide();
					$("#widget-main-mid-bottom-container").html('');
					$("#widget-main-mid-bottom-container").html(data);
				});

			});
		});
	</script>
</div>
<?php echo $this->Js->writeBuffer();?>