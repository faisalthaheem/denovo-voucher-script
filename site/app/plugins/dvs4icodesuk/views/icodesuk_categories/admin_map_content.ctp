<table>
	<thead>
		<td>
			ICodesUK Merchant
		</td>
		
		<td>
			DVS Merchant
		</td>
		
		<td>
		</td>
		
		<td>
			Action
		</td>
	</thead>
	
<?php 
	foreach($icMerchants as $icMerchant)
	{
?>
	
	<tr>
		<td>
			<?php echo $icMerchant['IcodesukMerchant']['merchant']; ?>
		</td>
		
		<td>
			<?php 
			
			if(false == $icMerchant['IcodesukMerchant']['match']){ ?>
			
				N/A
				
			<?php }else{

				echo $icMerchant['IcodesukMerchant']['match']['Merchant']['title'];
				
			}
			?>
		</td>
		
		<td>
		</td>
		
		<td>
		</td>
	</tr>
	
<?php
	} 
?>	
	
</table>

<?php
	debug($icMerchants, true); 
?>
