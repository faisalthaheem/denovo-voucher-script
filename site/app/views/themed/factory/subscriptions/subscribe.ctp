<div class="txt">
<?php
	if(!is_array($subscription_result)){
		echo $subscription_result; 
	}else{
		echo $subscription_result['email'];
	}
?>
</div>