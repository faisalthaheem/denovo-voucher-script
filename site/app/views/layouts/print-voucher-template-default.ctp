<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<title>
		<?php echo $title_for_layout; ?>
		<?php echo ' : ' .$sitename; ?>		
	</title>

    <!-- CSS -->
	<link rel="stylesheet" type="text/css" href="/css/print/print-voucher-template-style.css" media="all" />

</head>

<body>
	<div id="printPage-mainContainer">
    	<div class="header">
        	<div class="logo">
                <?php if(empty($siteInfo['logopath'])): ?>
                	<img src="/img/logo-dvs.png" border="0" />
                <?php else: ?>
                	<img src="<?php echo $this->Picturescomponent->getPathToPictureFromFileName($siteInfo['logopath']); ?>" border=0 />
                <?php endif;?>            	
            </div>
        </div>
        <div class="voucherDetail-widget-container">
        	<div class="title">
            	<div class="left">
                	<div class="barCode-container">
                    	<div class="txt">
                        	<?php __('Voucher Barcode'); ?>
                        </div>
                        <div class="img">
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

							    	echo $html->image('/files/barcodes/' . $filename);
							    }	
						    ?>                        
                        </div>
                    </div>
                </div>
                <div class="right">
                	<div class="txt1">
		            	<?php
		            		echo $cod['Vwbrowse']['title'];
		            	?>
                    </div>
                    <div class="btn">
                    	<a href="#" onclick="javascript:window.print()"><?php __('Print Voucher');?></a>
                    </div>
                    <div class="txt2">
                    	<?php __('Expires');?>:
                        <span>
			            	<?php
			            		echo $cod['Vwbrowse']['expiry_date'];
			            	?>            	
                        </span>
                    </div>
                </div>
            </div>
            <div class="detail">
            	<div class="img">
                            <?php
                            		echo $this->Html->image(
                            			$cod['Vwbrowse']['logo_url'],
                            			array(
                            				'class' => 'logoFix',
                            				'border' => 0
                            			)
                            		); 
                            ?> 
                </div>
                <div class="txt">
                <span>
	            	<?php
	            		echo $cod['Vwbrowse']['merchant_name'];
	            	?>
                </span>
                <br /><br />
	            	<?php
	            		echo $cod['Vwbrowse']['CODDESC'];
	            	?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>