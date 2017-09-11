<div id="dvs4-categories-widget-treeview-container-<?php echo $uniqueWidgetID; ?>">

<div id = "dvs4-categories-widget-treeview-dialog-<?php echo $uniqueWidgetID; ?>">

<table width=100%>
<tr>
<td width="80%">
	<ul id="dvs4-categories-widget-treeview" class="treeview-red">
	<?php
	foreach($categories as $category)
	{
	?>
	
	<li>
		<?php 
			if($category['Category']['id'] == 1){?>
				<span onclick="category_changed('<?php echo $category['Category']['catname'];?>',<?php echo $category['Category']['id'];?>);">
		<?php }else{?>
				<span>
		<?php
			}
			//write parent category's name
			echo $category['Category']['catname']; 
		?>
		</span>
	
	
		<?php
			//if any child nodes?
			if(!empty($category['children']))
			{
		?>
			<ul>
				<?php
					//write child nodes
					foreach($category['children'] as $childCat)
					{
				?>
					<li>
						<span onclick="category_changed('<?php echo $childCat['Category']['catname'];?>',<?php echo $childCat['Category']['id'];?>);">
							<?php
								echo $childCat['Category']['catname'];
							?>
						</span>
					</li>
				<?php
					}
				?>
			</ul>
		<?php
				
			} 
		?>
	</li>
	<?php
	} 
	?>
	</ul>
</td>
	<!-- Buttons -->
<td width="20%">
	<center>
		<div id="dvs4-categories-widget-dialog-<?php echo $uniqueWidgetID; ?>-label-selected">Uncategorised</div>
		<br />&nbsp;
		<a href="javascript:void(0);" id="dvs4-categories-widget-dialog-<?php echo $uniqueWidgetID; ?>-button-okay">Okay</a>
		<br />&nbsp;
		<br />&nbsp;
		<a href="javascript:void(0);" id="dvs4-categories-widget-dialog-<?php echo $uniqueWidgetID; ?>-button-close">Cancel</a>
	</center>
</td>

</table>
</div>	

<script>
	
	
	jQuery(document).ready(function(){
		jQuery("#dvs4-categories-widget-treeview").treeview({
			animated: "fast",
			collapsed: true,
			unique: true
		});

		jQuery("#dvs4-categories-widget-treeview-dialog-<?php echo $uniqueWidgetID; ?>").dialog({
				modal: true,
				width: 600,
				height: 400,
				autoOpen: false
		});

		jQuery("#dvs4-categories-widget-dialog-<?php echo $uniqueWidgetID; ?>-button-okay").button().click(function(){

			//invoke callback
			dvsCategoriesTVDialogCallback<?php echo $uniqueWidgetID; ?>(selected_category_name,selected_category_id);
			jQuery("#dvs4-categories-widget-treeview-dialog-<?php echo $uniqueWidgetID; ?>").dialog("close");
		});

		jQuery("#dvs4-categories-widget-dialog-<?php echo $uniqueWidgetID; ?>-button-close").button().click(function(){
			jQuery("#dvs4-categories-widget-treeview-dialog-<?php echo $uniqueWidgetID; ?>").dialog("close");
		});		
	});

	//todo: make multiple instance safe: introduce the uniqueid in function and variable names

	var selected_category_id = 1; //Uncategorised
	var selected_category_name = 'Uncategorised';

	function category_changed(categoryName, categoryID)
	{
		selected_category_id = categoryID;
		selected_category_name = categoryName;
		
		jQuery("#dvs4-categories-widget-dialog-<?php echo $uniqueWidgetID; ?>-label-selected").text(categoryName);
	}

	function dvsCategoriesTVDialog<?php echo $uniqueWidgetID; ?>()
	{
		jQuery("#dvs4-categories-widget-treeview-dialog-<?php echo $uniqueWidgetID; ?>").dialog("open");
	}
	
</script>

</div>

	
<?php
//debug($categories,true); 
?>
