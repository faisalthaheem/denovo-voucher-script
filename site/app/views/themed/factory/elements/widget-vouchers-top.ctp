	<div class="right-panel topProduct-widget-container topProduct-highlight" id="widget-vouchers-top">
                    <div class="title">
                        <div class="txt">
                        	<?php __('Top Vouchers');?>                      
                        </div>
                        <div class="btn" title="0">
                        	<a href="javascript:;">
                        		<img border="0" title="1" id="popularRetailer-arrow" src="/theme/factory/img/collapse-arrow.png">
                        	</a>
                        </div>
                    </div>
                    <div class="detail" style="display: block;">
                    	<?php foreach($index_page_top_cod_data as $cod): ?>
		                      <div class="item">
									<?php
                                		$imgcode = $html->image(
                                			$cod['Vwbrowse']['logo_url'],
                                			array(
                                				'alt' => 'Logo here'
                                				,'height'	=> 50
                                				,'width'	=> 104
                                				,'border'	=> 0
                                			)
                                		);
                                		
	                            		echo $this->Html->link(
                                			$imgcode,
                                			"/cods/view/{$cod['Vwbrowse']['safe_title']}/{$cod['Vwbrowse']['safe_merchant_name']}"
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