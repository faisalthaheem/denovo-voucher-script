<div title="" class="popup-container">
	<div class="content">
    	<div class="title">
						<?php
							if(isset($_SESSION['backurls']) && isset($_SESSION['backurls']['merchantsdetail'])):
						?>
						<div class="toolbar">
                            <div class="backTxt">
                            	&laquo;
                            	<?php
                            		echo $this->Html->link(
                            								__('Back',true),
                            								$_SESSION['backurls']['merchantsdetail']
                            		); 
                            	?>
                            </div>
                        </div>    	
                        <?php
                        	endif; 
                        ?>
        	<div class="fb-share" id="fb-share-<?php echo $cod['Vwbrowse']['CODID'];?>">
            	<div class="numbersDiv">
                	<div class="usersShare" id="fb-share-count-<?php echo $cod['Vwbrowse']['CODID'];?>">
		            	<?php
		            		echo $cod['Vwbrowse']['CODFBSHARECOUNT'];
		            	?>
                    </div>
                    <div class="txt">
                    	<?php __('shares');?>
                    </div>
                </div>
                <div class="bottomDiv">
                	<div class="txt">
                    	<a id="fb-share-link-<?php echo $cod['Vwbrowse']['CODID'];?>" href="http://www.facebook.com/sharer.php?url=<?php echo Router::url('',true); ?>" target="_blank" rel=""><?php __('Share');?></a>
                    </div>
                    <div class="icon"></div>                    
                </div>
            </div>
        	<div class="logo">
                              <?php
                                	if(!empty($cod['Vwbrowse']['custom_cod_img_url']))
                                	{
	                            		echo $this->Html->image(
	                            			$cod['Vwbrowse']['custom_cod_img_url'],
	                            			array(
	                            				'class' => 'logoFix',
	                            				'border' => 0
	                            			)
	                            		);
                                	}else{
	                            		echo $this->Html->image(
	                            			$cod['Vwbrowse']['logo_url'],
	                            			array(
	                            				'class' => 'logoFix',
	                            				'border' => 0
	                            			)
	                            		);                                				
                                	} 
	                            ?>
            </div>
            <div class="titleTxt">
            	<?php
            		echo $cod['Vwbrowse']['title'];
            	?>
            </div>
            <div class="expiryTxt">
            	Expires: 
            	<span>
            	<?php
            		echo $cod['Vwbrowse']['expiry_date'];
            	?>            	
            	</span>
            </div>
        </div>
    <?php
	    if($cod['Vwbrowse']['isprintable'])
	    {
	    	$filename = 'bc_' . $cod['Vwbrowse']['CODID'] . '.png';
	    	$file = APP . 'webroot/files/barcodes/'. $filename;
	    	
	    	if(!file_exists($file)){
		    	
	    		$data = $cod['Vwbrowse']['vouchercode'];
		    	
				$barcode->barcode(); 
				$barcode->setType('C128'); 
				$barcode->setCode($data); 
				$barcode->setSize(50,250);
				
				// Generates image file on server             
				$barcode->writeBarcodeFile($file);
	    	} 
	    }	
    ?>        
        <div class="detail">
        	<div class="txt">
                
                <?php
                	if(isset($location)): 
                ?>
                <div class="description">
                	<strong>
                	Address: 
	            	<?php
	            		echo $location['Location']['address1'];
	            	?>
	            	</strong>
	            </div>
                <?php
                	endif; 
                ?>
                
    			<?php
                	if($cod['Vwbrowse']['isprintable']):
                ?>        	
            	<div class="barCode-container">
                	<?php
                			echo $html->image('/files/barcodes/'.$filename);
                	?>
                </div>
                <?php endif;?>
                
				<div class="description">  	
	            	<?php
	            		echo $cod['Vwbrowse']['CODDESC'];
	            	?>
	            </div>
            </div>
            <div class="btnArea">
                <div class="btn1">
	                <a href="/cods/out/<?php echo $cod['Vwbrowse']['safe_title'];?>" id="show-code-<?php echo $cod['Vwbrowse']['CODID'];?>" target="_blank">
	                	<?php __('Show Code &amp; visit site');?>
	                </a>
                </div>

                <div class="btn1">
	                <a href="/cods/out/<?php echo $cod['Vwbrowse']['safe_title'];?>" id="visit-site-<?php echo $cod['Vwbrowse']['CODID'];?>" target="_blank">
	                	<?php __('Visit Site');?>
	                </a>
                </div>
                
                <?php
                	if($cod['Vwbrowse']['isprintable']):
                ?>
                
	                <div class="btn2">
	                	<a href="/cods/printcod/<?php echo $cod['Vwbrowse']['CODID'];?>" target="_blank">
	                		<?php __('Print Voucher');?>
	                	</a>
	                </div>
			                
                <?php endif; ?>
            </div>
            <div class="emblem">
            	<div id="code-<?php echo $cod['Vwbrowse']['CODID'];?>" class="hideCode">
            	<?php
            		if(!empty($cod['Vwbrowse']['vouchercode'])){
            			echo $cod['Vwbrowse']['vouchercode'];
            		}else{
            			echo __('Opened On Site');
            		}
            	?>
                </div>
            </div>
        </div>
        
    </div>
    

    
<script>
	$(document).ready(function() {

		
		$(".content .detail .btnArea .btn1").button();
		$(".content .detail .btnArea .btn2").button();

		
		$("#show-code-<?php echo $cod['Vwbrowse']['CODID'];?>").click(function(){
			$("#code-<?php echo $cod['Vwbrowse']['CODID'];?>").addClass("showCode");
		});

		$("#fb-share-<?php echo $cod['Vwbrowse']['CODID'];?>").click(function(){

			window.open("http://www.facebook.com/sharer.php?url=<?php echo Router::url('',true); ?>", 'dvsfbsharer',
					'width=400,height=300,scrollbars=no');

			//increment count
			$.get('/cods/incrementfbsharecount/<?php echo $cod['Vwbrowse']['CODID'];?>');
			curr_count = $("#fb-share-count-<?php echo $cod['Vwbrowse']['CODID'];?>").text();
			curr_count = parseInt(curr_count)+1;
			$("#fb-share-count-<?php echo $cod['Vwbrowse']['CODID'];?>").text(curr_count);
			
		});


		$.get('/nolayout/cods/increment_view_count/<?php echo $cod['Vwbrowse']['CODID'];?>');
		
	});
</script>

</div>

<?php
	echo $this->Js->writeBuffer(); 
?>