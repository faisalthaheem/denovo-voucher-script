<?php 
	header("Cache-Control: no-cache, must-revalidate");
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

	$filename = "Subscribers-$sitename-" . date('Y-m-d') . ".csv";
	header("Content-Disposition:attachment; filename=\"$filename\"");
	
	foreach($subscribers as $subscriber)
	{
		echo $subscriber['subscriptions']['email'] . "\n";
	}
?>