
<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		<div class="title">
			<div class="txt">
				<?php __('Create Category');?> &raquo;
			</div>
		</div>
		<div class="detail">
			
			<?php	
				if(isset($widget_category_add_result) && !$widget_category_add_result)
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
				else if(isset($widget_category_add_result) && $widget_category_add_result)
				{
			?>
				<script>
		    	
					<?php if($container == 'none'){?>
						$('#widget-main-mid-bottom-container').html('');
		    		<?php }else{?>
						$.get('<?php echo $_SESSION['Auth']['ManageCategoriesURL'];?>', function(data){
							$('#widget-main-mid-bottom-container').html('');
							$('#widget-main-mid-top-container').html('');
							$('#widget-main-mid-top-container').html(data);
						});
		    		<?php }?>
		    	</script>
			<?php 
				// return as nothing to do here
				return;
				}
					echo $this->Form->create('Category', array(
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
					<td><?php __('Parent');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('parent_id', array('options' => $catlist, 'class' => 'input-select-field-extra-large', 'default' => '0')); ?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Category Name');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('catname', array('class'=>'input-field-extra-large')); 
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Safe Name');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('safe_catname', array('class'=>'input-field-extra-large'));
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
					<td colspan="3">
						<?php
								echo $this->Js->submit(__('Create',true), array(
											'url' => "/{$this->params['prefix']}/categories/widget_categories_add/{$container}",
											'method'=> 'post',
											'update' => '#widget-main-mid-bottom-container',
											'div' => false,
											'class' => 'btn',
											'id' => 'btnCreateCategory'
											)
									); 
						?>
						<?php
								echo $this->Html->link(__('Cancel',true), 'javascript:void(0);', 
														array('id' => 'lnk-widget-category-add-cancel',
															'class' => 'btn')); 
						?>
					</td>
				</tr>
			</table>
			
			<?php
				echo $this->Form->end(); 
				echo $this->Js->writeBuffer();                  
		    ?>

			<script>
				$(document).ready(function(){
					$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();

					$("#lnk-widget-category-add-cancel").click(function(){
		    			
		    			<?php if($container == 'none'){?>
							$('#widget-main-mid-bottom-container').html('');
		    			<?php }else{?>
							$.get('<?php echo $_SESSION['Auth']['ManageCategoriesURL'];?>', function(data){
								$('#widget-main-mid-bottom-container').html('');
								$('#widget-main-mid-top-container').html('');
								$('#widget-main-mid-top-container').html(data);
							});
		    			<?php }?>
					});
				});
			</script>
			<?php
				if(isset($this->data['Category']['id'])){
					$RecordID = $this->data['Category']['id'];
				}else{
					$RecordID = 0;
				}
				
				echo $this->element('widget-backoffice-check-name-exists',
									array(
											'model' => 'Category',
											'controller' => 'categories',
											'func' => 'check_safe_name_exists',
											'field' => 'safe_catname',
											'label' => 'Safe Name',
											'inputFieldId' => 'CategorySafeCatname',
											'RecordId' => $RecordID,
											'SubmitButtonId' => 'btnCreateCategory'
											)
										);
			
			?>
		</div>  
	</div>
</div>  
