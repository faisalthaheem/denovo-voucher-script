<div>
		<form id="mapping_filter_form">
			<div id="mapping_filter">
				<input type="radio" id="mapping_filterAll" name="mapping_filter" checked="checked" value="all" /><label for="mapping_filterAll">All</label>
				<input type="radio" id="mapping_filterMapped" name="mapping_filter" value="mapped" /><label for="mapping_filterMapped">Mapped</label>
				<input type="radio" id="mapping_filterUnmapped" name="mapping_filter" value="unmapped" /><label for="mapping_filterUnmapped">Unmapped</label>
			</div>
		</form>
		
		<a href="javascript:void(0)" id="mapping_filter_btn">Set Mapping filter</a>
</div>

<div id="dvs4icodesuk-merchants-map-content-container">

</div>


<script>
	jQuery(document).ready(function(){
		jQuery( "#mapping_filter" ).buttonset();
		jQuery( "#mapping_filter_btn" ).button().click(function(){

			jQuery.get('/admin/dvs4icodesuk/icodesuk_merchants/mappingfilter/' + jQuery("input[name='mapping_filter']:checked", '#mapping_filter_form').val(), function(data){
				jQuery.get('/admin/dvs4icodesuk/icodesuk_merchants/map_content', function(data){
					jQuery("#dvs4icodesuk-merchants-map-content-container").html(data);
				});				
			});

		
		});


		jQuery.get('/admin/dvs4icodesuk/icodesuk_merchants/map_content', function(data){
			jQuery("#dvs4icodesuk-merchants-map-content-container").html(data);
		});
		
	});
</script>