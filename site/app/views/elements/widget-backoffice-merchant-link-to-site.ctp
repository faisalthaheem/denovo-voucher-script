			<?php	
				if(isset($widget_merchant_link_sites_result) && !$widget_merchant_link_sites_result)
				{
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
				else if(isset($widget_merchant_link_sites_result) && $widget_merchant_link_sites_result)
				{
			?>
			<div class="listItem-container">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3"><div class="success"><?php __('Operation Complete');?>.</div></td>
				</tr>
			</table>	
			</div>
					
			<script>
				$.get('<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>', function(data){
					$('#widget-manage-merchants-container').html(data);
					$('#widget-manage-merchants-container').show();
				});
			</script>
			<?php 
				}
					echo $this->Form->create('Merchant', array(
												'method'=>'post',
												'inputDefaults' => array(
																'label' => false,
																'div' => false
														)));
			?>
			<div class="listItem-container">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				
				<tr>
					<td valign="top" width="180"><?php __('Associate To');?>:</td>
					<td colspan="2">
           			<?php 
           				echo $this->Form->input('sites', array('options' => $sites, 'multiple' => 'checkbox', 'class' => 'checkBox-type3'));
						echo $this->Form->input('merchantIDs', array('type' => 'hidden', 'value' => $MerchantIDs)); 
					?>	                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
								echo $this->Js->submit(__('Create Link',true), array(
											'url' => "/{$this->params['prefix']}/merchants/widget_merchants_lnk_to_site",
											'method'=> 'post',
											'update' => '#widget-dailog-container',
											'div' => false,
											'class' => 'btn'
											)
									); 
						?>
					</td>
				</tr>
			</table>
			</div>

			<script>
				$(document).ready(function() {
					$(".listItem-container .btn").button();
				});
			</script>			
			
			<?php
					echo $this->Form->end(); 
					echo $this->Js->writeBuffer();                  
		    ?>
