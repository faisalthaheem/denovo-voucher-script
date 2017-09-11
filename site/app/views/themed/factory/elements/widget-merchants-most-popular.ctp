	<div class="right-panel popularRetailer-widget-container popularRetailer-highlight">
                    <div class="title">
                        <div class="txt">
                        	<?php __('Most Popular Merchants');?>                       
                        </div>
                        <div class="btn" title="0">
                        	<a href="javascript:;">
                        		<img border="0" title="1" id="popularRetailer-arrow" src="/theme/factory/img/collapse-arrow.png">
                        	</a>
                        </div>
                    </div>
                    <div class="detail" style="display: block;">
                    	<?php foreach($widget_merchants_most_popular_data as $merchant): ?>
		                      <div class="item">
									<?php
                                		$imgcode = $html->image(
                                			$merchant['Vwbrowse']['logo_url'],
                                			array(
                                				'alt' => "{$merchant['Vwbrowse']['merchant_name']}'s Logo"
                                				,'height'	=> 50
                                				,'width'	=> 104
                                				,'border'	=> 0
                                			)
                                		);
                                		
                                		echo $this->Html->link(
                                			$imgcode,
                                			"/merchants/detail/{$merchant['Vwbrowse']['safe_merchant_name']}"
                                			,array(
                                				'escape' => false
                                			)
                                		);
                                	?>		                            
		                      </div>
                      	<?php endforeach; ?>
                    </div>
					<?php
						//echo $this->Js->writeBuffer(); 
					?>
                </div>