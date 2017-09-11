<?php
	//debug($conversations,true); 
?>
<?php
	//pagination setup
	$this->Paginator->options(array(
		'update' => '#mid-container-left-panel',
		'evalScripts' => true
	)); 
?>
<!-- INOBX Widget Start -->
<div class="inbox-widget-container container-highlight">
      <div class="inbox-widget-title"><?php __('Conversations');?></div>
		<div class="action">
			<?php
				echo $this->element('widget-paging-standard'); 
			?>
		</div>      
      <div class="inbox-widget-detail">

        <!-- MESSAGE BOX START -->
        <?php foreach($conversations as $conversation): ?>
        <div class="inbox-widget-message-box">
            <div class="inbox-widget-message-box-left">
                <div class="inbox-widget-message-check-box">
                    <!-- <input type="checkbox"/>  -->
                </div>
                <div class="inbox-widget-message-img">
	                  <?php
	                  	if(!empty($conversation['Message'][0]['User']['Picture'])){
		                  	echo $this->Html->image(
		                  		$this->Picturescomponent->getPathToPicture($conversation['Message'][0]['User']['Picture'][0]['uuidtag'], Configure::read('PictureTags.TinyPicture'))
		                  		,array(
		                  			'border' => 0
		                  		)
		                  	); 
	                  	}
	                  ?>                	
                </div>
            </div>
            <div class="inbox-widget-message-box-right">
                <table width="410" border="0" cellpadding="0" cellspacing="0">
                  <tr>
                    <th colspan="2">
                    	<?php 
                    		echo $this->Js->link($conversation['Conversation']['subject'],
                    				"/conversations/detail/{$conversation['Conversation']['id']}"
                    				,array(
                    					'update' => '#mid-container-left-panel'
                    				)
                    			); 
                    	 ?>
                    </th>
                    <td width="241">
                    	<div class="date">
                    		[ <?php echo $conversation['Conversation']['created']; ?> ]
                    	</div>
                    </td>
                  </tr>
                  <tr>
                    <td colspan="3">
                    	<?php echo $conversation['Message'][0]['messagebody']; ?>
                    </td>
                  </tr>
                  <tr>
                    <td width="72"><div class="reply"><a href="" class="blueLink"></a></div></td>
                    <td width="74">
	                    <div class="delete">
	                    	<a href="#" class="blueLink widget-conversations-index-delete" id="<?php echo $conversation['Conversation']['id']; ?>">
	                    		<?php __('Delete');?>
	                    	</a>
	                    </div>
	                </td>
                    <td>&nbsp;</td>
                  </tr>
              </table>
            </div>
        </div>
        <?php endforeach;?>
        <!-- MESSAGE BOX END -->
        
      </div>
		<div class="action">
			<?php
				echo $this->element('widget-paging-standard'); 
			?>
		</div>
</div>
<!-- INBOX Widget END -->
<?php 
	echo $this->Js->writebuffer();
?>  
<script type="text/javascript">
	$(document).ready(function(){
		$(".widget-conversations-index-delete").click(function(){
			if(confirm("Are you sure you want to delete this conversation?"))
			{
				$.post("/conversations/delete/preventrender",
						{
							'data[Conversation][id]' : $(this).attr("id")
						},
						function(data){
							jQuery("#mid-container-left-panel").html(data);
						}
				);

				$("#mid-container-left-panel").load('<?php echo Router::url();?>');
			}
		});
	});
</script>