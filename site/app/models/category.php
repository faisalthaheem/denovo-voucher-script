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

class Category extends AppModel {
	var $name = 'Category';
	var $displayField = 'catname';
	var $actsAs = array('containable');
	
	var $hasAndBelongsToMany  = array(
		'Merchant' => array(
			'className' => 'Merchant',
			'joinTable' => 'categories_merchants',
			'foreignKey' => 'category_id',
			'associationForeignKey'  => 'merchant_id',
			'conditions' => '',
			'order' => ''
		),
		
		'Site' => array(
			'className' => 'Site',
			'joinTable' => 'categories_sites',
			'foreignKey' => 'category_id',
			'associationForeignKey'  => 'site_id',
			'conditions' => '',
			'order' => ''
		)
	);
	
	/*
	var $validate = array(
				'safe_catname' => array(
					
					'Name_IsUnique' => array(
							'rule' => 'isUnique',
							'message' => 'Safe Name already exists.'
					),
					'Name_NotEmpty' => array(
							'rule' => 'notEmpty',
							'message' => 'Safe Name cannot be blank.'
					)
				)										
			);
	*/
	
	//Following being used on main page, verify if it is obsoleted by Vwcategoriesbrowse
	function getCategoryNamesAndMerchantCounts($siteid)
	{
		return $this->query('SELECT 
							    Category.id, 
							    Category.catname,
							    Category.safe_catname, 
							    (SELECT 
							        count(*) 
							    FROM
							        merchants 
							    WHERE 
							        id IN (SELECT merchant_id FROM categories_merchants WHERE category_id = Category.id)
							    ) AS merchantCount 
							FROM 
							    categories Category
							ORDER BY
							    Category.catname
							LIMIT 14
							');
	}
	
	function incrementViewCount($category_id){
		$now = date('Y-m-d H:i:s');
		$this->query("UPDATE categories SET viewcount = viewcount + 1, lastviewed='$now' WHERE id = $category_id");
	}

	function incrementViewCountBySafeCatName($safe_catname){
		$now = date('Y-m-d H:i:s');
		$this->query("UPDATE categories SET viewcount = viewcount + 1, lastviewed='$now' WHERE safe_catname = '$safe_catname'");
	}
	
	function getCategoryIDFromSafeCatname($safe_catname){
		$ret = $this->find('first',array(
			'conditions' => array(
				'safe_catname' => $safe_catname
			),
			'fields' => array(
				'id'
			)
		));
		
		if(false != $ret){
			$ret = $ret['Category']['id'];
		}
		
		return $ret;
	}
	
	function getCategoryNameFromSafeCatname($safe_catname){
		$ret = $this->find('first',array(
			'conditions' => array(
				'safe_catname' => $safe_catname
			),
			'fields' => array(
				'catname'
			)
		));
		
		if(false != $ret){
			$ret = $ret['Category']['catname'];
		}
		
		return $ret;
	}

	function getCategoryInformationbySafeName($safe_catname){
		
		$data = $this->find('first', array('conditions' => 
										array('safe_catname' => $safe_catname)));
		
		$ret['Category'] = $data['Category'];
		$ret['Category']['site'] = array();
		
		foreach($data['Site'] as $Site){
			$ret['Category']['site'][] = $Site['CategoriesSite']['site_id'];
		}
		
		return $ret;
	}

	function isParent($CatId){
		
		$bRet = false;
		$ret =	$this->find('count', array('conditions' => 
												array('Category.parent_id' => $CatId)));
		
		if($ret > 0){
			$bRet = true;	
		}
		
		return $bRet;
	}
	
	function isChild($CatId){
		
		$bRet = false;
		$ret =	$this->find('count', array('conditions' => 
												array(	'Category.parent_id <>' => 0,
														'Category.id' => $CatId)));
		if($ret > 0){
			$bRet = true;	
		}
		
		return $bRet;
	}

	function isValidSafeNameUpdate($safe_catname, $CatId){
		
		$bRet = false;
		$ret =	$this->find('count', array(
										'conditions' => array(
														'Category.safe_catname' => $safe_catname,
														'Category.id <>' => $CatId)));
		if($ret > 0){
			$bRet = true;	
		}
		
		return $bRet;
	}
	
	function isValidSafeName($safe_catname){
		
		$bRet = false;
		$ret =	$this->find('count', array(
										'conditions' => array(
														'Category.safe_catname' => $safe_catname)));
		if($ret > 0){
			$bRet = true;	
		}
		
		return $bRet;
	}
	
	function removeAllChilds($CatId){
		$this->query("UPDATE categories SET parent_id = 0 WHERE parent_id = $CatId");	
	}

	function removeParent($CatId){
		$this->query("UPDATE categories SET parent_id = 0 WHERE id = $CatId");	
	}

	function updateMerchantCategoryRelation($CatId, $MergingCatIds){
		$this->query("UPDATE categories_merchants SET category_id = $CatId WHERE category_id IN ($MergingCatIds)");
	}

	function updateSiteCategoryRelation($CatId, $MergingCatIds){
		$this->query("UPDATE categories_sites SET category_id = $CatId WHERE category_id IN ($MergingCatIds)");
	}
	
	function mergeCategory($CatId, $MergingCatIds){
		$this->query("UPDATE categories SET merged_in = $CatId WHERE id IN ($MergingCatIds)");
	}

	function getchildCats($parent){
		
		$ret = null;
		$ret = $this->find('list', array('conditions' => array('parent_id' => $parent)));
		return $ret;
	}
	
	function getParentCat($child){

		$parent = 0;
		
		$ret = $this->find('first', array('conditions' => 
											array('Category.id' => $child)
											,'fields' => array('Category.parent_id')));
	
		if($ret != false){
			$parent = $ret['Category']['parent_id'];	
		}
		
		return $parent;
	}
	
	function linkCategorySite($CatId, $SiteId){

		$this->query("REPLACE INTO categories_sites 
							(category_id, site_id)  
							VALUES 
							({$CatId}, {$SiteId})");
	}
	
	function unlinkcategories($catIDs, $siteid){
		$this->query("DELETE FROM categories_sites WHERE site_id = {$siteid} AND category_id IN ({$catIDs})");
	}
	
	function unlinkSingleCategory($id){
		$this->query("DELETE FROM categories_sites WHERE category_id = {$id}");
	}
	
	function getCatSiteRelationsbyCatId($id){
		
		$data = $this->find('first', array('conditions' => 
										array('id' => $id)));
		
		$ret['Category'] = $data['Category'];
		$ret['Category']['site'] = array();
		
		foreach($data['Site'] as $Site){
			$ret['Category']['site'][] = $Site['CategoriesSite']['site_id'];
		}
		
		return $ret;
	}
	
}
?>