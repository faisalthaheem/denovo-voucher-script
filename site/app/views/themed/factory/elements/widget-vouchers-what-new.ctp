               <div class="right-panel whatsNew-widget-container">
                    <div class="whatsNew-widget-container title">
                        <div class="title txt">
                            <?php __('What\'s New');?>
                        </div>
                        <div class="title btn">
                            <a href="javascript:;"><img src="/theme/factory/img/expand-arrow.png" id="whatsNew-arrow" title="1" border="0" /></a>
                        </div>
                    </div>
                    <div class="whatsNew-widget-container detail">
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                        <div class="whatsNew-widget-container detail item">
                            <a href="javascript:;"><img src="/theme/factory/img/mp_img1.jpg" border="0" width="104" height="50" />
                            </a>
                        </div>
                    </div>
<script>
//What's New Toogle
$(document).ready(function() {
	$(".whatsNew-widget-container .detail").hide();
	
	$(".whatsNew-widget-container .title .btn").click(function(){
		$(".whatsNew-widget-container .detail").slideToggle(500);
		
			if( $(".whatsNew-widget-container .title .btn").attr("title") == 1)
			{	
				$(".whatsNew-widget-container .title .btn").attr("title", '0');
				document.images["whatsNew-arrow"].src='img/expand-arrow.png';
			}
			else
			{
				$(".whatsNew-widget-container .title .btn").attr("title", '1');
				document.images["whatsNew-arrow"].src='img/collapse-arrow.png';
			}
	
		return false;
	});
});
</script>
                </div>