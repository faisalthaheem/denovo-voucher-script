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

class ImportsController extends Dvs4adilityodbAppController {

	var $name = 'Imports';
	var $uses = array(	
					'Aodbcategoriesdump','Aodbcategory', 
					'Aodbadvertiserdump', 'Aodbadvertiser', 
					'Aodbadvertiserlocationsdump', 'Aodbadvertiserlocation', 
					'Aodboffersdump', 'Aodboffer', 'Pluginsconfiguration');
	
    var $helpers = array('Html');
    var $layout = 'ajax';
    
    
    /*
    #	API  
	#	https://testapi.offersdb.com/distribution/beta 	// demo
	#	https://api.offersdb.com/distribution/beta		// live
    
    # 	Category List
    #	Demo	: http://testapi.offersdb.com/distribution/beta/categories.xml?api_key=<api_key>
    #	Live	: http://api.offersdb.com/distribution/beta/categories.xml?api_key=<api_key>
	
	#	Offers
	#	All Parameters are customizable except per_page and current_page
	#		api_key:	Production key provided by Adility OfferDB
	#		city:		city name, users wants offers of for example: boston
	#		state_code:	US State code above city in for example: ma
	#		radius:		get offers in miles from city center, for example: 20 (miles) or 10 (miles)
	#		type:		currently dvs supports deal and coupon only.
	#		per_page:	how many offers should be on per page in import [Default = 100, currently we are using its Default Value]
	#		page:		current page index
	#
	#	Demo	: https://testapi.offersdb.com/distribution/beta/offers.xml?api_key=demo&city=boston&state_code=ma&radius=20&types=deal,coupon&per_page=100&page=1    
    #	Live	: https://api.offersdb.com/distribution/beta/offers.xml?api_key=<api_key>&city=<city_name>&state_code=<state_code>&radius=<radius>&types=<types>&per_page=<items_per_page>&page=<page_index>
    */
    
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
    	
    	if(round(abs($currentTime - $lastRun) / 60, 5) > 1){ 
			
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
    	
    	$currImport = $this->Pluginsconfiguration->getDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'offers_import_page'
    						);

    	if($currImport == 'eof'){
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
    
    function __isCategoryImportComplete(){
    	
    	$bRet = false;
    	
    	$category_status = $this->Pluginsconfiguration->getDataVal(
						    		$this->__PLUGIN_ID,
						    		$this->__PLUGIN_NAME,
						    		'category_import'
    							);

    	if($category_status == "yes"){
    		$bRet = true;	
    	}
    
    	return $bRet;
    }
    
    function __reset(){
    	
    	$this->Aodbcategoriesdump->query('truncate aodbcategoriesdumps;');
    	$this->Aodbadvertiserdump->query('truncate aodbadvertiserdumps;');
    	$this->Aodbadvertiserlocationsdump->query('truncate aodbadvertiserlocationsdumps;');
    	$this->Aodboffersdump->query('truncate aodboffersdumps;');
		
    	$this->Pluginsconfiguration->setDataVal(
    		$this->__PLUGIN_ID,
    		$this->__PLUGIN_NAME,
    		'offers_import_page',
    		1
    	);
    	
    	$this->Pluginsconfiguration->setDataVal(
    		$this->__PLUGIN_ID,
    		$this->__PLUGIN_NAME,
    		'second_level_import',
    		'no'
    	);
    	
    	$this->Pluginsconfiguration->setDataVal(
    		$this->__PLUGIN_ID,
    		$this->__PLUGIN_NAME,
    		'category_import',
    		'no'
    	);

    	$this->__log('AdilityODB Reset imports; ready.');
    }
    
    function admin_index()
    {
    	//ALGO
    	// IF CanRunNow IS FALSE 
    	//		Exit;
    	// END IF;
    	// IF IMPORT IS COMPLETE
    	// 		IF 2ND LEVEL IMPORT IS NOT COMPLETE
    	//			do 2ndLevelImport();
    	//		ELSE IF:
    	//			do finalImport();
    	//		END IF;
   		// ELSE IF
   		//		IF CATEGORY IMPORT IS NOT COMPLETE
    	//			IMPORT CATEGORIES
    	//		END IF
    	// 	
    	//		IMPORT OFFERS:
    	// END IF;
    	
    	
    	// check whether plugin is currently running
		if(!$this->__canRunNow()){
			
			$this->__log("AdilityODB: Cannot run now, invoked too early.");
			return;
		}
		
		// check whether import is complete (data dump from adility to our dump tables
		if($this->__isImportComplete()){
			
			if(!$this->__isSecondLevelComplete()){
				
				$this->__second_level_import();
				
				// mark second level import yes in configuration table
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
		else
		{
			
	    	$subscriptionKey = $this->__getSubscriptionKey();
	    	if($subscriptionKey == "not-configured") return;
			
	    	if(!$this->__isCategoryImportComplete()){
				
	    		$this->__importCategories($subscriptionKey);
				
	    		// mark categories import yes in configuration table
				$this->Pluginsconfiguration->setDataVal(
					    		$this->__PLUGIN_ID,
					    		$this->__PLUGIN_NAME,
					    		'category_import',
					    		'yes'
		    			);
			}
	    		
	    	$this->__importOffers($subscriptionKey);
		}
    }
    
    // Imports Categories 
    function __importCategories($subscriptionKey){
    	
    	$xml = $this->__QueryCategories($subscriptionKey);
    	if($xml->status != 'OK') return; 
    	
    	$import_count = 0;
    	foreach($xml->categories->category as $Category){

    		if(empty($Category->parent_id)){
    			$record['Aodbcategoriesdump']['parent_id'] = 0;
    		}else{
    			$record['Aodbcategoriesdump']['parent_id'] = $Category->parent_id;
    		}
    		
    		$record['Aodbcategoriesdump']['title'] = $Category->name;
    		$record['Aodbcategoriesdump']['odbid'] = $Category->id;
    		
    		$this->Aodbcategoriesdump->create();
    		$this->Aodbcategoriesdump->save($record, true);
    		$import_count++;
    	}
    	
    	$this->__log("Imported [$import_count] Categories from AdilityODB.");
    }
    
    // Returns xml Object
    function __QueryCategories($subscriptionKey){
    	
    	// Demo
    	$webservice_categories = "http://testapi.offersdb.com/distribution/beta/categories.xml?api_key=<api_key>";
    	// Live
    	//$webservice_categories = "http://api.offersdb.com/distribution/beta/categories.xml?api_key=<api_key>";
    	
    	$webservice_categories = str_replace("<api_key>", $subscriptionKey, $webservice_categories);
    	$xml = simplexml_load_file($webservice_categories, null, LIBXML_NOCDATA);
    	return $xml;
    }
    
    // Imports Offers
    function __importOffers($subscriptionKey){
    	
    	$pageIndex = $this->__getCurrentPage();
    	if($pageIndex == "not-configured" || $pageIndex == "eof") return null;
    	
    	$xml = $this->__QueryOffers($subscriptionKey, $pageIndex);
    	
    	if(null == $xml) return;
		if($xml->status != 'OK') return;
    	
    	// count variables
		$Offer_importCount = 0;
    	$Advertiser_importCount = 0;
    	$locations_importCount = 0;
    	
    	foreach($xml->offers->offer as $Offer)
    	{
    		/*
    		 * Dump Offers START
    		 */
    		$offerdump['Aodboffersdump']['aodbid'] = $Offer->id;
    		$offerdump['Aodboffersdump']['sku'] = $Offer->sku;
    		$offerdump['Aodboffersdump']['title'] = $Offer->title;
    		$offerdump['Aodboffersdump']['price'] = $Offer->price->amount;
    		$offerdump['Aodboffersdump']['cvalue'] = $Offer->value->amount;
    		$offerdump['Aodboffersdump']['quantity'] = $Offer->quantity_in_stock;
    		$offerdump['Aodboffersdump']['ctype'] = $Offer->type;
    		$offerdump['Aodboffersdump']['discounttype'] = $Offer->discount->type;
    		$offerdump['Aodboffersdump']['discountvalue'] = $Offer->discount->value;
    		$offerdump['Aodboffersdump']['fineprint'] = $Offer->fine_print;
    		$offerdump['Aodboffersdump']['description'] = $Offer->creative->description;
    		$offerdump['Aodboffersdump']['startdate'] = (!empty($Offer->start_date))? $Offer->start_date : '1970-01-01 00:00:00';
    		$offerdump['Aodboffersdump']['enddate'] = (!empty($Offer->end_date))? $Offer->end_date : '9999-01-01 00:00:00';
    		$offerdump['Aodboffersdump']['expirationdate'] = (!empty($Offer->voucher_expire->on))? $Offer->voucher_expire->on : '9999-01-01 00:00:00';
    		$offerdump['Aodboffersdump']['advertisername'] = $Offer->advertiser->name;
    		$offerdump['Aodboffersdump']['advertiserid'] = $Offer->advertiser->id;
    		$offerdump['Aodboffersdump']['illustrationurl'] = $Offer->creative->illustrations->illustration->url;
    		$offerdump['Aodboffersdump']['revenue'] = $Offer->distributor_revenue->amount;
			$offerdump['Aodboffersdump']['publishedat'] = (!empty($Offer->published_at))? $Offer->published_at :'9999-01-01 00:00:00';
			$offerdump['Aodboffersdump']['updatedat'] = (!empty($Offer->updated_at))? $Offer->updated_at :'9999-01-01 00:00:00';
			$offerdump['Aodboffersdump']['soldoutat'] = (!empty($Offer->closed_at))? $Offer->closed_at :'9999-01-01 00:00:00';
    		
    		$this->Aodboffersdump->create();
    		$this->Aodboffersdump->save($offerdump);
 			$Offer_importCount++;
 			
    		/*
    		 *  Dump Advertisers START
    		 */
    		$advertiser['Aodbadvertiserdump']['odbid'] = $Offer->advertiser->id;
    		$advertiser['Aodbadvertiserdump']['title'] = $Offer->advertiser->name;
    		$advertiser['Aodbadvertiserdump']['description'] = $Offer->advertiser->description;
    		$advertiser['Aodbadvertiserdump']['logo_url'] = $Offer->advertiser->logo->url;
    		
    		$i = 0;
    		foreach($Offer->advertiser->categories as $category){
    			
    			if($i == 0){
    				$advertiser['Aodbadvertiserdump']['category_id'] = $category->category->id;
    			}else{
    				$advertiser['Aodbadvertiserdump']['category_id'] .= ','.$category->category->id;
    			}
    			$i++;
    		}
    		
    		//	Following fields are currently not available in Advertiser's node.
    		//$advertiser['Aodbadvertiserdump']['contact_phone'] = $Offer->advertiser->contact_phone; 	
    		//$advertiser['Aodbadvertiserdump']['site_url'] = $Offer->advertiser->website_url;	
    		
    		$this->Aodbadvertiserdump->create();
    		$this->Aodbadvertiserdump->save($advertiser);
    		$Advertiser_importCount++;
    		
			/*
			 * Dump Redemption Locations START
			 */    		
			foreach($Offer->advertiser->redemption_locations as $redempLocations){
				
				$location['Aodbadvertiserlocationsdump']['advertiser_id'] = $Offer->advertiser->id;
				$location['Aodbadvertiserlocationsdump']['aodboffer_id'] = $Offer->id;
				$location['Aodbadvertiserlocationsdump']['city'] = trim($redempLocations->redemption_location->city);
				$location['Aodbadvertiserlocationsdump']['state'] = trim($redempLocations->redemption_location->state_code);
				$location['Aodbadvertiserlocationsdump']['zipcode'] = trim($redempLocations->redemption_location->postal_code);
				$location['Aodbadvertiserlocationsdump']['lat'] = trim($redempLocations->redemption_location->lat);
				$location['Aodbadvertiserlocationsdump']['lng'] = trim($redempLocations->redemption_location->lng);
				$location['Aodbadvertiserlocationsdump']['country_code'] = trim($redempLocations->redemption_location->country_code);
				$location['Aodbadvertiserlocationsdump']['address1'] = "{$location['Aodbadvertiserlocationsdump']['city']},
																		{$location['Aodbadvertiserlocationsdump']['state']},
																		{$location['Aodbadvertiserlocationsdump']['zipcode']},
																		{$location['Aodbadvertiserlocationsdump']['country_code']}"; 
				
				// Following fields are currently not available in Advertiser Redemption Locations node in ODB data
				//$location['Aodbadvertiserlocationsdump']['comments'] = $redempLocations->redemption_location->comments; // currently not available
				//$location['Aodbadvertiserlocationsdump']['address1'] = $redempLocations->redemption_location->address_line_1; // currently not available in data
				//$location['Aodbadvertiserlocationsdump']['address2'] = $redempLocations->redemption_location->address_line_2; // currently not available in data

				$this->Aodbadvertiserlocationsdump->create();
				$this->Aodbadvertiserlocationsdump->save($location);
				$locations_importCount++;
			}
    	}
    	
    	$this->__log("Page Complete: Imported [$Offer_importCount] Offers, Imported [$Advertiser_importCount] Advertisers, Imported [$locations_importCount] Locations of Page [$xml->page].");

    	if($pageIndex == $xml->total_pages){
    		
    		$this->Pluginsconfiguration->setDataVal(
    			$this->__PLUGIN_ID,
    			$this->__PLUGIN_NAME,
    			'offers_import_page',
    			'eof'
    		);
    	
    		$this->__log("All Pages Imported.");
    	
    	}else{
    		
    		$this->Pluginsconfiguration->setDataVal(
    			$this->__PLUGIN_ID,
    			$this->__PLUGIN_NAME,
    			'offers_import_page',
    			$pageIndex+1
    		);
    	}
    }
    
    // Returns xml Object
    function __QueryOffers($subscriptionKey, $pageIndex){

    	// Get and Check Parameters
    	$city = $this->__getCityName();
    	$stateCode = $this->__getStateCode();
    	$radius = $this->__getRadius();
    	$types = $this->__getTypes();
    	$itemsPerPage = $this->__getItemsPerPage();
    	
    	
    	if($city == "not-configured") return null;
    	if($stateCode == "not-configured") return null;
    	if($radius == "not-configured"){ $radius = 20;}
    	if($types == "not-configured") { $types = 'deal,coupon';}
    	if($itemsPerPage == "not-configured"){ $itemsPerPage = 50;}
    	
    	// Demo
    	$webservice_offers = "https://testapi.offersdb.com/distribution/beta/offers.xml?api_key=<api_key>&city=<city_name>&state_code=<state_code>&radius=<radius>&types=<types>&per_page=<items_per_page>&page=<page_index>";
    	// Live
    	//$webservice_offers = "https://api.offersdb.com/distribution/beta/offers.xml?api_key=<api_key>&city=<city_name>&state_code=<state_code>&radius=<radius>&types=<types>&per_page=<items_per_page>&page=<page_index>";
    	
    	$webservice_offers = str_replace("<api_key>", $subscriptionKey, $webservice_offers);
    	$webservice_offers = str_replace("<city_name>", $city, $webservice_offers);
    	$webservice_offers = str_replace("<state_code>", $stateCode, $webservice_offers);
    	$webservice_offers = str_replace("<radius>", $radius, $webservice_offers);
    	$webservice_offers = str_replace("<types>", $types, $webservice_offers);
    	$webservice_offers = str_replace("<items_per_page>", $itemsPerPage, $webservice_offers);
    	$webservice_offers = str_replace("<page_index>", $pageIndex, $webservice_offers);
    	
    	$xml = simplexml_load_file($webservice_offers, null, LIBXML_NOCDATA);
    	return $xml;
    }

    /*
     * copies all imported data to middle dump tables
     */
    function __second_level_import(){

		// Transfer Categories
		$this->Aodbcategory->query('call AdilityODBCopyCategoriesFromDump();');
		$this->__log("AdilityODB: Categories Copied to middle dump table.");
		
    	// Transfer Advertisers
    	$this->Aodbadvertiser->query('call AdilityODBCopyAdvertisersFromDump();');
		$this->__log("AdilityODB: Advertisers Copied to middle dump table.");
    	
    	// Transfer Offers
    	$this->Aodboffer->query('call AdilityODBCopyOffersFromDump();');
    	$this->__log("AdilityODB: Offers Copied to middle dump table.");
    	
    	// Transfer Redemption locations
    	$this->Aodboffer->query('call AdilityODBCopyLocationsFromDump();');
    	$this->__log('AdilityODB: Redemption Locations copied to middle dump tablel');
    }
    
    /*
     * transfers imported data to live db tables
     */
    function __live_data($sites){
    	
    	// Copy Categories to Live DB
    	$this->Aodbcategory->query("call AdilityODBGetImportedCategories($sites);");
		$this->__log("AdilityODB: Categories are live now.");
    	
    	// Copy advertisers to Live DB
    	$this->Aodbadvertiser->query("call AdilityODBGetImportedAdvertisers($sites);");
		$this->__log("AdilityODB: Advertisers are live now.");
    	
   		// Copy Offers to Live DB
    	$this->Aodboffer->query("call AdilityODBGetImportedOffers($sites);");
		$this->__log("AdilityODB: Offers are live now.");
		
		// Copy Locations to Live DB
		$this->Aodbadvertiserlocation->query('call AdilityODBGetImportedLocations();');
		$this->__log('AdilityODB, Location are live now.');
    }
}
?>