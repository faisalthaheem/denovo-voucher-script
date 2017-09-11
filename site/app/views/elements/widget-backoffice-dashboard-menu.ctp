    <!-- DASHBOARD START -->
    <div class="dashboard-container">
	    
	    <div class="title">
        	<div class="txt">
            	<?php __('Dashboard');?> &raquo;
            </div>
        </div>
        
        <div class="detail">
        	
        	<li class="active">
            	<a href="javascript:void(0);" id='dashboard-manage-categories'>
                    <div class="img">
                    	<?php 
                    		echo $this->Html->image('backoffice/dashboard-item1.png', array('border' => 0));
                    	?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Categories');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);"  id='dashboard-manage-merchants'>
                    <div class="img">
                    	<?php 
                    		echo $this->Html->image('backoffice/dashboard-item2.png', array('border' => 0));
                    	?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Merchants');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);"  id='dashboard-manage-vouchers'>
                    <div class="img">
	                  <?php 
	                  		echo $this->Html->image('backoffice/dashboard-item4.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Vouchers');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);"  id='dashboard-create-category'>
                    <div class="img">
	                  <?php 
	                  		echo $this->Html->image('backoffice/dashboard-item6.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Add Category');?></div>
                    </div>
                </a>
            </li>
            <li>
            	<a href="javascript:void(0);"  id='dashboard-create-merchant'>
                    <div class="img">
	                  <?php 
	                  		echo $this->Html->image('backoffice/dashboard-item7.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Add Merchant');?></div>
                    </div>
                </a>
            </li>
            <li>
            	<a href="javascript:void(0);"  id='dashboard-create-voucher'>
                    <div class="img">
	                	<?php 
	                  		echo $this->Html->image('backoffice/dashboard-item9.png', array('border' => 0));
	                  	?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Add Voucher');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);"  id='dashboard-manage-images'>
                    <div class="img">
	                	<?php 
	                  		echo $this->Html->image('backoffice/dashboard-item15.png', array('border' => 0));
	                  	?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Banners &amp; Logos');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);" id='dashboard-manage-users'>
                    <div class="img">
                  		<?php 
                  			echo $this->Html->image('backoffice/dashboard-item12.png', array('border' => 0));
                  		?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Users');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);" id="dashboard-marketplace">
                    <div class="img">
	                  <?php 
	                  	echo $this->Html->image('backoffice/dashboard-item21.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Market Place');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);" id="dashboard-news">
                    <div class="img">
	                  <?php 
	                  	echo $this->Html->image('backoffice/news.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('News');?></div>
                    </div>
                </a>
            </li>

            <li>
            	<a href="javascript:void(0);" id="dashboard-pages">
                    <div class="img">
	                  <?php 
	                  		echo $this->Html->image('backoffice/cms-icon.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('CMS');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);" id="dashboard-mange-sites">
                    <div class="img">
	                  <?php 
	                  		echo $this->Html->image('backoffice/sites-management.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Sites');?></div>
                    </div>
                </a>
            </li>
            
            <li>
            	<a href="javascript:void(0);" id="dashboard-mange-subscribers">
                    <div class="img">
	                  <?php 
	                  		echo $this->Html->image('backoffice/dashboard-subscriber-management.png', array('border' => 0));
	                  ?>
                    </div>
                    <div class="title">
                    	<div class="txt"><?php __('Subscribers');?></div>
                    </div>
                </a>
            </li>            
        
        </div>
	
		<script type="text/javascript">

			function toggleAjaxLoad(){
				$("#widget-mid-loading").toggle();
			}
			
			$(document).ready(function(){

				// Manage Catgories
				$("#dashboard-manage-categories").click(function(){
					
					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();

					$("#widget-mid-loading").toggle();
					$.get('/<?php echo $this->params['prefix'];?>/categories/widget_manage_categories/0', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					}); 
				});						
				
				// Manage Merchants
				$("#dashboard-manage-merchants").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('/<?php echo $this->params['prefix'];?>/merchants/widget_manage_merchants/0', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					}); 
				});						
				
				// Manage Vouchers
				$("#dashboard-manage-vouchers").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('/<?php echo $this->params['prefix'];?>/cods/widget_manage_cods/0', function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					}); 
				});						

				// Manage Users
				$("#dashboard-manage-users").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('/<?php echo $this->params['prefix'];?>/users/widget_users/', function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					}); 
				});
				
				// Create Category
				$("#dashboard-create-category").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get("/<?php echo $this->params['prefix'];?>/categories/widget_categories_add/", function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-bottom-container").html(data);
					});
				});
				
				// Create Merchant
				$("#dashboard-create-merchant").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get("/<?php echo $this->params['prefix'];?>/merchants/widget_merchants_add/", function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-bottom-container").html(data);
					});					
				});

				// Create Voucher
				$("#dashboard-create-voucher").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get("/<?php echo $this->params['prefix'];?>/cods/widget_cods_add/", function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-bottom-container").html(data);
					});					
				});

				//Manage Sites
				$("#dashboard-mange-sites").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get("/<?php echo $this->params['prefix'];?>/sites/manage_sites", function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					});					
				});
				
				// manage banners and logos
				$("#dashboard-manage-images").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('<?php echo "/{$this->params['prefix']}/pictures/index/"; ?>', function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					});					
				});

				// Market Place
				$("#dashboard-marketplace").click(function(){
					alert("<?php __('coming soon');?>");
				});

				// news
				$("#dashboard-news").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('<?php echo "/{$this->params['prefix']}/news/index/"; ?>', function(data){

						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					});					
				});
				
				// CMS						
				$("#dashboard-pages").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('/<?php echo $this->params['prefix'];?>/sites/manage_content/', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					}); 
				});

				// CMS						
				$("#dashboard-mange-subscribers").click(function(){

					$("#widget-main-mid-top-container").show();
					$("#widget-main-mid-top-container").empty();
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-mid-loading").toggle();
					$.get('/<?php echo $this->params['prefix'];?>/subscriptions/index/', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);
					}); 
				});				

			});
		</script>
	
	</div>
	<!-- DASHBOARD END -->
