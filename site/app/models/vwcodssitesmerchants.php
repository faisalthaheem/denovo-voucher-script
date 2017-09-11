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

class Vwcodssitesmerchants extends AppModel {
	var $name = 'Vwcodssitesmerchants';
	var $displayField = 'title';
		
	function getRecentCODsForIndexPage($siteid, $limit = 18)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ."'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'logo_url',
				'CODID',
				'title',
				'safe_title',
				'safe_merchant_name'
			),
			'limit' => $limit
			,'order' => 'CODID DESC'
		));
	}
	
	function getTopViewedCODsForIndexPage($siteid, $limit = 18)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ."'",
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
			'order' => 'viewcount DESC'
		));
	}

	function getDataForFooterRecentCODs($siteid, $limit)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ."'",
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
			'order' => 'lastviewed DESC'
		));		
	}
	
	function getTopCODsDataForIndexPage($siteid, $limit = 10)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				'istop' => 1,
				"start_date < '". date('Y-m-d') ."'",
				"expiry_date > '". date('Y-m-d') ."'" 
			),
			'fields' => array(
				'merchant_name',
				'logo_url',
				'CODID',
				'title',
				'cod_type',
				'codDescription',
				'custom_cod_img_url',
				'safe_title',
				'safe_merchant_name'
			),
			'limit' => $limit
			,'order' => 'CODID DESC'
		));		
	}
	
	function getMostViewedCODsDataForIndexPage($siteid, $limit = 10)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				"start_date < '". date('Y-m-d') ."'",
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
			'order' => 'viewcount DESC'
		));		
	}

	function getPrintableCODsDataForIndexPage($siteid, $limit = 10)
	{
		return $this->find('all',array(
			'conditions' => array(
				'SITEID' => $siteid,
				'isprintable' => 1,
				"start_date < '". date('Y-m-d') ."'",
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
		));		
	}	
}
?>