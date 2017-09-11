<div class="successMsg-widget-container ">
    <ul id="success-message-list">
		<li><?php __('Upload Successfull');?>..!</li>
	</ul>
</div>
<?php if(null!= $cbfunc): ?>
<script type="text/javascript">
	window.parent.document.getElementById('<?php echo $cbfunc;?>').src = '/files/pictures/<?php echo $uploaded_image;?>';
</script>
<?php endif; ?>