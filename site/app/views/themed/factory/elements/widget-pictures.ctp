	<div class="my-pictures-widget-container profile-expand my-pictures-highlight">
    	<div class="my-pictures-widget-title"><?php echo $title;?></div>
        <div class="my-pictures-widget-detail"><!-- DISPLAY NONE -->
		
		<?php
			//http://leandrovieira.com/projects/jquery/lightbox/# 
			foreach($widgetPictures as $picture):
					
				$popupPic = str_replace(
										Configure::read("PictureTags.ProfileViewPictureWidget")
										, Configure::read("PictureTags.PopupPicture")
										, $picture['Picture']['filename']
									);
				$popupPic = str_replace(
										Configure::read("PictureTags.ProfileViewPictureWidget")
										, Configure::read("PictureTags.PopupPicture")
										, $popupPic
									);
						
		?>
			<div class="picture-widget-container">
            	<div class="picture-widget-title">
					<?php 
                		if(strlen($picture['Picture']['title']) != 0){
                			echo substr($picture['Picture']['title'], 0, 25).'...';
                		}else{
                			echo __('No Title');
                		}
                	?>
                </div>
                <div class="picture-widget-detail">
                	<div class="picture-widget-img" id="profile-picture-<?php echo $picture['Picture']['picindex']?>">
                		<div class="picture-widget-img-boundary">
	                		<a href="/files/pictures/<?php echo $popupPic;?>" rel="<?php echo $groupName;?>">
								<img src="/files/pictures/<?php echo $picture['Picture']['filename'];?>" border="0" />
							</a>                                     
						</div>     
					</div>
                	<?php if($_SESSION['Auth']['User']['id'] != $user['User']['id']){?>
					<div class="picture-widget-abuse-report">
					<?php 
						echo $this->element(
								'widget-picture-report-abuse', 
									array(	'PicId' => $picture['Picture']['id'], 
										  	'isReported' => $picture['Picture']['isReportedAbuse'],
										  	'viewingProfile'=>$user['User']['id']
										));
					?>
					</div>
					<?php }?>
				</div>
			</div>
		<?php
			endforeach;
		?>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery("a[rel='<?php echo $groupName;?>']").lightBox();
			});
		</script>
	</div>
