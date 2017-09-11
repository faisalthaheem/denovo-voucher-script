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

 class Cod extends AppModel {

	var $name = 'Cod';
	var $displayField = 'title';
	var $useTable = 'cods';

	var $belongsTo = array(
		'Merchant' => array(
			'className' => 'Merchant',
			'foreignKey' => 'merchant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasAndBelongsToMany = array(
		'Site' => array(
			'className' => 'Site',
			'joinTable' => 'cods_sites',
			'foreignKey' => 'cod_id',
			'associationForeignKey' => 'site_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
		,'Location' => array(
			'className' => 'Location',
			'joinTable' => 'cods_locations',
			'foreignKey' => 'cod_id',
			'associationForeignKey' => 'location_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $validate = array(
		'title' => array(
			'rule' => 'notEmpty'
			,'on' => null
		),
		'safe_title' => array(
			'coreNotEmpty' => array(
				'rule' => 'notEmpty'
				,'on' => null
				,'message' => 'Please enter a valid safe title' 
			),
			'coreIsUnique' => array(
				'rule' => 'isUnique'
				,'on' => null
				,'message' => 'This safe title is already in use'
			)
		),
		'affiliate_url' => array(
			'coreNotEmpty' => array(
				'rule' => 'notEmpty'
				,'on' => null
				,'message' => 'Please enter a valid URL'
			),
			'coreURL' => array(
				'rule' => 'url'
				,'on' => null
				,'message' => 'Please enter a valid URL'
			)
		),
		'start_date' => array(
			'rule' => 'notEmpty'
			,'on' => null
			,'message' => 'Please enter a date in YYYY-MM-DD HH:MM:SS format.'
		),
		'expiry_date' => array(
			'rule' => 'notEmpty'
			,'on' => null
			,'message' => 'Please enter a date in YYYY-MM-DD HH:MM:SS format.'
		)
	);

	function incrementViewCount($cods_id){
		$now = date('Y-m-d H:i:s');
		$this->query("UPDATE cods SET viewcount = viewcount + 1, lastviewed='$now' WHERE id = $cods_id");
	}

	function incrementLikeCount($cods_id){
		$now = date('Y-m-d H:i:s');
		$this->query("UPDATE cods SET likecount = likecount + 1, lastviewed='$now' WHERE id = $cods_id");
	}

	function incrementFBShareCount($cods_id){
		$this->query("UPDATE cods SET fbsharecount = fbsharecount + 1 WHERE id = $cods_id");
	}

	function incrementTweetCount($cods_id){
		$this->query("UPDATE cods SET tweetcount = tweetcount + 1 WHERE id = $cods_id");
	}

	function getCodData($CodId){
		$data = array();

		$ret = $this->find('first',
								array('conditions' => array('Cod.id' => $CodId)));

		if($ret){

			$data['Cod'] = $ret['Cod'];
			$data['Cod']['site'] = array();
			// get cod site relation
			foreach($ret['Site'] as $Site){
				$data['Cod']['site'][] = $Site['CodsSite']['site_id'];
			}
		}

		return $data;
	}

	function createSiteCodRelation($SiteId, $CodId){

		//insert
		$this->query("REPLACE INTO cods_sites (cod_id, site_id) VALUES ({$CodId}, {$SiteId});");
	}

	function removeSiteCodRelation($CodId){
		$this->query("DELETE FROM cods_sites WHERE cod_id = {$CodId};");
	}

	function removeSiteCodRelationSigle($CodId, $SiteId){
		$this->query("DELETE FROM cods_sites WHERE cod_id = {$CodId} AND site_id = {$SiteId};");
	}

	function removeCod($CodId){
		
		$this->query("DELETE FROM  cods_sites WHERE cod_id = $CodId");
		$this->query("DELETE FROM  cods_locations WHERE cod_id =  $CodId");
		$this->query("DELETE FROM  cods WHERE id = $CodId");
	}

	function isValidSafeTitle($safe_title){

		$bRet = false;
		$ret =	$this->find('first', array(
										'conditions' => array(
														'Cod.safe_title' => $safe_title)));
		if($ret){
			$bRet = true;
		}

		return $bRet;
	}

	function isValidSafeTitleUpdate($safe_title, $CodId){

		$bRet = false;
		$ret =	$this->find('first', array(
										'conditions' => array(
														'Cod.safe_title' => $safe_title,
														'Cod.id <>' => $CodId)));
		if($ret){
			$bRet = true;
		}

		return $bRet;
	}

}
?>