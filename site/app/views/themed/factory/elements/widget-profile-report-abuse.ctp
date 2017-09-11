<?php

	if(!($viewingProfile == $_SESSION['Auth']['User']['id'])){
		//show options to report/withdraw
		echo $this->Html->link(
			($isAbuseReported == true)? __('Withdraw Abuse Report',true) : __('Report Abuse',true)
			,'javascript:void(0);'
			,array('id'=>"abuse-report-for-$viewingProfile")
		);
	}
?>

<script type="text/javascript">
	jQuery("#abuse-report-for-<?php echo $viewingProfile;?>").click(function(){

		jQuery.get('/abuse_reports/toggleprofile/<?php echo $viewingProfile?>');
		
		if(jQuery("#abuse-report-for-<?php echo $viewingProfile;?>").text() == '<?php __('Report Abuse');?>'){
			jQuery("#abuse-report-for-<?php echo $viewingProfile;?>").text('<?php __('Withdraw Abuse Report');?>');
		}else{
			jQuery("#abuse-report-for-<?php echo $viewingProfile;?>").text('<?php __('Report Abuse');?>');
		}
	});
</script>