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

class ImportsController extends Dvs4icodesukAppController {

	var $name = 'Imports';
	var $uses = array(	'IcodesukCategory', 'IcodesukCategoriesDump', 'Category', 'IcodesukMerchantsDump', 
						'IcodesukMerchant', 'IcodesukCodesDump', 'IcodesukCode','IcodesukOffer', 
						'IcodesukOffersDump','Icodesukcategorymerchantdump', 'Icodesukcategorymerchant');
	
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
					    		'offers_import_page')){
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
		
		$this->IcodesukMerchantsDump->query('truncate icodesuk_merchants_dumps;');
		$this->IcodesukMerchantsDump->query('truncate icodesuk_codes_dumps;');
		$this->IcodesukMerchantsDump->query('truncate icodesuk_offers_dumps;');
		$this->IcodesukCategoriesDump->query('truncate icodesuk_categories_dumps');
		$this->Icodesukcategorymerchantdump->query('truncate icodesukcategorymerchantdumps;');
		
		$this->__log('IcodesUK: Reset imports; ready.');
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
    		
    		$this->__log("IcodesUK: Cannot run now, invoked too early");
    		return false;
    	}
    	
    	if(!$this->__isImportComplete()){
	    	
    		if("yes" != $this->Pluginsconfiguration->getDataVal($this->__PLUGIN_ID, 
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
    		if(!$this->__isSecondLevelComplete())
    		{
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
     *  Imports ICODES UK Category List
     */
    function __importCategories(){

    	$xml = $this->__importCategoriesQuery();
    	
    	if($xml->Results > 0){
	    	
    		$import_count = 0;
			foreach($xml->item as $item){
				
				$data['IcodesukCategoriesDump']['icodes_name'] = $item->category;
				$data['IcodesukCategoriesDump']['icodes_id'] = $item->id;
				
				$this->IcodesukCategoriesDump->create();
				$this->IcodesukCategoriesDump->save($data, false);
				
				$import_count ++;
			}
			
			$this->__log("Imported [$import_count] categories from iCodesUK");
    	
    	}else{
			
    		$this->__log("Message: $xml->Message");
    	}
    }
    
    /*
     * returns an xml object
     */
    function __importCategoriesQuery(){
		
    	$username = $this->__getUserName();
		$subsid = $this->__getSubscriptionId();
		
		$category_webservices_request = 'http://webservices.icodes.co.uk/ws2.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=CategoryList';
		$category_webservices_request = str_replace("<usernamehere>", $username, $category_webservices_request);
		$category_webservices_request = str_replace("<subsidhere>", $subsid, $category_webservices_request);

		$xml = simplexml_load_file($category_webservices_request, null, LIBXML_NOCDATA);
		
		return $xml;
    }
    
    /*
     * Imports data from icodesUK and adds to dump table.
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
				$Categories = explode(' ', $item->category);
				
				foreach($Categories as $category){
	
					$join['Icodesukcategorymerchantdump']['merchant_icid'] = $item->icid;
					$join['Icodesukcategorymerchantdump']['merchant_name'] = $item->merchant;
					$join['Icodesukcategorymerchantdump']['category_id'] = $category;
					$this->Icodesukcategorymerchantdump->create();
					$this->Icodesukcategorymerchantdump->save($join, true);
				}
				
				$record['IcodesukMerchantsDump']['icid'] = $item->icid;
				$record['IcodesukMerchantsDump']['merchant'] = $item->merchant;
				$record['IcodesukMerchantsDump']['relationship'] = $item->relationship;
				$record['IcodesukMerchantsDump']['merchant_logo_url'] = $item->merchant_logo_url;
				$record['IcodesukMerchantsDump']['merchantid'] = $item->merchant_id;
				$record['IcodesukMerchantsDump']['programid'] = $item->program_id;
				$record['IcodesukMerchantsDump']['network'] = $item->network;
				$record['IcodesukMerchantsDump']['total_offers'] = (!empty($item->total_offers))? $item->total_offers : '0';
				$record['IcodesukMerchantsDump']['affiliate_url'] = $item->affiliate_url;
				$record['IcodesukMerchantsDump']['merchant_url'] = $item->merchant_url;
				
				$this->IcodesukMerchantsDump->create();
				$this->IcodesukMerchantsDump->save($record,false);
				$import_count++;
			}
			
			$this->__log("Merchants::Imported [$import_count] records from page [$curr_page] of letter [$curr_letter]");
		
    	}else{
    		
    		$this->__log("Message: $xml->Message");
    	}
		
    	if($curr_page >= $xml->TotalPages){
			
    		$import_char = $this->__getNextImportChar($curr_letter);
    		
			$this->Pluginsconfiguration->setDataVal(
				$this->__PLUGIN_ID,
				$this->__PLUGIN_NAME,
				'merchants_import_char',
				$this->__getNextImportChar($curr_letter)
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
		$merchants_webservices_request = "http://webservices.icodes.co.uk/ws2.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=MerchantList&Action=Search&Query=$letter&Page=$pageno&GroupBy=Merchant&PageSize=50";
		$merchants_webservices_request = str_replace("<usernamehere>", $username, $merchants_webservices_request);
		$merchants_webservices_request = str_replace("<subsidhere>", $subsid, $merchants_webservices_request);
		
		$xml = simplexml_load_file($merchants_webservices_request, null, LIBXML_NOCDATA);
		return $xml;
    }
    
    /*
     * Imports data from icodesUK and adds to codes dump table, once all data is dumped
     * 
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
				
				$record['IcodesukCodesDump']['icid'] = $item->icid;
				$record['IcodesukCodesDump']['merchant_icid'] = $item->mid;
				$record['IcodesukCodesDump']['title'] = $item->title;
				$record['IcodesukCodesDump']['description'] = $item->description;
				$record['IcodesukCodesDump']['merchant'] = $item->merchant;
				$record['IcodesukCodesDump']['relationship'] = $item->relationship;
				$record['IcodesukCodesDump']['merchant_logo_url'] = $item->merchant_logo_url;
				$record['IcodesukCodesDump']['merchantid'] = $item->merchant_id;
				$record['IcodesukCodesDump']['programid'] = (!empty($item->program_id))? $item->program_id : '0';
				$record['IcodesukCodesDump']['network'] = $item->network;
				$record['IcodesukCodesDump']['vouchercode'] = $item->voucher_code;
				$record['IcodesukCodesDump']['excode'] = $item->excode;
				$record['IcodesukCodesDump']['start_date'] = ($item->start_date == '0000-00-00 00:00:00')? date('Y-m-d H:i:s', strtotime($item->start_date)): $item->start_date;
				$record['IcodesukCodesDump']['expiry_date'] = $item->expiry_date;
				$record['IcodesukCodesDump']['deep_link'] = $item->deep_link;
				$record['IcodesukCodesDump']['affiliate_url'] = $item->affiliate_url;
				$record['IcodesukCodesDump']['merchant_url'] = $item->merchant_url;
				$record['IcodesukCodesDump']['categoryid'] = $item->category_id;
				$record['IcodesukCodesDump']['category'] = $item->category;
				
				$this->IcodesukCodesDump->create();
				$this->IcodesukCodesDump->save($record,false);
				$import_count++;
			}
			
			$this->__log("Codes::Imported [$import_count] records from page [$curr_page]");
    	
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
		
		$codes_webservices_request = "http://webservices.icodes.co.uk/ws2.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=Codes&Action=All&Sort=StartDateLow&Page=$pageno&PageSize=50";
		$codes_webservices_request = str_replace("<usernamehere>", $username, $codes_webservices_request);
		$codes_webservices_request = str_replace("<subsidhere>", $subsid, $codes_webservices_request);
		
		$xml = simplexml_load_file($codes_webservices_request, null, LIBXML_NOCDATA);
		
		return $xml;
    }

    /*
     * Imports data from icodesUK and adds to codes dump table
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
				
				$record['IcodesukOffersDump']['icid'] = $item->icid;
				$record['IcodesukOffersDump']['merchant_icid'] = $item->mid;
				$record['IcodesukOffersDump']['title'] = $item->title;
				$record['IcodesukOffersDump']['description'] = $item->description;
				$record['IcodesukOffersDump']['merchant'] = $item->merchant;
				$record['IcodesukOffersDump']['relationship'] = $item->relationship;
				$record['IcodesukOffersDump']['merchant_logo_url'] = $item->merchant_logo_url;
				$record['IcodesukOffersDump']['merchantid'] = $item->merchant_id;
				$record['IcodesukOffersDump']['programid'] = $item->program_id;
				$record['IcodesukOffersDump']['network'] = $item->network;
				$record['IcodesukOffersDump']['start_date'] = ($item->start_date == '0000-00-00 00:00:00')? date('Y-m-d H:i:s', strtotime($item->start_date)): $item->start_date;
				$record['IcodesukOffersDump']['expiry_date'] = $item->expiry_date;
				$record['IcodesukOffersDump']['deep_link'] = $item->deep_link;
				$record['IcodesukOffersDump']['affiliate_url'] = $item->affiliate_url;
				$record['IcodesukOffersDump']['merchant_url'] = $item->merchant_url;
				$record['IcodesukOffersDump']['categoryid'] = $item->category_id;
				$record['IcodesukOffersDump']['category'] = $item->category;
	
				$this->IcodesukOffersDump->create();
				$this->IcodesukOffersDump->save($record,false);
				$import_count++;
			}
			
			$this->__log("Offers::Imported [$import_count] records from page [$curr_page]");
    	
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
    	
		$codes_webservices_request = "http://webservices.icodes.co.uk/ws2.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=Offers&Action=All&Sort=StartDateLow&Page=$pageno&PageSize=50";
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
		$this->IcodesukCategory->query('call IcodesukCopyCategoriesFromDump();');
		$this->__log("IcodesUK: Categories copied to middle dump tables.");
		
    	// Transfer Merchants
    	$this->IcodesukMerchant->query('call IcodesukCopyMerchantsFromDump();');
		$this->__log("IcodesUK: Merchants copied to middle dump tables.");
    	
    	// Transfer Voucher Codes
    	$this->IcodesukCode->query('call IcodesukCopyCodesFromDump();');
		$this->__log("IcodesUK: Codes copied to middle dump tables.");
    	
    	// Transfer Offers
    	$this->IcodesukOffer->query('call IcodesukCopyOffersFromDump();');
		$this->__log("IcodesUK: Offers copied to middle dump tables.");
    	
    	// Transfer Category Merchant Join
    	$this->Icodesukcategorymerchant->query('call IcodesukCopyCategoryMerchantJoins();');
		$this->__log("IcodesUK: Category & Merchant relation copied to middle dump tables.");
    }
    
    /*
     * Here all data will be transferred to Live tables
     */
    function __live_data($sites)
    {
    	// Copy Categories to Live DB
    	$this->IcodesukCategory->query("call IcodesukGetImportedCategories($sites);");
		$this->__log("IcodesUK: Categories are live.");
    	
    	// Copy Merchants to Live DB
    	$this->IcodesukMerchant->query("call IcodesukGetImportedMerchants($sites);");
		$this->__log("IcodesUK: Merchants are live.");
    	
    	// Copy Category and Merchant Join to Live DB
    	$this->Icodesukcategorymerchant->query('call IcodesukGetCategoryMerchantJoins();');
		$this->__log("IcodesUK: Category & Merchant join are live.");
    	
    	// Copy Codes to Live DB
    	$this->IcodesukCode->query("call IcodesukGetImportedCodes($sites);");
		$this->__log("IcodesUK: Codes are live.");
    	
    	// Copy Offers to Live DB
    	$this->IcodesukOffer->query("call IcodesukGetImportedOffers($sites);");
		$this->__log("IcodesUK: Offers are live.");
    }
}
?>