
	<div class="siteSetting-widget-container">
 		
 		<div class="content2-widget-container">
        	<div class="title">
            	<div class="txt"><?php __('Add News');?> &raquo;</div>
            </div>
            
            <div class="detail">
				<?php	
					if(isset($widget_news_add_result) && !$widget_news_add_result)
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
					else if(isset($widget_news_add_result) && $widget_news_add_result)
					{
				?>
				
				<script type="text/javascript">
					$("#widget-mid-loading").toggle();
					$.get('<?php echo "/{$this->params['prefix']}/news/index/"; ?>', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-bottom-container").empty();
						$("#widget-main-mid-top-container").empty();
						$("#widget-main-mid-top-container").html(data);
					});					
				</script>
				
				<?php 
						// save was successfull
						return;
					}
					
					echo $this->Form->create('News', array(
												'method'=>'post',
												'inputDefaults' => array(
																'label' => false,
																'div' => false
														)));
				?>
				
				
				
				
				<table cellspacing="0" cellpadding="0" border="0" align="center" width="600">
                	<tr>
                    	<td colspan="3"></td>
                    </tr>
					<tr>
						<td valign="top"><?php __('Sites');?>:</td>
						<td colspan="2">
							<div class="news-site-list">	
								<?php echo $this->Form->input('site', array('options' => $sites, 'multiple' => 'checkbox', 'class' => 'input-select-field-small')); ?>	                        
							</div>
						</td>
					</tr>
                    
                    <tr>
                    	<td><?php __('News Title');?>:</td>
                        <td colspan="2">
                        	<?php 
                        		echo $this->Form->input('title', array('class' => 'input-field-extra-large'));
                        	?>
                        </td>
                    </tr>
                    <tr>
                    	<td><?php __('Description');?>:</td>
                        <td colspan="2">
							<?php 
								echo $this->Form->input('description', array('class' => 'input-field-textArea-extra-large'));
							?>	                        
                        </td>
                    </tr>
					<tr>
						<td colspan="3">
							<?php
								echo $this->Js->submit(__('Create',true), array(
											'url' => "/{$this->params['prefix']}/news/add/",
											'method'=> 'post',
											'update' => '#widget-main-mid-bottom-container',
											'div' => false,
											'class' => 'btn'
											)
									); 
								
								echo $this->Html->link(__('Cancel',true), 'javascript:void(0);', 
													array('id' => 'lnk-widget-news-add-cancel',
														'class' => 'btn')); 
							?>
						</td>
					</tr>
				</table>
				
				<?php
					echo $this->Form->end(); 
					echo $this->Js->writeBuffer();                  
		    	?>
        	
        	</div>
		</div>
		<script>
			$(document).ready(function() {
				$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();

				$("#lnk-widget-news-add-cancel").click(function(){
					$("#widget-main-mid-bottom-container").empty();
				});
			});
		</script>			
	
	
	</div>