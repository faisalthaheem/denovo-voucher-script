<?php
	if(!($viewingProfile == $_SESSION['Auth']['User']['id'])){
		//show options to report/withdraw
		echo $this->Html->link(
			($isReported == true)? __('Withdraw Abuse Report',true) : __('Report Abuse',true)
			,'javascript:void(0);'
			,array('id'=>"abuse-report-for-$PicId", 'class' => 'picture-widget-abuse-report')
		);
	}
?>

<script type="text/javascript">
	jQuery("#abuse-report-for-<?php echo $PicId;?>").click(function(){

		jQuery.get('/abuse_reports/togglepicture/<?php echo $viewingProfile;?>/<?php echo $PicId;?>');

		if(jQuery("#abuse-report-for-<?php echo $PicId;?>").text() == '<?php __('Report Abuse');?>'){
			jQuery("#abuse-report-for-<?php echo $PicId;?>").text('<?php __('Withdraw Abuse Report');?>');
		}else{
			jQuery("#abuse-report-for-<?php echo $PicId;?>").text('<?php __('Report Abuse');?>');
		}
	});
</script>