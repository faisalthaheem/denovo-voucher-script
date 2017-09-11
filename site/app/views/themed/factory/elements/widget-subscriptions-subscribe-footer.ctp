                    <div class="subcribe-widget-container">
                        <div class="title">
                            <?php __('Subcribe to our NewsLetter');?>
                        </div>
                        <div class="detail" id = "widget-subscriptions-subscribe-footer-detail">
                            <div class="txt">
                                <?php __('Sign up Best Voucher Codes delivered straight to your<br />inbox every week.');?>
                            </div>
                            
                            <input 
                            	type="text" 
                            	name="search"  
                            	class="input"
                            	id = "widget-subscriptions-subscribe-footer-email" 
                            />
                            
                            <input 
                            	type="submit" 
                            	name="submit" 
                            	class="btn" 
                            	value="Subscribe"  
                            	id = "widget-subscriptions-subscribe-footer-submit"  
                            />
                        </div>

					<script>
					$(function() {
						$("#widget-subscriptions-subscribe-footer-submit").button().click(function(){
							$.post(
									'/subscriptions/subscribe',
									{
										'data[Subscription][email]' : $("#widget-subscriptions-subscribe-footer-email").val()
									},
									function(response){
										$("#widget-subscriptions-subscribe-footer-detail").html(response);
									}
							);							
						});
					});
					</script>
                    </div>