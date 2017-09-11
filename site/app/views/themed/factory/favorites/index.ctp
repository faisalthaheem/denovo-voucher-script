<!-- MY FAVOURITE Widget Start -->
<div class="my-favourite-widget-container container-highlight" id="my-favourite-widget-container">
  <div class="my-favourite-widget-title">
      <?php __('My Favourite');?>
  </div>
  
  <div class="my-favourite-widget-detail">
  
  	<?php $i = 0; foreach($favorites as $favorite){ ?>
      <div id="<?php echo $favorite['FavoriteUser']['id'];?>" category="<?php echo $favorite['FavoriteUser']['category']; ?>" class="my-favourite-widget-detail-div" <?php echo (($i&1 == 1)? 'style="border-right:none;"':'');?> style="cursor:pointer;">
          <div class="my-favourite-widget-detail-div-left">
              <div class="my-favourite-widget-detail-div-left-img">
                  <?php
                  	echo $this->Html->image('/files/pictures/' . $favorite['FavoriteUser']['Picture'][0]['filename'], array(
                  		'border' => 0
                  	)); 
                  ?>
              </div>
          </div>
          <div class="my-favourite-widget-detail-div-right">
              <table width="180" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <th colspan="2">
                  	<?php echo $favorite['FavoriteUser']['fullname']; ?>
                  </th>
                </tr>
                <tr>
                  <td width="105"><?php __('Gender');?> :</td>
                  <td width="62">
                  	<span class="blue-txt">
                  		<?php echo $favorite['FavoriteUser']['gender']; ?>
                  	</span>
                  </td>
                </tr>
                <tr>
                  <td><?php __('Age');?> :</td>
                  <td>
                  	<span class="blue-txt">
                  		<?php
                  			$dobdate = date_parse($favorite['FavoriteUser']['dob']);
                  			$currdate= date_parse(date('Y-m-d'));
                  			echo $currdate['year'] - $dobdate['year']; 
                  		?>
                  	</span>
                  </td>
                </tr>
                <tr>
                	<td>
                  		<div class="send-message">
                        	<a href="#" class="blackLink"><?php __('Send Message');?></a>                                    
                    	</div>                                  
                    </td>
                  	<td>
                    	<div class="delete">
                        	<a href="#" class="blackLink"><?php __('Delete');?></a>                                    
                        </div>                                  
					</td>
                </tr>
            </table>
          </div>
      </div>
    <?php $i++;} ?>
  </div>
  
  
	<div class="my-favourite-widget-action">
   		<?php $this->Paginator->options(array(	'update' => '#left-panel-container-mid-panel-container', 
   												'evalScripts' => true,
   												'before' => 'favorite_contacts_ajaxload();')); ?>
      
		<div class="pagination">
 			<?php echo $this->Paginator->prev('Previous', null, null, array('class' => 'prev-disabled')); ?>
 			<?php echo $this->Paginator->next('Next', null, null, array('class' => 'next-disabled')); ?>             
		</div>
  	</div>
  <?php
  	echo $this->Js->writeBuffer(); 
  ?>
  <script type="text/javascript">
  	jQuery(".my-favourite-widget-detail-div").click(function(){

		jQuery("#my-favourite-widget-container-profile").fadeToggle("slow", "linear");

		if(jQuery(this).attr("category") == "Creative" || jQuery(this).attr("category") == "Performer")
		{
	  		jQuery.get('/users/widget_profile/' + jQuery(this).attr("id"), function(markup){
	  	  		jQuery("#my-favourite-widget-container-profile").html(markup);
	  			jQuery("#my-favourite-widget-container-profile").fadeToggle("slow", "linear");
	  		});
		}
		else if(jQuery(this).attr("category") == "Technical" || jQuery(this).attr("category") == "ServiceProvider")
		{
	  		jQuery.get('/users/widget_providerprofile/' + jQuery(this).attr("id"), function(markup){
	  	  		jQuery("#my-favourite-widget-container-profile").html(markup);
	  			jQuery("#my-favourite-widget-container-profile").fadeToggle("slow", "linear");
	  		});
		}
  	});

  	function favorite_contacts_ajaxload()
  	{
  		jQuery("#my-favourite-widget-container").toggle();
		jQuery("#fav-users-container-loading").toggle();
  	}  
  
  </script>
</div>
 <div id="my-favourite-widget-container-profile" style="display:block;">
 <!-- View Profile Container -->
 </div>

  <?php 
  	echo $this->element('widget-ajax-loading', array('div_dom_id' => 'fav-users-container-loading'))
  ?>
<!-- MY FAVOURITE Widget END -->