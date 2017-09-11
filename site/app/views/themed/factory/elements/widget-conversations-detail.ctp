<?php 
//	debug($convMsgs,true);
?>

<!-- INOBX Widget Start -->
<div class="inbox-widget-container container-highlight">
	<div class="inbox-widget-title">
		<?php
			echo $convMsgs['Conversation']['subject']; 
		?>
		
		<?php if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['conversations'])): ?>
		<span>
			<?php
				echo $this->Js->link(
					__('<< Back',true)
					,$_SESSION['backurls']['conversations']
					,array(
						'update' => '#mid-container-left-panel'
					)
				); 
			?> 
		</span>
		<?php endif; ?>
	</div>
  <div class="inbox-widget-detail">

    <!-- REPLY BOX START -->
    <div class="inbox-widget-reply-container">
      <div class="inbox-widget-reply-message-div">
        <table width="518" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="70"><?php __('Reply');?></td>
            <th colspan="3">
            <textarea class="inbox-widget-reply-text" id="message-reply-text"></textarea>
            </th>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
            <td width="344">
	              <span id="message-delete-button"><?php __('Delete');?></span>
            </td>
            <th width="95">
            	<span id="message-reply-button"><?php __('Reply');?></span>
            </th>
          </tr>
        </table>
      </div>
	
        <!-- MESSAGE BOX START -->
        <?php
        foreach($convMsgs['Message'] as $msg){ 
        ?>
        <div class="inbox-widget-message-box">
            <div class="inbox-widget-message-box-left">
              <div class="inbox-widget-message-img">
	                  <?php
	                  	if(!empty($msg['User']['Picture'][0]['uuidtag'])){
		                  	echo $this->Html->image(
			                  	$this->Picturescomponent->getPathToPicture($msg['User']['Picture'][0]['uuidtag'],Configure::read('PictureTags.TinyPicture'))
			                  	, array(
			                  		'border' => 0
		                  		)
		                  	);
	                  	} 
	                  ?>                	
              </div>
         	</div>
            <div class="inbox-widget-message-box-right inbox-message-width-change">
                <table width="445" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <th width="146"><?php echo $msg['User']['fullname']; ?></th>
                    <td width="241"><div class="date">[ <?php echo $msg['created']; ?> ]</div></td>
                  </tr>
                  <tr>
                    <td colspan="2">
                    	<?php echo nl2br($msg['messagebody']); ?>
                    </td>
                  </tr>
              </table>
          </div>
        </div>
        <?php
        } 
        ?>
        <!-- MESSAGE BOX END -->

    </div>
    <!-- REPLY BOX END -->
  </div>
  
<script type="text/javascript">
	jQuery(document).ready(function() 
	{
		jQuery("#message-delete-button").button().click(function(){
			if(confirm("Are you sure you want to delete this conversation?"))
			{
				jQuery.post("/conversations/delete",
						{
							'data[Conversation][id]' : <?php echo $convMsgs['Conversation']['id'];?>
						},
						function(data){
							jQuery("#mid-container-left-panel").html(data);
						}
				);
			}
		});

		jQuery("#message-reply-button").button().click(function(){

			if(jQuery("#message-reply-text").val().length == 0)
			{
				alert("Cannot send an empty message.");
				jQuery("#message-reply-text").focus();
				return;
			}
			jQuery.post("/conversations/reply/",
					{
						'data[Conversation][id]' : <?php echo $convMsgs['Conversation']['id'];?>,
						'data[Message][messagebody]' : jQuery("#message-reply-text").val()
					},
					function(data){
						jQuery("#mid-container-left-panel").html(data);
					}
			);
		});		
	});
</script>
<?php 
	echo $this->Js->writebuffer();
?>  
</div>
<!-- INBOX Widget END -->
