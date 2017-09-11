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

class CategoriesController extends AppController {

	var $name = 'Categories';
	var $uses = array(	'Category'
						,'Vwcategoriesbrowse' 
						,'Vwallcategoriesbrowse');

	var $cacheAction = array(
		'index' =>  CACHE24HR,
       	'expand' => CACHE24HR,
	);
	
	public function beforeFilter() {
		
		parent::beforeFilter();
       	
		$this->Auth->allow(
       		'index' 
       		,'expand'
       		,'incrementViewCountBySafeCatName'
       		,'increment_view_count'
       	);
	}	
	
	
	function index() {

		$this->loadModel('Vwbrowse');
		
		
		//build the association on the fly to prevent performance hit on other pages
		$this->Vwbrowse->bindModel(	
			array(
				'hasMany' => array(
					'Children' => array(
						'className' => 'Vwbrowse',
						'foreignKey' => 'parent_id'
					)
				)
			)
		);
		
		$this->Vwbrowse->primaryKey = 'CATID';
		
		$categories = $this->Vwbrowse->find('threaded',array(
			'conditions' => array(
				'SITEID' => $this->site_id,
			),
			'fields' => array(
				'distinct(catname) catname',
				'CATID',
				'parent_id',
				'safe_catname'
			)
			,'order' => 'catname ASC'
		));

		$this->set('categories',$categories);
	}
	
	function expand($safe_catname = null)
	{
		if(null == $safe_catname){
			$this->redirect('/');
			return;
		}
		
		$parent_id = $this->Category->getCategoryIDFromSafeCatname($safe_catname);
		if(false == $parent_id){
			$this->redirect('/');
			return;
		}
		
		$pagination_params = array(
			'Vwcategoriesbrowse'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id,
					'parent_id' => $parent_id,
					'merged_in' => 0 //only non merged/non deleted categories
				),
				'fields' => array(
					'catname',
					'safe_catname',
					'parent_id',
					'countMerchants',
				),
				'limit' => 20
			)
		);		
		
		$this->paginate = $pagination_params;
		$this->set('categories',$this->paginate('Vwcategoriesbrowse'));
		
		$this->Category->recursive = -1;
		$parent_category = $this->Category->find('first',array(
			'conditions' => array(
				'id' => $parent_id
			),
			'fields'=>array(
				'catname',
				'metakw',
				'metadesc'
			)
		));
		$this->set('parentcategory',$parent_category );
		
		$this->set('meta_desc', $parent_category['Category']['metadesc']);
		$this->set('meta_kws', $parent_category['Category']['metakw']);
		
		$this->set('title_for_layout', $parent_category['Category']['catname']);
		
	}
	
	function widget_treeview($uniqueWidgetID = '0')
	{
		$this->layout = 'ajax';
		$this->set('uniqueWidgetID',$uniqueWidgetID);
		$this->set('categories',$this->Category->find('threaded'));
	}
	
	function increment_view_count($safe_cat_name)
	{
		$this->layout = 'ajax';

		$this->Category->incrementViewCountBySafeCatName($safe_cat_name);
	} 
	
	/*
	 * Admin functions started
	 */
	function admin_widget_manage_categories($firstLoad = null){
		
		$this->layout = 'ajax';
		
		$conditions = array();
		$conditions['parent_id'] = 0;
		$conditions['merged_in'] = 0;
		
		if($firstLoad == null){
			
			if(!empty($this->data)){
				
				if(!empty($this->data['Category']['search'])){
					$conditions[] = "catname LIKE '%{$this->data['Category']['search']}%'";
					$_SESSION['Category']['search'] = $this->data['Category']['search'];		
				}
				
			}else{
				
				if(isset($_SESSION['Category']['search'])){
					$conditions[] = "catname LIKE '%{$_SESSION['Category']['search']}%'";
				}
			}
		}
		else
		{
			unset($_SESSION['Category']['search']);
		}
		
		$pagination_params = array(
			'Vwallcategoriesbrowse' => array(
				'conditions' => $conditions 
				,'fields' => array(
					'catname',
					'safe_catname',
					'viewcount',
					'source',
					'countMerchants',
					'parent_id'
				),
				'contain' => array(
					'Child' => array(
						'conditions' => array(),
						'fields' => array(
							'id',
							'catname',
							'safe_catname',
							'viewcount',
							'source',
							'countMerchants',
							'parent_id'
						),
					)
				),
				'limit' => 15,
				'order' => 'Vwallcategoriesbrowse.catname'
			)
		);		
		
		$this->paginate = $pagination_params;
		$this->set('categories',$this->paginate('Vwallcategoriesbrowse'));
		$this->set('view', $this->params['action']);
		
		// saving url to session so that we can update manage categories view
		$_SESSION['Auth']['ManageCategoriesURL'] = Router::url($this->here, true);
		
	}
	
	function admin_widget_manage_site_categories($siteid, $firstLoad = null)
	{
		$this->layout = 'ajax';
		
		$conditions = array();
		
		$conditions['SITEID'] = $siteid;
		$conditions['parent_id'] = 0;
		$conditions['merged_in'] = 0;
		
		if($firstLoad == null){
			
			if(!empty($this->data)){
				if(!empty($this->data['Category']['search'])){
					$conditions[] = "catname LIKE '%{$this->data['Category']['search']}%'";
					$_SESSION['Category']['search'] = $this->data['Category']['search'];		
				}
			
			}else{
				if(isset($_SESSION['Category']['search'])){
					$conditions[] = "catname LIKE '%{$_SESSION['Category']['search']}%'";
				}
			}
		}
		else
		{
			unset($_SESSION['Category']['search']);
		}
		
		$pagination_params = array(
			'Vwcategoriesbrowse' => array(
				'conditions' => $conditions,
				'fields' => array(
					'catname',
					'safe_catname',
					'viewcount',
					'source',
					'countMerchants',
					'parent_id'
				),
				'contain' => array(
					'Children' => array(
						'conditions' => array(),
						'fields' => array(
							'id',
							'catname',
							'safe_catname',
							'viewcount',
							'source',
							'countMerchants',
							'parent_id'
						)
					)
				),
				'limit' => 15,
				'order' => 'Vwcategoriesbrowse.catname'
			)
		);		
		
		$this->paginate = $pagination_params;
		$this->set('categories',$this->paginate('Vwcategoriesbrowse'));
		
		$this->set('siteid', $siteid);
		$this->set('view', $this->params['action']);
		
		// saving url to session so that we can update manage categories view
		$_SESSION['Auth']['ManageCategoriesURL'] = Router::url($this->here, true);
	}
	
	function admin_widget_categories_edit($safeCatName = null){
		
		if(!empty($this->data)){
			
			$validationErrors = array();
			$widget_category_edit_result = false;
			
			if(strlen($this->data['Category']['catname']) == 0){
				$validationErrors[] = 'Category Name: required.';
			}
			if(strlen($this->data['Category']['safe_catname']) == 0){
				$validationErrors[] = 'Safe Name: required.';
			}
			if($this->Category->isValidSafeNameUpdate($this->data['Category']['safe_catname'], $this->data['Category']['id'])){
				$validationErrors[] = 'Safe Name: Already exists.';
			}
			
			// check if parent category is selected
			if($this->data['Category']['parent_id'] != 0){

				// since parent is selected for this category
				// so, to make this category child we have to remove all its relations
				$this->Category->removeAllChilds($this->data['Category']['id']);
			}
			
			if(empty($validationErrors)){
				
				$this->data['Category']['autoupdate'] = 0;
				
				if($this->Category->save($this->data)){
					
					// Category Sites
					$this->Category->unlinkSingleCategory($this->data['Category']['id']);
					foreach($this->data['Category']['site'] as $SiteId){
						$this->Category->linkCategorySite($this->data['Category']['id'], $SiteId);					
					}
					
					$widget_category_edit_result = true;
				
				}else{
					
					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_category_edit_result = false;
				}
			}
			
			$this->set('widget_category_edit_result', $widget_category_edit_result);
			$this->set('validationErrors', $validationErrors);
		}

		if(!empty($safeCatName)){
			$this->data = $this->Category->getCategoryInformationbySafeName($safeCatName);
		}
		
		$catlist = $this->Category->find('list', array('conditions' => array('parent_id' => 0)));
		$catlist[0] = 'none';
		$this->set('catlist', $catlist);
		
		$sitelist = $this->Site->find('list');
		$this->set('sitelist', $sitelist);
	}

	function admin_widget_categories_add($container = 'none'){
		
		if(!empty($this->data)){
			
			$validationErrors = array();
			$widget_category_add_result = false;
			
			if(strlen($this->data['Category']['catname']) < 1){
				$validationErrors[] = 'Category Name: required.';
			}
			
			if(strlen($this->data['Category']['safe_catname']) < 1){
				$validationErrors[] = 'Safe Name: required.';
			}
			
			if($this->Category->isValidSafeName($this->data['Category']['safe_catname'])){
				$validationErrors[] = 'Safe Name: Already exists.';
			}
			
			if(empty($validationErrors)){
				
				$this->data['Category']['autoupdate'] = 1;
				$this->data['Category']['merged_in'] = 0; 
				$this->data['Category']['source'] = 'Manual';
				
				$this->Category->create();
				
				if($this->Category->save($this->data)){
					
					foreach($this->data['Category']['site'] as $siteId){
						$this->Category->linkCategorySite($this->Category->id, $siteId);
					}
					
					$widget_category_add_result = true;
				
				}else{
					
					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_category_add_result = false;
				}
			}
			
			$this->set('widget_category_add_result', $widget_category_add_result);
			$this->set('validationErrors', $validationErrors);
		}
		
		$catlist = $this->Category->find('list', array('conditions' => array('parent_id' => 0)));
		$catlist[0] = 'none';
		$this->set('catlist', $catlist);
		
		$sitelist = $this->Site->find('list');
		$this->set('sitelist', $sitelist);
		
		$this->set('container', $container);
	}
	
	function admin_widget_category_merge($catIDs = null){
		
		if(!empty($this->data)){
			
			$widget_category_merge_result = false;
			$validationErrors = array();
			$catIDs = $this->data['Category']['catIDs'];	
			
			$categories = explode(',', $catIDs);
			
			// Merging
			foreach($categories as $category){
				
				// remove relations before merge
				$this->Category->removeAllChilds($category);
				$this->Category->removeParent($category);
			}
			
			// Merge Now
			$this->Category->updateMerchantCategoryRelation($this->data['Category']['category_id'], $catIDs);
			$this->Category->updateSiteCategoryRelation($this->data['Category']['category_id'], $catIDs);
			$this->Category->mergeCategory($this->data['Category']['category_id'], $catIDs);
			
			$widget_category_merge_result = true;
			$this->set('widget_category_merge_result', $widget_category_merge_result);
		}
		
		$this->set('catIDs', $catIDs);
		$catlist = $this->Category->find('list', array('conditions' => array("Category.id NOT IN ({$catIDs})")));
		$this->set('catlist', $catlist);
	}
	
	function admin_widget_category_lnk_to_site($catIDs = null){

		if(!empty($this->data)){
			
			$widget_category_link_sites_result = false;
			$validationErrors = array();
			$catIDs = $this->data['Category']['catIDs'];	
			
			$categories = explode(',', $catIDs);
			
			// link
			foreach($this->data['Category']['sites'] as $index=>$sId){

				foreach($categories as $category){
					
					// remove relations before merge
					if($this->Category->isParent($category)){
						$childCats = $this->Category->getchildCats($category);
						foreach($childCats as $id=>$name){
							$this->Category->linkCategorySite($id, $sId);
						}
					}
					
					if($this->Category->isChild($category)){
						$this->Category->linkCategorySite($this->Category->getParentCat($category), $sId);	
					}

					$this->Category->linkCategorySite($category, $sId);
				}
			}
			
			$widget_category_link_sites_result = true;
			$this->set("widget_category_link_sites_result", $widget_category_link_sites_result);
		}
		
		$sites = $this->Category->Site->find('list');
		$this->set('catIDs', $catIDs);
		$this->set('sites', $sites);
	}

	function admin_widget_single_category_lnk_to_site($catid = null){

		if(!empty($this->data)){

			$widget_single_category_link_sites_result = false;
			$validationErrors = array();
			
			$catID = $this->data['Category']['id'];
			$this->Category->unlinkSingleCategory($catID);
			
			// link
			foreach($this->data['Category']['site'] as $index => $sId){

				if($this->Category->isParent($catID)){
					$childCats = $this->Category->getchildCats($catID);
					foreach($childCats as $id=>$name){
						$this->Category->linkCategorySite($id, $sId);
					}
				}
				
				if($this->Category->isChild($catID)){
					$this->Category->linkCategorySite($this->Category->getParentCat($catID), $sId);	
				}

				$this->Category->linkCategorySite($catID, $sId);
			}
			
			$widget_single_category_link_sites_result = true;
			$this->set("widget_single_category_link_sites_result", $widget_single_category_link_sites_result);
		}
		
		if(!empty($catid)){
			$this->data = $this->Category->getCatSiteRelationsbyCatId($catid);	
		}
		
		$sites = $this->Category->Site->find('list');
		$this->set('catid', $catid);
		$this->set('sites', $sites);
	}
	
	function admin_widget_categories_unlink($catIDs, $siteid){
		$this->Category->unlinkcategories($catIDs, $siteid);
	}
	
	function admin_widget_categories_just_unlink($catIDs = null){
		
		$this->layout = 'ajax';
		
		if(!empty($this->data)){
			
			$widget_category_unlink_sites_result = false;
			$validationErrors = array();
			$catIDs = $this->data['Category']['catIDs'];	
			
			$categories = explode(',', $catIDs);
			
			// unlink
			foreach($this->data['Category']['sites'] as $index => $sId){

				foreach($categories as $category){
					
					// unlink childs
					if($this->Category->isParent($category)){
						$childCats = $this->Category->getchildCats($category);
						foreach($childCats as $id=>$name){
							$this->Category->unlinkcategories($id, $sId);
						}
					}
					
					// unlink parent
					if($this->Category->isChild($category)){
						$this->Category->unlinkcategories($this->Category->getParentCat($category), $sId);	
					}

					// unlink category
					$this->Category->unlinkcategories($category, $sId);
				}
			}
			
			$widget_category_unlink_sites_result = true;
			$this->set("widget_category_unlink_sites_result", $widget_category_unlink_sites_result);
		}
		
		$sites = $this->Category->Site->find('list');
		$this->set('catIDs', $catIDs);
		$this->set('sites', $sites);
	}

	function admin_check_safe_name_exists(){
		
		$this->layout = 'ajax';
		
		if(!empty($this->data)){
			
			$Results = array();	
			$bRet = true;
			
			if($this->data['Category']['id'] == 0){
				
				$bRet = $this->Category->isValidSafeName($this->data['Category']['safe_catname']);	
			
			}else{
				
				$bRet = $this->Category->isValidSafeNameUpdate(
												$this->data['Category']['safe_catname'],
												$this->data['Category']['id']
											);	
			}
			
			if($bRet){
				$Results['Exists'] = 'yes';
			}else{
				$Results['Exists'] = 'no';
			}
			
			$this->set('results', json_encode($Results));
		}
	}
}
?>