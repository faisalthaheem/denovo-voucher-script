<?php
	//pagination setup
	$this->Paginator->options(array(
		//'update' => '#mid-container-left-panel',
		'evalScripts' => true
	)); 
?>
				<div class="vouchers-widget-container" id="widget-cods-index">
                    <div class="title">
                        <div class="title txt">
                            <?php
                            	echo $title; 
                            ?>
                        </div>
                    </div>
                    <div class="action">
						<?php
							echo $this->element('widget-paging-standard'); 
						?>
                    </div>
                    <div class="detail">
                    
						<div class="categoryList">
							<?php
								foreach($rows as $cod): 
							?>
	                            <div class="itemDiv">
	                            	
	                                <div class="logo">
			                            <?php
			                            		echo
			                            		$this->Html->link( 
				                            		$this->Html->image(
				                            			$cod['Vwbrowse']['logo_url'],
				                            			array(
				                            				'class' => 'logoFix',
				                            				'border' => 0,
				                            			)
				                            		),
				                            		"/cods/view/{$cod['Vwbrowse']['safe_title']}/{$cod['Vwbrowse']['safe_merchant_name']}",
				                            		array(
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
                    <div class="action">
						<?php
							echo $this->element('widget-paging-standard'); 
						?>
                    </div>
                </div>
                	
<?php 
	echo $this->Js->writebuffer();
?> 