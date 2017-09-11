    <!-- NAVIGATION START -->
    <div class="navigation-container">
    	
    	<li>
    		<a class="active" href="javascript:void(0);" id="tp-home"><?php __('Home');?></a>
			<script type="text/javascript">
				$(document).ready(function(){
	
					$("#tp-home").click(function(){

						$("#widget-main-mid-top-container").show();
						$("#widget-main-mid-top-container").empty();
						$("#widget-main-mid-bottom-container").empty();
						$("#widget-mid-loading").toggle();
						$.get("/<?php echo $this->params['prefix'];?>/users/widget_welcome", function(data){
							$("#widget-mid-loading").toggle();
							$("#widget-main-mid-top-container").html(data);
						});
					});
				});
			</script>	    
    	</li>
		
	    <div class="breakLine"></div>
        
        <li>
       		<a href="javascript:;"><?php __('Configuration');?></a>
            <ul>
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-sites"><?php __('Sites');?></a>
					<script type="text/javascript">

						$(document).ready(function(){
							$("#tp-manage-sites").click(function(){
								$("#widget-main-mid-top-container").show();
								$("#widget-main-mid-top-container").empty();
								$("#widget-main-mid-bottom-container").empty();
								$("#widget-mid-loading").toggle();
								$.get("/<?php echo $this->params['prefix'];?>/sites/manage_sites", function(data){
									$("#widget-mid-loading").toggle();
									$("#widget-main-mid-top-container").html(data);
								});
							});
						});
					</script>	    
            	</li>
            	
            	<li>
            		<a href="javascript:void(0);" id="tp-plugins-configuration"><?php __('Vouchers Import Plugins');?></a>
					<script type="text/javascript">
						$(document).ready(function(){
			
							$("#tp-plugins-configuration").click(function(){
			
								$("#widget-main-mid-top-container").show();
								$("#widget-main-mid-top-container").empty();
								$("#widget-main-mid-bottom-container").empty();
								$("#widget-mid-loading").toggle();
								$.get("/<?php echo $this->params['prefix'];?>/pluginsconfigurations/index", function(data){
									$("#widget-mid-loading").toggle();
									$("#widget-main-mid-top-container").html(data);
								});
							});
						});
					</script>	    
            	</li>
            </ul>
		</li>
	    	<div class="breakLine"></div>
        <li>
        	<a href="javascript:void(0);"><?php __('Content Management');?></a>
            <ul>
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-categories"><?php __('Categories');?></a>
					<script type="text/javascript">
						$(document).ready(function(){
							$("#tp-manage-categories").click(function(){

								$("#widget-main-mid-top-container").show();
								$("#widget-main-mid-top-container").empty();
								$("#widget-main-mid-bottom-container").empty();
								$("#widget-mid-loading").toggle();

								$.get('/<?php echo $this->params['prefix'];?>/categories/widget_manage_categories/0', function(data){
									$("#widget-mid-loading").toggle();
									$("#widget-main-mid-top-container").html(data);
								}); 
							});						
						});
            		</script>
            	</li>
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-merchants"><?php __('Merchants');?></a>
					<script type="text/javascript">
						$(document).ready(function(){
							$("#tp-manage-merchants").click(function(){

								$("#widget-main-mid-top-container").show();
								$("#widget-main-mid-top-container").empty();
								$("#widget-main-mid-bottom-container").empty();
								$("#widget-mid-loading").toggle();

								$.get('/<?php echo $this->params['prefix'];?>/merchants/widget_manage_merchants/0', function(data){

									$("#widget-mid-loading").toggle();
									$("#widget-main-mid-top-container").html(data);
								}); 
							});						
						});
            		</script>
            	</li>
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-vouchers"><?php __('Vouchers');?></a>
					<script type="text/javascript">
						$(document).ready(function(){
							$("#tp-manage-vouchers").click(function(){

								$("#widget-main-mid-top-container").show();
								$("#widget-main-mid-top-container").empty();
								$("#widget-main-mid-bottom-container").empty();
								$("#widget-mid-loading").toggle();

								$.get('/<?php echo $this->params['prefix'];?>/cods/widget_manage_cods/0', function(data){

									$("#widget-mid-loading").toggle();
									$("#widget-main-mid-top-container").html(data);
								}); 
							});
						});
            		</script>
            	</li>
            	
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-users"><?php __('Users');?></a>
            		<script>
	    				// Manage Users
	    				$("#tp-manage-users").click(function(){
	
							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();
	    					$.get('/<?php echo $this->params['prefix'];?>/users/widget_users/', function(data){
	
	    						$("#widget-mid-loading").toggle();
	    						$("#widget-main-mid-top-container").html(data);
	    					}); 
	    				});
            		
            		</script>
            	</li>
            	
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-pages"><?php __('CMS');?></a>
            		<script>
	    				// Manage Users
	    				$("#tp-manage-pages").click(function(){
	
							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();
	    					$.get('/<?php echo $this->params['prefix'];?>/sites/manage_content/', function(data){
	
	    						$("#widget-mid-loading").toggle();
	    						$("#widget-main-mid-top-container").html(data);
	    					}); 
	    				});
            		
            		</script>
            	</li>

            	<li>
            		<a href="javascript:void(0);" id="tp-manage-news"><?php __('News');?></a>
            		<script>
	    				// Manage News
	    				$("#tp-manage-news").click(function(){
	
							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();

							$.get('<?php echo "/{$this->params['prefix']}/news/index/"; ?>', function(data){
								$("#widget-mid-loading").toggle();
								$("#widget-main-mid-top-container").html(data);
							});					
	    				});
            		
            		</script>
            	</li>
            	
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-images"><?php __('Banners &amp; Logos');?></a>
            		<script>
	    				// Manage News
	    				$("#tp-manage-images").click(function(){
	
							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();

							$.get('<?php echo "/{$this->params['prefix']}/pictures/index/"; ?>', function(data){
								$("#widget-mid-loading").toggle();
								$("#widget-main-mid-top-container").html(data);
							});					
	    				});
            		
            		</script>
            	</li>
            
            	<li>
            		<a href="javascript:void(0);" id="tp-manage-subscribers"><?php __('Subscribers');?></a>
            		<script>
	    				// Manage News
	    				$("#tp-manage-subscribers").click(function(){
	
							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();

							$.get('<?php echo "/{$this->params['prefix']}/subscriptions/index/"; ?>', function(data){
								$("#widget-mid-loading").toggle();
								$("#widget-main-mid-top-container").html(data);
							});					
	    				});
            		
            		</script>
            	</li>            
            </ul>
        </li>
	    
	    <?php 
	    	if(isset($plugins_list) && !empty($plugins_list)){
	    ?>
		    <div class="breakLine"></div>
	        
	        <li>
	        	<a href="javascript:void(0);"><?php __('Plugins');?></a>
	            <ul>
				
	    		<?php foreach($plugins_list as $Plugin):?>	            	
	            	
	            	<li>
						<a href="javascript:void(0);" id="<?php echo $Plugin;?>">
						<?php echo ucfirst($Plugin);?>
						</a>	            	
	            	</li>
					<script type="text/javascript">
						$("#<?php echo $Plugin;?>").click(function(){
	
							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();

	    					$.get('<?php echo "/{$this->params['prefix']}/{$Plugin}/{$Plugin}/index";?>', function(data){

	    						$("#widget-mid-loading").toggle();
	    						$("#widget-main-mid-top-container").html(data);

		    				}); 
						});            		
					</script>
	            
				<?php endforeach;?>
	            
	            </ul>
	        </li>
	    
	    <?php 
	    	}
	    ?>
	    
	    <div class="breakLine"></div>
        
        <li>
        	<a href="javascript:void(0);"><?php __('Help');?></a>
            <ul>
            	<li><a href="http://blog.voucherscript.com/" target="_blank"><?php __('Blog');?></a></li>
            	<li><a href="http://talk.voucherscript.com/" target="_blank"><?php __('Forums');?></a></li>
            </ul>
        </li>
    	<div class="breakLine"></div>
        <li>
        	<a href="javascript:void(0);"><?php __('About');?></a>
            <ul>
            	<li>
            		<a href="javascript:void(0);" id='tp-about-dvs'><?php __('DVS');?></a>
            		<script type="text/javascript">
						$("#tp-about-dvs").click(function(){

							$("#widget-main-mid-top-container").show();
							$("#widget-main-mid-top-container").empty();
							$("#widget-main-mid-bottom-container").empty();
							$("#widget-mid-loading").toggle();
	    					$.get('/<?php echo $this->params['prefix'];?>/pages/about_us', function(data){

	    						$("#widget-mid-loading").toggle();
	    						$("#widget-main-mid-top-container").html(data);
	    					}); 
						});            		
            		</script>
            	</li>
            </ul>
        </li>
    <?php echo $this->Js->writeBuffer();?>
    </div>
    <!-- NAVIGATION END -->    