
<div class="content2-widget-container">
	<div class="title">
    	<div class="txt"><?php __('Manage Sites');?> &raquo;</div>
    	<div class="txt2">
			<?php
				echo $this->Js->link(
								__("Create Site",true)
								,"/{$this->params['prefix']}/sites/add/"
								,array(
									'update' => '#widget-main-mid-bottom-container'
								)
							); 
			?>
    	</div>
	</div>
    
    <div class="detail">
    
    <?php foreach($sites as $Site):?>
    	
    	<div class="siteInfo-widget-container">
        	
        	<table width="860" border="0" align="center">
            	
            	<tr>
                	<th colspan="2" width="647">
                    	<?php echo $Site['Site']['fqdn'];?> 
                   		<span><?php __('Created');?> : <?php echo date_format(date_create($Site['Site']['created']), "m-d-Y h:i:s A");?></span>
					</th>
				</tr>
                
                <tr>
                	<td colspan="2">
                    	<span><?php echo $Site['Site']['notes'];?></span>
					</td>
				</tr>
                          
                <tr>
                	<td colspan="2">
                    	<div class="links">
                        	<?php 
								echo $this->Html->link(__('Edit',true), 
															'javascript:void(0);',
															array('siteid' => $Site['Site']['id']
																  ,'sitename' => $Site['Site']['fqdn']
																  ,'name' => 'edit'));
                        	?>
                        	
                        	&nbsp;|&nbsp;
                    	
                        	<?php 
								echo $this->Html->link(__("Categories",true). " (".$Site[0]['categoryCount'].")", 
															'javascript:void(0);',
															array('siteid' => $Site['Site']['id']
																	,'sitename' => $Site['Site']['fqdn']
																	,'name' => 'categories'));
                        	?>
                        	
                        	&nbsp;|&nbsp;
                        	
                        	<?php 
								echo $this->Html->link(__("Merchants",true) . " (".$Site[0]['merchantCount'].")", 
															'javascript:void(0);', 
															array('siteid' => $Site['Site']['id']
																	,'sitename' => $Site['Site']['fqdn']
																	,'name' => 'merchants'));
                        	
                        	?>
                        	
                        	&nbsp;|&nbsp;
                        	
                        	<?php 
								echo $this->Html->link(__("Codes",true) . " (".$Site[0]['codCount'].")", 
															'javascript:void(0);',
															array('siteid' => $Site['Site']['id']
																	,'sitename' => $Site['Site']['fqdn']
																	,'name' => 'cods'));
                        	
                        	?>
                        	
                        	&nbsp;|&nbsp;
                        	
                        	<?php 
								echo $this->Html->link(__("Site Banners",true), 
															'javascript:void(0);',
															array('siteid' => $Site['Site']['id']
																	,'sitename' => $Site['Site']['fqdn']
																	,'name' => 'banners'));
                        	?>
                            
                            <span>
                            <?php 
                            	echo $this->element('widget-backoffice-manage-sites-activate', array(
                            								"isActive" => $Site['Site']['active'],
                            								"site_id" => $Site['Site']['id']));
                            
                            ?>
                            </span>
						</div>
					</td>
				</tr>
			
			</table>
		
		</div>
	<?php endforeach;?>
	
	<?php echo $this->Js->writeBuffer();?>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){

			$(".siteSetting-widget-container .content2-widget-container .detail .links a").click(function(){

				var name = $(this).attr('name');
				var siteid = $(this).attr('siteid');
				
				if("edit" == name){
					
					$.get('/<?php echo $this->params['prefix'];?>/sites/edit/' + siteid, function(data){
						$("#widget-main-mid-bottom-container").html('');
						$("#widget-main-mid-bottom-container").html(data);
					});

				}else if("categories" == name){

					$.get('/<?php echo $this->params['prefix'];?>/categories/widget_manage_site_categories/' + siteid + '/0', function(data){

						$("#widget-main-mid-bottom-container").html('');
						$("#widget-main-mid-top-container").html('');
						$("#widget-main-mid-top-container").html(data);
					});

				}else if("merchants" == name){

					$.get('/<?php echo $this->params['prefix'];?>/merchants/widget_manage_site_merchants/' + siteid + '/0', function(data){
						$("#widget-main-mid-bottom-container").html('');
						$("#widget-main-mid-top-container").html('');
						$("#widget-main-mid-top-container").html(data);
					});

				}else if("cods" == name){

					$.get('/<?php echo $this->params['prefix'];?>/cods/widget_manage_site_cods/' + siteid + '/0', function(data){
						$("#widget-main-mid-bottom-container").html('');
						$("#widget-main-mid-top-container").html('');
						$("#widget-main-mid-top-container").html(data);
					});

				}else if("banners" == name){

					$.get('/<?php echo $this->params['prefix'];?>/banners/index/' + siteid, function(data){
						$("#widget-main-mid-bottom-container").html('');
						$("#widget-main-mid-top-container").html('');
						$("#widget-main-mid-top-container").html(data);
					});
				}
			});
		});
	</script>


</div>
		