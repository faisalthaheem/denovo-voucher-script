<div class="siteSetting-widget-container">
	<?php $this->Paginator->options(array('update' => '#widget-main-mid-bottom-container', 
										'evalScripts' => true)); ?>
	
	<div class="content2-widget-container">
		<div class="title">
			<div class="txt"><?php echo $pluginname.' Configuration';?> &raquo;</div>
		</div>
	                
		<div class="detail2">
		
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
		    	<tr>
		        	<th><?php __('Time');?></th>
		        	<th colspan="2"><?php __('Message');?></th>
				</tr>
		        <tr>
		        	<td colspan="3"></td>
				</tr>
		        
				<?php foreach($logs as $Log):?>
		        <tr>
		        	<td>
		        		<?php 
		        			echo date_format(date_create($Log['Syslog']['created']), "m-d-Y h:i:s A"); 
		        		?>
		        	</td>
		            <td colspan="2">
		            	<?php echo $Log['Syslog']['logmsg'];?>
		            </td>
				</tr>
				<?php endforeach;?>
			</table>

			<?php echo $this->element('widget-backoffice-pagination'); ?>
			
			<?php
				echo $this->Js->writeBuffer(); 
			?>
		
		</div>
	</div>
</div>