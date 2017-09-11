<?php 
	$this->Paginator->options(
				array('update' => '#widget-main-mid-top-container', 
					'evalScripts' => true));
?>
<div class="siteSetting-widget-container">
	
	<div class="content1-widget-container">
    	<div class="title">
        	<div class="txt"><?php __('News');?> &raquo;</div>
		</div>
    	
    	<div class="detail">
			
			<div class="allnotificationNews-widget-container">
	        	
	        	<div class="detail">
	            	<div class="menuBar">
	                	
	                	<div class="item">
	                		<a id="create-news" href="javascript:void(0);"><?php __('New News');?></a>
	                	</div>
	                    
	                    <div class="item last">
	                    	<a href="javascript:void(0);" id="news-remove"><?php __('Remove');?></a>
	                    </div>
					
					</div>
	        		
	        		<div class="action">
						<?php echo $this->element('widget-backoffice-pagination');?>
	        		</div>
	                
	                <?php foreach($news as $bNews){?>
	                <div class="notificationNews-widget-container">
	                	<div class="txt">
	                    	<input type="checkbox" value="<?php echo $bNews['News']['id'];?>">
	                        <?php echo $bNews['News']['title'];?>
	                        <span>
	                        	<a href="javascript:void(0);" name="remove" newsid="<?php echo $bNews['News']['id'];?>"><?php __('Remove');?></a>
	                        </span>
	                        <span>
	                        	<a href="javascript:void(0);" name="edit" newsid="<?php echo $bNews['News']['id'];?>"><?php __('Edit');?></a>
	                        </span>
	                        <span class="last"><?php __("Created at") . " : {$bNews['News']['created']}";?></span>
						</div>
					</div>
					<?php }?>
	        		<div class="action">
						<?php echo $this->element('widget-backoffice-pagination');?>
	        		</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $this->Js->writeBuffer();?>
	<script type="text/javascript">
		$(document).ready(function(){

			// Create Link
			$("#create-news").click(function(){
				$("#widget-main-mid-bottom-container").html('');
				$.get('<?php echo "/{$this->params['prefix']}/news/add";?>', function(data){
					$("#widget-main-mid-bottom-container").html(data);	
				});
			});

			// Edit Link
			$('.detail .notificationNews-widget-container .txt span a[name="edit"]').click(function(){

				var newsid = $(this).attr('newsid');
				$("#widget-main-mid-bottom-container").html('');
				$.get('<?php echo "/{$this->params['prefix']}/news/edit/";?>' + newsid, function(data){
					$("#widget-main-mid-bottom-container").html(data);	
				});
			});

			// single Remove
			$('.detail .notificationNews-widget-container .txt span a[name="remove"]').click(function(){

				var res = confirm("<?php __('Are you sure?');?>");
				if(!res){
					return false;
				}
				
				var newsid = $(this).attr('newsid');
				$.get("/<?php echo $this->params['prefix'];?>/news/remove/" + newsid, function(data){

					$("#widget-mid-loading").toggle();
					$.get('<?php echo "/{$this->params['prefix']}/news/index/";?>', function(content){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-bottom-container").empty();
						$("#widget-main-mid-top-container").empty();
						$("#widget-main-mid-top-container").html(content);
					});
				});
				
			});

			// Bulk remove
			$("#news-remove").click(function(){

				var news = [];
				$('input[type="checkbox"]:checked').each(function(){
					news.push($(this).val());
				});

				if(news.length <= 0){
					alert("no news selected.");
					return false;
				}

				var res = confirm("<?php __('Are you sure to remove selected news?');?>");
				if(!res){
					return false;
				}

				$.get("/<?php echo $this->params['prefix'];?>/news/remove/" + news.join(), function(data){

					$("#widget-mid-loading").toggle();
					$.get('<?php echo "/{$this->params['prefix']}/news/index/";?>', function(content){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-bottom-container").empty();
						$("#widget-main-mid-top-container").empty();
						$("#widget-main-mid-top-container").html(content);
					});
				});
			});
		});
	</script>


</div>