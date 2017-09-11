
	<script type="text/javascript">
		$(document).ready(function(){

			if($("#widget-backoffice-upload-image-dailog-container").length <= 0)
			{
				$("#widget-main-mid-top-container").append('<div class="popup-container" title="<?php __('Upload Image');?>" id="widget-backoffice-upload-image-dailog-container"></div>');

			}

			// Dialog			
			$('#widget-backoffice-upload-image-dailog-container').dialog({
				autoOpen: false,
				width: 650,
				modal: true,
				resizable: false,
				buttons: {}
			});

			$('#widget-backoffice-upload-image-dailog-container').empty();
			
			//append iframe
			$('<iframe />', {
						
				id: 'upload-picture',
				name: 'Upload-Picture-iFrame',
				width: '600',
				height:'280',
				frameborder: '0',
				src: '/<?php echo $this->params['prefix'];?>/pictures/widget_upload_iframe/'
			}).appendTo('#widget-backoffice-upload-image-dailog-container');

			$('#widget-backoffice-upload-image-dailog-container').dialog('open');
		});
	</script>
