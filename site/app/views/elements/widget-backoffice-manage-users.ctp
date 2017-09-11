	<!-- SITE SETTTING START -->
	<div class="siteSetting-widget-container">
    	<div class="content1-widget-container">
        	<div class="title">
            	<div class="txt"><?php __('User Management');?> &raquo;</div>
			</div>
            
            <div class="detail">
            	<div class="userManagement-widget-container">
                	<div class="title">
                    	<div class="search-Div">
                        	
                        	<div class="heading">
                            	<?php __('Search');?>
                            </div>
							
							<?php 
								echo $this->Form->create('User', array(
												'method'=>'post',
												'inputDefaults' => array(
																	'label' => false,
																	'div' => false
															)
													)
											);
							?>
							
							<div class="input-row">
								<?php 
									echo $this->Form->input('search', array('class' => 'input-field'));
									echo $this->Js->submit('', array(
													'url' => "/{$this->params['prefix']}/users/search_users/",
													'method'=> 'post',
													'update' => '#widget-main-mid-top-container',
													'div' => false,
													'value' => null,
													'class' => 'btn'
													)
											);
                            		echo $this->Form->end();
                            		echo $this->Js->writeBuffer();
								?>
                            </div>
						
						</div>
                        
                        <div class="links-Div">
                        	
                        	<div class="txt1">
                            	<?php
                            		echo $this->Js->link(
                            			__("All Users",true)
                            			,"/{$this->params['prefix']}/users/all_users"
                            			,array(
                            				'update' => '#widget-main-mid-top-container'
                            			)
                            		); 
                            	?>                                   		
                            </div>
                            <span> | </span>
                            
                            <div class="txt1">
                            	<?php
                            		echo $this->Js->link(
                            			__("New Users",true)
                            			,"/{$this->params['prefix']}/users/new_users"
                            			,array(
                            				'update' => '#widget-main-mid-top-container',
                            			)
                            		); 
                            	?>                                   		
							</div>
                            <!--     
                            <span> | </span>
                            <div class="txt1">
                            	<?php
//                            		echo $this->Js->link(
//                            			"Online Users"
//                            			,"/{$this->params['prefix']}/users/online_users"
//                            			,array(
//                            				'update' => '#widget-user-list-container',
//                            			)
//                            		); 
                            	?>                                   		
							</div>
                            <span> | </span>
                            
                            <div class="txt2">
                            <?php
//                            	echo $this->Js->link(
//                            		"Refresh"
//                            		,"/{$this->params['prefix']}/users/all_users"
//                            		,array(
//                            			'update' => '#widget-user-list-container',
//                            		)
//                            	); 
                            ?>                                   		
							</div>
							 -->
						</div>
					</div>
                    
                    <?php echo $this->Js->writeBuffer();?>
                    
                    <div id="widget-user-list-container">
                   	<?php 
                   		echo $this->element('widget-backoffice-manage-users-list');
                   	?>	
					</div>
				</div>
			
			</div>
		</div>	
	</div>
	<!-- SITE SETTTING END -->
