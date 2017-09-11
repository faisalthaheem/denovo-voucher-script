
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
                    							array('installed' => $plugin['Pluginsconfiguration']['installed'], 
                    								'name' => $plugin['Pluginsconfiguration']['pluginname']));
                    endforeach;
				?>
			</ul>
		</div>
		
		<div class="right"></div>
	</div>
