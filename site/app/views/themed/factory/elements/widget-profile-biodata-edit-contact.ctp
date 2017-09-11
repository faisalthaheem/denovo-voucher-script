              <div class="edit-contact-information-widget-container contact-information-highlight" id="edit-contact-information-widget-container">
               	  <div class="edit-contact-information-widget-title">
                   	  <?php __('Contact Information');?>
                  </div>
                  
<?php
if(!isset($widget_profile_biodata_edit_contact_result))
{ 
	echo $this->Form->create('User', 
		array(
			'method'=>'post',
			'inputDefaults' => array(
				'label' => false,
				'div' => false
			)
		)
	); 
?>                  
                        
				<div class="edit-contact-information-widget-detail">
					<table width="485" border="0" cellpadding="0" cellspacing="0">
                   		<tr>
                   	  		<td width="82"></td>
                   	  		<td width="150"></td>
                   	  		<td width="82"></td>
                   	  		<td width="150"><center><?php __('Publicly visible?');?></center></td>
                   	  	</tr>
                   	  
						<tr>
                        	<td width="82"><?php __('Address');?>:</td>
                          	<td width="150">
								<?php
						    		echo $this->Form->input('address', array('class'=>'input-field-type-1')); 
								?>                                                            
                          	</td>
                          	<td width="82">&nbsp;</td>
                          	<td width="150">
                          		<div class="YesNo">
									<?php
							    		echo $this->Form->radio('addressvisible', 
							    			array(
							    				'0' => 'No',
							    				'1' => 'Yes'
							    			),
							    			array(
							    				'legend' => false
							    			)
							    		);						    	
									?>                 
								</div>                                  	                          	    
                          	</td>
						</tr>
                        
                        <tr>
                          <td width="82"><?php __('Phone No');?></td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('phone', array('class'=>'input-field-type-1')); 
							?>                                                            
                          </td>
                          <td width="82">&nbsp;</td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('phonevisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('My Website');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('webaddress', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('webvisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('My Blog');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('blogaddress', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('blogvisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('Facebook');?></td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('facebookurl', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('facebookvisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('My Space');?></td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('myspaceurl', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('myspacevisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('Twitter');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('twitterurl', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('twittervisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>                        
                        
                        <tr>
                          <td width="82"><?php __('Orkut');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('orkuturl', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('orkutvisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          								                                                   	                          	
                          </td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('Email');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input('profilemail', array('class'=>'input-field-type-1')); 
							?>                                                                                            
                          </td>
                          <td width="82"></td>
                          <td width="150">
                          	<div class="YesNo">
								<?php
							    	echo $this->Form->radio('profilemailvisible', 
							    		array(
							    			'0' => 'No',
							    			'1' => 'Yes'
							    		),
							    		array(
							    			'legend' => false
							    		)
							    	);						    	
								?>                 
							</div>                                  	                          	
                          </td>
                        </tr>                        
					  </table>
				  </div>
                        
                  <div class="edit-contact-information-widget-action">
						<?php
							echo $this->Js->submit(__('Update',true),
								array(
									'url' => '/users/widget_profile_biodata_edit_contact',
									'method'=> 'post',
									'update' => '#edit-profile-widget-detail-contact-container',
									'before' => 'edit_contact_information_widget_container_showAjaxLoad()',
									'div' => false,
									'class' => 'edit-contact-information-widget-action-btn'
								)
							); 
						?>
                 </div>

				<script>
					jQuery(document).ready(function(){
						jQuery(".edit-contact-information-widget-action-btn").button();
						jQuery(".YesNo").buttonset();
					});
				</script>
                  <?php
					echo $this->Form->end(); 
					echo $this->Js->writeBuffer();                  
                  ?>
<?php
}else if(false == $widget_profile_biodata_edit_contact_result){
?>
	<div class="errorMsg-widget-container">
    	<ul>
            <li><?php __('There was an error updating your data.');?></li>
		</ul>
	</div>
<?php	
} else{
?>
	<div class="successMsg-widget-container">
    	<ul>
            <li><?php __('Data updated successfully.');?></li>
		</ul>
	</div>
	<?php
		if(
			isset($_SESSION['users']) &&
			isset($_SESSION['users']['widget-profile-biodata-edit-contact']) &&
			isset($_SESSION['users']['widget-profile-biodata-edit-contact']['callbackfunc'])
		){ 
	?>
		<script>
			<?php echo $_SESSION['users']['widget-profile-biodata-edit-contact']['callbackfunc']; ?>
		</script>
	
	<?php
		} 
	?>	
	
<?php	
}
?>

              </div>

<script>
function edit_contact_information_widget_container_showAjaxLoad()
{
	jQuery("#edit-contact-information-widget-container").toggle();
	jQuery("#widget-profile-biodata-edit-contact-loading").toggle();
}

</script>

<?php
	echo $this->element('widget-ajax-loading', array('div_dom_id'=>'widget-profile-biodata-edit-contact-loading')); 
?>

              