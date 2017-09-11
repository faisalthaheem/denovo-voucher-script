	<?php 
		$this->Paginator->options(
					array(	'update' => '#widget-main-mid-top-container', 
							'evalScripts' => true)); 
	
	?>
	<div class="action">
		<?php echo $this->element('widget-backoffice-pagination');?>
	</div>
	<div class="detail">
	
	<?php //debug($users); 
		$i = 0;
		foreach($users as $User):
			$class = "userInfo-widget-container";
			$i++;
			if($i%3 == 0){
				$class = "userInfo-widget-container adjust";
			}
	?>                        	
		<!-- USER INFO START -->
        <div class="<?php echo $class;?>">
        	<div class="left">
            	<div class="img">
                	<img src = "/files/pictures/<?php echo $User['Vwusersbrowse']['profilePicture'];?>" alt="<?php echo "{$User['Vwusersbrowse']['fullname']}'s Photo";?>" width="108px" height="81px"/>
				</div>
			</div>
			<div class="right">
				<div class="description">
		        	<h4>
		        	<?php 
		        		echo $this->Js->link("{$User['Vwusersbrowse']['fullname']}",
		        						"/{$this->params['prefix']}/users/view_user_profile/{$User['Vwusersbrowse']['id']}",
		        						array('update' => "#widget-main-mid-top-container")
		        					);
		        	?>
		        	</h4>
		            <p>
		            	<?php echo "{$User['Vwusersbrowse']['gender']} | {$User['Vwusersbrowse']['age']}";?>
		            	<br /> 
		            	<?php echo "{$User['Vwusersbrowse']['nationality']}";?>
		            	</p>
				</div>
				<div class="action">
		        	
		        	<div class="txt">
		        		<?php echo $this->element('widget-backoffice-activate-user', 
		        										array(
											        		'isActive' => $User['Vwusersbrowse']['active'], 
											        		'user_id' => $User['Vwusersbrowse']['id']));?>
					
					</div>
					
					<span>|</span>
		            
		            <div class="txt">
						<?php 
		        			echo $this->Html->link(
		        								__("Remove",true), 
		        								"javascript:void(0);", 
		        								array('userid' => "{$User['Vwusersbrowse']['id']}"));
						?>		            	
					</div>
				
				</div>
			</div>
			<div class="bottom">
		    	<div class="row">
		        	<div class="message">
		            	<a href="#"><?php __('Conversations');?></a>
		            	<span><?php echo "{$User['Vwusersbrowse']['convCount']}";?></span>
					</div>
					<div class="abuse"><?php echo "{$User['Vwusersbrowse']['fconvCount']}";?></div>
				</div>
				<div class="row remove">
		        	<div class="picture">
		            	<a href="#"><?php __('Pictures');?></a><span><?php echo "{$User['Vwusersbrowse']['pictureCount']}";?></span>
					</div>
					<div class="abuse"><?php echo "{$User['Vwusersbrowse']['fpictureCount']}";?></div>
				</div>
				<!-- 
				<div class="row remove">
		        	<div class="video">
		            	<a href="#">Videos</a><span>125</span>
					</div>
		            <div class="abuse">135</div>
				</div>
				 -->
			</div>
		</div>
		<!-- USER INFO END -->
	<?php endforeach;?>
	
	<?php
		echo $this->Js->writeBuffer(); 
	?>                                            
	
	<script type="text/javascript">
		$(document).ready(function(){
			$(".userInfo-widget-container .action .txt a").click(function(){

				var userid;
				if($(this).attr('userid').length == 0)
				{
					return false;
					
				}else{
					
					userid = $(this).attr('userid');
				}

				// confirmation
				var res = confirm("<?php __('Are you sure to remove this user?');?>");
				if(!res){
					return false;
				}
				
				$.get("/<?php echo $this->params['prefix'];?>/users/remove_user/" + userid, function(data){
				<?php if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['users'])){?>

					$.get("<?php echo $_SESSION['backurls']['users'];?>", function(view){
						$("#widget-main-mid-top-container").html('');
						$("#widget-main-mid-top-container").html(view);
					});	
				<?php }?>
				});
			});
		});
	</script>
	
	</div>
	<div class="action">
		<?php echo $this->element('widget-backoffice-pagination');?>
	</div>
