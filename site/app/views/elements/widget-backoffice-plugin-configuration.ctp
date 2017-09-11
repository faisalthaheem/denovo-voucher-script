
	<!-- SITE SETTTING START -->
    <div class="siteSetting-widget-container">

    	<div class="content1-widget-container" id='plugin-list-content-container'>
			<div class="title">
		    	<div class="txt"><?php __('Plugins Settings');?> &raquo;</div>
			</div>
		                
		    <div class="detail">
		    	<div class="left">
		        	<ul>
		        		<li>Plugins</li>
		            	
						<?php 
		                	foreach($pluginlist as $id => $plugin):
		                    		
		                		echo $this->Html->tag('li', 
		                    						$plugin['Pluginsconfiguration']['pluginname'], 
		                    							array('name' => $plugin['Pluginsconfiguration']['pluginname']));
		                    endforeach;
						?>
					</ul>
				</div>
				
				<div class="right">
					<div id='plugin-configuration-content-container'>
					
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- SITE SETTTING END -->		
	<script>
		$(document).ready(function(){

			$(".siteSetting-widget-container .content1-widget-container .detail .left li").click(function(){
			    if($(this).hasAttr('name')) {

					var pluginname = $(this).attr('name');
					$.get("/<?php echo $this->params['prefix'];?>/" + pluginname + "/configuration/index", function(data){
						$("#widget-main-mid-bottom-container").empty();
						$("#plugin-configuration-content-container").empty();
						$("#plugin-configuration-content-container").html(data);
					});
				}
			});

			$.fn.hasAttr = function(name) {  
				   return this.attr(name) !== undefined;
			};
		});
	</script>
