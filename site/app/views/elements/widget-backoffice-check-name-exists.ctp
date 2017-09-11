<?php 
	$dataKeyName = "data[{$model}][{$field}]";
	$dataValueId = "data[{$model}][id]";
	$siteID = is_numeric($site) ? $site : '$("#' . $site .'").val()';
	$url = "/{$this->params['prefix']}/{$controller}/{$func}";
?>

<script type="text/javascript">

	function setFocusToObservedField()
	{
		$('#<?php echo $inputFieldId;?>').focus();
	}

	$(document).ready(function(){

		$('#<?php echo $inputFieldId;?>').focusout(function(){

			//validate safe name
			//can contain only alpha numeric and hyphens
			var urlslugRegex = /^[a-z0-9-]+$/;
			if(!$(this).val().match(urlslugRegex))
			{
				alert("<?php __('Invalid Safe Name. Safe Name can only contain lower case letters, numbers and hyphens');?>.");
				setTimeout("setFocusToObservedField()", 1000);
				return;	
			}
			
			$("#<?php echo $SubmitButtonId;?>").attr('disabled', true);		
			
			if($(this).val().length == 0){
				alert("<?php echo "{$label} " . __('is required.',true);?>");
				$("#<?php echo $SubmitButtonId;?>").attr('disabled', false);		
				return false;
			}
			
			$.ajax({
				url: "<?php echo $url;?>",
			    type: "POST",
				data:	(
							{
								'<?php echo $dataKeyName;?>'		: 	$(this).val(),
								'<?php echo $dataValueId;?>' 		:	<?php echo $RecordId;?>,
								'data[<?php echo $model; ?>][site_id]':	<?php echo $siteID;?>
							}
						),
			    dataType: "json",
			    success: function(res){

				    if(res.Exists == 'yes'){

						alert("<?php echo "{$label} " . __('already exists, Please change it.',true);?>");
						$('#<?php echo $inputFieldId;?>').focus();

					}else{

						$("#<?php echo $SubmitButtonId;?>").attr('disabled', false);		
						return false;
					}
			    }
			});
		});	    
	});
</script>