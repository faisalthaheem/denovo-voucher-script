                <div class="right-panel search-widget-container">
                    <div class="search-widget-container title">
                        <?php __('Search All Voucher Codes &amp; Merchants');?>
                    </div>
                    <div class="search-widget-container detail">
                    	<form method="get" action="/merchants/search" id="widget-search-codes-and-merchants-top">
                        <input 
                        	type="text" 
                        	name="kw" 
                        	class="search-input" 
                        	value="Enter keywords..."
                        	id="widget-search-codes-and-merchants-kw" 
                        />
                        
                        <select class="search-combo" id="widget-search-codes-and-merchants-type">
                            <option value="merchants"><?php __('Merchants');?></option>
                            <option value="vouchers"><?php __('Vouchers');?></option>
                        </select>
                        
                        <input 
                        	type="submit" 
                        	name="submit" 
                        	class="search-btn" 
                        	value="Search"
                        	id="widget-search-codes-and-merchants-submit"   
                        />
                        </form>
                    </div>
					<script type="text/javascript">
					jQuery(function() {
						jQuery("#widget-search-codes-and-merchants-submit").button().click(function(){

							if(jQuery("#widget-search-codes-and-merchants-type").val() != "merchants")
							{
								$("#widget-search-codes-and-merchants-top").attr('action','/cods/search');
							}
						});
					});

					
					jQuery("#widget-search-codes-and-merchants-kw").focus(function(){
						if(jQuery("#widget-search-codes-and-merchants-kw").val() == 'Enter keywords...'){
							jQuery("#widget-search-codes-and-merchants-kw").val('');
						}
					});

					jQuery("#widget-search-codes-and-merchants-kw").blur(function(){
						if(jQuery("#widget-search-codes-and-merchants-kw").val() == ''){
							jQuery("#widget-search-codes-and-merchants-kw").val('Enter keywords...');
						}
					});

					jQuery("#widget-search-codes-and-merchants-kw").keypress(function(e){
						if(e.keyCode == 13) {
							jQuery("#widget-search-codes-and-merchants-submit").click();
						}
					});					
					
					</script>
                </div>