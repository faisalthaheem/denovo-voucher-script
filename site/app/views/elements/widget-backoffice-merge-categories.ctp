		<div class="detail">

			<?php	
				if(isset($widget_category_merge_result) && !$widget_category_merge_result)
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
				else if(isset($widget_category_merge_result) && $widget_category_merge_result)
				{
			?>
			<div class="listItem-container">
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3"><div class="success"><?php __('Update Complete');?>.</div></td>
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
					<td><?php __('Merge into');?>:</td>
					<td colspan="2" height="40">
						<?php echo $this->Form->input('category_id', array('options' => $catlist, 'class' => 'input-select-field-large', 'default' => '0')); ?>	                        
						<?php echo $this->Form->input('catIDs', array('type' => 'hidden', 'value' => $catIDs)); ?>	                        
					</td>
				</tr>
				<tr>
					<td colspan="3">
					&nbsp;
					</td>
				</tr>
				<tr>
					<td></td>
					<td colspan="2">
						<?php
								echo $this->Js->submit(__('Merge Categories',true), array(
											'url' => "/{$this->params['prefix']}/categories/widget_category_merge",
											'method'=> 'post',
											'update' => '#widget-dailog-container',
											'div' => false,
											'class' => 'btn2'
											)
									); 
						?>
					</td>
				</tr>
			</table>
			</div>
			<script>
				$(document).ready(function() {
					$(".listItem-container .btn2").button();
				})
			</script>			
			
			<?php
					echo $this->Form->end(); 
					echo $this->Js->writeBuffer();                  
		    ?>
		</div>  