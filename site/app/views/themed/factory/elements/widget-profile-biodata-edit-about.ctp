			<div class="edit-basic-information-widget-container basic-information-highlight" id="edit-basic-information-widget-container">
               	<div class="edit-basic-information-widget-title">
					<?php __('Basic Information');?>
				</div>
                  
				<?php
				if(!isset($widget_profile_biodata_edit_about_result))
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
                        
                  <div class="edit-basic-information-widget-detail">
                   	  <table width="485" border="0" cellpadding="0" cellspacing="0">
                        
                        <tr>
                          <td width="82"><?php __('Full Name');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input(
							    		'fullname', 
							    		array(
							    			'class'=>'input-field-type-1', 
							    			'title'=>'Please enter your first name and last name.'
							    		)
						    		); 
							?>                                                      
                          </td>
                          
                          <td width="82"></td>
                          <td width="150"></td>
                        </tr>
                        
                        <tr>
                          <td width="82"><?php __('Nationality');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input(
						    			'nationality', 
							    		array(
							    			'class'=>'input-field-type-1', 
							    			'title'=>'e.g. Pakistani, British, American etc.'
							    		)
						    		); 
						    	 
							?>                                                      
                          </td>
                          
                          <td width="82"><?php __('Date of Birth');?>:</td>
                          <td width="150">
							<?php
						    	echo $this->Form->input(
						    		'dob', array('type' => 'text','class'=>'input-field-type-1')); 
							?>                          	
                          </td>
                        </tr>
                                                
                    </table>
				  </div>
                        
                  <div class="edit-basic-information-widget-action">
						<?php
							echo $this->Js->submit(__('Update',true),
								array(
									'url' => '/users/widget_profile_biodata_edit_about',
									'method'=> 'post',
									'update' => '#edit-profile-widget-detail-about-container',
									'before' => 'edit_basic_information_widget_container_showAjaxLoad()',
									'div' => false,
									'class' => 'edit-basic-information-widget-action-btn'
								)
							); 
						?>
                  </div>
                  
				<?php
					echo $this->Form->end(); 
					echo $this->Js->writeBuffer();                  
                ?>
			
				<script>
				jQuery(document).ready(function(){
					// styling button
					jQuery(".edit-basic-information-widget-action-btn").button();
				
					// Date Picker
					jQuery("input[id=UserDob]").datepicker({
						minDate: "-70Y",
						maxDate: "+1D",
						dateFormat: 'yy-mm-dd',
						changeMonth: true,
						changeYear: true,
						showAnim: 'blind',
						showMonthAfterYear: true,
						yearRange: '1940:2010'
					});
				
					if(jQuery("input[id=UserDob]").val().length == 0)
					{
						// Populating Date in Text Box
						// 1_ User can recognize the format if wants to write manually without using datepicker
						// 2_ we can prevent empty value going to datetime column which generates error
						var myDate = new Date();
					    var month = myDate.getMonth() + 1;
					    var prettyDate = myDate.getFullYear() + '-' + myDate.getMonth() + '-' + myDate.getDate();
					    jQuery("input[id=UserDob]").val(prettyDate);	
					}
				});
				</script>			
                
<?php
}else if(false == $widget_profile_biodata_edit_about_result){
?>
	<div class="errorMsg-widget-container">
    	<ul>
            <li><?php __('There was an error updating your data.');?></li>
		</ul>
	</div>
<?php	
}else{
?>
	<div class="successMsg-widget-container">
    	<ul>
            <li><?php __('Data updated successfully.');?></li>
		</ul>
	</div>

	<?php
		if(
			isset($_SESSION['users']) &&
			isset($_SESSION['users']['widget-profile-biodata-edit-about']) &&
			isset($_SESSION['users']['widget-profile-biodata-edit-about']['callbackfunc'])
		){ 
	?>
		<script>
			<?php echo $_SESSION['users']['widget-profile-biodata-edit-about']['callbackfunc']; ?>
		</script>
	
	<?php
		}// End-IF Session User, Callback check 
	?>	
	
<?php	
} // End-Else
?>
			</div>
			
<script>

	function edit_basic_information_widget_container_showAjaxLoad()
	{
		jQuery("#edit-basic-information-widget-container").toggle();
		jQuery("#widget-profile-biodata-edit-about-loading").toggle();
	}

	<?php
		echo $this->element('widget-mb-tooltip-script'); 
	?>
</script>			
			
<?php
	echo $this->element('widget-ajax-loading', array('div_dom_id'=>'widget-profile-biodata-edit-about-loading')); 
?>