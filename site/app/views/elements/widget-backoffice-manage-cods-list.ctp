<?php 
	$this->Paginator->options(
				array(	'update' => '#widget-main-mid-top-container', 
						'evalScripts' => true)); 

	if($view == 'admin_widget_manage_cods' || $view == 'admin_widget_manage_merchant_cods'){
		$model = 'Vwcodsbrowse';
	}else{
		$model = 'Vwsitecodsbrowse';
	}
?>
	<?php echo $this->element('widget-backoffice-pagination');?>
	
	<?php foreach($cods as $Cod):?>            	

	<div class="voucherCode-widget-container">
    	<div class="left">
        	<div class="img">
				<?php
                	echo $html->image($Cod[$model]['logo_url'],
                               	array('alt' => "{$Cod[$model]['merchant_name']}'s Logo"
                                	 ,'class' => 'logoFix')
                               		);
        		?>
        	</div>
		</div>
    
    	<div class="right">
    	
    		<div class="emblem">
        		<span>
        			<?php echo ucfirst($Cod[$model]['cod_type']);?>
        		</span>
			</div>
        
        	<div class="txt1">
        		<input type="checkbox" class="checkBox" value="<?php echo $Cod[$model]['id'];?>" />
				<label for="merchant"><?php echo $Cod[$model]['title'];?></label>
			</div>
        
        	<?php if($Cod[$model]['cod_type'] == 'voucher'){?>
        	<div class="emblemCode">
        		<span><?php echo $Cod[$model]['vouchercode'];?></span>
			</div>
			<?php }?>
        
        	<div class="txt2">
        		<?php __('Viewed');?> :<span><?php echo $Cod[$model]['viewcount'];?></span>
			</div>
		
			<div class="txt2">
        		<?php __('Likes');?> :<span><?php echo $Cod[$model]['likes'];?></span>
			</div>
        
        	<div class="txt2">
        		<?php __('FB Shared');?> :<span><?php echo $Cod[$model]['fbsharecount'];?></span>
			</div>
	
		</div>
	
		<div class="description">
		<?php echo htmlentities($Cod[$model]['description']);?>	
		</div>
    
    	<div class="links-Div">
			<?php 
				if($view == 'admin_widget_manage_cods' || $view == 'admin_widget_manage_merchant_cods'){
					echo $this->Html->link(__('Link To Site',true),"javascript:void(0);" ,
                        		array('cid' => $Cod[$model]['id'],
                        			  'lnk' => 'lnkSingleCODToSite'));
			?>
				|
			<?php 
            		echo $this->Html->link(__('Edit',true),"javascript:void(0);" ,
                        		array('cid' => $Cod[$model]['id'],
									  'lnk' => 'CodEdit'));
			?>	
				|
			<?php 
					echo $this->Html->link(__('Remove',true),"javascript:void(0);" ,
                        		array('cid' => $Cod[$model]['id'],
									  'lnk' => 'CodRemove'));
				}else{
					
					echo $this->Html->link(__('Unlink',true),"javascript:void(0);" ,
                        		array('cid' => $Cod[$model]['id'],
                        			  'lnk' => 'unlinkSingleCod',
                        			  'siteid' => $siteid));
                }
			?>
		</div>
    
    	<div class="txt3">
    		<?php __('Star Date');?>:<span><?php echo date_format(date_create($Cod[$model]['start_date']), "m-d-Y"); ?></span>
		</div>
    
    	<div class="txt3">
    		<?php __('Expiry Date');?>:<span><?php echo date_format(date_create($Cod[$model]['expiry_date']), "m-d-Y"); ?></span>
		</div>
	
	</div>
	
	
	<?php endforeach;?>
	<?php echo $this->element('widget-backoffice-pagination');?>
	<?php echo $this->Js->writeBuffer();?>

<script>
	$(document).ready(function(){

		$(".voucherCode-widget-container .links-Div a").click(function(){

			var Cid = $(this).attr('cid');
			var linkType = $(this).attr('lnk');

			if('CodEdit' == linkType){

				$("#widget-main-mid-top-container").empty();
				$("#widget-mid-loading").toggle();
					
				$.get('/<?php echo $this->params["prefix"];?>/cods/widget_cods_edit/' + Cid, function(data){
					$("#widget-mid-loading").toggle();
					$("#widget-main-mid-bottom-container").html(data);
				});

			}else if('lnkSingleCODToSite' == linkType){

				$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/cods/widget_single_cod_lnk_to_site/' + Cid);		
				$('#widget-dailog-container').dialog('open');

			}else if('unlinkSingleCod' == linkType){

				$("#widget-main-mid-top-container").empty();
				$("#widget-mid-loading").toggle();
				
				var siteid = $(this).attr('siteid');
				$.get("/<?php echo $this->params['prefix'];?>/cods/widget_cods_unlink/" + Cid + "/" + siteid, function(data){
					$.get('<?php echo $_SESSION['Auth']['ManageCODURL'];?>', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);	
					});
				});
			}else if('CodRemove' == linkType){

				var res = confirm("<?php __('Do you really want to remove selected item?');?>");
				if(!res){
					return false;
				}

				$("#widget-main-mid-top-container").empty();
				$("#widget-mid-loading").toggle();
				
				$.get("/<?php echo $this->params['prefix'];?>/cods/remove/" + Cid , function(){
					$.get('<?php echo $_SESSION['Auth']['ManageCODURL'];?>', function(data){
						$("#widget-mid-loading").toggle();
						$("#widget-main-mid-top-container").html(data);	
					});
				});
			}else if('codAvailability' == linkType){
				$("#widget-dailog-container").html('<center><img src="/img/backoffice/ajax-loading.gif" alt = "Loading..." /></center>');
				$("#widget-dailog-container").load('/admin/cods_locations/index/' + Cid);
				$("#widget-dailog-container").dialog({
					'title': 'COD Availability'
					,width: 1000
					,height: 420
					,position: 'center'
				});
				$("#widget-dailog-container").dialog('open');
				
			}

			
		});
	});
</script>
	