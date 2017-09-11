	<div class="edit-pictures-widget-img-boundary" id="picture-<?php echo $picindex.'-'.$userid; ?>">

    	<div class="hover-widget-container" id="hover-widget-container-<?php echo $picindex;?>">
        	<div id="widget-delete-<?php echo $picindex;?>" picindex='<?php echo $picindex;?>' param='<?php echo $userid;?>' class="hover-widget-delete"></div>
            <div id="widget-edit-<?php echo $picindex;?>" picindex='<?php echo $picindex;?>' param='<?php echo $userid;?>' class="hover-widget-edit"></div>
		</div>
<?php 
			if(isset($pictures[$picindex]))
			{
?>
			<div class="edit-pictures-widget-img">
				<img picindex="<?php echo $picindex;?>" src="<?php echo '/files/pictures/'.$pictures[$picindex]['Picture']['filename'];?>" border="0" id="img-<?php echo $picindex . '-' . $userid;?>" title="<?php echo $pictures[$picindex]['Picture']['title'];?>" />
			</div>
<?php 
			}else{
?>
			<div class="edit-pictures-widget-img">
				<img picindex="<?php echo $picindex;?>" src="/theme/factory/img/my-picture-3.jpg" border="0" id="img-<?php echo $picindex . '-' . $userid;?>" title="default" />
			</div>
<?php 
			}
?>	
	</div>
	
	
		
	<script type="text/javascript">

		jQuery(document).ready(function(){

			jQuery("#picture-<?php echo $picindex.'-'.$userid; ?>").mouseover(function(){
				jQuery(this).children("#hover-widget-container-<?php echo $picindex;?>").show();
			});
		
			jQuery("#picture-<?php echo $picindex.'-'.$userid; ?>").mouseout(function(){
				jQuery(this).children("#hover-widget-container-<?php echo $picindex;?>").hide();
			});

			jQuery("#widget-edit-<?php echo $picindex;?>").mouseover(function(){
				jQuery("#widget-edit-<?php echo $picindex;?>").css("background-color","black");
			});
		
			jQuery("#widget-edit-<?php echo $picindex;?>").mouseout(function(){
				jQuery("#widget-edit-<?php echo $picindex; ?>").css("background-color","transparent");
			});
			
			jQuery("#widget-delete-<?php echo $picindex;?>").mouseover(function(){
				jQuery("#widget-delete-<?php echo $picindex;?>").css("background-color","black");
			});
		
			jQuery("#widget-delete-<?php echo $picindex;?>").mouseout(function(){
				jQuery("#widget-delete-<?php echo $picindex;?>").css("background-color","transparent");
			});
			

			// Image Delete event
			jQuery("#widget-delete-<?php echo $picindex;?>").click(function(){

				var picindex = jQuery(this).attr('picindex');
				var userid = jQuery(this).attr('param');

				// get title of the image
				var title = jQuery('#img-' + picindex + '-' + userid).attr('title');

				if(title == 'default')
				{
					alert("Picture does not exist.");
					return false;
				}
				else
				{
					// Delete User Image
					jQuery.get('/pictures/delete_picture/' + picindex + '/' + userid, 
							function(response){
								if(response == "Success")
								{ 
									document.getElementById('img-' + picindex + '-' + userid).src = '/img/default-pic.jpg';
								}
								else if(response == "Failed")
								{ 
									alert("Delete Failed, Please try again later.");
									return false;
								}
						});					
				}
			});

			// Image edit/upload event
			jQuery("#widget-edit-<?php echo $picindex;?>").click(function(){

				// ALGO
				// if title == 'default'
				//    then this is default image and we will directly upload image
				// else 
				//    then this is uploaded image first delete it then upload another
				var picindex = jQuery(this).attr('picindex');
				var userid = jQuery(this).attr('param');

				// get title of the image
				var title = jQuery('#img-' + picindex + '-' + userid).attr('title');

				resetUploadDialog();

				jQuery('#picture-upload-dialog-<?php echo $picindex.'-'.$userid;?>').dialog('open');
				
			});

			if(jQuery("#picture-upload-dialog-<?php echo $picindex.'-'.$userid;?>").length == 0)
			{
				jQuery("#picture-<?php echo $picindex.'-'.$userid; ?>").append('<div id="picture-upload-dialog-<?php echo $picindex."-".$userid;?>" style="display: none;" title="Upload Picture" class="popup-pictures-widget-container"></div>');
	
				jQuery.ajaxSetup ({cache: false});
				
				// Creating iFrame
				resetUploadDialog();
					
				// Dialog
				jQuery('#picture-upload-dialog-<?php echo $picindex.'-'.$userid;?>').dialog({
					autoOpen: false,
					width: 600,
					height:400,
					resizable:false,
					modal: true,
					buttons: {
						"Ok": function() { 
							jQuery(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							jQuery(this).dialog("close"); 
						} 
					}
				});			
			}
	});

	function resetUploadDialog()
	{
		//show loading bouncer image
		$('#picture-upload-dialog-<?php echo $picindex."-".$userid;?>').html('<?php echo $this->element('widget-ajax-loading-normally-shown',array('div_dom_id'=>'widget-picture-edit-upload-iframe-loader'));?>');

		//append iframe
		$('<iframe />', 
		{
		  id: 'upload-pic-<?php echo $picindex.'-'.$userid; ?>',
		  name: 'Upload-Picture-iFrame',
		  width: '400',
		  frameborder: '0'
		}).appendTo('#picture-upload-dialog-<?php echo $picindex."-".$userid;?>');

		//set url
		$("iframe#upload-pic-<?php echo $picindex.'-'.$userid; ?>").attr('src','/pictures/widget_upload_iframe/img-<?php echo "$picindex-$userid";?>');

		//load iframe and hide loader image
		$("iframe#upload-pic-<?php echo $picindex.'-'.$userid; ?>").load(function(){
			$("#widget-picture-edit-upload-iframe-loader").hide('slow');
		});
	}
	</script>	    
	
