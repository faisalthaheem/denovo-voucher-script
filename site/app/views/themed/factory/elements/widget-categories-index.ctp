            	<div class="left-panel categories-widget-container">
                    <div class="title">
                        <div class="title txt">
                            <?php __('All Categories');?>
                        </div>
                    </div>
                    <div class="detail">
                    	<?php foreach($categories as $category):?>
                        <div class="category-widget-container">
                            <div class="title">
                                <?php 
                                	echo $this->Html->link(
                                		$category['Vwbrowse']['catname'], 
                                		"/merchants/by_category/{$category['Vwbrowse']['safe_catname']}"
                                	);
                                ?>
                            </div>
                            <div class="detail">
                                <div class="links">
                                	<?php 
                                		foreach($category['children'] as $subcat)
                                		{
                                			echo $this->Html->link(
                                				$subcat['Vwbrowse']['catname'],
                                				"/merchants/by_category/{$subcat['Vwbrowse']['safe_catname']}"
                                			) . " | ";
                                		} 
                                	?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach;?>
                    </div>
				</div>