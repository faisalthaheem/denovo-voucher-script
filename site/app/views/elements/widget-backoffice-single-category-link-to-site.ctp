			<?php	
				if(isset($widget_single_category_link_sites_result) && !$widget_single_category_link_sites_result)
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
				else if(isset($widget_single_category_link_sites_result) && $widget_single_category_link_sites_result)
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
				$.get('<?php echo $_SESSION['Auth']['ManageCategoriesURL'];?>', function(data){
					$('#widget-manage-categories-container').html(data);
					$('#widget-manage-categories-container').show(data);
				});
			</script>
			<?php 
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
					<td width="180" valign="top"><?php __('Associate To');?>:</td>
					<td colspan="2">
           			<?php 
           				echo $this->Form->input('site', array('options' => $sites, 'multiple' => 'checkbox', 'class' => 'checkBox-type3'));
						echo $this->Form->input('id', array('type' => 'hidden', 'value' => $catid)); 
					?>	                        
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
								echo $this->Js->submit(__('Link',true),
										 array(
											'url' => "/{$this->params['prefix']}/categories/widget_single_category_lnk_to_site",
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
