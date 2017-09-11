
        	<div class="<?php echo $cssclass; ?>">
        	<?php
	        	$domid = String::uuid(); 
	        	if($banner['Banner']['active'] == 1)
	        	{
	          	          
	   	        	if($banner['Banner']['accountingmethod'] == 'clicks' && $banner['Banner']['clicksdone'] < $banner['Banner']['maxclicks'])
	   	        	{
		   	        	?>
		   	        	<a id="<?php echo $domid; ?>" target="_blank" href="<?php echo $banner['Banner']['url']; ?>" >
		   	        		<img src="<?php echo $this->Picturescomponent->getPathToPictureFromFileName($banner['Picture']['filename']); ?>" border=0 />
		   	        	</a>

		   	        	<script type="text/javascript">
		   	        		$(document).ready(function(){
			   	        		$("#<?php echo $domid; ?>").click(function(){
			   	        			$.get('/banners/click/<?php echo $banner['Banner']['id']?>');
			   	        		});
			   	        	});
		   	        	</script>
		   	        	<?php	   	        	
	   	        	}elseif($banner['Banner']['accountingmethod'] == 'impressions' && $banner['Banner']['impressionsdone'] < $banner['Banner']['maximpressions'])
	   	        	{
		   	        	?>
		   	        	<a id="<?php echo $domid; ?>" target="_blank" href="<?php echo $banner['Banner']['url']; ?>" >
		   	        		<img src="<?php echo $this->Picturescomponent->getPathToPictureFromFileName($banner['Picture']['filename']); ?>" border=0 />
		   	        	</a>

		   	        	<script type="text/javascript">
		   	        		$(document).ready(function(){
			   	        		$.get('/banners/impression/<?php echo $banner['Banner']['id']?>');
			   	        	});
		   	        	</script>
		   	        	<?php
	   	        	}else{
		   	        	?>
		   	        	<a id="<?php echo $domid; ?>" target="_blank" href="<?php echo $banner['Banner']['url']; ?>" >
		   	        		<img src="<?php echo $this->Picturescomponent->getPathToPictureFromFileName($banner['Picture']['filename']); ?>" border=0 />
		   	        	</a>

		   	        	<script type="text/javascript">
		   	        	</script>
		   	        	<?php	   	        	
	   	        	}
	        	}
			?>
            </div>
            
            