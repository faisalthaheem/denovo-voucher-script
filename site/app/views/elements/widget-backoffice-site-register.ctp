<div id="widget-backoffice-sites-register" class="registerUser-widget-container">
<?php
	echo $this->Form->hidden('widget-backoffice-sites-register-status', array('value'=>$registration_status, 'div' => false)); 
?>

<?php if(false == $registration_status): ?>
<div class="detail" style="width: auto;">
	<label><?php __('Full Name');?></label>
	<input id="widget-backoffice-sites-register-fullname" class="input-field-large" />

	<label><?php __('Email');?></label>
	<input id="widget-backoffice-sites-register-email" class="input-field-large" />
	
	<a href="javascript:void(0);" id="widget-backoffice-sites-register-submit" class="btn"><?php __('Register!');?></a>
	
	<img src="/img/backoffice/ajax-loading.gif" alt = "Loading..." style="display: none;" id="widget-backoffice-sites-register-processing" />
</div>	

	<script type="text/javascript">
		$(document).ready(function(){
			$("#widget-backoffice-sites-register-submit").button().click(function(){

				if($("#widget-backoffice-sites-register-fullname").val().length == 0)
				{
					alert("<?php __('Please enter your name');?>");
					$("#widget-backoffice-sites-register-fullname").focus();
					return;
				}

				var email_pattern = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				useremail = $("#widget-backoffice-sites-register-email").val();
				if(!useremail.match(email_pattern))
				{
					alert("<?php __('Please provide with a valid email address');?>");
					$("#widget-backoffice-sites-register-email").focus();
					return;					
				}

				$("#widget-backoffice-sites-register-fullname").attr("disabled",true);
				$("#widget-backoffice-sites-register-email").attr("disabled",true);
				$(this).button("disable");
				$("#widget-backoffice-sites-register-processing").toggle();

				jQuery.ajax({
					  url: '/admin/sites/register',
					  type: 'POST',
					  data: ({	'data[Registration][fullname]' : $("#widget-backoffice-sites-register-fullname").val(),
	  							'data[Registration][email]': useremail
					  	}),
					  success: function(data){
					  		$("#widget-backoffice-sites-register").html(data);
				 		}
				});				
				
			});
		});
	</script>	       
	        				
<?php else: ?>
	<?php __('Thank you for registering!');?>
<?php endif;?>




</div>