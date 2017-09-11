<table width=76%>
	<thead>
		<td width=40%>
			ICodesUS Category
		</td>
		
		<td width=40%>
			DVS Category
		</td>
		
		<td width=20%>
			Map
		</td>
	</thead>
<?php
	foreach($icodesusCats as $uscat)
	{ 
?>
	<tr>
		<td>
			<?php
				echo $uscat['IcodesusCategory']['icodes_name']; 
			?>
		</td>
		
		<td>
			<span id="icodesus-map-dvs-cat-name-<?php echo $uscat['IcodesusCategory']['id'];?>">
			<?php
				echo $categories[$uscat['IcodesusCategory']['category_id']]; 
			?>
			</span>
		</td>
		<td>
			<a href="javascript:void(0);" id = "map-icodes-us-category-button-<?php echo $uscat['IcodesusCategory']['id'];?>">
				Map
				<script>
					jQuery("#map-icodes-us-category-button-<?php echo $uscat['IcodesusCategory']['id'];?>").button().click(function(){
						showCategorySelectionDialog(<?php echo $uscat['IcodesusCategory']['id'];?>);
					});
				</script>
			</a>
		</td>
	</tr>
<?php
	}	
?>
</table>

<!-- Define the callback script -->
<script>

	//to be used in callback on dialog close
	var mappingUSCategory = 0;

	//called by the dialog when okay is pressed, handle to process of user's selection
	function dvsCategoriesTVDialogCallback0(selectedname, selectedid)
	{
		jQuery.get("/admin/dvs4icodesus/icodesus_categories/map_to_category/" + mappingUSCategory + "/" + selectedid, function(){
				jQuery("#icodesus-map-dvs-cat-name-" + mappingUSCategory).text(selectedname);
		})
		.error(function(){
			alert("Error updating mapping to " + selectedname);
		});
	}

	//helper - opens and shows the dialog
	function showCategorySelectionDialog(mappingid)
	{
		mappingUSCategory = mappingid;
		dvsCategoriesTVDialog0(); //defined in widget's view
	}
	
</script>

<?php
	//include the category selected, which is invoked using the above helper
	echo $this->requestAction('/categories/widget_treeview', array('return'));
?>