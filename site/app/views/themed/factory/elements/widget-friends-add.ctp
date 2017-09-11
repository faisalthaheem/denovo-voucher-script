<span id="friend-status-for-<?php echo $viewingProfile;?>">

<?php
	if(! ($viewingProfile == $_SESSION['Auth']['User']['id'])) {
		//show options to add as friend or show status
		if( 'n/a' == $friendStatus){
		echo $this->Html->link(
			__('Add as friend',true)
			,'javascript:void(0);'
			,array(
				'id' => "friend-action-for-$viewingProfile"
			)
		);
		}else if('friends' == $friendStatus){
			__('Friends');
		}else{
			__('Pending');
		}
	}
?>

</span>

<script type="text/javascript">
	jQuery("#friend-action-for-<?php echo $viewingProfile;?>").click(function(){

		jQuery.get('/friends/add/<?php echo $viewingProfile?>');
		jQuery("#friend-status-for-<?php echo $viewingProfile;?>").text('<?php __('Request sent.');?>');
		
	});
</script>