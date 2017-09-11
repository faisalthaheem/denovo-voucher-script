<?php
	//Show activate option
	echo $this->Html->link(
		($isActive == 0)? 'Activate':'Ban' 
		,'javascript:void(0);'
		,array('id'=>"activate-user-$user_id")
	);
?>

<script type="text/javascript">

	$('#activate-user-<?php echo $user_id;?>').click(function(){

		$.get("/<?php echo $this->params["prefix"];?>/users/toggleUserStatus/<?php echo $user_id;?>");

		if($("#activate-user-<?php echo $user_id;?>").text() == 'Ban'){

			$("#activate-user-<?php echo $user_id;?>").text('Activate');

		}else{

			$("#activate-user-<?php echo $user_id;?>").text('Ban');
		}
	});

</script>                            
