	
	<div class="general-widget-container">
    	<div class="left">
        	<div class="txt">
            	<?php echo $label;?>
			</div>
		</div>
        
        <div class="mid">
        	
        	<div class="action-Div">
            	<div class="edit-btn">
                	<a href="javascript:void(0);" id="update">
                		<img src="/img/backoffice/edit-icon.png">
                	</a>
                </div>
			</div>
            
            <div class="img">
                <?php if(empty($imageTag)){?>
                	<?php if($imageType == Configure::read('PictureTags.Logo')){?>
            		<img src="/img/backoffice/ad-2.jpg">
                	<?php }else{?>
            		<img src="/img/backoffice/ad-1.jpg">
					<?php }?>                
                <?php }else{?>
                	<img border=0 src="<?php echo $this->Picturescomponent->getPathToPicture($imageTag, $imageType, '.'.$this->Picturescomponent->getFileExtension($filename)); ?>"/>
                <?php }?>
			</div>
		</div>
		
		<script>
			$(document).ready(function(){

				if($("#widget-image-selector-dialog").length <=0 )
				{
					$("#<?php echo $container;?>").append('<div class="popup-container" title="<?php __('Select Image');?>" id="widget-image-selector-dialog"></div>');
				}

				// Dialog			
				$('#widget-image-selector-dialog').dialog({
					autoOpen: false,
					width: 1000,
					modal: true,
					resizable: false,
					position: 'top',
					buttons: {}
				});

				$("#dialog").click(function(){
					loadImages();
				});

				$("#update").click(function(){
					loadImages();
				});
				
			});

			function loadImages(){

				$("#widget-image-selector-dialog").empty();				
				$("#widget-image-selector-dialog").load('<?php echo "/{$this->params['prefix']}/pictures/widget_image_selector/{$imageType}/{$hiddenField}/widget-image-selector-dialog/{$imageTag}"; ?>');		
				$('#widget-image-selector-dialog').dialog('open');
			}
			
		</script>
	</div>						
