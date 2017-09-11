<div class="siteSetting-widget-container">
	<div class="content1-widget-container">
		<div class="title">
			<div class="txt"><?php __('Content Management');?> &raquo;</div>
		</div>
		<div class="detail">
			<div class="left">
				<div class="siteList">
				<li>
					<?php __('Choose a Site');?>
				</li>
				<?php foreach($sites as $Site):?>
				<li>
					<?php 
						echo $this->Js->link(
										"{$Site['Site']['fqdn']}",
										"/{$this->params['prefix']}/pages/index/{$Site['Site']['id']}",
										array("update" => "#widget-pages-list-container")
									);
					?>	
				</li>
				<?php endforeach;?>
				<?php echo $this->Js->writeBuffer();?>
				</div>
			</div>

			<div class="right" id="pages-list-container">
				
				<div id="widget-pages-list-container">
					<?php 
						echo $this->element('widget-backoffice-pages-list');
					?>			
				</div>
			</div>
		</div>
	</div>
</div>