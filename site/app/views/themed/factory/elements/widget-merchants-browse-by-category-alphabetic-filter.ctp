                    	<div class="filter">
                    		<?php
                    			$active_letter = 'none';
                    			if(isset($_SESSION['merchants']['by_category_filter_by_letter'])){
                    				$active_letter = $_SESSION['merchants']['by_category_filter_by_letter'];
                    			}
                    			foreach(range('A','Z') as $alphabet)
                    			{ 
                    				
                    				if($alphabet == $active_letter){
                    		?>
			                        	
			                        	<span class="category active">
			                            	<?php
			                            		echo $this->Html->link(
			                            			$alphabet,
			                            			"/merchants/by_category_filter_by_letter/$alphabet"
			                            		);
			                            	?>
			                            </span>
			                            
                            <?php 
                    				}else{
                    		?>
			                        	
			                        	<span class="category">
			                            	<?php
			                            		echo $this->Html->link(
			                            			$alphabet,
			                            			"/merchants/by_category_filter_by_letter/$alphabet"
			                            		);
			                            	?>
			                            </span>
			                                                		
                    		<?php 
                    				}
                    			}
                            ?>
                        	<span class="category <?php echo ($active_letter == '0-9') ? 'active' : '';?>">
                            	<?php
                            		echo $this->Html->link(
                            			"0 - 9",
                            			"/merchants/by_category_filter_by_letter/0-9"
                            		);
                            	?>
                            </span>   
                            
                        	<span class="category <?php echo ($active_letter == 'none') ? 'active' : '';?>">
                            	<?php
                            		echo $this->Html->link(
                            			"&Oslash;",
                            			"/merchants/by_category_filter_by_letter/none",
                            			array(
                            				'escape' => false
                            			)
                            		);
                            	?>
                            </span>                            
                        </div>