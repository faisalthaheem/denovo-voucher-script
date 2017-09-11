	<!-- widget-search-community-search-form => Element -->
	<!-- SEARCH FILTER Widget Start -->
	<div class="advanced-search-filter-widget-container" id="search-filter-widget-container">
  		
  		<div class="advanced-search-filter-widget-title" id="create-search-options">
          <a href="javascript::void(0);"></a>
  		</div>
  	
  		<div class="advanced-search-filter-widget-listArea" id="filters-list">
  			<!-- Dynamic Search filter would be added -->
		</div>
    
    	<div class="advanced-search-filter-widget-keyword-row">
			<a href="javascript::void(0);" class="popup-forget-password-widget-btn" id="advance-search-button">
				<?php __('Search');?>
			</a>
  		</div>
	
		<script type="text/javascript">

			jQuery(document).ready(function(){

				jQuery(".popup-forget-password-widget-btn").button();

				jQuery("#search-options").dialog({
					autoOpen: false,
					width: '480',
					height:'320',
					resizable:true,
					buttons: {
						"OK": function() { 
							createfilters();
							jQuery(this).dialog("close");
							
						}
					}
				});

				jQuery("#create-search-options").click(function(){
					jQuery("#search-options").dialog('open');
				});

				jQuery("#advance-search-button").click(function(){

					search_results_widget_container_showAjaxLoad();

					var data = [];
					jQuery('.advanced-search-filter-widget-listArea-item').each(function(index){
						data.push(jQuery(this).attr('data'));
					});

					var strData = serialize(data);

					jQuery.ajax({
						  url: '/users/widget_search/',
						  type: 'POST',
						  data: {
						  		'data' : serialize(data)
						  },
						  success: function(html){
									search_results_widget_container_showAjaxLoad();
									jQuery('#left-panel-container-mid-panel-container-widget-search-community-search-results').empty();
									jQuery('#left-panel-container-mid-panel-container-widget-search-community-search-results').html(html);
					 			 }
					});
				});
			});

			// showing spinner image
			function search_results_widget_container_showAjaxLoad()
			{
				jQuery("#search-user-profile-view-container").fadeToggle("slow", "linear");
				jQuery("#search-user-profile-view-container").html('');
				
				jQuery("#widget-search-community-search-results-loading").toggle();
				jQuery("#search-results-widget-container").toggle();				
			}

			// handling age filter
			function AgeFilter(control)
			{
				if(control.options[control.selectedIndex].value == "is")
				{
					jQuery("#between-from-age-value").show();	
					jQuery("#between-to-age-value").hide();	
				}
				else if(control.options[control.selectedIndex].value == "between")
				{
					jQuery("#between-from-age-value").show();	
					jQuery("#between-to-age-value").show();	
				}
				else
				{
					jQuery("#between-from-age-value").hide();	
					jQuery("#between-to-age-value").hide();
				}
			}

			// mouse over on filter to show cross link
			function filterItem_mouseover(control)
			{
				jQuery(control).children(".advanced-search-filter-widget-listArea-item-crossDiv").show();
			}

			// mouse out on filter to hide cross link
			function filterItem_mouseout(control)
			{
				jQuery(control).children(".advanced-search-filter-widget-listArea-item-crossDiv").hide();
			}

			// mouse over function cross link on the filter
			function removelink_mouseover(control)
			{
				jQuery(control).css('opacity', 1);
			}

			// mouse out function cross link on the filter
			function removelink_mouseout(control)
			{
				jQuery(control).css('opacity', 0.5);
			}

			// After closing dialog box this function 
			// checks whos choosen with what value
			// and creates filters on tha page
			function createfilters()
			{
				// Html for removing filter
            	var removeFilterHtml = "<div class='advanced-search-filter-widget-listArea-item-crossDiv' onMouseOver='removelink_mouseover(this);' onMouseOut='removelink_mouseout(this);' onclick='removefilter(this);'><a href='javascript::void(0);'><img src='/theme/factory/img/community-img/hover-delete.png' border='0' /></a></div>";

            	// User anem Filter
				if(jQuery('#username-filter').val().length > 0)
				{
					if(jQuery('#username-filter-value').length == 0)
					{
						// filter does not exist, so create one
						jQuery('<div/>', 
								{	id: 'username-filter-value'
									,class: 'advanced-search-filter-widget-listArea-item'
									,onMouseOver: 'filterItem_mouseover(this);'
									,onMouseOut:'filterItem_mouseout(this);'
						}).appendTo('#filters-list');
					}

					// Update div with filters
					jQuery('#username-filter-value').html('');
					jQuery('#username-filter-value').html('<span>UserName:' + jQuery('#username-filter').val() + '</span>' + removeFilterHtml);
					jQuery('#username-filter-value').attr('data', 'username:' + jQuery('#username-filter').val());
				}
				else
				{
					if(jQuery('#username-filter-value').length > 0)
					{
						jQuery('#username-filter-value').remove();
					}
				}
				// user name filter ends
				
				///	AGE Filter Check
				if(jQuery('#age-filter-select-box option:selected').val() != 0)
				{
					if(jQuery('#age-filter-value').length == 0)
					{
						// filter does not exist, so create it
						jQuery('<div/>', {  
						    	id: 'age-filter-value'
							    ,class: 'advanced-search-filter-widget-listArea-item'
								,onMouseOver: 'filterItem_mouseover(this);'
								,onMouseOut:'filterItem_mouseout(this);'
						}).appendTo('#filters-list');
					}
					
					if(jQuery('#age-filter-select-box option:selected').val() == 'is')
					{
						// 'is' filter selected for Age then we get value from between-from-age-value textbox
						jQuery('#age-filter-value').html('');
						jQuery('#age-filter-value').html('<span>Age:' + jQuery('#between-from-age-value').val() + '</span>' + removeFilterHtml);
						jQuery('#age-filter-value').attr('data', 'age:' + jQuery('#between-from-age-value').val());
					}
					else if(jQuery('#age-filter-select-box option:selected').val() == 'between')
					{

						// 'between' filter selected for age, we get value from between-from/to-age-value textboxes
						jQuery('#age-filter-value').html('');
						jQuery('#age-filter-value').html(	'<span>' + 
															'Age:between(' + 
															jQuery('#between-from-age-value').val() + 
															',' +
															jQuery('#between-to-age-value').val() +
															')</span>' + 
															removeFilterHtml);
						

						jQuery('#age-filter-value').attr('data','agefrom:' + jQuery('#between-from-age-value').val() + 
																';ageto:' + jQuery('#between-to-age-value').val());
	
					}

				}
				else
				{
					if(jQuery('#age-filter-value').length > 0)
					{
						jQuery('#age-filter-value').remove();
					}
				}
				/// Age Ends

				///
				///	Check Gender Filter
				///
				if(jQuery('input[name:data[gender]]:checked').val() == "Male" || jQuery('input[name:data[gender]]:checked').val() == "Female")
				{

					if(jQuery('#gender-filter-value').length == 0)
					{
						jQuery('<div/>', {  
						    id: 'gender-filter-value'
							,class: 'advanced-search-filter-widget-listArea-item'
							,onMouseOver: 'filterItem_mouseover(this);'
							,onMouseOut:'filterItem_mouseout(this);'
						}).appendTo('#filters-list');
					}
					
					jQuery('#gender-filter-value').html('<span>Gender:' + jQuery('input[name:data[gender]]:checked').val() + '</span>' + removeFilterHtml);
					jQuery('#gender-filter-value').attr('data', 'gender:' + jQuery('input[name:data[gender]]:checked').val());

				}
				else
				{
					if(jQuery('#gender-filter-value').length > 0)
					{
						jQuery('#gender-filter-value').remove();
					}
				}
				///	Gender Ends
			}

			// This function invokes on clicking cross link on the filter
			// it removes that filter
			function removefilter(elem)
			{
				if(jQuery(elem).parent('div:first').attr('id') == 'age-filter-value')
				{
					jQuery('#age-filter-select-box option[value=0]').attr('selected', 'selected');
					jQuery('#between-from-age-value').val('');
					jQuery('#between-from-age-value').hide();
					jQuery('#between-to-age-value').val('');
					jQuery('#between-to-age-value').hide();
				}
				else if(jQuery(elem).parent('div:first').attr('id') == 'gender-filter-value')
				{
					jQuery('input[name:data[gender]]:checked').attr('checked', false);
				}
				else if(jQuery(elem).parent('div:first').attr('id') == 'username-filter-value')
				{
					jQuery('#username-filter').val('');
				}

				jQuery(elem).parent('div:first').remove();
			}

			// This function serializes filters array
			// so that, can be handled on server easily
			function serialize( mixed_value ) {
			    var _getType = function( inp ) {
			        var type = typeof inp, match;
			        var key;
			        if (type == 'object' && !inp) {
			            return 'null';
			        }
			        if (type == "object") {
			            if (!inp.constructor) {
			                return 'object';
			            }
			            var cons = inp.constructor.toString();
			            match = cons.match(/(\w+)\(/);
			            if (match) {
			                cons = match[1].toLowerCase();
			            }
			            var types = ["boolean", "number", "string", "array"];
			            for (key in types) {
			                if (cons == types[key]) {
			                    type = types[key];
			                    break;
			                }
			            }
			        }
			        return type;
			    };
			    var type = _getType(mixed_value);
			    var val, ktype = '';
			    
			    switch (type) {
			        case "function": 
			            val = ""; 
			            break;
			        case "undefined":
			            val = "N";
			            break;
			        case "boolean":
			            val = "b:" + (mixed_value ? "1" : "0");
			            break;
			        case "number":
			            val = (Math.round(mixed_value) == mixed_value ? "i" : "d") + ":" + mixed_value;
			            break;
			        case "string":
			            val = "s:" + mixed_value.length + ":\"" + mixed_value + "\"";
			            break;
			        case "array":
			        case "object":
			            val = "a";
			            var count = 0;
			            var vals = "";
			            var okey;
			            var key;
			            for (key in mixed_value) {
			                ktype = _getType(mixed_value[key]);
			                if (ktype == "function") { 
			                    continue; 
			                }
			                
			                okey = (key.match(/^[0-9]+$/) ? parseInt(key, 10) : key);
			                vals += serialize(okey) +
			                        serialize(mixed_value[key]);
			                count++;
			            }
			            val += ":" + count + ":{" + vals + "}";
			            break;
			    }
			    if (type != "object" && type != "array") {
			      val += ";";
			  }
			    return val;
			}
		</script>
	</div>
	
    <div id="search-options" title="Choose Search Criteria" style="display:none">
    	<div  class="popup-search-options" id="search-options-container" style="font-size: 14px;">
	    	<table width="auto" cellpadding="2px" cellspacing="2px" border="0">
				
				<tr>
					<td width="120px"><?php __('User Name');?>:</td>
					<td>
						<?php echo $this->Form->input('name', array('id' => 'username-filter',
																	'label' => false,
																	'div' => false));?>
					</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
				</tr>
				
				<tr>
					<!-- Age Filters -->
					<td width="120px"><?php __('Age');?>:</td>
					<td>
						<?php echo $this->Form->input('agefilter', array(
																	'options' => array(	'0' => 'Select Filter Type',
																						'is' =>'is',
																				   		'between' => 'between'),
																	'label' => false,
																	'div' => false,
																	'onchange' => 'AgeFilter(this);',
																	'id' => 'age-filter-select-box'));?>
					</td>
					<td>
						<?php echo $this->Form->input('fromage', array(	'id' => 'between-from-age-value', 
																		'label' => false, 
																		'div' => false, 
																		'style' => 'width:80px; display:none;'));?>
					</td>
					<td>
						<?php echo $this->Form->input('toage', array(	'id' => 'between-to-age-value', 
																		'label' => false, 
																		'div' => false, 
																		'style' => 'width:80px; display:none;'));?>
					</td>
				</tr>    
				
				<tr>
					<!-- Gender Filters -->
					<td width="120px"><?php __('Gender');?>:</td>
					<td colspan="3">
					
							<?php echo $this->Form->radio('gender', array(	'Male' => 'Male', 
																			'Female' => 'Female'),
																	array(	'id' => 'gender-value',
																			'label' => false, 
																			'div' => false));
																?>
					</td>
				</tr>    
	    	</table>
    	</div>
    </div>
	<?php
	  	echo $this->Js->writeBuffer(); 
	?>
	
	<!-- ADVANCED SEARCH FILTER Widget END -->