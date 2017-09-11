				<div class="left-panel merchantProducts-widget-container" id="merchantProducts-widget-container">
                	<div class="merchantProducts-widget-container title">
						<div class="toolbar">
							<?php
								if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['merchants'])):
							?>
                            <div class="backTxt">
                            	&laquo;
                            	<?php
                            		echo $this->Html->link(
                            								__('Back',true),
                            								$_SESSION['backurls']['merchants']
                            		); 
                            	?>
                            </div>
                            <?php
                            	endif; 
                            ?>
                            <div class="share-fb-container">
                            	<div class="shareDiv" id="merchant-fb-share-button-<?php echo $merchant['Merchant']['id']; ?>">
                                	<img border="0" src="/theme/factory/img/facebook-share.png">
                                </div>
                                <div class="counter" id="merchant-fb-share-counter-<?php echo $merchant['Merchant']['id']; ?>">
                            	<?php
                            		echo $merchant['Merchant']['fbsharecount']; 
                            	?>
                                </div>
                            </div>
                            <div class="twitter-fb-container">
                            	<div class="shareDiv" id="merchant-twitter-share-button-<?php echo $merchant['Merchant']['id']; ?>">
                                	<img border="0" src="/theme/factory/img/twitter-share.png">
                                </div>
                                <div class="counter" id="merchant-tweet-counter-<?php echo $merchant['Merchant']['id']; ?>">
                            	<?php
                            		echo $merchant['Merchant']['tweetcount']; 
                            	?>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                        	$(document).ready(function(){
                            	$("#merchant-fb-share-button-<?php echo $merchant['Merchant']['id']; ?>").click(function(){

                        			window.open("http://www.facebook.com/sharer.php?u=<?php echo Router::url('',true); ?>", 'dvsfbsharer',
                						'width=400,height=300,scrollbars=no');                            		

                            		$.get('/merchants/incrementfbsharecount/<?php echo $merchant['Merchant']['id'];?>');
                        			curr_count = $("#merchant-fb-share-counter-<?php echo $merchant['Merchant']['id']; ?>").text();
                        			curr_count = parseInt(curr_count)+1;
                        			$("#merchant-fb-share-counter-<?php echo $merchant['Merchant']['id']; ?>").text(curr_count);                            		
                            	});

                            	$("#merchant-twitter-share-button-<?php echo $merchant['Merchant']['id']; ?>").click(function(){

                        			window.open("http://twitter.com/share?text=<?php echo $merchant['Merchant']['merchant_name'] . ' ' . urlencode(Router::url('',true)); ?>", 'dvsfbsharer',
                						'width=800,height=400,scrollbars=no');                            		

                            		$.get('/merchants/incrementtweetcount/<?php echo $merchant['Merchant']['id'];?>');
                        			curr_count = $("#merchant-tweet-counter-<?php echo $merchant['Merchant']['id']; ?>").text();
                        			curr_count = parseInt(curr_count)+1;
                        			$("#merchant-tweet-counter-<?php echo $merchant['Merchant']['id']; ?>").text(curr_count);                            		
                            	});                            	
                            	
                        	});
                        </script>
                    </div>
                	<div class="detail">
                    	<div class="companyInfo">
                        	<div class="logo">
                            	<?php
                            		echo $this->Html->image(
                            			$merchant['Merchant']['logo_url'],
                            			array(
                            				'class' => 'logoFix',
                            				'border' => 0
                            			)
                            		); 
                            	?>
                            </div>
                            <div class="heading">
                            	<?php
                            		echo $merchant['Merchant']['merchant_name']; 
                            	?>
                            </div>
                            <div class="description">
                            	<?php
                            		echo $merchant['Merchant']['description']; 
                            	?>                            	
                            </div>
                        </div>
                        
                        <?php
                        	foreach($cods as $cod): 
                        ?>
                        
                        	<?php if($cod['Vwbrowse']['cod_type'] == 'voucher' || $cod['Vwbrowse']['cod_type'] == 'coupon'): ?>
		                    	<div class="voucherBox-code" id="<?php echo $cod['Vwbrowse']['CODID']; ?>">
		                        	<div class="title">
		                            	<?php
		                            		echo $cod['Vwbrowse']['title'];
		                            		echo $this->Html->link($cod['Vwbrowse']['title'],
		                            			"/cods/view/{$cod['Vwbrowse']['safe_title']}/{$cod['Vwbrowse']['safe_merchant_name']}/",
		                            			array(
		                            				'id' => "lnk-{$cod['Vwbrowse']['CODID']}",
		                            				'style' => 'display: none;'
		                            			)
		                            		);		                            		
		                            	?>
		                            </div>
		                            <div class="emblemCode">
		                            	<?php __('Code');?>
		                            </div>
		                        </div>     
		                       </a>                   	
                        	<?php elseif($cod['Vwbrowse']['cod_type'] == 'discount'): ?>
		                    	<div class="voucherBox-discount" id="<?php echo $cod['Vwbrowse']['CODID']; ?>">
		                        	<div class="title">
		                            	<?php
		                            		echo $cod['Vwbrowse']['title'];
		                            		echo $this->Html->link($cod['Vwbrowse']['title'],
		                            			"/cods/view/{$cod['Vwbrowse']['safe_title']}/{$cod['Vwbrowse']['safe_merchant_name']}/",
		                            			array(
		                            				'id' => "lnk-{$cod['Vwbrowse']['CODID']}",
		                            				'style' => 'display: none;'
		                            			)
		                            		);		                            		
		                            	?>
		                            </div>
		                            <div class="emblemDiscount">
		                            	<?php __('Discount');?>
		                            </div>
		                        </div>                        	
                        	<?php elseif($cod['Vwbrowse']['cod_type'] == 'offer'): ?>
		                    	<div class="voucherBox-offer" id="<?php echo $cod['Vwbrowse']['CODID']; ?>">
		                        	<div class="title">
		                            	<?php
		                            		echo $cod['Vwbrowse']['title'];
		                            		echo $this->Html->link($cod['Vwbrowse']['title'],
		                            			"/cods/view/{$cod['Vwbrowse']['safe_title']}/{$cod['Vwbrowse']['safe_merchant_name']}/",
		                            			array(
		                            				'id' => "lnk-{$cod['Vwbrowse']['CODID']}",
		                            				'style' => 'display: none;'
		                            			)
		                            		);		                            		
		                            	?>
		                            </div>
		                            <div class="emblemOffer">
		                            	<?php __('Offer');?>
		                            </div>
		                        </div>                        	
                        	<?php elseif($cod['Vwbrowse']['cod_type'] == 'deal'): ?>
		                    	<div class="voucherBox-deal" id="<?php echo $cod['Vwbrowse']['CODID']; ?>">
		                        	<div class="title">
		                            	<?php
		                            		echo $cod['Vwbrowse']['title']; 
		                            		echo $this->Html->link($cod['Vwbrowse']['title'],
		                            			"/cods/view/{$cod['Vwbrowse']['safe_title']}/{$cod['Vwbrowse']['safe_merchant_name']}/",
		                            			array(
		                            				'id' => "lnk-{$cod['Vwbrowse']['CODID']}",
		                            				'style' => 'display: none;'
		                            			)
		                            		);		                            		
		                            	?>
		                            </div>
		                            <div class="emblemDeal">
		                            	<?php __('Deal');?>
		                            </div>
		                        </div>                        	
                        	<?php endif;?>
                        
                        <?php
                        	endforeach; 
                        ?>
					</div>
				</div>
				
<script type="text/javascript">
<!--

$(document).ready(function() {


	$(".left-panel .merchantProducts-widget-container .detail .voucherBox-discount").click(function(){
		window.location.href = $("#lnk-" + $(this).attr("id")).attr("href");
	});
	
	$(".left-panel .merchantProducts-widget-container .detail .voucherBox-code").click(function(){
		window.location.href = $("#lnk-" + $(this).attr("id")).attr("href");
	});
	
	$(".left-panel .merchantProducts-widget-container .detail .voucherBox-deal").click(function(){
		window.location.href = $("#lnk-" + $(this).attr("id")).attr("href");
	});
	
	$(".left-panel .merchantProducts-widget-container .detail .voucherBox-offer").click(function(){
		window.location.href = $("#lnk-" + $(this).attr("id")).attr("href");		
	});

	$.get('/nolayout/merchants/increment_view_count/<?php echo $merchant['Merchant']['safe_merchant_name'];?>');
	
});
//-->
</script>