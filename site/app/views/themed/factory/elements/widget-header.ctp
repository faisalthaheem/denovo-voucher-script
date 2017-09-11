        <div class="header">
        <cake:nocache>

        	<!-- Header Top Bar START -->
        	<div class="top-bar-container">
                <div class="download-div">
	                <a href="" class="yellowLINK"><?php __('Download our Toolbar');?></a>
                </div>
                
                <?php if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['User']) && !empty($_SESSION['Auth']['User'])):?>
      			<div class="socialCommunity-info-container">
	                <div class="friend-Div">
                    	<div class="img">
                    		<img src="/theme/factory/img/friend-icon.png" border="0" />
                    	</div>
                        <div class="txt">
                        	<?php __('Friends');?>
                        </div>
                        <div class="f-dropMenu-cotainer">
                            <div class="information-box" id="socialCommunity-info-container-f-manage-manage">
                            	<div class="img">
                            		<img src="/theme/factory/img/manage-friends.png" border="0" />
                            	</div>
                                <div class="txt">
									<?php
										echo $this->Js->link(
											__('Manage Friends',true)
											,'/friends/manage'
											,array(
												'update' => '#mid-container-left-panel'
											)
										); 
									?> 
                                </div>
                            </div>
                            <script type="text/javascript">
                            	$(document).ready(function(){
									$("#socialCommunity-info-container-f-manage-manage").click(function(){
										$("#mid-container-left-panel").load('/friends/manage');
									});
                            	});
                            </script> 
                            
                            
                            <div class="information-box" id="socialCommunity-info-container-f-manage-pending-my-approval">
                            	<div class="img">
                            		<img src="/theme/factory/img/pending-friends.png" border="0" />
                            	</div>
                                <div class="txt">
									<?php
										echo $this->Js->link(
											__('Pending My Approval',true)
											,'/friends/pending_my_approval'
											,array(
												'update' => '#mid-container-left-panel'
											)
										); 
									?> 
                                </div>
                            </div>
                            <script type="text/javascript">
                            	$(document).ready(function(){
									$("#socialCommunity-info-container-f-manage-pending-my-approval").click(function(){
										$("#mid-container-left-panel").load('/friends/pending_my_approval');
									});
                            	});
                            </script> 
                            
                            
                            <div class="information-box" id="socialCommunity-info-container-f-manage-sent-requests">
                            	<div class="img">
                            		<img src="/theme/factory/img/sent-request.png" border="0" />
                            	</div>
                                <div class="txt">
									<?php
										echo $this->Js->link(
											__('Sent Requests',true)
											,'/friends/sent_requests'
											,array(
												'update' => '#mid-container-left-panel'
											)
										); 
									?> 
                                </div>
                            </div>
                            <script type="text/javascript">
                            	$(document).ready(function(){
									$("#socialCommunity-info-container-f-manage-sent-requests").click(function(){
										$("#mid-container-left-panel").load('/friends/sent_requests');
									});
                            	});
                            </script> 
                            
                            
                            <div class="information-box" id="socialCommunity-info-container-f-find-friends">
                            	<div class="img">
                            		<img src="/theme/factory/img/find-friends.png" border="0" />
                            	</div>
                                <div class="txt">
									<?php
										echo $this->Js->link(
											__('Find Friends',true)
											,'/users/widget_search_community' 
											,array(
												'update' => '#mid-container-left-panel'
											)
										); 
									?>                                	
                                </div>
                            </div>
                            <script type="text/javascript">
                            	$(document).ready(function(){
									$("#socialCommunity-info-container-f-find-friends").click(function(){
										$("#mid-container-left-panel").load('/users/widget_search_community');
									});
                            	});
                            </script> 
                            
                            
                        </div>
                    </div>
                    
                    <div class="message-Div">
                    	<div class="img">
                    		<img src="/theme/factory/img/message-icon.png" border="0" />
                    	</div>
                        <div class="txt"><?php __('Messaging');?></div>
                        
                        <div class="m-dropMenu-cotainer">
                            <div class="information-box" id="socialCommunity-info-container-m-inbox">
                            	<div class="img">
                            		<img src="/theme/factory/img/conversation.png" border="0" />
                            	</div>
                                <div class="txt">
									<?php
										echo $this->Js->link(
											__('Conversations',true)
											,'/conversations/index' 
											,array(
												'update' => '#mid-container-left-panel'
											)
										); 
									?> 
                                </div>
                            </div>
                            <script type="text/javascript">
                            	$(document).ready(function(){
									$("#socialCommunity-info-container-m-inbox").click(function(){
										$("#mid-container-left-panel").load('/conversations/index');
									});
                            	});
                            </script>                             
                            
                            <div class="information-box" id="socialCommunity-info-container-m-new-message">
                            	<div class="img">
                            		<img src="/theme/factory/img/compose-message-img.png" border="0" />
                            	</div>
                                <div class="txt">
									<?php
										echo $this->Js->link(
											__('New Message',true)
											,'/conversations/new_conversation' 
											,array(
												'update' => '#mid-container-left-panel'
											)
										); 
									?> 
                                </div>
                            </div>
                            <script type="text/javascript">
                            	$(document).ready(function(){
									$("#socialCommunity-info-container-m-new-message").click(function(){
										$("#mid-container-left-panel").load('/conversations/new_conversation');
									});
                            	});
                            </script> 
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                
                <div class="welcome-div">
                <?php if(!empty($_SESSION['Auth']['User'])): ?>
                
                	<span>Welcome</span>
                    
                    <span>
                    	<?php
                    		echo $_SESSION['Auth']['User']['fullname']; 
                    	?>
                    </span>
                    
                    <span>-</span>
                    
                    <span>
						<?php
							echo $this->Html->link(
								__('Logout',true)
								,'/users/logout' 
							); 
						?>
                    </span>
				
				<?php else: ?>
					<span>
						<?php
							echo $this->Html->link(
								__('Login',true)
								,'/users/widget_signin' 
							); 
						?>
					</span>
					
					<span>
						&nbsp;-&nbsp;
					</span>
					
					<span>
						<?php
							echo $this->Html->link(
								__('Register',true)
								,'/users/widget_signup' 
							); 
						?>
					</span>
				<?php endif; ?>
				
				</div>
				

            </div>
            <!-- Header Top Bar END -->

            <!-- Header Container START -->
            <div class="mid-header-container">
                <div class="logo-container">
                	<a href="/">
                		<?php if(empty($siteInfo['logopath'])): ?>
                			<img src="/theme/factory/img/logo-dvs.png" border="0" />
                		<?php else: ?>
                			<img src="<?php echo $this->Picturescomponent->getPathToPictureFromFileName($siteInfo['logopath']); ?>" border=0 />
                		<?php endif;?>
                	</a>
                </div>
                
                <div class="nav1-container">
                	<?php if(!empty($_SESSION['Auth']['User'])): ?>

                    <li>
						<?php
							echo $this->Html->link(
								__('Dashboard',true)
								,'/users/widget_dashboard' 
							); 
						?>
                    </li>
                    
                    <li>
						<?php
							echo $this->Html->link(
								__('Profile',true)
								,'/users/widget_profile' 
							); 
						?>
                    </li>

                    <li>
						<?php
							echo $this->Html->link(
								__('Account',true)
								,'/users/account' 
							); 
						?>
                    </li>

                    <?php endif; ?>
                </div>
                
                

                <div class="nav2-container">
                    <li>
						<?php
							echo $this->Html->link(
								__('Categories',true)
								,'/categories' 
							); 
						?>
                    </li>

                    <li>
						<?php
							echo $this->Html->link(
								__('Everything',true)
								,'/everything' 
							); 
						?>
                    </li>

                    <li>
						<?php
							echo $this->Html->link(
								__('New Stuff',true)
								,'/new' 
							); 
						?>
                    </li>

                    <li>
						<?php
							echo $this->Html->link(
								__('Expiring Stuff',true)
								,'/expiring' 
							); 
						?>
                    </li>

                </div>
            </div>
            <!-- Header Container END -->
			<?php
				echo $this->Js->writeBuffer(); 
			?>
			</cake:nocache>
        </div>