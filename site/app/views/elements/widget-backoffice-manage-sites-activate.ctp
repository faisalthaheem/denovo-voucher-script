<?php
	//TODO: check where this is being used
	//Show activate option
	echo $this->Html->link(
		($isActive == 0)? __('Activate',true):__('De-activate',true) 
		,'javascript:void(0);'
		,array('id'=>"activate-site-$site_id")
	);
?>

<script type="text/javascript">
	$("#activate-site-<?php echo $site_id;?>").click(function(){

		$.get("/<?php echo $this->params["prefix"];?>/sites/toggleSiteStatus/<?php echo $site_id;?>");

		if($("#activate-site-<?php echo $site_id;?>").text() == 'De-activate'){
			$("#activate-site-<?php echo $site_id;?>").text('<?php __('Activate');?>');
		}else{
			$("#activate-site-<?php echo $site_id;?>").text('<?php __('De-activate');?>');
		}
	});
</script>                            
