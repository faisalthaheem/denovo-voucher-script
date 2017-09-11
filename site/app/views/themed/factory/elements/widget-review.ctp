<?php
//	debug($reviewStats,true);
//	debug($haveReviewed,true); 
	$randid = 'star'.rand();
	$readonly = (($haveReviewed==true) || ($user['User']['id'] == $_SESSION['Auth']['User']['id']))? 'disabled="disabled"' : '';
	//$readonly = (($haveReviewed==true))? 'disabled="disabled"' : '';
	
	$star1Checked = ''; $star2Checked = ''; $star3Checked = ''; $star4Checked = ''; $star5Checked = '';
	if($reviewStats['review_avg'] >4){
		$star5Checked = " checked='checked'";	
	}else if($reviewStats['review_avg'] >3){
		$star4Checked = " checked='checked'";	
	}else if($reviewStats['review_avg'] >2){
		$star3Checked = " checked='checked'";	
	}else if($reviewStats['review_avg'] >1){
		$star2Checked = " checked='checked'";		
	}else if($reviewStats['review_avg'] >0){
		$star1Checked = " checked='checked'";	
	}
	
?>
            <div class="profile-info-widget-row">
                <div class="profile-info-widget-txt-3">
                    <input name="<?php echo $randid;?>" type="radio" class="star" <?php echo $readonly . $star1Checked;?> value='1' />
                	<input name="<?php echo $randid;?>" type="radio" class="star" <?php echo $readonly . $star2Checked;?> value='2' />
                	<input name="<?php echo $randid;?>" type="radio" class="star" <?php echo $readonly . $star3Checked;?> value='3' />
                	<input name="<?php echo $randid;?>" type="radio" class="star" <?php echo $readonly . $star4Checked;?> value='4' />
                	<input name="<?php echo $randid;?>" type="radio" class="star" <?php echo $readonly . $star5Checked;?> value='5' />
                </div>

                <div class="profile-info-widget-txt-2"><?php echo $widget_title;?></div>
            </div>
            
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('input.star').rating({
		'cancel': 'Cancel Review'
		,callback: function(val, link){
			
			if(val == undefined){
				rating = 0;
			}else{
				rating = val;
			}

			jQuery.get("/reviews/reviewed/<?php echo $user['User']['id'];?>/" + rating);
		}
	});
});
</script>