                <div class="right-panel allCategories-widget-container">
                    <div class="allCategories-widget-container title">
                        <?php __('Merchant &amp; Voucher Categories');?>
                    </div>
                    <div class="allCategories-widget-container detail">
                        <div class="detail left">
                            <ul>
                            <?php
                            	for($i = 0; $i<count($widget_categories_vouchers_deals_data)/2; $i++): 
                            ?>
                            
                                <li>
                                	<div class="block">
                                		<span>
                                		<?php
                                			echo $widget_categories_vouchers_deals_data[$i]['Vwbrowse']['countMerchants']; 
                                		?>
                                		</span>
                                	</div>
                                	<?php
										echo $this->Html->link(
											"{$widget_categories_vouchers_deals_data[$i]['Vwbrowse']['catname']}"
											,'/merchants/by_category/' .  $widget_categories_vouchers_deals_data[$i]['Vwbrowse']['safe_catname']
										); 
                                	?>
                               	</li>
                                
                           	<?php 
                           		endfor;
                           	?>
                            </ul>
                        </div>
                
                        <div class="detail right">
                            <ul>
                            <?php
                            	for($i = count($widget_categories_vouchers_deals_data)/2; $i<count($widget_categories_vouchers_deals_data); $i++): 
                            ?>
                            
                                <li>
                                	<div class="block">
                                		<span>
                                		<?php
                                			echo $widget_categories_vouchers_deals_data[$i]['Vwbrowse']['countMerchants']; 
                                		?>
                                		</span>
                                	</div>
                                
                                	<?php
										echo $this->Html->link(
											"{$widget_categories_vouchers_deals_data[$i]['Vwbrowse']['catname']}"
											,'/merchants/by_category/' .  $widget_categories_vouchers_deals_data[$i]['Vwbrowse']['safe_catname']
										); 
                                	?>
                               	</li>
                                
                           	<?php 
                           		endfor;
                           	?>
                            </ul>
                        </div>
                    </div>
                    <?php
                    	echo $this->Js->writeBuffer(); 
                    ?>
                </div>