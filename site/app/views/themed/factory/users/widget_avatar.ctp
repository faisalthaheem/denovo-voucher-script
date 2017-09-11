<div class="avatar-widget-container">
	<div class="avatar-widget-img">
		<div class="avatar-widget-img-container">         
		<?php 
        	echo $html->image(
        		$this->Picturescomponent->getPathToPicture($pic['Picture']['uuidtag'], Configure::read('PictureTags.Avatar')) 
        		,array(
        			'alt'=>'Profile picture', 
        			'border'=>'0' 
        		)
        	);
        ?>
        </div>
	</div>
	<div class="avatar-widget-name">
		<?php echo $_SESSION['Auth']['User']['fullname']; ?>
	</div>
</div>

