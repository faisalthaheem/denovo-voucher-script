<br />
<br />
<br />
<br />
<br />
<br />

<center>
	<?php __('Please wait while we process your request...'); ?>
</center>

<script type="text/javascript">

	function redirectToHomepage()
	{
		window.location = "/";
	}

	$(document).ready(function(){

		setTimeout("redirectToHomepage()", 2000);
	});
</script>