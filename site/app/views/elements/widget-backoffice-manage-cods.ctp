<!-- SITE SETTTING START -->
<div class="siteSetting-widget-container">
	<div class="content1-widget-container">
    	<div class="title">
        	<div class="txt"><?php echo $title;?> &raquo;</div>
    		<div class="txt2">
			<?php 
				if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['sites'])):    		
					echo $this->Js->link(
										"Back" ,
										"/{$_SESSION['backurls']['sites']}", 
										array('update' => '#widget-main-mid-top-container')); 
				
				elseif (isset($_SESSION['backurls']) && isset($_SESSION['backurls']['merchants'])):
					
					echo $this->Js->link(
										"Back" ,
										"/{$_SESSION['backurls']['merchants']}", 
										array('update' => '#widget-main-mid-top-container')); 
				endif;
			?>
		
			</div>
		</div>
        
        <div class="detail">
        	
        	<div class="menuBar">
        	
				<?php if($view == 'admin_widget_manage_cods' || $view == 'admin_widget_manage_merchant_cods'){?>
            	<div class="item">
					<?php 
            			echo $this->Html->link(__('Create',true), 
            							   'javascript:void(0);', 
            							   array('id' => 'create-cod'));
            		?>	
            	</div>
				
				<div class="item">
					<?php 
            			echo $this->Html->link(__('Link To Site',true), 
            							   'javascript:void(0);', 
            							   array('id' => 'link-cod-to-site'));
            		?>	
				</div>
            	
				<div class="item">
					<?php 
            			echo $this->Html->link(__('Remove',true), 
            							   'javascript:void(0);', 
            							   array('id' => 'remove-cods'));
            		?>	
				</div>
				
				<div class="item last">
					<?php 
            			echo $this->Html->link(__('Unlink',true), 
            							   'javascript:void(0);', 
            							   array('id' => 'unlink-cods-sites'));
            		?>	
				</div>
            	
            	<?php }else{?>
                
                <div class="item last">
            		<?php 
            			echo $this->Html->link(__('Unlink',true), 
            								'javascript:void(0);', 
            								array(	'id' => 'unlink-cod', 
            										'siteid' => $siteid));
            		?>	
                </div>
                
            	<?php }?>
                
                
                <?php if($view == 'admin_widget_manage_cods' || $view == 'admin_widget_manage_site_cods'):?>
                
                <div class="searchBar">
                	<div class="title">
                    	<?php __('Search');?>
					</div>
					<?php 
						echo $this->Form->create('Cod', array(
										'method'=>'post',
										'inputDefaults' => array(
															'label' => false,
															'div' => false
													)
											)
									);
							echo $this->Form->input("search", array("class" => "input"));
							
							if($view == 'admin_widget_manage_cods'){
							
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/cods/widget_manage_cods",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'value' => 0,
											'class' => 'btn')
										);
							}else{
								
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/cods/widget_manage_site_cods/{$siteid}",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'value' => 0,
											'class' => 'btn'
											)
									);
							}
							
							echo $this->Form->end();
							echo $this->Js->writeBuffer();
					?>
				</div>
            	<?php endif;?>
			
			</div>
            
            <div class="allVouchers-widget-container">
				<?php 
					echo $this->element('widget-backoffice-manage-cods-list');
				?>	
			</div>            	
		</div>
	</div>
</div>
	<script>

	$(document).ready(function(){

		if($("#widget-dailog-container").length <= 0)
		{
			$("#widget-main-mid-top-container").append('<div class="popup-container" title="<?php __('Cod Operations');?>" id="widget-dailog-container"></div>');
		}
		else
		{
			$("#widget-dailog-container").attr('title', '<?php __('Cod Operations');?>');
		}

		// Dialog			
		$('#widget-dailog-container').dialog({
			autoOpen: false,
			width: 650,
			modal: true,
			resizable: false,
			buttons: {}
		});
		
		$("#create-cod").click(function(){

			var container = 'widget-main-mid-top-container';

			$("#widget-main-mid-top-container").empty();
			$("#widget-mid-loading").toggle();
			
			$.get('/<?php echo $this->params["prefix"];?>/cods/widget_cods_add/' + container, function(data){
				$("#widget-mid-loading").toggle();
				
				$("#widget-main-mid-bottom-container").html('');
				$("#widget-main-mid-bottom-container").html(data);
			});
		});

		$("#link-cod-to-site").click(function(){
			var cods = [];
			$('input[type="checkbox"]:checked').each(function(){
				cods.push($(this).val());
			});

			if(cods.length <= 0){
				alert("<?php __('no item selected.');?>");
				return false;
			}

			$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/cods/widget_cods_lnk_to_site/' + cods.join());
					
			$('#widget-dailog-container').dialog('open');
		});

		$("#unlink-cod").click(function(){
			var cods = [];
			$('input[type="checkbox"]:checked').each(function(){
				cods.push($(this).val());
			});

			if(cods.length <= 0){
				alert("<?php __('no item selected.');?>");
				return false;
			}

			$("#widget-main-mid-top-container").empty();
			$("#widget-mid-loading").toggle();
			
			var siteid = $(this).attr('siteid');
			$.get("/<?php echo $this->params['prefix'];?>/cods/widget_cods_unlink/" + cods.join() + "/" + siteid, 
				function(data){
				$.get("<?php echo $_SESSION['Auth']['ManageCODURL'];?>", function(data){
					$("#widget-mid-loading").toggle();
					$("#widget-main-mid-top-container").html(data);	
				});
			});

		});

		$("#remove-cods").click(function(){
			var cods = [];
			$('input[type="checkbox"]:checked').each(function(){
				cods.push($(this).val());
			});

			if(cods.length <= 0){
				alert("<?php __('no item selected.');?>");
				return false;
			}

			var res = confirm("<?php __('Do you really want to remove selected item(s)?');?>");
			if(!res){
				return false;
			}

			$("#widget-main-mid-top-container").empty();
			$("#widget-mid-loading").toggle();

			$.get("/<?php echo $this->params['prefix'];?>/cods/remove/" + cods.join(), function(){
				$.get("<?php echo $_SESSION['Auth']['ManageCODURL'];?>", function(data){
					$("#widget-mid-loading").toggle();
					$("#widget-main-mid-top-container").html(data);	
				});
			});
		});

		//Unlink Cods Sites
		$("#unlink-cods-sites").click(function(){
			var cods = [];
			$('input[type="checkbox"]:checked').each(function(){
				cods.push($(this).val());
			});

			if(cods.length <= 0){
				alert("<?php __('no item selected.');?>");
				return false;
			}

			$("#widget-dailog-container").load("/<?php echo $this->params['prefix'];?>/cods/widget_cods_just_unlink/" + cods.join());		
			$('#widget-dailog-container').dialog('open');
		});
		

		$(".ui-dialog-titlebar-close, ").click(function() {
			$("#widget-dailog-container").html('');
		});
	});
	</script>
<!-- SITE SETTTING END -->
