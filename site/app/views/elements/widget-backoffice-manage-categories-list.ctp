<div class="column">                       
<?php 		
	$this->Paginator->options(
			array('update' => '#widget-main-mid-top-container', 
				'evalScripts' => true)); 

	if($view == 'admin_widget_manage_site_categories'){
		$model = 'Vwcategoriesbrowse';	
		$children = 'Children';
	}else{
		$model = 'Vwallcategoriesbrowse';	
		$children = 'Child';
	}
?>			

<?php echo $this->element('widget-backoffice-pagination');?>
<?php 
	foreach($categories as $Category):
?>                	
    		<div class="parentCategory-widget-container">
            	<div class="title">
                	<div class="heading">
                    	<input type="checkbox" value="<?php echo $Category[$model]['id'];?>" />
                        <label for="category"><?php echo $Category[$model]['catname'];?></label>
					</div>
                    <div class="description">
                    	<div class="txt1">S</div>
                        <div class="txt2"><?php echo $Category[$model]['source'];?></div>
                        <div class="txt1">V</div>
                        <div class="txt2"><?php echo $Category[$model]['viewcount'];?></div>
                        <div class="txt1">M</div>
                        <div class="txt2"><?php echo $Category[$model]['countMerchants'];?></div>
                        <div class="links-Div">
							<?php if($view == 'admin_widget_manage_site_categories'){?>
                        	<?php echo $this->Html->link(__('Unlink',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $Category[$model]['safe_catname'],
                        											'catid' => $Category[$model]['id'],
                        											'lnk' => 'unlinkSingleCat',
                        											'siteid' => $siteid)
                                								);
							?>
							
							<?php }else{?>
							
							<?php 
                        		echo $this->Html->link(__('Link To Site',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $Category[$model]['safe_catname'],
                        											'catid' => $Category[$model]['id'],
                        											'lnk' => 'lnkSingleCatToSite')
                                								);
							?>
							|
							<?php 
                        		echo $this->Html->link(__('Edit',true),"javascript:void(0);" ,
                        										array(	
                        											'category' => $Category[$model]['safe_catname'],
                        											'catid' => $Category[$model]['id'],
                        											'lnk' => 'categoryEdit')
                                								);
							?>
							|
							<?php 
                        		echo $this->Html->link(__('Merge &amp; Remove',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $Category[$model]['safe_catname'],
                        											'catid' => $Category[$model]['id'],
                        											'lnk' => 'MergeRemoveCat'
                        											,'escape' => false
                        											)
                                								);
							?>
							<?php }?>
						</div>
					</div>
				</div>
			</div>

			<?php 
				if(count($Category[$children]) > 0){
				
					foreach($Category[$children] as $SubCat):
			?>
			<div class="subCategory-widget-container child">
				<div class="title">
	            	<div class="heading">
	                	<input type="checkbox" value="<?php echo $SubCat['id'];?>" />
	                    <label for="category"><?php echo $SubCat['catname'];?></label>
					</div>
	                <div class="description">
	                	<div class="txt1">S</div>
	                    <div class="txt2"><?php echo $SubCat['source'];?></div>
	                    <div class="txt1">V</div>
	                    <div class="txt2"><?php echo $SubCat['viewcount'];?></div>
	                    <div class="txt1">M</div>
	                    <div class="txt2"><?php echo $SubCat['countMerchants'];?></div>
	                    <div class="links-Div">
							
							<?php if($view == 'admin_widget_manage_site_categories'){?>
                        	
							<?php echo $this->Html->link(__('Unlink',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $SubCat['safe_catname'],
                        											'catid' => $SubCat['id'],
                        											'lnk' => 'unlinkSingleCat',
                        											'siteid' => $siteid)
                                								);
							?>
							
							<?php }else{?>
			
							<?php 
                        		echo $this->Html->link(__('Link To Site',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $SubCat['safe_catname'],
                        											'catid' => $SubCat['id'],
                        											'lnk' => 'lnkSingleCatToSite'
                        											)
                                								);
							?>
							|
							<?php 
                        		echo $this->Html->link(__('Edit',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $SubCat['safe_catname'],
                        											'catid' => $SubCat['id'],
                        											'lnk' => 'categoryEdit'
                        											)
                                								);
							?>
							|
							<?php 
                        		echo $this->Html->link(__('Merge & Remove',true),"javascript:void(0);" ,
                        										array(
                        											'category' => $SubCat['safe_catname'],
                        											'catid' => $SubCat['id'],
                        											'lnk' => 'MergeRemoveCat'
                        											)
                                								);
							?>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
			<?php 
					endforeach;
				}
			?>
	
		<?php endforeach;?>
		
		<?php echo $this->element('widget-backoffice-pagination');?>
		
		</div>
		
		<?php
			echo $this->Js->writeBuffer(); 
		?>                                            
	<script type="text/javascript">

		function before_category_operation_setup(){
			$("#category-management-details-container").hide();	
		}

		$(document).ready(function(){
	
			$(".title .description .links-Div a").click(function(){
	
				var safeCatName = $(this).attr('category');
				var catid = $(this).attr('catid');
				var linkType = $(this).attr('lnk');
	
				if('categoryEdit' == linkType){
	
					$.get('/<?php echo $this->params["prefix"];?>/categories/widget_categories_edit/' + safeCatName, function(data){
						$("#widget-main-mid-top-container").html('');	
						$("#widget-main-mid-bottom-container").html(data);
					});
				}
				else if('lnkSingleCatToSite' == linkType)
				{
					$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/categories/widget_single_category_lnk_to_site/' + catid);		
					$('#widget-dailog-container').dialog('open');
				}
				else if('unlinkSingleCat' == linkType)
				{

					var siteid = $(this).attr('siteid');
					$.get("/<?php echo $this->params['prefix'];?>/categories/widget_categories_unlink/" + catid + "/" + siteid, function(data){
						<?php	
							if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['categories'])): 
						?>
							$.get('<?php echo $_SESSION['backurls']['categories'];?>', function(data){
								$("#widget-main-mid-top-container").html(data);	
							});
						<?php 	
							endif;
						?>
					});
				}
				else if('MergeRemoveCat' == linkType)
				{
					var res = confirm("<?php __('Are you sure to remove selected categories?');?>");
					if(!res){
						return false;
					}
					
					$("#widget-dailog-container").load('/<?php echo $this->params['prefix'];?>/categories/widget_category_merge/' + catid);		
					$('#widget-dailog-container').dialog('open');
				}
			});
		});
	</script>
	