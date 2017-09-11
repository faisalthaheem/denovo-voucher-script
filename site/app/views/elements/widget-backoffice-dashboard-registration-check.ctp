	<?php
		if($registration_status == false):
	?>
	
	<script type="text/javascript">
	if(jQuery("#widget-main-mid-container-registration-dialog").length == 0)
	{
		jQuery("#widget-main-mid-container").append('<div id="widget-main-mid-container-registration-dialog" title="Register DVS4" class="popup-container"></div>');

		jQuery.ajaxSetup ({cache: false});

		var registered = false;

		$("#widget-main-mid-container-registration-dialog").load('/admin/sites/register');

		jQuery('#widget-main-mid-container-registration-dialog').dialog({
			autoOpen: true,
			closeOnEscape: false,
			draggable: false,
			width: 600,
			height:400,
			resizable:false,
			modal: true,
			buttons: {
				"Ok": function() { 

					if($("#widget-backoffice-sites-register-status").val() == "true"){
						registered = true;
						jQuery(this).dialog("close"); 
					}else{
						alert("<?php __('Please register to contnue');?>");
					}
				}
			},
			beforeClose: function(){
				return registered;
			}
		});
	}	
	</script>	
	
	<?php
		endif; 
	?>