<?php
	//if viewing one's own own profile then show the current stats of how many people like myself
	if($viewingProfile == $_SESSION['Auth']['User']['id']){
		echo "by $favStats member(s)";
	}else{
		//show options to like/unlike
		echo $this->Html->link(
			($isFavorited == true)? __('Remove from favorites',true) : __('Add to favorites',true)
			,'javascript:void(0);'
			,array('id'=>"favaction-for-$viewingProfile")
		);
	}
?>

<script type="text/javascript">
	jQuery("#favaction-for-<?php echo $viewingProfile;?>").click(function(){

		jQuery.get('/favorites/toggle/<?php echo $viewingProfile?>');
		
		if(jQuery("#favaction-for-<?php echo $viewingProfile;?>").text() == '<?php __('Add to favorites');?>'){
			jQuery("#favaction-for-<?php echo $viewingProfile;?>").text('<?php __('Remove from favorites');?>');
		}else{
			jQuery("#favaction-for-<?php echo $viewingProfile;?>").text('<?php __('Add to favorites');?>');
		}
	});
</script>