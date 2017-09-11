
	<?php	
		if(isset($profile_data_edit_result) && !$profile_data_edit_result){
	?>
	<div class="listItem-container">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="3">
					<?php 
						if(isset($validationErrors))
						{
							foreach($validationErrors as $error):
								echo '*'.$error.'<br/>'; 
							endforeach;
						}
					?>
				</td>
			</tr>
		</table>
	</div>	
	<?php
		}
		else if(isset($profile_data_edit_result) && $profile_data_edit_result)
		{
	?>
	<div class="listItem-container">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="3">
					<div class="success"><?php __('Update Complete');?></div>
				</td>
			</tr>
		</table>
	</div>	
	<script> 
		$.get('<?php echo "/{$this->params['prefix']}/users/view_user_profile/{$id}";?>', function(data){
			$('#widget-main-mid-top-container').html('');
			$('#widget-main-mid-top-container').html(data);
		});
	</script>
	<?php 
		}
			$gender = array( __('Male',true) => __('Male',true), __('Female',true) => __('Female',true));
			
			echo $this->Form->create('User', array(
											'method'=>'post',
											'inputDefaults' => array(
															'label' => false,
															'div' => false
													)));
	?>
	<div class="listItem-container">
		<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="3"></td>
			</tr>
			
			<tr>
				<td width="238"><?php __('Name');?>:</td>
				<td colspan="2">
					<?php echo $this->Form->input('fullname', array('class' => 'input-field-large',)); ?>	                        
				</td>
			</tr>
			
			<tr>
				<td><?php __('Email');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('email', array('class'=>'input-field-large'));
						echo $this->Form->input('id', array('type'=>'hidden')); 
					?>	                        
				</td>
			</tr>
				
			<tr>
				<td><?php __('Gender');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('gender', array('options' => $gender, 'class'=>'input-select-field-large'));
					?>	                        
				</td>
			</tr>
				
			<tr>
				<td><?php __('Nationality');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('nationality', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>
				
			<tr>
				<td><?php __('Birthday');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('dob', array('type' => 'text', 'class'=>'input-field--large'));
					?>	                        
				</td>
			</tr>
				
			<tr>
				<td><?php __('Phone');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('phone', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>
				
			<tr>
				<td><?php __('Website');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('webaddress', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>

			<tr>
				<td><?php __('Facebook URL');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('facebookurl', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>

			<tr>
				<td><?php __('Twitter URL');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('twitterurl', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>

			<tr>
				<td><?php __('MySpace URL');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('myspaceurl', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>

			<tr>
				<td><?php __('Orkut URL');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('orkuturl', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>
			
			<tr>
				<td><?php __('Education');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('education', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>
			
			<tr>
				<td><?php __('Address');?>:</td>
				<td colspan="2">
					<?php 
						echo $this->Form->input('address', array('class'=>'input-field-large'));
					?>	                        
				</td>
			</tr>
			
			<tr>
				<td colspan="3">&nbsp;</td>
			</tr>
				
			<tr>
				<td></td>
				<td colspan="2">
					<?php
						echo $this->Js->submit(__('Update',true),
								 array(
									'url' => "/{$this->params['prefix']}/users/profile_data_edit/{$id}",
									'method'=> 'post',
									'update' => '#widget-dailog-container',
									'div' => false,
									'class' => 'btn'
									)
							); 
						
						echo $this->Form->end(); 
						echo $this->Js->writeBuffer();                  
					?>
				</td>
			</tr>
		</table>
	
	</div>
	<script>
		$(document).ready(function() {
			$(".btn").button();

			$("#UserDob").datepicker({
				minDate: "-50Y",
				maxDate: "+1D",
				dateFormat: 'yy-mm-dd',
				changeMonth: true,
				changeYear: true,
				showAnim: 'blind',
				showMonthAfterYear: true,
				yearRange: '1950:2011'
			});

		});
	</script>			
