                    <div class="followUs-widget-container">
                    	<?php if(!empty($siteInfo['twitterusername'])): ?>
                        <div class="followUs-widget-container twitter">
                            <div class="followUs-widget-container twitter img">
                              <img src="/theme/factory/img/twitter.png" border="0" />
                            </div>
                            <div class="followUs-widget-container twitter txt">
                                <?php __('Want to be the first to know about our vouchers and deals?');?> 
                                <span>
                                	<a href="http://twitter.com/#!/<?php echo $siteInfo['twitterusername'];?>" class="blueLINK" target="_blank"><?php __('Follow us on Twitter!');?></a>
                                </span>
                            </div>
                        </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($siteInfo['fbpagename'])): ?>
                        <div class="followUs-widget-container facebook">
                            <div class="followUs-widget-container facebook img">
                              <img src="/theme/factory/img/facebook.png" border="0" />
                            </div>
                            <div class="followUs-widget-container facebook txt">
                                <?php __('Catch us onFacebook!');?>  
                                <span>
                                	<a href="<?php echo $siteInfo['fbpagename'];?>" class="blueLINK" target="_blank"><?php __('Become a fan now.');?></a>
                                </span>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>