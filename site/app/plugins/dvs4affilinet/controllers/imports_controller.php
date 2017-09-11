<?php
// Copyright 2006-2017 Faisal Thaheem
// 
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
// 
//     http://www.apache.org/licenses/LICENSE-2.0
// 
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

class ImportsController extends Dvs4affilinetAppController{

	var $name = 'Imports';
	var $uses = array(	'AffilinetShopsDump', 'AffilinetShop',
						'AffilinetCodesDump', 'AffilinetCode', 
						'AffilinetCategoriesDump', 'AffilinetCategory', 
						'AffilinetCategoriesShopsDump', 'AffilinetCategoriesShop');
    var $helpers = array('Html');
	var $layout = 'ajax';

    function beforeFilter()
    {
    	parent::beforeFilter();
		$this->Auth->allow('admin_index');
    }
	
    /*
    #	Publisher Documentation
    //	http://developer.affili.net/Portaldata/1/Resources/pdfs/Documentation_Publisher_Web_Services.pdf
    
    # 	Get Category List Documentation
    //	http://developer.affili.net/Portaldata/1/Resources/pdfs/Documentation_GetCategoryList.pdf
    
    #	Get Shop List Documentation
    //	http://developer.affili.net/Portaldata/1/Resources/pdfs/Documentation_GetShopList.pdf
    
    # 	Get Voucher Codes Documentation
    //	http://developer.affili.net/Portaldata/1/Resources/pdfs/Documentation_GetVoucherCodes.pdf
    
    # 	Shop List Services Web Service
    // 	https://api.affili.net/V2.0/ProductServices.svc?wsdl // live
    //	https://developer-api.affili.net/V2.0/ProductServices.svc?wsdl // demo

    #	Get Category List Web Service
    //	https://api.affili.net/V2.0/ProductServices.svc?wsdl // live
    //	https://developer-api.affili.net/V2.0/ProductServices.svc?wsdl // demo
    
    #	Voucher Codes Web Service
    //	https://api.affili.net/V2.0/PublisherInbox.svc?wsdl // live
    //	https://developer-api.affili.net/V2.0/PublisherInbox.svc?wsdl // demo
    
    #	Logon Web Service
    //	https://developer-api.affili.net/V2.0/Logon.svc?wsdl // demo
    //	https://api.affili.net/V2.0/Logon.svc?wsdl // live
    //	Login Function : Logon(Username, password, WebServiceType{'Product', 'Publisher'});
	//	When a user login via logon service, a token is generated for the user
	//	which is valid for 20 minutes
	//	following is the function to check remaining validity time
    //	Token Remainig Time : GetIdentifierExpiration('Token');
    */
    
    function __canRunNow(){
    	
    	$bRet = false;
    	
    	$lastRunTime = $this->Pluginsconfiguration->getDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'last_run_time'
    						);

    	
    						
    						
		$currentTime = strtotime(date("Y-m-d H:i:s"));
    	$lastRun = strtotime($lastRunTime);
    	
    	if(round(abs($currentTime - $lastRun) / 60, 0) > 1){
			
			$bRet = true;
    		
			// Update last runtime with current time
			$this->Pluginsconfiguration->setDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'last_run_time',
					    		date("Y-m-d H:i:s")
    						);
			
		}
		
		return $bRet;
    }
    
    function __isImportComplete(){

    	// checks import is complete or not
    	$bRet = false;
    	
    	if ($this->__getShopImportStatus() == "yes" && 
    		$this->__getCategoryImportStatus() == "yes" &&
    		$this->__getVoucherImportStatus() == "yes")
    	{
    		$bRet = true;
    	}
    	
    	return $bRet;
    }
    
    function __isSecondLevelComplete(){

    	$bRet = false;
    	
    	$SecondLevelImport = $this->Pluginsconfiguration->getDataVal(
									    		$this->__PLUGIN_ID,
									    		$this->__PLUGIN_NAME,
									    		'second_level_import'
    										);

    	if($SecondLevelImport == 'yes'){
    		$bRet = true;	
    	}
    
    	return $bRet;
    }
    
    /*
     * reset configuration to start import again
     */
    function __reset()
    {
		$this->AffilinetShopsDump->query('truncate affilinet_shops_dumps;');
		$this->AffilinetCodesDump->query('truncate affilinet_codes_dumps;');
		$this->AffilinetCategoriesDump->query('truncate affilinet_categories_dumps');
		$this->AffilinetCategoriesShopsDump->query('truncate affilinet_categories_shops_dumps;');
		
		$this->Pluginsconfiguration->setDataVal(
    			$this->__PLUGIN_ID,
    			$this->__PLUGIN_NAME,
    			'isShopImportComplete',
    			'no'
    	);
		
		$this->Pluginsconfiguration->setDataVal(
    			$this->__PLUGIN_ID,
    			$this->__PLUGIN_NAME,
    			'isCategoryImportComplete',
    			'no'
    	);
    	
		$this->Pluginsconfiguration->setDataVal(
    			$this->__PLUGIN_ID,
    			$this->__PLUGIN_NAME,
    			'isVoucherImportComplete',
    			'no'
    	);
		
		$this->Pluginsconfiguration->setDataVal(
    			$this->__PLUGIN_ID,
    			$this->__PLUGIN_NAME,
    			'second_level_import',
    			'no'
    	);
    	
		$this->__log('Affilinet: Reset configuration, ready for import.');
    }
    
    function __product_authentication($userid, $publisherid, $password)
    {
    	$this->__log("Entered Method: __product_authentication");
		$isTokenAuthentic = false;
		
		$webservice_authentication = "https://developer-api.affili.net/V2.0/Logon.svc?wsdl"; // demo
		//$webservice_authentication = "https://developer-api.affili.net/V2.0/PublisherProgram.svc?wsdl"; // live
		
		$SOAP_LOGON = new SoapClient($webservice_authentication);
		// Following line should be commented on release
		$DeveloperSettings = array('SandboxPublisherID' => $publisherid);
		
		try{
			
			$ProToken = $SOAP_LOGON->Logon(array(
		                     'Username'  => $userid,
		                     'Password'  => $password,
		                     'WebServiceType' => 'Product',
		                     'DeveloperSettings' => $DeveloperSettings
		                     ));			
			
			$_SESSION[$this->__PLUGIN_ID]['Product']['Token'] = $ProToken;
			$this->__log("Product Login Successfull: Start Shops & Category Import");
			
			$isTokenAuthentic = true;
		} 
		catch(Exception $e) 
		{
			$this->__log($e->getMessage());
			$isTokenAuthentic = false;
		}
		
		return $isTokenAuthentic;
    }
        
    function __publisher_authentication($userid, $publisherid, $password)
    {
    	$this->__log("Entered Method: __publisher_authentication");
		
    	$isTokenAuthentic = false;
		
		$webservice_authentication = "https://developer-api.affili.net/V2.0/Logon.svc?wsdl"; // demo
		//$webservice_authentication = "https://developer-api.affili.net/V2.0/PublisherProgram.svc?wsdl"; // live
			
		$SOAP_LOGON = new SoapClient($webservice_authentication);
		// Following line should be commented on release
		$DeveloperSettings = array('SandboxPublisherID' => $publisherid);
		
		try{
			
			$PubToken = $SOAP_LOGON->Logon(array(
		                     'Username'  => $userid,
		                     'Password'  => $password,
		                     'WebServiceType' => 'Publisher',
		                     'DeveloperSettings' => $DeveloperSettings
		                     ));			
			
			$_SESSION[$this->__PLUGIN_ID]['Publisher']['Token'] = $PubToken;
			$this->__log("Publisher Login Successfull: Start Voucher Import");
			
			$isTokenAuthentic = true;
		} 
		catch(Exception $e) 
		{
			$this->__log($e->getMessage());
			$isTokenAuthentic = false;
		}
		
		return $isTokenAuthentic;
    }
    
    /*
     * import process start
     */
    function admin_index(){

    	//	ALGO
    	// 	IF IMPORT IS RUNNING 
    	//		Exit;
    	//	END IF;
    	//
    	// 	IF IMPORT IS NOT COMPLETE
    	//
    	//		IF ShopImport IS NOT COMPLET
    	//
    	//			do ImportShops();
    	//
    	//		ELSE
    	//
    	//			IF CategoryImport IS NOT COMPLETE
    	//				do ImportCategories();
    	//			ELSE
    	//				IF VoucherCodeImport IS NOT COMPLETE
    	//					do ImportVoucherCodes();	
    	//				END IF;
    	//			END IF;
    	//
    	//		END IF;
    	//
    	//	ELSE 
    	//	
    	// 		IF 2ND LEVEL IMPORT IS NOT COMPLETE
    	//			do 2ndLevelImport();
    	//		ELSE IF:
    	//			do finalImport();
    	//		END IF;
		//
    	//	END IF;    	
    	
    	if(!$this->__canRunNow()){
    		
    		$this->__log("Affilinet: Cannot run now, invoked too early");
    		return false;
    	}
		
    	if(!$this->__isImportComplete())
		{
	    	// get userid
			$userid = $this->Pluginsconfiguration->getDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				"userid"	
			);
			
			// get publisherid
			$publisherid = $this->Pluginsconfiguration->getDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				"publisherid"
			);
			
			// get password
			$password = $this->Pluginsconfiguration->getDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				"password"
			);
		
			// Check Shop Import is Completed or not
			if($this->__getShopImportStatus() == "no")
			{
				// Shop Import Start
				// Authentication of Webservice login/or authenticate token
				if(!$this->__product_authentication($userid, $publisherid, $password))
		    	{
		    		return false;	
		    	}
				
		    	// import shops
				if($this->__importShops()){

					// mark isShopImportComplete as yes
		    		$this->Pluginsconfiguration->setDataVal(
		    			$this->__PLUGIN_ID,
		    			$this->__PLUGIN_NAME,
		    			'isShopImportComplete',
		    			'yes'
		    		);
	    		}
	    		
	    		// Shop Import Done
			}
			else if($this->__getShopImportStatus() == "yes")
			{
				// Check Category Import is Complete
				if($this->__getCategoryImportStatus() == "no")
				{
    				
					// fetch shops from db to get Category List
					$getImportedShops = $this->AffilinetShopsDump->find('list', 
														array('fields' => array('AffilinetShopsDump.id', 'AffilinetShopsDump.shop_id')
															,'conditions' => array('AffilinetShopsDump.shop_processed' => 0)																			
															,'limit' => 3)
														);
					
					if(count($getImportedShops) == 0)
					{
						// since there are no un processed shops so
				    	// mark isCategoryImportComplete as yes
			    		$this->Pluginsconfiguration->setDataVal(
			    			$this->__PLUGIN_ID,
			    			$this->__PLUGIN_NAME,
			    			'isCategoryImportComplete',
			    			'yes'
			    		);
					}
					else
					{
						// Category Import Start
						// Authentication of Webservice login/or authenticate token
						if(!$this->__product_authentication($userid, $publisherid, $password))
				    	{
				    		return false;	
				    	}
	
			    		// Import all categories for shops
						foreach($getImportedShops as $id => $affShopId)
			    		{
			    			$this->__importCategories($affShopId);
							$this->AffilinetShopsDump->id = $id;
							$this->AffilinetShopsDump->saveField('shop_processed', 1);
			    		}
					}										
				}
				else if($this->__getCategoryImportStatus() == "yes")
				{
					// Check Voucher Import is Complete
					if($this->__getVoucherImportStatus() == "no")
					{
				    	
				    	$getImportedPrograms = $this->AffilinetShopsDump->find('list', array(
				    																'fields' => array('AffilinetShopsDump.id', 'AffilinetShopsDump.program_id'),
				    																'conditions' => array('AffilinetShopsDump.program_processed' => 0),
				    																'limit' => 3,
				    																'group' => 'AffilinetShopsDump.program_id'
				    															)
				    													);
	    				
				    	if(count($getImportedPrograms) == 0)
				    	{
							// since there are no un processed programs so
					    	// mark isVoucherImportComplete as yes
				    		$this->Pluginsconfiguration->setDataVal(
				    			$this->__PLUGIN_ID,
				    			$this->__PLUGIN_NAME,
				    			'isVoucherImportComplete',
				    			'yes'
				    		);
				    	}
	    				else
	    				{
	    					// Voucher Import Start
	    					// Authentication of Webservice login/or authenticate token
					    	if(!$this->__publisher_authentication($userid, $publisherid, $password))
					    	{
					    		return false;	
					    	}
			    			
					    	// import vouchers for each provided program
					    	foreach($getImportedPrograms as $id => $Program){
					    		
					    		$this->__importVoucherCodes($Program);
					    	
								$this->AffilinetShopsDump->id = $id;
								$this->AffilinetShopsDump->saveField('program_processed', 1);
					    	} // END IF - Foreach
	    				
	    				} // END IF - Count(Imported Programs)
					
					} // END IF - VoucherCodes Import Status
				
				} // END IF - Category Import Status
		
			} // END IF - ShopImportStatus
    	}
    	else // ELSE - isImportComplete
    	{
    		// Import Complete
    		// Check for 2nd Level of Import
    		if(!$this->__isSecondLevelComplete())
    		{
    			$this->__second_level_import();
				// mark second level import yes in plugin configuration table
				$this->Pluginsconfiguration->setDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'second_level_import',
					    		'yes'
		    			);
    		}
    		else
    		{
				$this->__live_data($this->__getSites());
				$this->__reset();
    		}
    		
    	} // END IF - isImportComplete
    }
    
    /*
     * this function imports shops from affilinet
     */
    function __importShops(){
    	
    	$shopImportComplete = false;
    	
    	# LIVE
    	//$webservice_shops_list = "https://api.affili.net/V2.0/ProductServices.svc?wsdl"; 
    	# DEMO
    	$webservice_shops_list = "https://developer-api.affili.net/V2.0/ProductServices.svc?wsdl";

    	try{
    		
			$SOAP_SHOPLIST = new SoapClient($webservice_shops_list);
	    	$data = $SOAP_SHOPLIST->GetShopList(array(
	    											'CredentialToken' => $_SESSION[$this->__PLUGIN_ID]['Product']['Token']
			             							));
	
			$import_count = 0;
			foreach($data->Shops->Shop as $Shop)
			{
				$records['AffilinetShopsDump']['shop_id'] = $Shop->ShopId;
				$records['AffilinetShopsDump']['program_id'] = $Shop->ProgramId;		
				$records['AffilinetShopsDump']['title'] = $Shop->Title;		
				$records['AffilinetShopsDump']['last_update'] = $Shop->LastUpdate;		
				$records['AffilinetShopsDump']['logo_url'] = $Shop->LogoUrl;		
				$records['AffilinetShopsDump']['products'] = $Shop->Products;		
				
				$import_count++;
				$this->AffilinetShopsDump->create();
				$this->AffilinetShopsDump->save($records, true);
			}
			
			$this->__log("Affilinet Shop Import Session Complete: $import_count shops imported.");
			$shopImportComplete = true;
    	}
    	catch(Exception $ex)
    	{
    		$shopImportComplete = false;
    		$this->__log($ex->getMessage());
    	}
    	
    	return $shopImportComplete;
    }

    /*
     * this function imports categories for provided shop
     */
    function __importCategories($affShopId){
    	
		//LIVE
		//$webservice_category_list = "https://api.affili.net/V2.0/ProductServices.svc?wsdl";
		//DEMO
		$webservice_category_list = "https://developer-api.affili.net/V2.0/ProductServices.svc?wsdl";

		$params = array('ShopId' => $affShopId);
		
    	try
    	{
		
			$SOAP_CATEGORYLIST = new SoapClient($webservice_category_list);
			$data = $SOAP_CATEGORYLIST->GetCategoryList(array(
			            										'CredentialToken' => $_SESSION[$this->__PLUGIN_ID]['Product']['Token'],
			            										'GetCategoryListRequestMessage' => $params
												            ));
    	
			$importCount = 0;
															            
			foreach($data->CategoryResult->Categories->Category as $Cat)
			{
				// Save Category
				$category['AffilinetCategoriesDump']['affilinet_category_id'] = $Cat->CategoryId;
				$category['AffilinetCategoriesDump']['category_title'] = $Cat->Title; 
				$category['AffilinetCategoriesDump']['parent_id'] = $Cat->ParentCategoryId;
				$category['AffilinetCategoriesDump']['category_path'] = $Cat->CategoryPath;
				
				$this->AffilinetCategoriesDump->create();
				$this->AffilinetCategoriesDump->save($category, true);
				
				// Save Catogory and Shop id relation
				$record['AffilinetCategoriesShopsDump']['shop_id'] = $affShopId;
				$record['AffilinetCategoriesShopsDump']['affilinetcategory_id'] = $Cat->CategoryId;
			
				$this->AffilinetCategoriesShopsDump->create();
				$this->AffilinetCategoriesShopsDump->save($record, true);
				$importCount++;
			}
			
			$this->__log("Affilinet Categories Import Complete: For Shop[$affShopId], Categories [$importCount] Imported.");
    	}
    	catch(Exception $ex)
    	{
    		$this->__log($ex->getMessage());
    	}
    }
    
    /*
     * this function imports voucher codes for provided program
     */
    function __importVoucherCodes($Program){
    	
    	# LIVE
    	// $webservice_vouchercodes = "https://api.affili.net/V2.0/PublisherInbox.svc?wsdl";
    	# DEMO
    	$webservice_vouchercodes = "https://developer-api.affili.net/V2.0/PublisherInbox.svc?wsdl";
    	
		$params = array('ProgramId' => $Program,
						'StartDate' => strtotime("now"),
						'EndDate' => strtotime("now"));

		try 
		{
			$SOAP_GETVOUCHERCODES = new SoapClient($webservice_vouchercodes);
			$data = $SOAP_GETVOUCHERCODES->GetVoucherCodes(array(
			            									'CredentialToken' => $_SESSION[$this->__PLUGIN_ID]['Publisher']['Token'],
			            									'GetVoucherCodesRequestMessage' => $params
			            								));
		
			$code_import_count = 0;	            								
			foreach($data->VoucherCodeCollection as $VoucherCodeCollection){
				
				if(count($VoucherCodeCollection) > 0){
						
					foreach($VoucherCodeCollection as $VoucherCode){
	
						$record['AffilinetCodesDump']['vouchercode_id'] = $VoucherCode->Id;
						$record['AffilinetCodesDump']['program_id'] = $VoucherCode->ProgramId;
						$record['AffilinetCodesDump']['code'] = $VoucherCode->Code;
						$record['AffilinetCodesDump']['description'] = $VoucherCode->Description;
						$record['AffilinetCodesDump']['start_date'] = $this->__formateAffiliDate($VoucherCode->StartDate);
						$record['AffilinetCodesDump']['end_date'] = $this->__formateAffiliDate($VoucherCode->EndDate);
						$record['AffilinetCodesDump']['integration_code'] = $VoucherCode->IntegrationCode;
						
						if($VoucherCode->ActivePartnership == 1)
							$record['AffilinetCodesDump']['active_partnership'] = $VoucherCode->ActivePartnership;
						else
							$record['AffilinetCodesDump']['active_partnership'] = 0;
						
						
						if($VoucherCode->IsRestricted == 1)
							$record['AffilinetCodesDump']['is_restricted'] = $VoucherCode->IsRestricted;
						else
							$record['AffilinetCodesDump']['is_restricted'] = 0;
						
						$this->AffilinetCodesDump->create();
						$this->AffilinetCodesDump->save($record, true);
						$code_import_count++;
					}
				}
			}
		
			$this->__log("Affilinet Import Complete: For Program [$Program], Vouchers [$code_import_count] Imported.");
		}
    	catch(Exception $ex)
    	{
    		$this->__log($ex->getMessage());
    	}
    }
    
    /*
     * this function formats affilinet date format
     */
    function __formateAffiliDate($date){
		
    	$retDate = substr($date, 0, 19);    	
		$retDate = substr_replace($retDate, " ", 10, 1);	
		return $retDate;
    }
    
    /* 
     * copies all imported data to middle dump tables
     */
    function __second_level_import()
    {
    	// Transfer Merchants
    	$this->AffilinetShop->query('call AffilinetCopyShopsFromDump();');
		$this->__log("Affilinet: Shops Copied to middle dump tables.");
    	
		// Transfer Categories
		$this->AffilinetCategory->query('call AffilinetCopyCategoriesFromDump();');
		$this->__log("Affilinet: Categories Copied to middle dump tables.");
		
    	// Transfer Category Merchant Join
    	$this->AffilinetCategoriesShop->query('call AffilinetCategoryShopRelationFromDump();');
		$this->__log("Affilinet: Shops and Categories relation Copied to middle dump tables.");
    	
    	// Transfer Voucher Codes
    	$this->AffilinetCode->query('call AffilinetCopyCodesFromDump();');
		$this->__log("Affilinet: Voucher Codes Copied to middle dump tables.");
    }
    
    /*
     * all imported data will be transferred to Live db tables from middle tables
     */
    function __live_data($sites)
    {
    	// Copy Merchants to Live DB
    	$this->AffilinetShop->query("call AffilinetGetImportedShops($sites);");
		$this->__log("Affilinet: Shops are live now.");
    	
    	// Copy Categories to Live DB
    	$this->AffilinetCategory->query("call AffilinetGetCategories($sites);");
		$this->__log("Affilinet: Categories are live now.");
    	
    	// Copy Category and Merchant Join to Live DB
    	$this->AffilinetCategoriesShop->query('call AffilinetGetCategoryShopRelation();');
		$this->__log("Affilinet: Shops & Categories are live now.");
    	
    	// Copy Codes to Live DB
    	$this->AffilinetCode->query("call AffilinetGetImportedCodes($sites);");
		$this->__log("Affilinet: Voucher Codes are live now.");
    }    
}
?>