<?php
//debug($abuseProfilesDashboard,true); 
?>

					<!-- ABUSE REPORT START -->
                    <div class="abuse-report-widget-container extra-style1">
                        <div class="abuse-report-widget-title">Latest Profile Abuses</div>
                        <div class="abuse-report-widget-detail">
                        <?php
                        	$i = 0;
                        	foreach($abuseProfilesDashboard as $profile){
                        		$breakText = ( ($i % 3) == 0)? 'margin-remove-right' : '';
                        ?>
                          <div class="abuse-report-widget-detail-box">
                                <div class="abuse-report-widget-detail-box-img <?php echo $breakText;?>">
                                	<?php
                                		if(!empty($profile['User']['Picture'])){
                                			echo $this->Html->image(
                                				"/files/pictures/{$profile['User']['Picture'][0]['filename']}"
                                				, array('border'=>0)
                                			);
                                		} 
                                	?>
                                </div>
                                <div class="abuse-report-widget-detail-box-column">
                                    <div class="abuse-report-widget-detail-box-txt blue-color">
                                    	<?php echo $profile['User']['fullname']; ?>
									</div>
                                    <div class="abuse-report-widget-detail-box-txt">
                                        <?php echo $profile['User']['address']; ?>
                                    </div>
                                </div>
                          </div>
                        <?php
                        		$i++;
                        	} 
                        ?>
                        </div>                        
                    </div>
                    <!-- ABUSE REPORT END -->