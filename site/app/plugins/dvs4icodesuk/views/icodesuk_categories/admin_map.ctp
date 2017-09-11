<table width=76%>
	<thead>
		<td width=40%>
			ICodesUK Category
		</td>
		
		<td width=40%>
			DVS Category
		</td>
		
		<td width=20%>
			Map
		</td>
	</thead>
<?php
	foreach($icodesukCats as $ukcat)
	{ 
?>
	<tr>
		<td>
			<?php
				echo $ukcat['IcodesukCategory']['icodes_name']; 
			?>
		</td>
		
		<td>
			<span id="icodesuk-map-dvs-cat-name-<?php echo $ukcat['IcodesukCategory']['id'];?>">
			<?php
				echo $categories[$ukcat['IcodesukCategory']['category_id']]; 
			?>
			</span>
		</td>
		<td>
			<a href="javascript:void(0);" id = "map-icodes-uk-category-button-<?php echo $ukcat['IcodesukCategory']['id'];?>">
				Map
				<script>
					jQuery("#map-icodes-uk-category-button-<?php echo $ukcat['IcodesukCategory']['id'];?>").button().click(function(){
						showCategorySelectionDialog(<?php echo $ukcat['IcodesukCategory']['id'];?>);
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
	var mappingUKCategory = 0;

	//called by the dialog when okay is pressed, handle to process of user's selection
	function dvsCategoriesTVDialogCallback0(selectedname, selectedid)
	{
		jQuery.get("/admin/dvs4icodesuk/icodesuk_categories/map_to_category/" + mappingUKCategory + "/" + selectedid, function(){
				jQuery("#icodesuk-map-dvs-cat-name-" + mappingUKCategory).text(selectedname);
		})
		.error(function(){
			alert("Error updating mapping to " + selectedname);
		});
	}

	//helper - opens and shows the dialog
	function showCategorySelectionDialog(mappingid)
	{
		mappingUKCategory = mappingid;
		dvsCategoriesTVDialog0(); //defined in widget's view
	}
	
</script>

<?php
	//include the category selected, which is invoked using the above helper
	echo $this->requestAction('/categories/widget_treeview', array('return'));
?>