<?php 
	$codtype = array(	
		'discount' => 'discount',
		'deal' => 'deal',
		'offer' => 'offer',
		'voucher' => 'voucher',
		'coupon' => 'coupon'
	);
?>
<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		
		<div class="title">
			<div class="txt">
				<?php __('Edit Voucher');?> &raquo;
			</div>
		</div>
		
		<div class="detail">

			<?php	
				if(isset($widget_cod_edit_result) && !$widget_cod_edit_result)
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
				else if(isset($widget_cod_edit_result) && $widget_cod_edit_result)
				{
			?>
					<script> 
						$("#widget-main-mid-top-container").empty();
						$("#widget-mid-loading").toggle();
						
						$.get('<?php echo $_SESSION['Auth']['ManageCODURL'];?>', function(data){
							$("#widget-mid-loading").toggle();
							
							$('#widget-main-mid-bottom-container').empty();
							$('#widget-main-mid-top-container').html(data);
						});
					</script>
			<?php 
					// as nothing to do here
					return;
				}
					echo $this->Form->create('Cod', array(
												'method'=>'post',
												'inputDefaults' => array(
																'label' => false,
																'div' => false
														)));
			?>
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
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
					<td valign="top"><?php __('Merchant');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('merchant_id', array('class'=>'input-select-field-extra-large')); 
							echo $this->Form->input('id', array('type' => 'hidden'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Type');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('cod_type', array('options'=>$codtype,'class'=>'input-select-field-extra-large')); 
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Title');?><sup>*</sup>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input(
								'title' 
								,array(
									'class'=>'input-field-extra-large'
									,'error' => false
								)
							);
						?>	                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
							echo $this->Form->error('title'); 
						?>
					</td>
				</tr>
				
				<tr>
					<td><?php __('Safe Title');?><sup>*</sup>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input(
								'safe_title' 
								,array(
									'class'=>'input-field-extra-large'
									,'error' => false
								)
							);
						?>                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
							echo $this->Form->error('safe_title'); 
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
					<td><?php __('Voucher Code');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('vouchercode', array('class'=>'input-field-extra-large'));
						?>	                        
					</td>
				</tr>
				
				
				<tr>
					<td><?php __('Start Date');?><sup>*</sup>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('start_date', 
								array(
									'class' => 'input-field-extra-large' 
									,'type' => 'text'
									,'error' => false
								)
							);
						?>	                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
							echo $this->Form->error('start_date'); 
						?>
					</td>
				</tr>
				
				<tr>
					<td><?php __('Expiry Date');?><sup>*</sup>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('expiry_date', 
								array(
									'class' => 'input-field-extra-large' 
									,'type' => 'text'
									,'error' => false
								)
							);
						?>                      
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
							echo $this->Form->error('expiry_date'); 
						?>
					</td>
				</tr>
				
				<tr>
					<td><?php __('Affiliate URL');?><sup>*</sup>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('affiliate_url', 
								array(
									'class' => 'input-field-extra-large' 
									,'type' => 'text'
									,'error' => false
								)
							);
						?>                     
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
							echo $this->Form->error('affiliate_url'); 
						?>
					</td>
				</tr>
				
				<tr>
					<td><?php __('Custom Image URL');?>:</td>
					<td colspan="1">
						<div style="floag:right; width: 100px;">
							<a href="javascript:void(0);" onclick="$('#voucher-image-selector').toggle();" style="float:right;"> 
								<?php __('Select');?>
							</a>
						</div>
					</td>
					<td colspan="1">
						<?php 
							echo $this->Form->input('custom_cod_img_url', array('class' => 'input-field-logo-url-with-select-option'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td colspan="3" id="voucher-image-selector" style="display:none; border: 2px dashed">
						<div id="widget-image-selector-container">
							<span style="align: right;">
							<?php
								echo $this->element('widget-backoffice-image-selector',
														array(
															'label' => "Voucher Image"
															,'imageTag' => ""
															,'filename' => ""
															,'imageType' => Configure::read('PictureTags.Voucher')
															,'hiddenField' => "CodCustomCodImgUrl"
															,'container' => "widget-image-selector-container"
														));
							?>
							</span>
						</div>					
					</td>
				</tr>
				
				<tr>
					<td><?php __('Tag');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->select('tag', 
								$tagOptions, 
								explode(',',$this->data['Cod']['tag']), 
								array(
									'class' => 'input-select-field-extra-large-multi-select'
									,'empty'=>false
									,'multiple' => true
								)
							);
						?>	                        
					</td>
				</tr>				

				<tr>
					<td><?php __('Top');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('istop', array('type' => 'checkbox', 'class'=>'checkBox-type1-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Exclusive');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('exclusive', array('type' => 'checkbox', 'class'=>'checkBox-type1-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Printable');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('isprintable', array('type' => 'checkbox', 'class'=>'checkBox-type1-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Print Template');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('printtemplate', array('options' => $templates, 'class'=>'input-select-field-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Generic Print Text 1');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('generic_print_1', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Generic Print Text 2');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('generic_print_2', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Generic Print Text 3');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('generic_print_3', array('class'=>'input-field-textArea-extra-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td colspan="3">
						<?php
								echo $this->Js->submit(__('Update',true), array(
											'url' => "/{$this->params['prefix']}/cods/widget_cods_edit",
											'method'=> 'post',
											'update' => '#widget-main-mid-bottom-container',
											'div' => false,
											'class' => 'btn',
											'id' => 'btnUpdateCod'
											)
									); 
						?>
						<?php
								echo $this->Html->link(__('Cancel',true), 
														'javascript:void(0);', array(
																				'id' => 'lnk-widget-cod-edit-cancel',
																				'class' => 'btn')); 
						?>
					</td>
				</tr>
			</table>

			<script>
				$(document).ready(function() {

					$("#CodStartDate").datetimepicker({
						minDate: "-1Y",
						maxDate: "+3Y",
						dateFormat: 'yy-mm-dd',
						changeMonth: true,
						changeYear: true,
						showAnim: 'blind',
						showMonthAfterYear: true,
						yearRange: '-1:+3'
					});

					$("#CodExpiryDate").datetimepicker({
						minDate: "-1Y",
						maxDate: "+3Y",
						dateFormat: 'yy-mm-dd',
						changeMonth: true,
						changeYear: true,
						showAnim: 'blind',
						showMonthAfterYear: true,
						yearRange: '-1:+3'
					});
					
					$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();

					$("#lnk-widget-cod-edit-cancel").click(function(){
						$.get('<?php echo $_SESSION['Auth']['ManageCODURL'];?>', function(data){
							$('#widget-main-mid-bottom-container').html('');
							$('#widget-main-mid-top-container').html('');
							$('#widget-main-mid-top-container').html(data);
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
			if(isset($this->data['Cod']['id'])){
				$RecordID = $this->data['Cod']['id'];
			}else{
				$RecordID = 0;
			}
			
			echo $this->element('widget-backoffice-check-name-exists',
								array(
									'model' => 'Cod',
									'controller' => 'cods',
									'func' => 'check_safe_title_exists',
									'field' => 'safe_title',
									'label' => 'Safe Title',
									'inputFieldId' => 'CodSafeTitle',
									'RecordId' => $RecordID,
									'SubmitButtonId' => 'btnUpdateCod'
									)
								);
		
		?>
		  
	</div>
</div>  
