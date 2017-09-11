<?php 
		if(!isset($upload_results))
		{
?>

<?php
		echo $this->Html->css('/theme/factory/css/dvs-community');
		echo $this->Html->css('/theme/factory/css/jquery-ui-1.8.11.custom');
		echo $this->Html->script('jquery-1.5.1.min');
		echo $this->Html->script('jquery-ui-1.8.11.custom.min');
			
 		echo $this->Form->create('Picture', 
 									array(
 										'url' => "/pictures/widget_upload_iframe/cbfunc:$cbfunc",
 										'type' => 'file',
										'method'=>'post',
										'inputDefaults' => 
 												array(
													'label' => false,
													'div' => false
 												)
 									)
							);			
?>
		<div class="upload-widget-detail">
    		<div class="upload-widget-detail-left">
        		<table width="320" height="80" border="0" cellpadding="0" cellspacing="0">
          			<tr>
          				<td style="Font-size:14px;"><?php __('Choose Picture');?>:</td>
			            <td>
			            <?php 
							echo $this->Form->file('pic', array());			            
			            ?>    
			            </td>
		          	</tr>
		          	<tr>
		            	<td colspan="2">
							<?php
								echo $this->Form->submit(__('UPLOAD',true),
									array(
										'div' => false,
										'class' => 'upload-widget-action-btn-2',
										'id' => 'submitbutton'
										)
									); 
							?>
            			</td>
          			</tr>
        		</table>
                  
				<?php
					echo $this->Form->end(); 
                	//echo $this->Js->writeBuffer();
				?>
    		
    		</div>
		</div>
		<script>

		$(document).ready(function(){
			jQuery("#submitbutton").button();
		});
		
		</script>
		
<?php 
		}
		else if($upload_results)
		{
			echo $this->element('widget-picture-upload-success', array('cbfunc' => $callback, 'uploaded_image'=> $uploaded_image));
		}
		else 
		{
			echo $this->element('widget-picture-upload-failure');
		}
?>
