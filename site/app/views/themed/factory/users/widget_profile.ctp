<!-- PROFILE Widget Start -->
<div class="profile-widget-container container-highlight">

<div class="header">

	<?php
		if($_SESSION['Auth']['User']['id'] == $user['User']['id']){

			echo $this->Js->link(
				'Edit profile'
				,'/users/widget_profileedit' 
				,array(
					'update' => '#mid-container-left-panel'
				)
			); 
			echo ' ';
			echo $this->Js->link(
				'Change Profile Picture'
				,'/pictures/profilepicture' 
				,array(
					'update' => '#mid-container-left-panel'
				)
			);
		} 
	?>
</div>						
												
  	<div class="profile-widget-title">
  		<?php echo $user['User']['fullname']; ?>
		
		<?php if($_SESSION['Auth']['User']['id'] != $user['User']['id']){?>
		<span class="restore-widget-container" onclick="toggleWidget(this);">
			<div class="restore-widget-title">Show/Hide</div>
		</span>
		<?php }?>
 	</div>
  	<div class="profile-widget-detail" id="profile-<?php echo $user['User']['id']; ?>">

		<!-- PROFILE INFO WIDGET START -->
	    <?php
	    	echo $this->element('widget-profile-header'); 
	    ?>	
		<!-- PROFILE INFO WIDGET START -->
            
	    <!-- BIO DATA WIDGET START -->
	    <?php
	    	echo $this->element('widget-profile-biodata'); 
	    ?>
	    <!-- BIO DATA WIDGET END -->

  	</div>
	<script type="text/javascript">
		function toggleWidget(element){
			jQuery("#profile-<?php echo $user['User']['id']; ?>").toggle('slow');	
		}	
	</script>
	
	<?php
		echo $this->Js->writeBuffer(); 
	?>  	
</div>
<!-- PROFILE Widget END -->