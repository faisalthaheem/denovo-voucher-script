<?php 
		if(!isset($upload_results))
		{
?>

<?php
		echo $this->Html->css('backoffice/backoffice-style');
		echo $this->Html->css('backoffice/jquery-ui-1.8.11.custom');
		echo $this->Html->css('backoffice/jquery-ui-1.8.11.custom.dialog-box');
		echo $this->Html->script('jquery-1.5.1.min');
		echo $this->Html->script('jquery-ui-1.8.11.custom.min');
			
 		echo $this->Form->create('Picture', 
 									array(
 										'url' => "/{$this->params['prefix']}/pictures/widget_upload_iframe",
 										'type' => 'file',
										'method'=>'post',
										'inputDefaults' => 
 												array(
													'label' => false,
													'div' => false
 												),
 										'id' => 'picture-upload-form'
 									)
							);			
?>
		<div class="upload-widget-container">
			<div id="loader-candy-red" style="text-align: center; display:none;">
				<span>
					<?php
						echo $this->Html->image('loaders/candy-horizontal-red.gif'); 
					?>
				</span>
			</div>
    		<div class="detail" id="container-picture-upload-form">
        		<table width="360" height="80" border="0" cellpadding="0" cellspacing="0">
          			<tr>
          				<td colspan="2">
          					<?php 
          						if($_SESSION['pictures']['picturetype'] == Configure::read('PictureTags.Banner')){
          							echo "<strong>DVS supports 3 types of Banners.</strong>";
          							echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1_ Horizontal Large (h-large).";
          							echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2_ Small Box Left (s-left).";
          							echo "<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3_ Small Box Right (s-right).";
          							echo "<br/><strong>Please upload banners accordingly.</strong>";
          						}elseif($_SESSION['pictures']['picturetype'] == Configure::read('PictureTags.Logo')){
          							echo "<strong>Ideal logo size is 104x50 pixels.</strong>";
          						}elseif($_SESSION['pictures']['picturetype'] == Configure::read('PictureTags.Voucher')){
          							echo "<strong>Ideal voucher size is 560x220 pixels.</strong>";
          						}          					
          					?>
          				</td>
          			</tr>
          			<tr>
          				<td>&nbsp;</td>
          			</tr>
          			<tr>
          				<td style="Font-size:14px;"><?php __('Title (optional)');?>:</td>
			            <td>
			            <?php 
							echo $this->Form->input('Picture.title', array('class'=>'input-field-picture-upload'));			            
			            ?>    
			            </td>
		          	</tr>
          			<tr>
          				<td style="Font-size:14px;"><?php __('Select Image');?>:</td>
			            <td>
			            <?php 
							echo $this->Form->file('pic', array());			            
			            ?>    
			            </td>
		          	</tr>
		          	<tr>
		            	<td colspan="2">
					<?php
						echo $this->Form->submit(
							__('UPLOAD',true),
							array(
								'div' => false,
								'class' => 'btn'
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
				
				$(".btn").button();

				$("#picture-upload-form").submit(function(){
					
					$("#container-picture-upload-form").toggle();
					$("#loader-candy-red").toggle();
				});

			});
		</script>
		
<?php 
		}
		else if($upload_results)
		{
			echo $this->element('widget-backoffice-picture-upload-success');
		}
		else 
		{
			echo $this->element('widget-backoffice-picture-upload-failure');
		}
?>
