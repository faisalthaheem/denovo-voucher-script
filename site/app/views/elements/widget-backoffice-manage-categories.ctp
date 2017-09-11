<div class="siteSetting-widget-container">	
	<div class="content1-widget-container">
    	<div class="title">
        	
        	<div class="txt"><?php __('Category Management');?> &raquo;</div>
    		
    		<div class="txt2">
			<?php 
				if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['sites']) && $view == 'admin_widget_manage_site_categories'):    		
					echo $this->Js->link(
										"Back" ,
										"/{$_SESSION['backurls']['sites']}", 
										array('update' => '#widget-main-mid-top-container')); 
				endif;
			?>
    		</div>
		
		</div>
        
        <div class="detail" id="category-management-details-container">
        	
        	<div class="menuBar">
            	<?php if($view == 'admin_widget_manage_site_categories'){?>
                <div class="item last">
	            	<?php 
	            		echo $this->Html->link(__('Unlink',true), 'javascript:void(0);', array('id' => 'unlink-cat', 'siteid' => $siteid));
	            	?>	
                </div>
            	
	            <?php }else{?>
            	
            	<div class="item">
	            	<?php 
	            		echo $this->Html->link(__('Create',true), 'javascript:void(0);', array('id' => 'add-category'));
	            	?>	
            	</div>
                <div class="item">
	            	<?php 
	            		echo $this->Html->link(__('Merge &amp; Remove',true), 'javascript:void(0);', array('id' => 'merge-category', 'escape'=>false));
	            	?>	
                </div>
                
                <div class="item">
	            	<?php 
	            		echo $this->Html->link(__('Link To Site',true), 'javascript:void(0);', array('id' => 'lnk-cat-site'));
	            	?>	
                </div>
                
                <div class="item last">
	            	<?php 
	            		echo $this->Html->link(__('Unlink',true), 'javascript:void(0);', array('id' => 'unlnk-cats-sites'));
	            	?>	
                </div>
                
                <?php }?>
                
                <div class="searchBar">
                	<div class="title">
                    	<?php __('Search');?>
					</div>
					<?php 
						echo $this->Form->create('Category', array(
										'method'=>'post',
										'inputDefaults' => array(
															'label' => false,
															'div' => false
													)
											)
									);
							echo $this->Form->input('search', array('class' => 'input'));
							
							if($view == 'admin_widget_manage_site_categories'){
							
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/categories/widget_manage_site_categories/{$siteid}",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'value' => '',
											'class' => 'btn'
											)
									);
							
							}else{
								
								// search button
								echo $this->Js->submit('', array(
											'url' => "/{$this->params['prefix']}/categories/widget_manage_categories",
											'method'=> 'post',
											'update' => '#widget-main-mid-top-container',
											'div' => false,
											'value' => '',
											'class' => 'btn')
										);
							}
								
							echo $this->Form->end();
							echo $this->Js->writeBuffer();
					?>
				
				</div>
			</div>
            
            <div class="categories-widget-container">
				<?php 
					echo $this->element('widget-backoffice-manage-categories-list');
				?>	
			</div>
		</div>
	</div>
</div>

	<script>

	$(document).ready(function(){

		if($("#widget-dailog-container").length <=0 )
		{
			$("#widget-main-mid-top-container").append('<div class="popup-container" title="<?php __('Category Operations');?>" id="widget-dailog-container"></div>');
		}

		// Dialog			
		$('#widget-dailog-container').dialog({
			autoOpen: false,
			width: 650,
			modal: true,
			resizable: false,
			buttons: {}
		});
		
		$("#add-category").click(function(){
			var container = 'widget-main-mid-top-container';
			$.get("/<?php echo $this->params['prefix'];?>/categories/widget_categories_add/" + container, function(data){
				$("#widget-main-mid-top-container").empty();
				$("#widget-main-mid-bottom-container").empty();
				$("#widget-main-mid-bottom-container").html(data);
			});
		});

		$("#merge-category").click(function(){

			var cats = [];
			$('input[type="checkbox"]:checked').each(function(){
			    cats.push($(this).val());
			});

			if(cats.length <= 0){
				alert("<?php __('No category selected.');?>");
				return false;
			}

			var res = confirm("<?php __('Are you sure to Merge & Remove selected categories?');?>");
			if(!res){
				return false;
			}
			
			$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/categories/widget_category_merge/' + cats.join());		
			$('#widget-dailog-container').dialog('open');
		});

		$("#lnk-cat-site").click(function(){
			var cats = [];
			$('input[type="checkbox"]:checked').each(function(){
			    cats.push($(this).val());
			});

			if(cats.length <= 0){
				alert("<?php __('No category selected.');?>");
				return false;
			}

			$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/categories/widget_category_lnk_to_site/' + cats.join());		
			$('#widget-dailog-container').dialog('open');
		});

		$("#unlink-cat").click(function(){
			var cats = [];
			$('input[type="checkbox"]:checked').each(function(){
			    cats.push($(this).val());
			});

			if(cats.length <= 0){
				alert("<?php __('No category selected.');?>");
				return false;
			}

			var siteid = $(this).attr('siteid');
			
			$.get("/<?php echo $this->params['prefix'];?>/categories/widget_categories_unlink/" + cats.join() + "/" + siteid, function(html){
				$.get("<?php echo $_SESSION['Auth']['ManageCategoriesURL'];?>", function(data){
					$('#widget-main-mid-top-container').html(data);	
				});
			});
		});
		
		$("#unlnk-cats-sites").click(function(){
			var cats = [];
			$('input[type="checkbox"]:checked').each(function(){
			    cats.push($(this).val());
			});

			if(cats.length <= 0){
				alert("<?php __('No category selected.');?>");
				return false;
			}

			$("#widget-dailog-container").load("/<?php echo $this->params['prefix'];?>/categories/widget_categories_just_unlink/" + cats.join());		
			$('#widget-dailog-container').dialog('open');
		});
		

		$(".ui-dialog-titlebar-close").click(function() {
			$("#widget-dailog-container").html('');
		});
	});
	</script>
