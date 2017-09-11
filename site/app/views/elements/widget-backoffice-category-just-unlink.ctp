			<?php	
				if(isset($widget_category_unlink_sites_result) && !$widget_category_unlink_sites_result)
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
				else if(isset($widget_category_unlink_sites_result) && $widget_category_unlink_sites_result)
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
				$.get('<?php echo $_SESSION['Auth']['ManageCategoriesURL'];?>', function(data){
					$('#widget-main-mid-bottom-container').html('');
					$('#widget-main-mid-top-container').html(data);
				});
			</script>
			<?php
					return;
				}
					echo $this->Form->create('Category', array(
												'method'=>'post',
												'inputDefaults' => array(
																'label' => false,
																'div' => false
														)));
			?>
			<div class="listItem-container">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				
				<tr>
					<td width="180" valign="top"><?php __('Unlink From');?>:</td>
					<td colspan="2">
           			<?php 
           				echo $this->Form->input('sites', array('options' => $sites, 'multiple' => 'checkbox', 'class' => 'checkBox-type3'));
						echo $this->Form->input('catIDs', array('type' => 'hidden', 'value' => $catIDs)); 
					?>	                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
								echo $this->Js->submit(__('Unlink',true), array(
											'url' => "/{$this->params['prefix']}/categories/widget_categories_just_unlink",
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
