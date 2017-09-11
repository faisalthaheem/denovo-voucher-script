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

class Vwsitesmerchantscodcounts extends AppModel {
	var $name = 'Vwsitesmerchantscodcounts';
	var $displayField = 'title';

	//V 4.5 - obsoleted
	//code moved to app_controller
	//will be removed in upcoming versions.
	function getTopMerchantsForIndexPage($siteid, $randomness = 0.0, $limit = 9)
	{		
		$criteria = array(
			'conditions' => array(
				'SITEID' => $siteid,
				'istop' => 1
			),
			'fields' => array(
				'merchant_name',
				'safe_merchant_name',
				'logo_url',
				'cods_count'
			),
			'limit' => $limit
		);
		
		if(0.0 != $randomness)
		{
			$criteria['order'] = "rand() < $randomness";
		}
			
		return $this->find('all',
			$criteria 
		);
	}
	
	
	//V 4.5 - obsoleted
	//code moved to app_controller
	//will be removed in upcoming versions.
	function getDataForWidgetMerchantsMostPopular($siteid, $limit = 9)
	{
		return $this->find('all', array(
			'conditions' => array(
				'SITEID' => $siteid
			),
			'fields' => array(
				'merchant_name',
				'safe_merchant_name',
				'logo_url',
			),
			'limit' => $limit,
			'order' => 'viewcount DESC'
		));
	}
	
	//V 4.5 - obsoleted
	//code moved to app_controller
	//will be removed in upcoming versions.
	function getDataForWidgetMerchantsTop($siteid, $limit = 9)
	{
		return $this->find('all', array(
			'conditions' => array(
				'SITEID' => $siteid,
				'istop' => 1
			),
			'fields' => array(
				'merchant_name',
				'safe_merchant_name',
				'logo_url',
			),
			'limit' => $limit,
			'order' => 'viewcount DESC'
		));		
	}
	
	//V 4.5 - obsoleted
	//code moved to app_controller
	//will be removed in upcoming versions.
	function getDataForFooterRecentMerchants($siteid, $limit)
	{
		return $this->find('all', array(
			'conditions' => array(
				'SITEID' => $siteid,
			),
			'fields' => array(
				'merchant_name',
				'safe_merchant_name',
			),
			'limit' => $limit,
			'order' => 'lastviewed DESC'
		));		
	}
	
}
?>