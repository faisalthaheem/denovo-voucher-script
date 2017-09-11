<div>
	<!-- PICTURES Widget Start -->
    <div class="edit-pictures-widget-container basic-information-highlight">
    	<div class="edit-pictures-widget-title"><?php echo $title;?></div>
                        
        <div class="edit-pictures-widget-detail">
        	
        	<div id="Prov-PView-container-1">
        		<?php
        			//0 th index is fixed for profile pic
        			echo $this->element('widget-picture-edit', array('picindex' => 0, 'userid' => $userid));
        		?>
        	</div>
		</div>
	
	</div>
	<!-- PICTURES Widget END -->
</div>