			<!-- FOOTER TITLE START -->
            <div class="title">

		        <?php
		        	echo $this->element('widget-menu-footer'); 
		        ?> 
		                        
		        <?php
		        	echo $this->element('widget-statistics-users-online'); 
		        ?>                    
                
            </div>
            <!-- FOOTER TITLE END -->

            <!-- FOOTER DETAIL START -->
            <div class="detail">
            	<!-- FOOTER DETAIL LEFT START -->
                <div class="detail-left">
                    <div class="column">
                        <div class="column title">
                        	<?php __('Recently Viewed Merchants');?>
                        </div>
                        <div class="column detail">
                            <ul>
                            <?php
                            	foreach($footer_recent_merchants as $merchant)
                            	{
                            			echo '<li>';
										echo $this->Html->link(
											$merchant['Vwbrowse']['merchant_name']
											,'/merchants/detail/' . $merchant['Vwbrowse']['safe_merchant_name']
										);
										echo '</li>';                            		
                            	} 
                            ?>
                            </ul>
	                    </div>
                    </div>
                    <div class="column">
                        <div class="column title">
                            <?php __('Recently Viewed Categories');?>
                        </div>
                        <div class="column detail">
                            <ul>
                           <?php
                            	foreach($footer_recent_categories as $category)
                            	{
                            			echo '<li>';
										echo $this->Html->link(
											$category['Vwbrowse']['catname']
											,'/merchants/by_category/' . $category['Vwbrowse']['safe_catname']
										);
										echo '</li>';                            		
                            	} 
                            ?>
                            </ul>
                        </div>
                    </div>
                    <div class="column">
                        <div class="column title">
                            <?php echo $sitename;?>
                        </div>
                        <div class="column detail">
                            <ul>
                                <li>
                                <?php
									echo $this->Html->link(
										__('About',true)
										,'/about/'
									);                                 
                                ?>
                                </li>

                                <li>
                                <?php
									echo $this->Html->link(
										__('Terms of use',true)
										,'/terms-and-conditions'
									);                                 
                                ?>
                                </li>
                                
                                <li>
                                <?php
									echo $this->Html->link(
										__('Privacy Policy',true)
										,'/privacy-policy'
									);                                 
                                ?>
                                </li>
                                

                            </ul>
                        </div>
                    </div>
                
                    <div class="detail-left action">
                        <input type="button" class="bookmark" value="<?php __('Boomark Page');?>" />
                        <input type="button" class="toolbar" value="<?php __('Download Toolbar');?>"  />
                    </div>
                    
                    <?php
                    	echo $this->Js->writebuffer(); 
                    ?>
                </div>
                <!-- FOOTER DETAIL LEFT END -->

                <!-- FOOTER DETAIL RIGHT START -->
                <div class="detail-right">

                	<!-- Subscribe Widget START -->
			        <?php
			        	echo $this->element('widget-subscriptions-subscribe-footer'); 
			        ?>
                    <!-- Subscribe Widget END -->



                    <!-- FOLLOW US WIDGET START -->
			        <?php
			        	echo $this->element('widget-footer-follow-us'); 
			        ?>
                    <!-- FOLLOW US WIDGET END -->

                </div>
                <!-- FOOTER DETAIL RIGHT END -->

            </div>
            <!-- FOOTER DETAIL END -->

            <!-- FOOTER BOTTOM START -->
            <div class="bottom">
                <div class="bottom txt1">
                    <?php __('Use of this site is subject to the');?> 
                    &nbsp;
                    <span>
                                <?php
									echo $this->Html->link(
										__('Terms & Conditions',true)
										,'/terms-and-conditions'
										,array(
											'class' => 'blueLINK'
										)
									);                                 
                                ?>                        
                    </span>
                    &nbsp;
                    <?php __('which constitutes a legal agreement between you and DVS, Inc.<br />View our');?> 
                    <span>
                                <?php
									echo $this->Html->link(
										__('Privacy Policy',true)
										,'/privacy-policy'
										,array(
											'class' => 'blueLINK'
										)
									);                                 
                                ?>
                    </span>
                    &nbsp;
                    , <?php __('revised and effective');?> <?php echo date('Y/m/d'); ?>.
                </div>
                
                <div class="bottom txt2">
                	<?php echo "Copyrigth &copy; " . date('Y') . " $sitename"; ?>
                </div>
            </div>
            <!-- FOOTER BOTTOM END -->
