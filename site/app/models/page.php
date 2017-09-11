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

class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'pagename';
	var $actsAs = array('containable');
	var $useTable = 'pages';
	
	var $belongsTo = array(
		'Site' => array(
			'className' => 'Site',
			'foreignKey' => 'site_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	function getPageInfo($PageId){

		$this->recursive = -1;
		$data = $this->find('first', array(
								'conditions' => array(
										'Page.id' => $PageId
									)
								)
							);
		return $data;
	}
	
	//Used with pages::display to determine whether a requested
	//page is cms driven or static on disk
	function checkPageExists($siteid, $linkname = null)
	{
		if(null == $linkname) return false;
		if(empty($linkname)) return false;
		
		$page = $this->find('first',array(
			'conditions' => array(
				'site_id' => $siteid,
				'linkname' => $linkname
			)
		));
		
		return $page;
	}

	//Used with pages create
	function isValidSafeName($siteId, $safe_name){
		
		$bRet = false;
		$ret =	$this->find('count', 
					array(
						'conditions' => array(
							'Page.site_id' => $siteId
							,'Page.linkname' => $safe_name
						)
					)
				);
		
		if($ret){
			$bRet = true;	
		}
		
		return $bRet;
	}

	//used with pages edit
	function isValidSafeNameUpdate($siteId, $safe_name, $edited_page_id){
		
		$bRet = false;
		$ret =	$this->find('count', 
					array(
						'conditions' => array(
							'Page.site_id' => $siteId,
							'Page.id <>' => $edited_page_id,
							'Page.linkname' => $safe_name
						)
					)
				);
				
		if($ret){
			$bRet = true;	
		}
		
		return $bRet;
	}	
}
?>