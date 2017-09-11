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

class Vwbrowse extends AppModel {

	var $name = 'Vwbrowse';
	var $useTable = 'vwbrowse';

	
	//following was added to compensate of a mysql bug which returned data from mysql in the following manner
//	[0] => Array
//        (
//            [merchant] => Array
//                (
//                    [merchant_name] => Groupon
//                    [logo_url] => http://somesite/files/pictures/logo-7103c7c1-5896-0b94-49a2-9125dc71326e.jpg
//                    [MERAFFILIATEURL] => url
//                    [safe_merchant_name] => groupon.ie
//                )
//
//            [Vwbrowse] => Array
//                (
//                    [cod_type] => deal
//                    [title] => Dublin, Cork, Limerick : Laser Teeth Whitening Treatment For One Hour (€95) or 30 Minutes (€69) With Consultation at White Smile Clinic (Up to 57% Off)
//                    [CODID] => 2693
//                    [isprintable] => 0
//                    [CODAFFILIATEURL] => urlurl(http://www.groupon.ie/deals/dublin-special/White-Smile-Clinic/6067004)
//                    [safe_title] => safe title
//                    [vouchercode] => 
//                    [expiry_date] => 2014-01-01 00:00:00
//                )
//
//        )
//        
//        
//        by adding the following code, results are formatted to
//        		[Vwbrowse] => Array
//                (
//                    [merchant_name] => Groupon
//                    [logo_url] => http://somesite/files/pictures/logo-7103c7c1-5896-0b94-49a2-9125dc71326e.jpg
//                    [MERAFFILIATEURL] => url
//                    [safe_merchant_name] => groupon.ie
//                    [cod_type] => deal
//                    [title] => Dublin, Cork, Limerick : Laser Teeth Whitening Treatment For One Hour (€95) or 30 Minutes (€69) With Consultation at White Smile Clinic (Up to 57% Off)
//                    [CODID] => 2693
//                    [isprintable] => 0
//                    [CODAFFILIATEURL] => urlurl(http://www.groupon.ie/deals/dublin-special/White-Smile-Clinic/6067004)
//                    [safe_title] => safe title
//                    [vouchercode] => 
//                    [expiry_date] => 2014-01-01 00:00:00
//                )

	function afterFind($results, $primary)
	{
		if(!$primary) return $results;

		$ret = array();
		
		//we are primary and not part of an associated find
		if(is_array($results) && count($results) == 1) //find first
		{
			$tables = array_keys($results[0]);
			
			
			if(count($tables) == 1)
			{
				return $results;
			}
			
			$record = array();
			foreach($tables as $table){
				$record = array_merge($record,$results[0][$table]);
			}
			$ret[0]['Vwbrowse'] = $record;
			
		}elseif(is_array($results) && !empty($results)){ //merge all arrays if separated
			$tables = array_keys($results[0]);
			foreach($results as $result){
				$record['Vwbrowse'] = array();
				foreach($tables as $table){
					$record['Vwbrowse'] = array_merge($record['Vwbrowse'],$result[$table]);
				}
				$ret[] = $record;
			}
		}else{
			return $results;
		}

		return $ret;
	}
	
	//https://groups.google.com/forum/?fromgroups=#!topic/tickets-cakephp/0uIFWtgRJqw
	public function paginateCount($conditions = null, $recursive = 0, $extra = array()) {
		$parameters = compact('conditions', 'recursive');
 
		if (isset($extra['group'])) {
			$parameters['fields'] = $extra['group'];
 
			if (is_string($parameters['fields'])) {
				// pagination with single GROUP BY field
				if (substr($parameters['fields'], 0, 9) != 'DISTINCT ') {
					$parameters['fields'] = 'DISTINCT ' . $parameters['fields'];
				}
				unset($extra['group']);
				$count = $this->find('count', array_merge($parameters, $extra));
			} else {
				// resort to inefficient method for multiple GROUP BY fields
				$count = $this->find('count', array_merge($parameters, $extra));
				$count = $this->getAffectedRows();
			}
		} else {
			// regular pagination
			$count = $this->find('count', array_merge($parameters, $extra));
		}
		return $count;
	}
	
	function getRecentCODsForIndexPage($siteid, $limit = 18)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ." 23:59:59'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'DISTINCT(CODID) CODID',
				'logo_url',
				'title',
				'safe_title',
				'safe_merchant_name'
			),
			'limit' => $limit
			,'order' => 'CODID DESC'
			,'group' => 'CODID'
		));
	}
	
	function getTopViewedCODsForIndexPage($siteid, $limit = 18)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ." 23:59:59'",
				"expiry_date > '". date('Y-m-d') ."'" 		
			),
			'fields' => array(
				'logo_url',
				'CODID',
				'title',
				'safe_title',
				'safe_merchant_name'
			),
			'limit' => $limit,
			'order' => 'CODVIEWS DESC'
			,'group' => 'CODID'
		));
	}

	function getDataForFooterRecentCODs($siteid, $limit)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ." 23:59:59'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'logo_url',
				'CODID',
				'title',
				'safe_title',
				'safe_merchant_name'
			),
			'limit' => $limit,
			'order' => 'CODLASTVIEWED DESC'
			,'group' => 'CODID'
		));		
	}
	
	function getTopCODsDataForIndexPage($siteid, $limit = 10)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				'CODISTOP' => 1,
				"start_date < '". date('Y-m-d') ." 23:59:59'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'merchant_name',
				'logo_url',
				'CODID',
				'title',
				'cod_type',
				'CODDESC',
				'custom_cod_img_url',
				'safe_title',
				'safe_merchant_name'
			),
			'group' => 'CODID'
			,'limit' => $limit
			,'order' => 'CODID DESC'
		));		
	}
	
	function getMostViewedCODsDataForIndexPage($siteid, $limit = 10)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ." 23:59:59'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'merchant_name',
				'logo_url',
				'CODID',
				'title',
				'cod_type'
			),
			'limit' => $limit,
			'order' => 'CODVIEWS DESC'
			,'group' => 'CODID'
		));		
	}

	function getPrintableCODsDataForIndexPage($siteid, $limit = 10)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				'isprintable' => 1,
				"start_date < '". date('Y-m-d') ." 23:59:59'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'merchant_name',
				'logo_url',
				'CODID',
				'title',
				'cod_type',
				'safe_merchant_name',
				'safe_title'
			),
			'limit' => $limit
			,'order' => 'CODID DESC'
			,'group' => 'CODID'
		));		
	}	
	
	function getTopMerchantsForIndexPage($siteid, $randomness = 0.0, $limit = 9)
	{
		
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				'MERISTOP' => 1
			),
			'fields' => array(
				'DISTINCT(merchant_name) merchant_name',
				'safe_merchant_name',
				'logo_url',
				'MERID'
			),
			'limit' => $limit,
			'order' => 'MERVIEWS DESC',
			'group' => 'MERID'
		));
	
	}
}
?>