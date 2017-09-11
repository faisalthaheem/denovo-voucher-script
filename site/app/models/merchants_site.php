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

class MerchantsSite extends AppModel{

	var $name = 'MerchantsSite';
	//var $actsAs = array('containable');
	
//	var $belongsTo = array(
//		'Site' => array(
//			'className' => 'Site',
//			'foreignKey' => 'site_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		),
//		'Merchant' => array(
//			'className' => 'Merchant',
//			'foreignKey' => 'merchant_id',
//			'conditions' => '',
//			'fields' => '',
//			'order' => ''
//		)
//	);
	
//	function getSiteMerchantCount($site_id)
//	{
//		$count = $this->find('count', 
//								array('conditions' => 
//										array('MerchantsSite.site_id' => $site_id)));		
//		return $count;
//	}

	function linkMerchantSite($SiteId, $MerchantId){
		
		$exists = $this->find('first',
								array('conditions' =>
										array(
											'MerchantsSite.site_id' => $SiteId,
											'MerchantsSite.merchant_id' => $MerchantId)));
		if(!$exists){
			
			$data['MerchantsSite']['site_id'] = $SiteId;
			$data['MerchantsSite']['merchant_id'] = $MerchantId;
			
			$this->create();
			$this->save($data);
		}
	}
}
?>