<div class="siteSetting-widget-container">
	
	<div class="content2-widget-container">
		
		<div class="title">
			<div class="txt">
				<?php __('Update Banner');?> &raquo;
			</div>
		</div>
		<div class="detail">
		
			<?php
				if(isset($widget_banner_edit_result) && !$widget_banner_edit_result){
			?>
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3">
						<?php 
							if(isset($validationErrors)){
								
								foreach($validationErrors as $error):
									echo '*'.$error.'<br/>'; 
								endforeach;
							}
						?>
					</td>
				</tr>
			</table>	
			
			<?php
				}else if(isset($widget_banner_edit_result) && $widget_banner_edit_result){
			?>
			
			<script type="text/javascript">
				$.get('<?php echo "/{$this->params['prefix']}/sites/manage_sites/"; ?>', function(data){
					$("#widget-main-mid-top-container").html('');
					$("#widget-main-mid-top-container").html(data);
				});
			</script>
			
			<?php
					// edit was successfull
					return; 
				}
			?>
			
			<?php
					$imageTag = '';
					$imagefilename = '';
					
					if(isset($banner[0]['Picture']['uuidtag'])){
						$imageTag = $banner[0]['Picture']['uuidtag'];
						$imagefilename = $banner[0]['Picture']['filename'];
					}
			
			
					$tags = array(
							'h-large' => "Horizontal Large", 
							's-right' => "Small Box Right", 
							's-left' => "Small Box Left"
						); 
				
					$acMethods = array(
							'clicks' => "clicks",
							'impressions' => "impressions",
							'date' => 'date'
						);
						
				
				echo $this->Form->create('Banner', 
											array(
												'method'=>'post',
												'inputDefaults' => 
												array('label' => false,
													'div' => false)
												)
											);
			?>
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				<tr>
					<td colspan="3"></td>
				</tr>
				<tr>
					<td width="237"><?php __('Site');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.site_id', array('class'=>'input-select-field-large', 'disabled' => 'true')); 
							
							echo $this->Form->input('Banner.id', array('type' => 'hidden'));
							echo $this->Form->input('bannerImage', array('type' => 'hidden', 'value' => $imageTag, 'id' => 'uuid-hidden-field'))
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Banner Type');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.tag', array('options' => $tags, 'class'=>'input-select-field-large', 'disabled' => 'true'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td valign="top"><?php __('Link URL');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.url', array('class'=>'input-field-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Accounting Method');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.accountingmethod', array('options' => $acMethods
																			,'class'=>'input-select-field-large'
																			,'onchange' => 'changeAccountMethod($(this).attr("value"));'));
						?>	                        
					</td>
				</tr>
				
				<tr id="maximpressions" style="display:none;">
					<td><?php __('Max. Impressions');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.maximpressions', array('class'=>'input-field-large'));
						?>	                        
					</td>
				</tr>
				
				<tr id="maxclicks">
					<td><?php __('Max. Clicks');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.maxclicks', array('class'=>'input-field-large'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Active');?>:</td>
					<td colspan="2">
						<?php 
							echo $this->Form->input('Banner.active', array('type' => 'checkbox', 'class'=>'checkBox-type1'));
						?>	                        
					</td>
				</tr>
				
				<tr>
					<td colspan="3">
						<?php
								echo $this->Js->submit(__('Update',true), array(
											'url' => "/{$this->params['prefix']}/banners/edit/",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'class' => 'btn'
										)
									);

								echo $this->Html->link(__('Cancel',true), 
														'javascript:void(0);',
														array('id' => 'banner-edit-cancel',
															'class' => 'btn'));
						?>
					</td>
				</tr>
			</table>
			<?php
				echo $this->Form->end(); 
				echo $this->Js->writeBuffer();                  
		    ?>
		    
			<div id="widget-image-selector-container">
				<?php
					echo $this->element('widget-backoffice-image-selector',
											array(
												'label' => "Select Banner"
												,'imageTag' => $imageTag
												,'filename' => $imagefilename
												,'imageType' => Configure::read('PictureTags.Banner')
												,'hiddenField' => "uuid-hidden-field"
												,'container' => "widget-image-selector-container"
											));
				?>
			</div>
		    
		    
			<script>
				$(document).ready(function() {
					$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();
					$(".btn").button();

					$("#banner-edit-cancel").click(function(){
						$.get('<?php echo "{$_SESSION['backurls']['sites']}";?>', function(data){
							$("#widget-main-mid-top-container").html('');
							$("#widget-main-mid-top-container").html(data);
						});
					});
				});

				function changeAccountMethod(type){

					if(type == "impressions"){

						$("#maxclicks").hide();
						$("#clicksdone").hide();
						$("#maximpressions").show();
						$("#impressionsdone").show();

					}else if(type == "clicks"){

						$("#maxclicks").show();
						$("#clicksdone").show();
						$("#maximpressions").hide();
						$("#impressionsdone").hide();

					}else{

						$("#maxclicks").hide();
						$("#clicksdone").hide();
						$("#maximpressions").hide();
						$("#impressionsdone").hide();
					}
				}
			</script>			
		</div>  
	</div>
</div>  
