<div class="siteSetting-widget-container">
	
	<div class="content2-widget-container">
		
		<div class="title">
			<div class="txt">
				<?php __('Update Merchant');?> &raquo;
			</div>
		</div>
		
		<div class="detail">

			<?php	
				if(isset($widget_merchant_edit_result) && !$widget_merchant_edit_result)
				{
			?>
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
			<?php
				
				}
				else if(isset($widget_merchant_edit_result) && $widget_merchant_edit_result)
				{
			?>
					<script> 
						$.get('<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>', function(data){
							$('#widget-main-mid-top-container').html(data);
							$('#widget-main-mid-top-container').show();
						});
					</script>
			<?php 
					//return as nothing to here
					return;
				}
					echo $this->Form->create('Merchant', array(
												'method'=>'post',
												'inputDefaults' => array(
																'label' => false,
																'div' => false
														)));
			?>
			<table width="650" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3"></td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Sites');?>:</td>
					<td colspan="2">
						<div class="news-site-list">	
							<?php echo $this->Form->input('site', array('options' => $sitelist, 'multiple' => 'checkbox', 'class' => 'input-select-field-small',)); ?>	                        
						</div>
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Categories');?>:</td>
					<td colspan="2">
						<div class="merchant-category-list">	
							<?php echo $this->Form->input('category', array('options' => $catlist, 'multiple' => 'checkbox', 'class' => 'input-select-field-small',)); ?>	                        
						</div>
					</td>
				</tr>
				
				<tr>
					<td><?php __('Merchant Name');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('merchant_name', array('class'=>'input-field-extra-large'));
							echo $this->Form->input('id', array('type'=>'hidden')); 
							
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Safe Name');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('safe_merchant_name', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Description');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('description', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Site URL');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('site_url', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Logo URL');?>:</td>
					<td colspan="1">
						<div style="floag:right; width: 100px;">
							<a href="javascript:void(0);" onclick="$('#merchant-logo-selector').toggle();" style="float:right;"> 
								<?php __('Select');?> 
							</a>
						</div>
					</td>
					<td colspan="1">
						<?php 
							echo $this->Form->input('logo_url', array('class'=>'input-field-logo-url-with-select-option'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td colspan="3" id="merchant-logo-selector" style="display:none; border: 2px dashed">
						<div id="widget-image-selector-container">
							<span style="align: right;">
							<?php
								echo $this->element('widget-backoffice-image-selector',
														array(
															'label' => "Merchant Logo"
															,'imageTag' => ""
															,'filename' => ""
															,'imageType' => Configure::read('PictureTags.Logo')
															,'hiddenField' => "MerchantLogoUrl"
															,'container' => "widget-image-selector-container"
														));
							?>
							</span>
						</div>					
					</td>
				</tr>
								
				<tr>
					<td><?php __('Affiliate URL');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('affiliate_url', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Top Merchant?');?></td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('istop', array('type' => 'checkbox', 'class'=>'checkBox-type1-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Meta Keywords');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('metakw', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>

				<tr>
					<td valign="top"><?php __('Meta Description');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('metadesc', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>

				<tr>
					<td valign="top"><?php __('Meta Title');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('metatitle', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Phone 1');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('phone1', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>				
								
				<tr>
					<td><?php __('Phone 2');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('phone2', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>				

				<tr>
					<td><?php __('Phone 3');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('phone3', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>		
				
				<tr>
					<td valign="top"><?php __('Address 1');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('address1', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Address 2');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('address2', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td colspan="3">
						<?php
								echo $this->Js->submit(__('Update',true), 
										array(
											'url' => "/{$this->params['prefix']}/merchants/widget_merchants_edit",
											'method'=> 'post',
											'update' => '#widget-main-mid-bottom-container',
											'div' => false,
											'class' => 'btn',
											'id' => 'btnUpdateMerchant'
											)
									); 
						?>
						<?php
								echo $this->Html->link(__('Cancel',true), 
											'javascript:void(0);', 
											array(
												'id' => 'lnk-widget-merchant-edit-cancel',
												'class' => 'btn'
											)
										); 
						?>
					</td>
				</tr>
			</table>

			<script>
				$(document).ready(function() {

					$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();
					$("#lnk-widget-merchant-edit-cancel").click(function(){
						$.get("<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>", function(data){
							$('#widget-main-mid-bottom-container').html('');
							$('#widget-main-mid-top-container').html('');
							$('#widget-main-mid-top-container').html(data);
							$('#widget-main-mid-top-container').show();
						});
					});
				});
			</script>			
			
			<?php
				echo $this->Form->end(); 
				echo $this->Js->writeBuffer();                  
		    ?>
		</div>
		<?php
			if(isset($this->data['Merchant']['id'])){
				$RecordID = $this->data['Merchant']['id'];
			}else{
				$RecordID = 0;
			}
			
			echo $this->element('widget-backoffice-check-name-exists',
								array(
										'model' => 'Merchant',
										'controller' => 'merchants',
										'func' => 'check_safe_name_exists',
										'field' => 'safe_merchant_name',
										'label' => 'Safe Name',
										'inputFieldId' => 'MerchantSafeMerchantName',
										'RecordId' => $RecordID,
										'SubmitButtonId' => 'btnUpdateMerchant'
										)
									);
		
		?>
		  
	</div>
</div>  
