<!-- SITE SETTTING START -->
        <div class="siteSetting-widget-container">
            <div class="content1-widget-container">
                <div class="title">
                    <div class="txt"><?php __('Subscribers');?></div>
                </div>
                <div class="detail">
                	<div class="subscriber-widget-container">
                    	<table width="640" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="151"><?php __('Select Site');?>:</td>
                            <td colspan="3">
                            <?php
                            	echo $this->Form->select('Subscription.site',$sites,null,
                            		array(
                            			'empty' => false
                            			,'id' => 'select-site-dropdown'
                            		)
                            	); 
                            ?>
		                    </td>
                          </tr>
                          <tr>
                            <td colspan="4">
                                <input type="button" class="btn" value="Download" id="download-subscribers" />
                            </td>
                          </tr>
                        </table>
						<script>
							$(document).ready(function() {
								$("#select-site-dropdown").sb();

								$('#download-subscribers').button().click(function(){
									window.location.href='/admin/subscriptions/download/' + $('#select-site-dropdown').val() ;
								});
								
							});
						</script>
                    </div>
               	</div>
            </div>
		</div>
        <!-- SITE SETTTING END -->