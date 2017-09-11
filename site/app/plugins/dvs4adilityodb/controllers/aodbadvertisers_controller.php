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

class AodbadvertisersController extends Dvs4adilityodbAppController{

	var $name = 'Aodbadvertisers';
	//var $uses = array('IcodesukMerchant','Merchant','IcodesukCategory','Category');
	
	
	function index()
	{

	}
	
//	function admin_recordlimit($limit = 20)
//	{
//		$_SESSION[$this->__PLUGIN_NAME]['search']['limit'] = $limit;
//	}
//	
//	/*
//	 * addds to the like clause
//	 */
//	function admin_searchfilter($filter = 'all')
//	{
//		$this->layout = 'ajax';
//		
//		if($filter != 'all'){
//			$_SESSION[$this->__PLUGIN_NAME]['search']['filter'] = $filter;
//		}else{
//			unset($_SESSION[$this->__PLUGIN_NAME]['search']['filter']);
//		}
//	}
//	
//	/*
//	 * adds to the and clause
//	 */
//	function admin_mappingfilter($what = 'all')
//	{
//		$this->layout = 'ajax';
//		
//		$filter = null;
//		
//		switch($what){
//			case 'mapped':
//				$filter = 'IcodesukMerchant.merchant_id IS NOT NULL';
//				break;
//			case 'unmapped':
//				$filter = 'IcodesukMerchant.merchant_id IS NULL';
//				break;
//		}
//		
//		if(null != $filter)
//		{
//			$_SESSION[$this->__PLUGIN_NAME]['search']['mappingfilter'] = $filter;
//		}else{
//			unset($_SESSION[$this->__PLUGIN_NAME]['search']['mappingfilter']);
//		}
//		
//	}
//	
//	function admin_map()
//	{
//		
//	}
//	
//	function admin_map_content()
//	{
//		$limit = 8;
//		$conditions = array();
//		if(isset($_SESSION[$this->__PLUGIN_NAME]['search']) && !empty($_SESSION[$this->__PLUGIN_NAME]['search']))
//		{
//			if(!empty($_SESSION[$this->__PLUGIN_NAME]['search']['filter'])){
//				$conditions[] = "IcodesukMerchant.merchant LIKE '%{$_SESSION[$this->__PLUGIN_NAME]['search']['filter']}%'";
//			}
//			
//			if(!empty($_SESSION[$this->__PLUGIN_NAME]['search']['mappingfilter'])){
//				$conditions[] = $_SESSION[$this->__PLUGIN_NAME]['search']['mappingfilter'];
//			}
//			
//			if(!empty($_SESSION[$this->__PLUGIN_NAME]['search']['limit'])){
//				$limit = $_SESSION[$this->__PLUGIN_NAME]['search']['limit'];
//			}			
//			
//		}
//		debug($conditions,true);
//		$this->paginate['IcodesukMerchant']['limit'] = $limit;
//		$this->paginate['IcodesukMerchant']['conditions'] = $conditions;
//		$icMerchants = $this->paginate('IcodesukMerchant');
//		
//		foreach($icMerchants as &$icMerchant)
//		{
//			$icMerchant['IcodesukMerchant']['match'] = $this->__admin_map_suggest($icMerchant['IcodesukMerchant']['merchant']);
//		}
//		$this->set('icMerchants', $icMerchants);	
//	}
//	
//	function __admin_map_suggest($icodesMerchant)
//	{
//		$match = $this->Merchant->find('first', array(
//			'conditions' => array(
//				"title LIKE '%$icodesMerchant%'"
//			)
//		));
//		return $match;
//	}

}
?>