<?php if(isset($result_widget_site_add) && $result_widget_site_add = true){?>
	<script>
		$("#widget-main-mid-top-container").html('');
		$("#widget-main-mid-bottom-container").html('');
		$.get("/<?php echo $this->params['prefix'];?>/sites/manage_sites", function(data){
			$("#widget-main-mid-top-container").html(data);
		});
	</script>
<?php 
		// save is successfull
		return;
	}else{
?>
<div class="siteSetting-widget-container">

	<div class="content2-widget-container">
		
		<div class="title">
			<div class="txt">
				<?php __('Create New Site');?> &raquo;
			</div>
		</div>
		
		<div class="detail">
		
			<?php 											
					echo $this->Form->create('Site', 
										array('method'=>'post',
												'inputDefaults' => array(
																'label' => false,
																'div' => false
															)
														)
													); 
			?>
					                	
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
				
				<tr><td colspan="3"></td></tr>
				
				<tr><th colspan="3"><?php __('Site Settings');?></th></tr>
				
				<tr><td colspan="3"></td></tr>
				
				<tr>
					<td><?php __('Fully Qualified Domain Name');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('fqdn', array('class'=>'input-field-large')); ?>
						<?php echo $this->Form->input('logopath', array('type' => 'hidden', 'value' => '', 'id'=>'uuid-hidden-field'));?>
					</td>
				</tr>
				
				<tr>
					<td><?php __('Theme Name');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('theme', array('class'=>'input-field-large')); ?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Active');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('active', array('class'=>'checkBox-type1', 'type' => 'checkbox'));?>
					</td>
				</tr>

				<tr>
					<td>
						<?php __('No reply email');?>:
						<br/>
						<span class="tip">(Emails sent to users will make use of this address.)</span>
					</td>					
					<td colspan="2">
						<?php echo $this->Form->input('emailnoreply', array('class'=>'input-field-large')); ?>
					</td>
				</tr>

				<tr>
					<td>
						<?php __('Info Email');?>:
						<br/>
						<span class="tip">(Used for display purposes only.)</span>
					</td>					
					<td colspan="2">
						<?php echo $this->Form->input('emailinfo', array('class'=>'input-field-large')); ?>
					</td>
				</tr>

				<tr>
					<td>
						<?php __('Contact Email');?>:
						<br/>
						<span class="tip">(Emails sent by visitors will be sent to this address.)</span>
					</td>
					<td colspan="2">
						<?php echo $this->Form->input('emailcontact', array('class'=>'input-field-large')); ?>
					</td>
				</tr>
				
				
				<tr><th colspan="3">
					<div id="widget-image-selector-container">
						<?php
							echo $this->element('widget-backoffice-image-selector',
													array(
														'label' => __("Site Logo",true)
														,'imageTag' => ""
														,'filename' => ""
														,'imageType' => Configure::read('PictureTags.Logo')
														,'hiddenField' => "uuid-hidden-field"
														,'container' => "widget-image-selector-container"
													));
						?>
					</div>					
				</th></tr>
				
				<tr>
					<td><?php __('Notes');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('notes', array('class'=>'input-field-textArea', 'type' => 'textarea'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Insert to Header');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('headerinserts', array('class'=>'input-field-textArea', 'type' => 'textarea'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Insert to Footer');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('footerinserts', array('class'=>'input-field-textArea', 'type' => 'textarea'));?>	                        
					</td>
				</tr>
				
				
				<tr><th colspan="3"><?php __('Twitter Settings');?></th></tr>
				
				<tr><td colspan="3"></td></tr>
				
				<tr>
					<td><?php __('Twitter Username');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('twitterusername', array('class'=>'input-field-large')); ?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Twitter Password');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('twitterpassword', array('class'=>'input-field-large', 'type' => 'password')); ?>	                        
					</td>
				</tr>
				
				<tr><th colspan="3"><?php __('Facebook Settings');?></th></tr>
				
				<tr><td colspan="3"></td></tr>
				
				<tr>
					<td><?php __('Facebook Application Id');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('fbappid', array('class'=>'input-field-large'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Facebook Secret');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('fbsecret', array('class'=>'input-field-large'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Facebook Like Code');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('fblikecode', array('class'=>'input-field-textArea', 'type' => 'textarea'));?>	                        
					</td>
				</tr>
				
				<tr>
					<td><?php __('Facebook Page');?>:</td>
					<td colspan="2">
						<?php echo $this->Form->input('fbpagename', array('class'=>'input-field-textArea', 'type' => 'textarea'));?>	                        
					</td>
				</tr>				
				
				<tr>
					<td colspan="3">
						<?php
							echo $this->Js->submit(__('Create',true),
								array(
									'url' => '/'.$this->params["prefix"].'/sites/add/',
									'method'=> 'post',
									'update' => '#widget-main-mid-bottom-container',
									'div' => false,
									'class' => 'btn',
									'id' => 'add-site'
								)
							); 
						
							echo $this->Html->link(__('Cancel',true), 
													'javascript:void(0);',
													array('id' => 'lnk-widget-site-add-cancel',
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
				$(document).ready(function() {
					$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();

					$("#lnk-widget-site-add-cancel").click(function(){
						$("#widget-main-mid-bottom-container").html('');
					});

				});
			</script>
		</div>
	</div>
</div>
<?php }?>