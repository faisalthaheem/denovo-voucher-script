<?php
	//pagination setup
	$this->Paginator->options(array(
		'evalScripts' => true
	)); 
?>


<div class="left-panel browseRetailers-widget-container">
                	<div class="title">
                    	<div class="icon"></div>
                    	<div class="txt2"><?php __('Browsing by Category');?></div>
                        <div class="txt2">&nbsp;"<?php echo $catInfo['Category']['catname']; ?>"</div>
                    </div>

                    <div class="detail">
                    	<?php
                    		echo $this->element('widget-merchants-browse-by-category-alphabetic-filter'); 
                    	?>

                        <div class="categoryList">
                        	<?php
                        		foreach($merchants as $merchant): 
                        	?>
                        	<div class="itemDiv">
                            	<div class="logo">
                                	<?php
                                		$imgcode = $html->image(
                                			$merchant['Vwcategoriesmerchantscodcount']['logo_url'],
                                			array(
                                				'alt' => "{$merchant['Vwcategoriesmerchantscodcount']['merchant_name']}'s Logo"
                                				,'class' => 'logoFix'
                                			)
                                		);
                                		
                                		echo $this->Html->link(
                                			$imgcode,
                                			"/merchants/detail/{$merchant['Vwcategoriesmerchantscodcount']['safe_merchant_name']}"
                                			,array(
                                				'escape' => false
                                			)
                                		);
                                	?>
                                </div>
                                <div class="txt1">
                                	<?php
                                		echo $merchant['Vwcategoriesmerchantscodcount']['cods_count'];
                                	?>
                                </div>
                                <div class="txt2">
                                	<?php
                                		echo $this->Html->link(
                                			$merchant['Vwcategoriesmerchantscodcount']['merchant_name'],
                                			"/merchants/detail/{$merchant['Vwcategoriesmerchantscodcount']['safe_merchant_name']}"
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
                
                <script>
					$(document).ready(function() {

						$.get('/nolayout/categories/increment_view_count/<?php echo $catInfo['Category']['safe_catname'];?>');
												
					});
				</script>
<?php
	echo $this->Js->writeBuffer(); 
?>                