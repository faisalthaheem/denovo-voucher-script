                    <div class="tab-widget-container" id='widget-index-tabbed-hot-mostliked-morecentlyviewed'>
                    	<div id="container">
                            <ul class="menu">
                                <li class="active" id="recentVoucher"><?php __('Most Recent');?></li>
                              <li id="topViewedDiscounts" class=""><?php __('Top Viewed');?></li>
                              <li id="merchantDirectory" class=""><?php __('Top Merchants');?></li>
                            </ul>

							<span class="clear"></span>

			              	<div class="detail recentVoucher" style="">
                                <div class="content">
                                    <div class="categoryList">
										<?php
											foreach($recentCODs as $cod): 
										?>
				                            <div class="itemDiv widget-index-tabbed-hot-mostliked-morecentlyviewed-cod">
				                                <div class="logo">
						                            <?php
						                            		$imgcode = $this->Html->image(
						                            			$cod['Vwbrowse']['logo_url'],
						                            			array(
						                            				'class' => 'logoFix',
						                            				'border' => 0
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
				                                <div class="txt">
				                                    <?php
				                                    	echo $cod['Vwbrowse']['title']; 
				                                    ?>
				                                </div>
				                            </div>
			                            <?php endforeach; ?>                                    	
                                    </div>
                                </div>
							</div>
							
								
            
                            <div class="detail topViewedDiscounts" style="display: none;">
								<div class="content">
                                    <div class="categoryList">
										<?php
											foreach($index_page_top_cod_data as $cod): 
										?>
				                            <div class="itemDiv widget-index-tabbed-hot-mostliked-morecentlyviewed-cod">
				                                <div class="logo">
						                            <?php
						                            		$imgcode = $this->Html->image(
						                            			$cod['Vwbrowse']['logo_url'],
						                            			array(
						                            				'class' => 'logoFix',
						                            				'border' => 0
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
				                                <div class="txt">
				                                    <?php
				                                    	echo $cod['Vwbrowse']['title']; 
				                                    ?>
				                                </div>
				                            </div>
			                            <?php endforeach; ?>                                    
                                    </div>
                                </div>
                            </div>


                            <div class="detail merchantDirectory" style="display: none;">
                                <div class="content">
            						<div class="categoryList">
            						
			                        	<?php
			                        		foreach($topMerchants as $merchant): 
			                        	?>
			                        	<div class="itemDiv">
			                            	<div class="logo">
			                                	<?php
			                                		$imgcode = $html->image(
			                                			$merchant['Vwbrowse']['logo_url'],
			                                			array(
			                                				'alt' => "{$merchant['Vwbrowse']['merchant_name']}'s Logo"
			                                				,'class' => 'logoFix'
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
			                                <div class="txt1">
			                                	<?php
			                                		echo $merchant['Vwbrowse']['cods_count'];
			                                	?>
			                                </div>
			                                <div class="txt2">
			                                	<?php
			                                		echo $this->Js->link(
			                                			$merchant['Vwbrowse']['merchant_name'],
			                                			"/merchants/detail/{$merchant['Vwbrowse']['safe_merchant_name']}"
			                                			,array(
			                                				'update' => '#mid-container-left-panel',
			                                				'escape' => false
			                                			)
			                                		);                                	
			                                	?>
			                                </div>
			                            </div>
			                            <?php
			                            	endforeach; 
			                            ?>            						
                                     </div>
                                </div>
                                <div class="action">
                                	<?php
                                		echo $this->Html->link(
                                			'View All'
                                			,"/merchants/index"
                                		);                                	
                                	?>                                	
                                </div>
						  </div>
						</div>
                    </div>
