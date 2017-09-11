<div class="siteSetting-widget-container">
	<div class="content2-widget-container">
		<div class="title">
	    	<div class="txt">Adility OffersDB Settings &raquo;</div>
		</div>
	                
	    <div class="detail">
		
			<?php 
				echo $this->Form->create('Pluginsconfiguration', 
											array('method'=>'post',
												'inputDefaults' => array(
															'label' => false,
															'div' => false
														))); 
			?>
		
			<table width="620" border="0" cellpadding="0" cellspacing="0" align="center">
	        	
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
	            	<td>AdilityODB Subscription Id</td>
	                <td colspan="2">
	                	<?php 
	                		echo $this->Form->input('subscriptionid', array('class' => 'input-field-large'));
	                	?>
	                </td>
				</tr>
	            
	            <tr>
	            	<td colspan="3">Please provide City, State and Radius (in miles) to import Vouchers, deals and offers from the location.</td>
	            </tr>
	            
	            <tr>
	            	<td>City Name</td>
					<td colspan="2">
	                	<?php 
	                		echo $this->Form->input('city', array('class' => 'input-field-large'));
	                	?>
					</td>
				</tr>
	
	            <tr>
	            	<td>State Code</td>
					<td colspan="2">
	                	<?php 
	                		echo $this->Form->input('state_code', array('class' => 'input-field-large'));
	                	?>
					</td>
				</tr>
	
	            <tr>
	            	<td>Radius (in miles)</td>
					<td colspan="2">
	                	<?php 
	                		echo $this->Form->input('radius', array('class' => 'input-field-large'));
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
									'url' => '/'.$this->params["prefix"].'/dvs4adilityodb/configuration/configure/',
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