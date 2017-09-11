                    	<div class="filter">
                    		<?php
                    			$active_letter = 'none';
                    			if(isset($_SESSION['merchants']['index_letter_filter'])){
                    				$active_letter = $_SESSION['merchants']['index_letter_filter'];
                    			}
                    			foreach(range('A','Z') as $alphabet)
                    			{ 
                    				
                    				if($alphabet == $active_letter){
                    		?>
			                        	
			                        	<span class="category active">
			                            	<?php
			                            		echo $this->Js->link(
			                            			$alphabet,
			                            			"/merchants/index/$alphabet"
			                            			,array(
			                            				'update' => '#mid-container-left-panel'
			                            			)
			                            		);
			                            	?>
			                            </span>
			                            
                            <?php 
                    				}else{
                    		?>
			                        	
			                        	<span class="category">
			                            	<?php
			                            		echo $this->Js->link(
			                            			$alphabet,
			                            			"/merchants/index/$alphabet"
			                            			,array(
			                            				'update' => '#mid-container-left-panel'
			                            			)
			                            		);
			                            	?>
			                            </span>
			                                                		
                    		<?php 
                    				}
                    			}
                            ?>
                        	<span class="category <?php echo ($active_letter == '0-9') ? 'active' : '';?>">
                            	<?php
                            		echo $this->Js->link(
                            			"0 - 9",
                            			"/merchants/index/0-9"
                            			,array(
                            				'update' => '#mid-container-left-panel'
                            			)
                            		);
                            	?>
                            </span>   
                            
                        	<span class="category <?php echo ($active_letter == 'none') ? 'active' : '';?>">
                            	<?php
                            		echo $this->Js->link(
                            			"&Oslash;",
                            			"/merchants/index/"
                            			,array(
                            				'update' => '#mid-container-left-panel'
                            				,'escape' => false
                            			)
                            		);
                            	?>
                            </span>                            
                        </div>