
<!--   	          <img src="/theme/factory/img/ad-1.jpg" border="0" />-->
<?php 
	if(!empty($banners[0]['Picture'])){
		echo $this->element(
			'widget-banner-container', 
			array(
				'cssclass'=>'ad-type1', 
				'filename'=>$banners[0]['Picture']['filename'],
				'banner' => $banners[0]
			)
		);		
	}

?>
<!--<img src="/theme/factory/img/ad-2.jpg" border="0" />-->
<?php 
	if(!empty($banners[1]['Picture'])){
		echo $this->element(
			'widget-banner-container', 
			array(
				'cssclass'=>'ad-type2', 
				'filename'=>$banners[1]['Picture']['filename'],
				'banner' => $banners[1]
			)
		);
	}

?>

<!--<img src="/theme/factory/img/ad-3.jpg" border="0" />-->
<?php 
	if(!empty($banners[2]['Picture'])){
		echo $this->element(
			'widget-banner-container', 
			array(
				'cssclass'=>'ad-type2', 
				'filename'=>$banners[2]['Picture']['filename'],
				'banner' => $banners[2]
			)
		);
	}


?>