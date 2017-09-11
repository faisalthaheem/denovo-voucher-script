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

class Vwcategoriesmerchantscodcount extends AppModel {
	var $name = 'Vwcategoriesmerchantscodcount';
	var $displayField = 'catname';
		

	//V 4.5 - obsoleted
	//code moved to app_controller
	//will be removed in upcoming versions.
	
//	function getDataForFooterRecentCategories($siteid, $limit)
//	{
//		return $this->find('all',array(
//			'conditions' => array(
//				'SITEID' => $siteid
//			),
//			'fields' => array(
//				'DISTINCT safe_catname',
//				'catname'
//			),
//			'limit' => $limit,
//			'order' => 'catlastviewed DESC'
//		));		
//	}
	
}
?>