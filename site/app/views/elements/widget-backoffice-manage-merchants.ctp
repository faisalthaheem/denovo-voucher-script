<!-- SITE SETTTING START -->
<div class="siteSetting-widget-container">
	
	<div class="content1-widget-container">
    	
    	<div class="title">
        	<div class="txt"><?php __('Manage Merchants');?> &raquo;</div>
    		<div class="txt2">
			<?php 
				if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['sites'])):    		
					echo $this->Js->link(
										__("Back",true) ,
										"/{$_SESSION['backurls']['sites']}", 
										array('update' => '#widget-main-mid-top-container')); 
				endif;
			?>
		
		</div>
        
        <div class="detail">
        	
        	<div class="menuBar">
				<?php if($view == 'admin_widget_manage_merchants'){?>
            	<div class="item">
					<?php 
            			echo $this->Html->link(__('Create Merchant',true),
            							   'javascript:void(0);', 
            							   array('id' => 'create-merchant'));
            		?>	
            	</div>
				
				<div class="item">
					<?php 
            			echo $this->Html->link(__('Link To Site',true), 
            							   'javascript:void(0);', 
            							   array('id' => 'link-Merchant-to-site'));
            		?>	
				</div>
            	
				<div class="item">
					<?php 
            			echo $this->Html->link(__('Remove',true), 
            							   'javascript:void(0);', 
            							   array('id' => 'remove-Merchant'));
            		?>	
				</div>
                
                <div class="item last">
	            	<?php 
	            		echo $this->Html->link(__('Unlink',true), 
	            							'javascript:void(0);', 
	            							array('id' => 'unlnk-merchants-sites'));
	            	?>	
                </div>
				
            	<?php }else{?>
                
                <div class="item last">
            		<?php 
            			echo $this->Html->link(	__('Unlink',true), 
            								'javascript:void(0);', 
            								array(	'id' => 'unlink-merchant', 
            										'siteid' => $siteid));
            		?>	
                </div>
                
            	<?php }?>
                
                <div class="searchBar">
					
					<div class="title">
                    	<?php __('Search');?>
                    </div>
					<?php
						echo $this->Form->create('Merchant', array(
										'method'=>'post',
										'inputDefaults' => array(
															'label' => false,
															'div' => false
													)
											)
									);
							echo $this->Form->input('search', array('class' => 'input'));
							
							if($view == 'admin_widget_manage_merchants'){
							
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/merchants/widget_manage_merchants",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'value' => 0,
											'class' => 'btn')
										);
							}else{
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/merchants/widget_manage_site_merchants/{$siteid}",
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
			
			</div>
                
            <div class="allMerchants-widget-container">
				<?php 
					echo $this->element('widget-backoffice-manage-merchants-list');
				?>	
            </div>
		</div>
	</div>
</div>
	<script>

	$(document).ready(function(){

		if($("#widget-dailog-container").length <= 0)
		{
			$("#widget-main-mid-top-container").append('<div class="popup-container" title="Merchant Operations" id="widget-dailog-container"></div>');
		}
		else
		{
			$("#widget-dailog-container").attr('title', 'Merchant Operations');
		}

		// Dialog			
		$('#widget-dailog-container').dialog({
			autoOpen: false,
			width: 650,
			modal: true,
			resizable: false,
			buttons: {}
		});
		
		$("#create-merchant").click(function(){

			var container = 'widget-main-mid-top-container';
			$.get("/<?php echo $this->params['prefix'];?>/merchants/widget_merchants_add/" + container, function(data){
				$("#widget-main-mid-top-container").html('');
				$("#widget-main-mid-bottom-container").html('');
				$("#widget-main-mid-bottom-container").html(data);
			});
		});

		$("#link-Merchant-to-site").click(function(){
			var merchants = [];
			$('input[type="checkbox"]:checked').each(function(){
				merchants.push($(this).val());
			});

			if(merchants.length <= 0){
				alert("<?php __('no merchant selected.');?>");
				return false;
			}

			$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/merchants/widget_merchants_lnk_to_site/' + merchants.join());		
			$('#widget-dailog-container').dialog('open');
		});

		$("#unlink-merchant").click(function(){
			var merchants = [];
			$('input[type="checkbox"]:checked').each(function(){
				merchants.push($(this).val());
			});

			if(merchants.length <= 0){
				alert("<?php __('no merchant selected.');?>");
				return false;
			}

			var siteid = $(this).attr('siteid');
			$.get("/<?php echo $this->params['prefix'];?>/merchants/widget_merchants_unlink/" + merchants.join() + "/" + siteid, 
				function(data){
				$.get("<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>", function(data){
					$("#widget-main-mid-top-container").html(data);	
				});
			});

		});

		//remove-Merchant
		$("#remove-Merchant").click(function(){
			var merchants = [];
			$('input[type="checkbox"]:checked').each(function(){
				merchants.push($(this).val());
			});

			if(merchants.length <= 0){
				alert("<?php __('no merchant selected.');?>");
				return false;
			}

			var res = confirm("<?php __('Do you really want to remove selected merchant(s)?');?>");
			if(!res){
				return false;
			}

			$.get("/<?php echo $this->params['prefix'];?>/merchants/remove/" + merchants.join(), function(){

				$.get("<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>", function(data){
					$("#widget-main-mid-top-container").html('');
					$("#widget-main-mid-top-container").html(data);	
				});
			});
		});

		// unlink merchants
		$("#unlnk-merchants-sites").click(function(){
			var merchants = [];
			$('input[type="checkbox"]:checked').each(function(){
				merchants.push($(this).val());
			});

			if(merchants.length <= 0){
				alert("<?php __('no merchant selected.');?>");
				return false;
			}

			$("#widget-dailog-container").load("/<?php echo $this->params['prefix'];?>/merchants/widget_merchants_just_unlink/" + merchants.join());		
			$('#widget-dailog-container').dialog('open');
		});
		
		$(".ui-dialog-titlebar-close, ").click(function() {
			$("#widget-dailog-container").html('');
		});
	});
	</script>
	<!-- SITE SETTTING END -->
