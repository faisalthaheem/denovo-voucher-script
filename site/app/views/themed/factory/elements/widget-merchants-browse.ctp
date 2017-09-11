                <div class="right-panel browseSHOPS-widget-container">
                	<div class="browseSHOPS-widget-container title">
                    	<?php __('Browse shops');?>
                    </div>
                    <div class="browseSHOPS-widget-container filter">
                    <?php 
                    	foreach (range('A','Z') as $letter){
                    		echo $this->Html->link(
                    			$letter,
                    			array(
                    				'controller' => 'merchants',
                    				'action' => 'index',
                    				$letter
                    			),
                    			array(
                    				'class' => 'browse-merchant-by-letter'
                    				,'letter' => $letter
                    			)
                    		);	
                    	}                    	
                    ?>
                    </div>
                </div>
