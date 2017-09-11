<div class="description2">	
	
	<div class="txt">
		<?php echo $plugintitle;?>
	</div>

	<div class="links-Div">
		<?php 
			echo $this->Js->link("Configuration",
								"/{$this->params['prefix']}/{$pluginname}/configuration/configure",
								array("update" => "#widget-main-mid-bottom-container")
								);
		?>
		|
		<?php 
			echo $this->Js->link("Logs",
								"/{$this->params['prefix']}/syslogs/plugin_logs/{$pluginname}",
								array("update" => "#widget-main-mid-bottom-container")
								);
		?>
	</div>
	<p>
		Plugin description goes here.....
	</p>
	<?php echo $this->Js->writeBuffer();?>
</div>	
