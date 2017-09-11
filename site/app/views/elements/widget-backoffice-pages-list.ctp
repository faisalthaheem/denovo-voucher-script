<div class="description">	
	<?php if(isset($SiteId)){ ?>

	<?php 
		$this->Paginator->options(array('update' => '#widget-pages-list-container', 
										'evalScripts' => true)); 
	?>

	
	<div class="txt1" style="border-bottom: 1px solid black;">
		
		<?php echo "{$sitename} Pages";?> | 
		
		<?php echo $this->Js->link(	__("Create New Page",true), 
									"/{$this->params['prefix']}/pages/add",
									array("update" => "#widget-main-mid-bottom-container"));
		
		?>
	</div>
	
	<?php } ?>
	
	<?php	
		if(isset($pages)){ 
	?>	

		<?php		
			if(!empty($pages)){ 
		?>
		
		<?php 	
				foreach($pages as $Page): 
		?>		
		<div class="txt2">
			<?php 	
				echo $this->Html->link("{$Page['Page']['pagename']}",
											"javascript:void(0);",
											array("pageid" => "{$Page['Page']['id']}"));
			?>
			<span>
				<?php echo date_format(date_create($Page['Page']['modified']), "m-d-Y h:i A");?>
			</span>
			
			<span>
				<?php echo $this->Js->link(	__("Delete Page",true), 
											"/{$this->params['prefix']}/pages/delete/{$SiteId}/{$Page['Page']['id']}",
											array(
												'confirm' => "Are you sure you want to delete [{$Page['Page']['pagename']}]?"
												,'update' => '#widget-pages-list-container'
											)
							);
				
				?>			
			</span>
		
		</div>
		<?php 
				endforeach;		
		?>
		
		<?php 		
			}else{	
		?>

			<?php echo "0 Pages found.";?>

		<?php 		
			}
		?>

	<?php 	
		}else{ 
	?>
			<div class="heading"><?php __("Please Select Site from the left"); ?></div>

	<?php 	
		} 
	?>

</div>

<?php 
	if(isset($SiteId)){
		echo $this->element('widget-backoffice-pagination');
	}

	echo $this->Js->writeBuffer();
?>

	<script>
		$(document).ready(function(){

			$("#widget-main-mid-bottom-container").html('');

			$(".description .txt2 a").click(function(){
				var pageid = $(this).attr('pageid');
				if(undefined == pageid) return;
				
				$.get('<?php echo "/{$this->params['prefix']}/pages/edit/";?>' + pageid, function(data){	
					$("#widget-main-mid-bottom-container").empty();
					$("#widget-main-mid-bottom-container").html(data);

				});
			});
		});
	</script>