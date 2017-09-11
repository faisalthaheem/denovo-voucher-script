<div class="content2-widget-container" id="login-form-container">
	        	
					<div class="title">
						<div class="txt">
							<?php 
								if($this->params['prefix'] == 'admin')
								{
									__('Admin Login') .  " &raquo;";
								}
								else if($this->params['prefix'] == 'manager')
								{
									__('Manager Login') . " &raquo;";
								
								}
							?>
						</div>
					</div>
					<div class="detail">
	            	
					<?php 											
						echo $this->Form->create('User', 
							array('method'=>'post',
									'inputDefaults' => array(
														'label' => false,
														'div' => false
													)
										)
								); 
					?>
					                	
							<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
						    	<tr>
						        	<th colspan="3">
						        		<?php
						        			if(true == Configure::read('site.adminLoginCredits'))
						        			{
						        				__('Welcome to Admin Panel, please login using your credentials.');
						        			}else{
						        				__('Welcome to Admin Panel, please login using your credentials.');
						        			}
						        		?>
						        	</th>
						        </tr>
						        <tr>
						        	<td colspan="3"></td>
								</tr>
						        <tr>
						        	<td><?php __('Email');?></td>
									<td colspan="2">
										<?php echo $this->Form->input('email', array('class'=>'input-field-large')); ?>	                        
									</td>
								</tr>
								<tr>
									<td><?php __('Password');?></td>
									<td colspan="2">
										<?php echo $this->Form->input('pass', array('class'=>'input-field-large', 'type' => 'password'));?>	                        
									</td>
								</tr>
						        <tr>
						        	<td colspan="3">
										<?php 
												echo $this->Form->submit(__('Login',true),
																	array(
																		'url' => '/'.$this->params["prefix"].'/users/home',
																		'method'=> 'post',
																		'div' => false,
																		'class' => 'btn',
																		'id' => 'login-button'
																	)
																); 
												?>
									</td>
								</tr>
							</table>
									
							<script>
								$(document).ready(function() {
									$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();
								});
							</script>
					</div>
				</div>