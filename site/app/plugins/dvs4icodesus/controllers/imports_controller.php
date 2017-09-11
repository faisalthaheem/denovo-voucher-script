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

class ImportsController extends Dvs4icodesusAppController {

	var $name = 'Imports';
	var $uses = array(	'IcodesusCategory', 'IcodesusCategoriesDump', 'Category', 
						'IcodesusMerchantsDump', 'IcodesusMerchant', 
						'IcodesusCodesDump', 'IcodesusCode',
						'IcodesusOffersDump', 'IcodesusOffer',
						'Icodesuscategorymerchantdump', 'Icodesuscategorymerchant');
	
    var $helpers = array('Html');
    var $layout = 'ajax';
    
    function beforeFilter()
    {
    	parent::beforeFilter();
		$this->Auth->allow('admin_index');
    }

    function __canRunNow(){
    	
    	$bRet = false;
    	
    	$lastRunTime = $this->Pluginsconfiguration->getDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'last_run_time'
    						);
    						
		$currentTime = strtotime(date("Y-m-d H:i:s"));
    	$lastRun = strtotime($lastRunTime);
    	
    	if(round(abs($currentTime - $lastRun) / 60, 0) > 1){ // in each import call there should be 60 minutes break
			
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

    	$bRet = false;
    	
    	if("eof" == $this->Pluginsconfiguration->getDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'merchants_import_char')){
						    		
			$bRet = true;
		}

    	if($bRet && "eof" == $this->Pluginsconfiguration->getDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'codes_import_page')){
			$bRet = true;			    		
		}
		else
		{
			$bRet = false;
		}
    						
    	if($bRet && "eof" == $this->Pluginsconfiguration->getDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'codes_import_page')){
			$bRet = true;			    		
		}
		else
		{
			$bRet = false;
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
    
    function __reset()
    {
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'merchants_import_char',
			0
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'merchants_import_page',
			1
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'codes_import_page',
			1
		);

		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'offers_import_page',
			1
		);

		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'category_import',
			'no'
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'second_level_import',
			'no'
		);
		
		$this->IcodesusMerchantsDump->query('truncate icodesus_merchants_dumps;');
		$this->IcodesusMerchantsDump->query('truncate icodesus_codes_dumps;');
		$this->IcodesusMerchantsDump->query('truncate icodesus_offers_dumps;');
		$this->IcodesusCategoriesDump->query('truncate icodesus_categories_dumps;');
		$this->Icodesuscategorymerchantdump->query('truncate icodesuscategorymerchantdumps;');
		
		$this->__log('IcodesUS: Reset imports, ready.');
    }
    
    function admin_index()
    {
    	// ALGO
    	//
    	//	IF CanRunNow is FALSE
    	//		EXIT;
    	//	END IF;
    	//	
    	//	IF IMPORT IS NOT COMPLETE
    	//	
    	//		IF CategoryImport IS NOT COMPLETE
    	//			do ImportCategories;
    	//		END IF;
    	//		
    	//		do ImportMerchants();
    	//		do ImportCodes();		
    	//		do ImportOffers();
    	//	
    	//	ELSE 
    	//	
    	//		IF SECOND LEVEL IMPORT IS NOT COMPLETE
    	//			do 2ndLevelImport();
    	//		ELSE 
    	//			do finalImport();
    	//			do reset();
    	//		END IF;
    	//	END IF;
    	
    	if(!$this->__canRunNow()){
    		
    		$this->__log("IcodesUS: Cannot run now, invoked too early");
    		return false;
    	}
    	
    	if(!$this->__isImportComplete()){
    	
    	
	    	if("yes" != $this->Pluginsconfiguration->getDataVal(
	    												$this->__PLUGIN_ID, 
	    												$this->__PLUGIN_NAME, 
	    												'category_import'))
	    	{
	    		$this->__importCategories();
	    	
				$this->Pluginsconfiguration->setDataVal($this->__PLUGIN_ID, 
	    												$this->__PLUGIN_NAME, 
	    												'category_import',
	    												'yes');	    	
	    	}
    	
	    	$this->__importMerchants();
	  		$this->__importCodes();
	  		$this->__importOffers();
    	}
    	else
    	{
    		if(!$this->__isSecondLevelComplete()){
    			
				$this->__second_level_import();
				// mark second level import as done.
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
    	}
    }
    
    /*
     * returns next import character
     */
	function __getNextImportChar($curr_char)
	{
		if($curr_char == null) return '0';
		
		for($j=48; $j<=57; $j++){
			
			if($j == ord($curr_char)){
				if($j == 57){
					return chr(97);
				}
				else
				{
					return chr(ord($curr_char) + 1);
				}
			}	
		}
		
		for ($i=97; $i<=122; $i++) 
		{
			if($i == ord($curr_char)){
				if($i == 122){
					return 'eof';
				}
				else
				{
					return chr(ord($curr_char) + 1);
				}
			}	
		}
	}
    
    /*
     * Imports data from icodesUS and adds to dump table
     */
    function __importCategories(){
    	
		$xml = $this->__importCategoriesQuery();
		
    	if($xml->Results > 0){
		
	    	$import_count = 0;
			foreach($xml->item as $item)
			{
				$data['IcodesusCategoriesDump']['icodes_name'] = $item->category;
				$data['IcodesusCategoriesDump']['icodes_id'] = $item->id;
				
				$this->IcodesusCategoriesDump->create();
				$this->IcodesusCategoriesDump->save($data, false);
				$import_count++;
			}
			
			$this->__log("IcodesUS Category::Imported [$import_count] categories imported.");
    	
    	}else{
    		
    		$this->__log("Message: $xml->Message");
    	}
    }
    
    /*
     * retuns an xml object
     */
    function __importCategoriesQuery(){
		
    	$username = $this->__getUserName();
		$subsid = $this->__getSubscriptionId();
		
		$category_webservices_request = 'http://webservices.icodes-us.com/ws2_us.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=CategoryList';
		$category_webservices_request = str_replace("<usernamehere>", $username, $category_webservices_request);
		$category_webservices_request = str_replace("<subsidhere>", $subsid, $category_webservices_request);

		$xml = simplexml_load_file($category_webservices_request, null, LIBXML_NOCDATA);
		
		return $xml;
    }
    
    /*
     * Imports data from icodesUS and adds to dump table
     */
    function __importMerchants() {
    	
    	$curr_letter = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'merchants_import_char'
		);
		
    	$curr_page = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'merchants_import_page'
		);		
		
		if($curr_letter == 'eof'){
			return;
		}
		
		$xml = $this->__importMerchantsQuery($curr_letter, $curr_page);
		
    	if($xml->Results > 0){
		
			$import_count = 0;
			foreach($xml->item as $item)
			{
				// creating array of categories and dump to join table
				$Categories = explode(' ', $item->category_ids);
				
				foreach($Categories as $category){
	
					$join['Icodesuscategorymerchantdump']['merchant_icid'] = $item->icid;
					$join['Icodesuscategorymerchantdump']['merchant_name'] = $item->merchant;
					$join['Icodesuscategorymerchantdump']['category_id'] = $category;
					$this->Icodesuscategorymerchantdump->create();
					$this->Icodesuscategorymerchantdump->save($join, true);
				}
							
				$record['IcodesusMerchantsDump']['icid'] = $item->icid;
				$record['IcodesusMerchantsDump']['merchant'] = $item->merchant;
				$record['IcodesusMerchantsDump']['merchant_logo_url'] = $item->merchant_logo_url;
				$record['IcodesusMerchantsDump']['network'] = $item->network;
				$record['IcodesusMerchantsDump']['total_offers'] = (!empty($item->total_offers))? $item->total_offers : '0';
				$record['IcodesusMerchantsDump']['affiliate_url'] = $item->affiliate_url;
				$record['IcodesusMerchantsDump']['merchant_url'] = $item->merchant_url;
	
				$this->IcodesusMerchantsDump->create();
				$this->IcodesusMerchantsDump->save($record, false);
				$import_count++;
			}
			
			$this->__log("IcodesUS Merchants::Imported [$import_count] records from page [$curr_page] of letter [$curr_letter]");
    	
    	}else{
    		$this->__log("Message: $xml->Message");
    	}
    			
		if($curr_page >= $xml->TotalPages){
			
			$import_char = $this->__getNextImportChar($curr_letter);
			
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'merchants_import_char',
				$import_char
			);
			
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'merchants_import_page',
				1
			);
			
			if($import_char == 'eof'){
				$this->__log("Merchants::Import complete.");
			}else{
				$this->__log("Merchants::Advancing to next character [$import_char].");
			}
			
		}else{
			
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'merchants_import_page',
				$curr_page+1
			);
		}
	}
    
    /*
     * Returns an xml object
     */
    function __importMerchantsQuery($letter, $pageno)
    {
		$username = $this->__getUserName();
		$subsid = $this->__getSubscriptionId();
		
		$merchants_webservices_request = "http://webservices.icodes-us.com/ws2_us.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=MerchantList&Action=Search&Query=$letter&Page=$pageno&GroupBy=Merchant&PageSize=50";
		$merchants_webservices_request = str_replace("<usernamehere>", $username, $merchants_webservices_request);
		$merchants_webservices_request = str_replace("<subsidhere>", $subsid, $merchants_webservices_request);
		
		$xml = simplexml_load_file($merchants_webservices_request, null, LIBXML_NOCDATA);
		return $xml;
    }
    
    /*
     * Imports data from icodesUS and adds to codes dump table
     */
    function __importCodes() {
    	
    	$curr_page = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'codes_import_page'
		);		
		
		if($curr_page == 'eof'){
			
			//log here
			return;
		}
		
		$xml = $this->__importCodesQuery($curr_page);
		
    	if($xml->Results > 0){
		
			$import_count = 0;
			foreach($xml->item as $item)
			{
				
				$record['IcodesusCodesDump']['icid'] = $item->icid;
				$record['IcodesusCodesDump']['merchant_icid'] = $item->mid;
				$record['IcodesusCodesDump']['title'] = $item->title;
				$record['IcodesusCodesDump']['description'] = $item->description;
				$record['IcodesusCodesDump']['merchant'] = $item->merchant;
				$record['IcodesusCodesDump']['merchant_logo_url'] = $item->merchant_logo_url;
				$record['IcodesusCodesDump']['network'] = $item->network;
				$record['IcodesusCodesDump']['vouchercode'] = $item->voucher_code;
				$record['IcodesusCodesDump']['excode'] = $item->excode;
				$record['IcodesusCodesDump']['start_date'] = ($item->start_date == '0000-00-00 00:00:00')? date('Y-m-d H:i:s', strtotime($item->start_date)): $item->start_date;
				$record['IcodesusCodesDump']['expiry_date'] = $item->expiry_date;
				$record['IcodesusCodesDump']['affiliate_url'] = $item->affiliate_url;
				$record['IcodesusCodesDump']['merchant_url'] = $item->merchant_url;
				$record['IcodesusCodesDump']['categoryid'] = $item->category_id;
				$record['IcodesusCodesDump']['category'] = $item->category;
				
				$this->IcodesusCodesDump->create();
				$this->IcodesusCodesDump->save($record,false);
				$import_count++;
			}
			
			$this->__log("IcodesUS Codes::Imported [$import_count] records from page [$curr_page]");
    	}else{
    		$this->__log("Message: $xml->Message");
    	}
    			
		if($curr_page >= $xml->TotalPages){
						
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'codes_import_page',
				'eof'
			);
			
			$this->__log("Codes::Import complete.");
			
		}else{
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'codes_import_page',
				$curr_page+1
			);			
		}
    }
    
    /*
     * Returns an xml object
     */
    function __importCodesQuery($pageno)
    {
    	$username = $this->__getUserName();
		$subsid = $this->__getSubscriptionId();
		
		$codes_webservices_request = "http://webservices.icodes-us.com/ws2_us.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=Codes&Action=All&Sort=StartDateLow&Page=$pageno&PageSize=50";
		$codes_webservices_request = str_replace("<usernamehere>", $username, $codes_webservices_request);
		$codes_webservices_request = str_replace("<subsidhere>", $subsid, $codes_webservices_request);
		
		$xml = simplexml_load_file($codes_webservices_request, null, LIBXML_NOCDATA);
		
		return $xml;
    }

    /*
     * Imports data from icodesUS and adds to codes dump table
     */
    function __importOffers() {
    	
    	$curr_page = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'offers_import_page'
		);		
		
		if($curr_page == 'eof'){
			
			//log here
			return;
		}
		
		$xml = $this->__importOffersQuery($curr_page);
		
    	if($xml->Results > 0){
		
			$import_count = 0;
			foreach($xml->item as $item)
			{
				
				$record['IcodesusOffersDump']['icid'] = $item->icid;
				$record['IcodesusOffersDump']['merchant_icid'] = $item->mid;
				$record['IcodesusOffersDump']['title'] = $item->title;
				$record['IcodesusOffersDump']['description'] = $item->description;
				$record['IcodesusOffersDump']['merchant'] = $item->merchant;
				$record['IcodesusOffersDump']['merchant_logo_url'] = $item->merchant_logo_url;
				$record['IcodesusOffersDump']['network'] = $item->network;
				$record['IcodesusOffersDump']['start_date'] = ($item->start_date == '0000-00-00 00:00:00')? date('Y-m-d H:i:s', strtotime($item->start_date)): $item->start_date;
				$record['IcodesusOffersDump']['expiry_date'] = $item->expiry_date;
				$record['IcodesusOffersDump']['affiliate_url'] = $item->affiliate_url;
				$record['IcodesusOffersDump']['merchant_url'] = $item->merchant_url;
				$record['IcodesusOffersDump']['categoryid'] = $item->category_id;
				$record['IcodesusOffersDump']['category'] = $item->category;
				
				$this->IcodesusOffersDump->create();
				$this->IcodesusOffersDump->save($record,false);
				$import_count++;
			}
			
			$this->__log("IcodesUS Offers::Imported [$import_count] records from page [$curr_page]");
    	
    	}else{
    		$this->__log("Message: $xml->Message");
    	}
    			
		if($curr_page >= $xml->TotalPages){
						
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'offers_import_page',
				'eof'
			);
			
			$this->__log("Offers::Import complete.");
			
		}else{
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'offers_import_page',
				$curr_page+1
			);			
		}
    }
    
    /*
     * Returns an xml object
     */
    function __importOffersQuery($pageno)
    {
		$username = $this->__getUserName();
		$subsid = $this->__getSubscriptionId();
    	
		$codes_webservices_request = "http://webservices.icodes-us.com/ws2_us.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=Offers&Action=All&Sort=StartDateLow&Page=$pageno&PageSize=50";
		$codes_webservices_request = str_replace("<usernamehere>", $username, $codes_webservices_request);
		$codes_webservices_request = str_replace("<subsidhere>", $subsid, $codes_webservices_request);
		
		$xml = simplexml_load_file($codes_webservices_request, null, LIBXML_NOCDATA);
		return $xml;
    }    

    /* 
     * Here All raw dump data will be transferred to our tables
     */
    function __second_level_import()
    {
		// Transfer Categories
		$this->IcodesusCategory->query('call IcodesusCopyCategoriesFromDump();');
		$this->__log("IcodesUS: Categories Copied to middle dump tables.");
		
    	// Transfer Merchants
    	$this->IcodesusMerchant->query('call IcodesusCopyMerchantsFromDump();');
		$this->__log("IcodesUS: Merchants Copied to middle dump tables.");
    	
    	// Transfer Voucher Codes
    	$this->IcodesusCode->query('call IcodesusCopyCodesFromDump();');
		$this->__log("IcodesUS: Codes Copied to middle dump tables.");
    	
    	// Transfer Offers
    	$this->IcodesusOffer->query('call IcodesusCopyOffersFromDump();');
		$this->__log("IcodesUS: Offers Copied to middle dump tables.");
    	
    	// Transfer Category Merchant Join
    	$this->Icodesuscategorymerchant->query('call IcodesusCopyCategoryMerchantJoins();');
		$this->__log("IcodesUS: Category & Merchant join Copied to middle dump tables.");
    }
    
    /*
     * Here all data will be transferred to Live tables
     */
    function __live_data($sites)
    {
    	// Copy Categories to Live DB
    	$this->IcodesusCategory->query("call IcodesusGetImportedCategories($sites);");
		$this->__log("IcodesUS: Categories are live.");
    	
    	// Copy Merchants to Live DB
    	$this->IcodesusMerchant->query("call IcodesusGetImportedMerchants($sites);");
		$this->__log("IcodesUS: Merchants are live.");
    	
    	// Copy Category and Merchant Join to Live DB
    	$this->Icodesuscategorymerchant->query('call IcodesusGetCategoryMerchantJoins();');
		$this->__log("IcodesUS: Category & Merchants join are live.");
    	
    	// Copy Codes to Live DB
    	$this->IcodesusCode->query("call IcodesusGetImportedCodes($sites);");
		$this->__log("IcodesUS: Codes are live.");
    	
    	// Copy Offers to Live DB
    	$this->IcodesusOffer->query("call IcodesusGetImportedOffers($sites);");
		$this->__log("IcodesUS: Offers are live.");
    }
}
?>