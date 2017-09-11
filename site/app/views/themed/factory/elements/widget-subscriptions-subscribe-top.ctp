                <div class="right-panel subcribeVoucher-widget-container">
                    <div class="subcribeVoucher-widget-container title">
                        <?php __('Subcribe to our Vouchers &amp; Discounts by Email');?>
                    </div>
                    <div class="subcribeVoucher-widget-container detail" id = "widget-subscriptions-subscribe-top-detail" >
                        <div class="subcribeVoucher-widget-container detail txt">
                            <?php __('Enter your Email Address below and start recieving the day\'s best vouchers and deals');?>
                        </div>
                        <input 
                        	type="text" 
                        	name="search" 
                        	class="subscribeVoucher-input" 
                        	id = "widget-subscriptions-subscribe-top-email" 
                        />
                        <input 
                        	type="submit" 
                        	name="submit" 
                        	class="subscribeVoucher-btn" 
                        	value="Subscribe"
                        	id = "widget-subscriptions-subscribe-top-submit"  
                        />
                    </div>
					<script>
					$(function() {
						$("#widget-subscriptions-subscribe-top-submit").button().click(function(){
							$.post(
									'/subscriptions/subscribe',
									{
										'data[Subscription][email]' : $("#widget-subscriptions-subscribe-top-email").val()
									},
									function(response){
										$("#widget-subscriptions-subscribe-top-detail").html(response);
									}
							);							
						});
					});
					</script>
                </div>