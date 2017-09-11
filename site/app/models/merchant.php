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

class Merchant extends AppModel {
	var $name = 'Merchant';
	var $displayField = 'merchant_name';
	var $actsAs = array('containable');
	
	var $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'categories_merchants',
			'foreignKey' => 'merchant_id',
			'associationForeignKey' => 'category_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Site' => array(
			'className' => 'Site',
			'joinTable' => 'merchants_sites',
			'foreignKey' => 'merchant_id',
			'associationForeignKey' => 'site_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);	
	
	var $hasMany = array(
		'Cod' => array(
			'className' => 'Cod',
			'foreignKey' => 'merchant_id'
		),
		'Location' => array(
			'className' => 'Location',
			'foreignKey' => 'merchant_id'
		)		
	);
	
	function incrementViewCount($merchant_id){
		$now = date('Y-m-d H:i:s');
		$this->query("UPDATE merchants SET viewcount = viewcount + 1, lastviewed='$now' WHERE id = $merchant_id");
	}

	function incrementViewCountBySafeName($safe_name){
		$now = date('Y-m-d H:i:s');
		$this->query("UPDATE merchants SET viewcount = viewcount + 1, lastviewed='$now' WHERE safe_merchant_name = '$safe_name'");
	}
		
	function incrementLikeCount($merchant_id){
		$this->query("UPDATE merchants SET likes = likes +  1 WHERE id = $merchant_id");
	}

	function incrementFBShareCount($merchant_id){
		$this->query("UPDATE merchants SET fbsharecount = fbsharecount +  1 WHERE id = $merchant_id");
	}
	
	function incrementTweetCount($merchant_id){
		$this->query("UPDATE merchants SET tweetcount = tweetcount +  1 WHERE id = $merchant_id");
	}
	
	function isValidSafeName($safe_name){
		
		$bRet = false;
		$ret =	$this->find('first', array(
										'conditions' => array(
														'Merchant.safe_merchant_name' => $safe_name)));
		if($ret){
			$bRet = true;	
		}
		
		return $bRet;
	}
	
	function isValidSafeNameUpdate($safe_name, $MerchantId){
		
		$bRet = false;
		$ret =	$this->find('first', array(
										'conditions' => array(
														'Merchant.safe_merchant_name' => $safe_name,
														'Merchant.id <>' => $MerchantId)));
		if($ret){
			$bRet = true;	
		}
		
		return $bRet;
	}
		
	function createCategoryMerchantRelation($CatId, $MerchantId){
		$this->query("REPLACE INTO 
							categories_merchants 
							(category_id, merchant_id) 
							VALUES 
							({$CatId}, {$MerchantId});");
	}
	
	function removeCatMerchantRelation($MerchantId){
		$this->query("DELETE FROM 
						categories_merchants 
						WHERE merchant_id = {$MerchantId};");
	}
	
	function createSiteMerchantRelation($SiteId, $MerchantId){
		$this->query("REPLACE INTO 
							merchants_sites 
							(merchant_id, site_id) 
							VALUES 
							({$MerchantId}, {$SiteId});");
	}
	
	function removeSiteMerchantRelation($MerchantId){
		$this->query("DELETE FROM 
						merchants_sites 
						WHERE merchant_id = {$MerchantId};");
	}
	
	function getMerchantbySafeName($safe_name){
		
		$data = $this->find('first', array('conditions' => 
										array('safe_merchant_name' => $safe_name)));
		
		$ret['Merchant'] = $data['Merchant'];
		$ret['Merchant']['category'] = array();
		$ret['Merchant']['site'] = array();
		
		foreach($data['Category'] as $Category){
			$ret['Merchant']['category'][] = $Category['CategoriesMerchant']['category_id'];
		}
		
		foreach($data['Site'] as $Site){
			$ret['Merchant']['site'][] = $Site['MerchantsSite']['site_id'];
		}
		
		return $ret;
	}
	
	function getMerchantbyId($id){
		
		$data = $this->find('first', array('conditions' => 
										array('id' => $id)));
		
		$ret['Merchant'] = $data['Merchant'];
		$ret['Merchant']['category'] = array();
		$ret['Merchant']['site'] = array();
		
		foreach($data['Category'] as $Category){
			$ret['Merchant']['category'][] = $Category['CategoriesMerchant']['category_id'];
		}
		
		foreach($data['Site'] as $Site){
			$ret['Merchant']['site'][] = $Site['MerchantsSite']['site_id'];
		}
		
		return $ret;
	}

	function unLinkMerchants($mIDs, $SiteId){
		$this->query("DELETE FROM merchants_sites WHERE site_id = {$SiteId} AND merchant_id IN ({$mIDs})");
	}
	
	function removeMerchant($MerchantId){
 
		 /* removes all site associations of cods belongs to merchant */
		 $this->query("DELETE FROM cods_sites WHERE cod_id IN (SELECT id FROM cods WHERE merchant_id = $MerchantId)");
		 
		 /* remove all cods locations belongs to merchant */
		 $this->query("DELETE FROM cods_locations WHERE cod_id IN (SELECT id FROM cods WHERE merchant_id = $MerchantId)");
		 
		 /* remove all cods belongs to merchant */
		 $this->query("DELETE FROM cods WHERE merchant_id = $MerchantId");
		 
		 /* remove all locations belongs to merchant */
		 $this->query("DELETE FROM locations WHERE merchant_id = $MerchantId");
		    
		 /* remove all merchant site associations */
		 $this->query("DELETE FROM merchants_sites WHERE merchant_id = $MerchantId");
		    
		 /* remove all category merchant relations */
		 $this->query("DELETE FROM categories_merchants WHERE merchant_id = $MerchantId");
		    
		 /* remove merchant */
		 $this->query("DELETE FROM merchants WHERE id = $MerchantId");
	}
	
	function getMerchantNamebyId($MerchantId){
		
		$ret = null;
		
		$data = $this->find('first', array('conditions' => 
										array('id' => $MerchantId)));
	
		if($data){
			$ret = $data['Merchant']['merchant_name'];	
		}
		
		return $ret;
	}
}
?>