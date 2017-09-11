<?php
	//pagination setup
	$this->Paginator->options(array(
		'evalScripts' => true
	)); 
?>


		<div class="left-panel browseRetailers-widget-container">
                	<div class="title">
                    	<div class="icon"></div>
                    	<div class="txt2"><?php __('Browsing Merchants');?></div>
                        <div class="txt2">&nbsp;</div>
                    </div>
					<div class="action">
						<?php
							echo $this->element('widget-paging-standard'); 
						?>
                    </div>
                    <div class="detail">
                    	<?php
                    		echo $this->element('widget-merchants-browse-index-alphabetic-filter'); 
                    	?>

                        <div class="categoryList">
                        	<?php
                        		foreach($merchants as $merchant): 
                        	?>
                        	<div class="itemDiv">
                            	<div class="logo">
                                	<?php
                                	// todo: fix the localhost
                                		$imgcode = $html->image(
                                			(empty($merchant['Vwsitesmerchantscodcounts']['logo_url'])) ? 'http://localhost/null.jpg' : $merchant['Vwsitesmerchantscodcounts']['logo_url'],
                                			array(
                                				'alt' => "{$merchant['Vwsitesmerchantscodcounts']['merchant_name']}'s Logo"
                                				,'class' => 'logoFix'
                                			)
                                		);
                                		
                                		echo $this->Html->link(
                                			$imgcode,
                                			"/merchants/detail/{$merchant['Vwsitesmerchantscodcounts']['safe_merchant_name']}"
                                			,array(
                                				'escape' => false
                                			)
                                		);
                                	?>
                                </div>
                                <div class="txt1">
                                	<?php
                                		echo $merchant['Vwsitesmerchantscodcounts']['cods_count'];
                                	?>
                                </div>
                                <div class="txt2">
                                	<?php
                                		echo $this->Html->link(
                                			$merchant['Vwsitesmerchantscodcounts']['merchant_name'],
                                			"/merchants/detail/{$merchant['Vwsitesmerchantscodcounts']['safe_merchant_name']}"
                                			,array(
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
							echo $this->element('widget-paging-standard'); 
						?>
                    </div>
                </div>
<?php
	echo $this->Js->writeBuffer(); 
?>                