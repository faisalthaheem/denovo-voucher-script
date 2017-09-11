	<?php	
		if(isset($widget_single_merchant_link_sites_result) && !$widget_single_merchant_link_sites_result)
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
		else if(isset($widget_single_merchant_link_sites_result) && $widget_single_merchant_link_sites_result)
		{
	?>
		<div class="listItem-container">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3"><div class="success"><?php __('Operation Complete.');?></div></td>
				</tr>
			</table>	
		</div>					
		<script>
			$.get('<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>', function(data){
				$('#widget-main-mid-bottom-container').html('');
				$('#widget-main-mid-top-container').html(data);
			});
		</script>
	<?php
			return; 
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
					<td width="180" valign="top"><?php __('Associate To');?>:</td>
					<td colspan="2">
           			<?php 
           				echo $this->Form->input('site', array('options' => $sites, 'multiple' => 'checkbox', 'class' => 'checkBox-type3'));
						echo $this->Form->input('id', array('type' => 'hidden', 'value' => $merchantId)); 
					?>	                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
								echo $this->Js->submit(__('Link',true),
									 array(
											'url' => "/{$this->params['prefix']}/merchants/widget_single_merchant_lnk_to_site",
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
