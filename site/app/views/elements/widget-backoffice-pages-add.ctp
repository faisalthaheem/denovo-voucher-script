<style type="text/css">
	.CodeMirror {border: 1px solid black; font-size:13px}
</style>

<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		
		<div class="title">
			<div class="txt">
				<?php __('Create Page');?> &raquo;
			</div>
		</div>
		
		<div class="detail">
			<?php
				if(isset($widget_page_add_result) && !$widget_page_add_result){
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
				else if(isset($widget_page_add_result) && $widget_page_add_result)
				{
			?>
				<script>
					<?php if(isset($siteid)){?>

						$.get('<?php echo "/{$this->params['prefix']}/pages/index/{$siteid}";?>', function(data){
							$("#widget-main-mid-bottom-container").html('');
							$("#widget-pages-list-container").html('');
							$("#widget-pages-list-container").html(data);
						});
					<?php }?>
				
				</script>
			<?php 
				}
				
				echo $this->Form->create('Page', 
											array(
												'method'=>'post',
												'inputDefaults' => 
													array(
														'label' => false,
														'div' => false)
														)
													);
			?>
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td><?php __('Site');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('site_id', array('options' => $SiteList, 'class' => 'input-select-field-large')); ?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Layout');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->select(
										'layout', 
										Configure::read('Layouts'), 
										null, 
										array(
											'class' => 'input-select-field-large'
											,'empty' => false
										)
									); 
						?>	                        
					</td>
				</tr>
							
				<tr>
					<td><?php __('Page Name');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('pagename', array('class'=>'input-field-large')); 
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Link Name');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('linkname', array('class'=>'input-field-large')); 
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Meta Title');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('metatitle', array('class'=>'input-field-large')); 
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Meta Description');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('metadesc', array('class'=>'input-field-large')); 
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Meta Keywords');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('metakws', array('class'=>'input-field-large')); 
						?>	                        
					</td>
				</tr>				
				
				<tr>
					<td colspan="3">
						<?php __('Page Content');?>:
					</td>
				</tr>
				
			</table>
			
			<?php 
				echo $this->Form->input('pagecontent', array('rows' => 30,
															'cols' => 80));
			?>
			<br />
			
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">	
				<tr>
					<td colspan="3">
						<?php
								echo $this->Js->submit(__('Create', true),
									 array(
									 	'id' => 'form-submit-button',
										'url' => "/{$this->params['prefix']}/pages/add/",
										'method'=> 'post',
										'update' => '#widget-main-mid-bottom-container',
										'div' => false,
										'class' => 'btn'
										)
									); 
								
								echo $this->Html->link(
											__('Cancel', true),
											'javascript:void(0);', 
											array(
												'id' => 'lnk-widget-page-add-cancel',
												'class' => 'btn'
											)
										); 
						?>
					</td>
				</tr>
			</table>
			<?php
					echo $this->Form->end(); 
		    ?>

			<script>
				$(document).ready(function() {

					$(".btn").button();

					$("#lnk-widget-page-add-cancel").click(function(){
						$("#widget-main-mid-bottom-container").html('');
					});
				});

				$("#PageSiteId").change(function(){
					$("#PageLinkname").focus();
				});

				var editor = 
				CodeMirror.fromTextArea(
						document.getElementById("PagePagecontent"), 
						{
							mode: "text/html", 
							tabMode: "indent",
							theme: "twilight",
							lineNumbers: true,
							lineWrapping: true
						}
				);
	
			$("#form-submit-button").click(function(){
				editor.save();
			});
			</script>
			
			<?php
				
				echo $this->element('widget-backoffice-check-name-exists',
									array(
										'model' => 'Page',
										'controller' => 'pages',
										'func' => 'check_safe_name_exists',
										'field' => 'linkname',
										'label' => 'Link Name',
										'inputFieldId' => 'PageLinkname',
										'RecordId' => 0,
										'site' => 'PageSiteId',
										'SubmitButtonId' => 'form-submit-button'
									)
							);
			
			?>
			
			<?php
				echo $this->Js->writeBuffer(); 
			?>						
		</div>  
	</div>
</div>