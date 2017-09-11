	<!-- widget-search-community-search-results => Element -->
	
	<!-- SEARCH RESULTS Widget Start -->
    <div class="search-results-widget-container search-result-highlight" id="search-results-widget-container">
		
		<div class="search-results-widget-title">
            <?php __('Search Results');?>
        </div>
        
        <div class="search-results-widget-detail">
        	
        	<?php
        		if(!isset($users[0])){ 
        	?>
            
            <span style="font-family: Arial,Helvetica,sans-serif;font-size: 13px;line-height: 26px;">
            	0 <?php __('matches');?>.
            </span>
        	
        	<?php 
        		}else{
        			
        			$i = 0;
        			foreach($users as $User):
        	?>
        	
        	<div id="<?php echo $User['User']['id'];?>" class="search-results-widget-detail-box" <?php echo (($i&1 == 1)? 'style="border-right:none;"':'');?> style="cursor:pointer;">
            	
            	<div class="search-results-widget-detail-box-left">
                	<div class="search-results-widget-detail-box-left-img">
						<?php

							if(isset($User['Picture'][0]))
							{ 
								
								echo $this->Html->image(
									$this->Picturescomponent->getPathToPicture($User['Picture'][0]['uuidtag'], Configure::read('PictureTags.TinyPicture'))
									,array('border' => 0)
								);
							}
							else
							{
								echo $this->Html->image('default-pic.jpg', array('border' => 0, 'width' => '51px', 'height' => '38px'));
							}
						?>                		
                	</div>
                    
                    <div class="search-results-widget-detail-box-left-icon">
                    	<!-- 
                    	<img src="img/artist-ico.png" border="0" />
                    	 -->
                    </div>
				</div>
                
                <div class="search-results-widget-detail-box-right">
                	<table width="180" border="0" cellpadding="0" cellspacing="0">
                    	<tr>
                      		<th colspan="2">
                      			<a href="javascript:void(0);" class="blackLink"><?php echo $User['User']['fullname'];?></a>
                      		</th>
                    	</tr>
                    	<tr>
                      		<td width="70"><?php __('Gender');?>:</td>
                      		<td width="120">
                      			<div class="search-results-widget-detail-box-right-txt"><?php echo $User['User']['gender'];?></div>
                      		</td>
                    	</tr>
                    	<tr>
                      		<td><?php __('Age');?>:</td>
                      		<td>
                      			<div class="search-results-widget-detail-box-right-txt"><?php echo $User['User']['age'];?></div>
                      		</td>
                    	</tr>
                  	</table>
				</div>
            
            </div>
			<?php
					$i++; 
					endforeach;
        		}// END-ELSE IF
			?>
            
    	</div>
	</div>
    
    <div class="search-results-widget-action">
        
   		<?php $this->Paginator->options(array(	'update' => '#left-panel-container-mid-panel-container-widget-search-community-search-results', 
   												'evalScripts' => true,
   												'before' => 'results_ajax_load();')); ?>
        
        <div class="pagination">
 			<?php echo $this->Paginator->prev('Previous', null, null, array('class' => 'prev-disabled')); ?>
 			<?php echo $this->Paginator->next('Next', null, null, array('class' => 'next-disabled')); ?>             
        </div>
    </div>
    
    <!-- SEARCH RESULTS Widget END -->
	
	<?php
		echo $this->element('widget-ajax-loading', array('div_dom_id'=>'widget-search-community-search-results-loading')); 
	?>
	
	<?php
		echo $this->Js->writeBuffer(); 
	?>
	
	<script type="text/javascript">

		function results_ajax_load()
		{
			jQuery("#widget-search-community-search-results-loading").toggle('fast');
		} 

		jQuery(".search-results-widget-detail-box").click(function(){

			jQuery("#search-user-profile-view-container").fadeToggle("slow", "linear");

	  		jQuery.get('/users/widget_profile/' + jQuery(this).attr("id"), function(markup){
	  	  		jQuery("#search-user-profile-view-container").html(markup);
	  	  		jQuery("#search-user-profile-view-container").fadeToggle("slow", "linear");
		  	});
	  	});
	
	</script>
    
	