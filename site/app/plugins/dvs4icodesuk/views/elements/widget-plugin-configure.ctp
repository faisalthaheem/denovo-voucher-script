<div class="siteSetting-widget-container">	
	<div class="content2-widget-container">
		<div class="title">
	    	<div class="txt">IcodesUK Settings &raquo;</div>
		</div>
	                
	    <div class="detail">
			
			<?php 
				echo $this->Form->create('Pluginsconfiguration', 
											array('method'=>'post',
												'inputDefaults' => array(
															'label' => false,
															'div' => false
														)
											)
									); 
			?>
			
			<table width="600" border="0" cellpadding="0" cellspacing="0" align="center">
	        	<tr>
	            	<th colspan="3">
	            		<?php 
							echo $result;            	
	            		?>
	            	</th>
				</tr>
	            <tr>
	            	<td colspan="3"></td>
				</tr>
	            <tr>
	            	<td>IcodesUK Username:</td>
	                <td colspan="2">
	                	<?php 
	                		echo $this->Form->input('username', array('class' => 'input-field-large'));
	                	?>
	                </td>
				</tr>
	            <tr>
	            	<td>IcodesUK Subscription ID:</td>
					<td colspan="2">
	                	<?php 
	                		echo $this->Form->input('subscriptionid', array('class' => 'input-field-large'));
	                	?>
					</td>
				</tr>
				
	            <tr>
	            	<td colspan="3">Please Select default Sites from the following to associate all imported data to.</td>
	            </tr>
	           
				<tr>
	           		<td>Sites List:</td>
	           		<td>
	           		<?php 
	           			echo $this->Form->input('sites', array('options' => $sites, 'multiple' => 'checkbox', 'class' => 'checkBox-type2'));
	           		?>
	           		</td>
	           </tr>
				
	            <tr>
	            	<td colspan="3">
					<?php
							echo $this->Js->submit('UPDATE',
								array(
									'url' => '/'.$this->params["prefix"].'/dvs4icodesuk/configuration/configure/',
									'method'=> 'post',
									'update' => '#widget-main-mid-bottom-container',
									'div' => false,
									'class' => 'btn',
									'id' => 'update-configuration'
								)
							); 
					?>
					</td>
				</tr>
			</table>
			
			<?php
				echo $this->Form->end(); 
				echo $this->Js->writeBuffer();
			?>		
			
			<script type="text/javascript">
				$(document).ready(function() {
					$(".siteSetting-widget-container .content2-widget-container .detail .btn").button();
				});
			</script>
		</div>
	</div>
</div>