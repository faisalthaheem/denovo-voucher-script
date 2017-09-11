<?php 
	$this->Paginator->options(
				array(	'update' => '#widget-main-mid-top-container', 
						'evalScripts' => true)); 

	if($view == 'admin_widget_manage_merchants'){
		$model = 'Vwmerchantsbrowse';
	}else{
		$model = 'Vwsitemerchantsbrowse';
	}
?>
	<?php echo $this->element('widget-backoffice-pagination');?>

	<?php foreach($merchants as $Merchant):?>            	
    	
    	<div class="merchant-widget-container">
			<div class="left">
				<div class="img">
					<?php
                		echo $html->image($Merchant[$model]['logo_url'],
                               		array('alt' => "{$Merchant[$model]['merchant_name']}'s Logo"
                                		 ,'class' => 'logoFix')
                               			);
        			?>
				</div>            	
			</div>
						
			<div class="right">
            	<div class="txt1">
					<input type="checkbox" value="<?php echo $Merchant[$model]['id'];?>" />
					<label for="merchant">
					<?php if($Merchant[$model]['istop']){?>
        				<span>
						<?php echo $Merchant[$model]['merchant_name'];?>
						</span>
        			<?php }else{?>
        				<?php echo $Merchant[$model]['merchant_name'];?>
					<?php }?>
					</label>
				</div>

				<div class="links-Div">
					
					<?php if($view == 'admin_widget_manage_merchants'){?>
						<?php 
                        	echo $this->Html->link(__('Link',true),"javascript:void(0);" ,
                        										array(
                        											'merchant' => $Merchant[$model]['safe_merchant_name'],
                        											'mid' => $Merchant[$model]['id'],
                        											'lnk' => 'lnkSingleMerToSite')
                                								);
							?>
					
							|
						<?php 
                        	echo $this->Html->link(__('Edit',true),"javascript:void(0);" ,
                        										array(	
                        											'merchant' => $Merchant[$model]['safe_merchant_name'],
                        											'mid' => $Merchant[$model]['id'],
                        											'lnk' => 'MerchantEdit')
                                								);
							?>
							|
						<?php 
                        	echo $this->Html->link(__('Remove',true),"javascript:void(0);" ,
                        										array(	
                        											'merchant' => $Merchant[$model]['safe_merchant_name'],
                        											'mid' => $Merchant[$model]['id'],
                        											'lnk' => 'MerchantRemove')
                                								);
							?>
							
					<?php }else{?>
                        
						<?php 
                        	echo $this->Html->link(__('Unlink',true),"javascript:void(0);" ,
                        										array(
                        											'merchant' => $Merchant[$model]['safe_merchant_name'],
                        											'mid' => $Merchant[$model]['id'],
                        											'lnk' => 'unlinkSingleMerchant',
                        											'siteid' => $siteid)
                                									);
							?>
                    <?php }?>
				</div>
                            
				<div class="txt2">
            		<?php __('Viewed');?>:<span> <?php echo $Merchant[$model]['viewcount'];?> </span>
				</div>
                
                <div class="txt2">
            		<?php __('Likes');?>:<span> <?php echo $Merchant[$model]['likes'];?> </span>
				</div>
                            
                <div class="txt2">
            		<?php __('FB Shared');?>:<span> <?php echo $Merchant[$model]['fbsharecount'];?> </span>
				</div>
				
				<div class="txt2">
            		<?php __('Tweets');?>:<span> <?php echo $Merchant[$model]['tweetcount'];?></span>
				</div>
                            
				<div class="txt2">
            		<?php 
            			echo $this->Js->link(__("Voucher Codes",true),
            								"/{$this->params['prefix']}/cods/widget_manage_merchant_cods/{$Merchant[$model]['id']}",
            								array("update" => "#widget-main-mid-top-container"));
            		?>
            		
            		<span> N/A<?php //echo $Merchant[$model]['countCODs'];?></span>
				
				</div>
				
			</div>
                        
            <div class="description">
				<?php echo htmlentities($Merchant[$model]['description']);?>
			</div>
                        
            <div class="txt3">
            	<?php __('Merchant Url');?>:<span><?php echo $Merchant[$model]['site_url'];?></span>
			</div>
                        
            <div class="txt3">
            	<?php __('Affiliate Url');?>:<span><?php echo $Merchant[$model]['affiliate_url'];?></span>
			</div>
		
		</div>
	<?php endforeach;?>
	<?php echo $this->element('widget-backoffice-pagination');?>

	<?php 
		echo $this->Js->writeBuffer();
	?>
<script>

	$(document).ready(function(){

		if($("#widget-dailog-container").length <= 0)
		{
			$("#widget-main-mid-top-container").append('<div class="popup-container" title="<?php __('Merchant Operations');?>" id="widget-dailog-container"></div>');
		}
		else
		{
			$("#widget-dailog-container").attr('title', '<?php __('Merchant Operations');?>');
		}
		
		$(".merchant-widget-container .right .links-Div a").click(function(){

			var safeName = $(this).attr('merchant');
			var Mid = $(this).attr('mid');
			var linkType = $(this).attr('lnk');

			if('MerchantEdit' == linkType){

				$.get('/<?php echo $this->params["prefix"];?>/merchants/widget_merchants_edit/' + safeName, function(data){
					$("#widget-main-mid-top-container").html('');	
					$("#widget-main-mid-bottom-container").html(data);
				});

			}else if('lnkSingleMerToSite' == linkType){

				$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/merchants/widget_single_merchant_lnk_to_site/' + Mid);		
				$('#widget-dailog-container').dialog('open');

			}else if('unlinkSingleMerchant' == linkType){
				var siteid = $(this).attr('siteid');

				$.get("/<?php echo $this->params['prefix'];?>/merchants/widget_merchants_unlink/" + Mid + "/" + siteid, function(html){
					$.get('<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>', function(data){
						$("#widget-main-mid-top-container").html(data);	
					});
				});
			}else if('MerchantRemove' == linkType){

				var res = confirm("<?php __('Do you really want to remove merchant?');?>");
				if(!res){
					return false;
				}
				
				$.get("/<?php echo $this->params['prefix'];?>/merchants/remove/" + Mid, function(){
					$.get('<?php echo $_SESSION['Auth']['ManageMerchantURL'];?>', function(data){
						$("#widget-main-mid-top-container").html(data);	
					});
				});
			}
		});
	});
</script>
