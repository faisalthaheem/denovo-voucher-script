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

class MerchantsController extends AppController {

	var $name = 'Merchants';
	var $helpers = array('Barcode');
	var $uses = array(	'Merchant',
						'Category',
						'Site',
						'MerchantsSite',
						'CategoriesMerchant',
						'Vwcategoriesmerchantscodcount',
						'Vwbrowse',
						'Vwsitesmerchantscodcounts',
						'Vwmerchantsbrowse',
						'Vwsitemerchantsbrowse');
	
	var $components = array(
		'Picupload'
	);
	
	var $cacheAction = array(
		'index' => CACHE24HR,
       	'by_category' => CACHE24HR,
       	'by_category_filter_by_letter' => CACHE24HR,
       	'detail' => CACHE24HR,
	);

	public function beforeFilter() {
       parent::beforeFilter();

       $this->Auth->allow(	
       						'index',
       						'by_category',
       						'by_category_filter_by_letter',
       						'search',
       						'detail',
       						'incrementfbsharecount',
       						'incrementtweetcount',
       						'increment_view_count'
      );
	}

	function index($filter_by_letter = null) {

		if(null == $filter_by_letter){
			unset($_SESSION['merchants']['index_letter_filter']);
		}else{
			$_SESSION['merchants']['index_letter_filter'] = $filter_by_letter;
		}

		//set back url for the merchant detail page to revert to
		$this->_setBackURL('merchants');

		$pagination_params = array(
			'Vwsitesmerchantscodcounts'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id
				),
				'limit' => 27,
				'order' => 'cods_count DESC'
			)
		);

		if(isset($_SESSION['merchants']['index_letter_filter'])){

			if($_SESSION['merchants']['index_letter_filter'] == '0-9'){
				$pagination_params['Vwsitesmerchantscodcounts']['conditions'][] = "ASCII(SUBSTRING(merchant_name,1)) BETWEEN ASCII('0') AND ASCII('9')";
			}else{
				$pagination_params['Vwsitesmerchantscodcounts']['conditions'][] = "UCASE(merchant_name) LIKE '{$_SESSION['merchants']['index_letter_filter']}%'";
			}
		}

		$this->paginate = $pagination_params;
		$this->set('merchants',$this->paginate('Vwsitesmerchantscodcounts'));
	}

	function by_category($category = null){

		if(null == $category){
			$this->redirect('/');
			return;
		}
		
		$this->Category->recursive = -1;
		$catInfo = $this->Category->find('first',array(
			'conditions' => array(
				'safe_catname' => $category
			),
			'fields' => array(
				'id', 'catname', 'safe_catname'
			)
		));
		
		
		$cat_id = false;
		if(false != $catInfo){
			$cat_id = $catInfo['Category']['id'];
			
			$this->set('catInfo',$catInfo);
		}
		
		if(false == $cat_id) {
			$this->redirect('/');
			return;
		}

		$_SESSION['merchants']['by_category'] = $category;

		//set back url for the merchant detail page to revert to
		$this->_setBackURL('merchants');

		$pagination_params = array(
			'Vwcategoriesmerchantscodcount'=>array(
				'conditions' => array(
					'CATID' => $cat_id
					,'SITEID' => $this->site_id
				),
				'limit' => 60,
				'order' => 'merchant_name, cods_count DESC'
			)
		);

		if(isset($_SESSION['merchants']['by_category_filter_by_letter'])){

			if($_SESSION['merchants']['by_category_filter_by_letter'] == '0-9'){
				$pagination_params['Vwcategoriesmerchantscodcount']['conditions'][] = "ASCII(SUBSTRING(merchant_name,1)) BETWEEN ASCII('0') AND ASCII('9')";
			}else{
				$pagination_params['Vwcategoriesmerchantscodcount']['conditions'][] = "UCASE(merchant_name) LIKE '{$_SESSION['merchants']['by_category_filter_by_letter']}%'";
			}
		}

		$this->paginate = $pagination_params;
		$this->set('merchants',$this->paginate('Vwcategoriesmerchantscodcount'));
	}

	function by_category_filter_by_letter($letter)
	{
		if(null != $letter){
			if('none' != $letter){
				$_SESSION['merchants']['by_category_filter_by_letter'] = $letter;
			}else{
				unset($_SESSION['merchants']['by_category_filter_by_letter']);
			}
		}

		$this->by_category(
			$_SESSION['merchants']['by_category']
		);

		$this->render('by_category');
	}

	function search() {

		$this->_setBackURL('merchants');

		$pagination_params = array(
			'Vwsitesmerchantscodcounts'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id
				),
				'limit' => 60,
				'order' => 'merchant_name'
			)
		);

		if(!empty($this->data)){
			$_SESSION['merchants']['search_kw'] = $this->data['Searches']['keyword'];
		}elseif(isset($_REQUEST['kw'])){
			$_SESSION['merchants']['search_kw'] = $_REQUEST['kw'];
		}

		if(isset($_SESSION['merchants']['search_kw']))
		{
			$pagination_params['Vwsitesmerchantscodcounts']['conditions'][] = "merchant_name LIKE '%{$_SESSION['merchants']['search_kw']}%'";
		}

		$this->paginate = $pagination_params;
		$this->set('merchants',$this->paginate('Vwsitesmerchantscodcounts'));
	}

	function detail($safe_merchant_name = null)
	{
		if(null == $safe_merchant_name){
			return;
		}

		
		$_SESSION['merchants']['detail'] = $safe_merchant_name;

		$cods = $this->Vwbrowse->find('all', array(
			'conditions' => array(
				'safe_merchant_name' => $safe_merchant_name
				,'SITEID' => $this->site_id
				,"start_date <= '". date('Y-m-d') ."'"
				,"expiry_date > '". date('Y-m-d') ."'" 
			)
			,'order' => 'CODID DESC'
		));
		$this->set('cods',$cods);

		$this->Merchant->recursive = -1;
		$merchant = $this->Merchant->find('first',array(
			'conditions' => array(
				'safe_merchant_name' => $safe_merchant_name
			)
		));
		
		$this->_setBackURL('merchantsdetail');
				
		$this->set('merchant',$merchant);
		$this->set('safe_merchant_name',$safe_merchant_name);

		$this->set('meta_title', $merchant['Merchant']['metatitle']);
		$this->set('meta_desc', $merchant['Merchant']['metadesc']);
		$this->set('meta_kws', $merchant['Merchant']['metakw']);

		$this->set('title_for_layout', $merchant['Merchant']['merchant_name']);
		
		//Set Open Graph data
		$this->setOGInfo(
			$merchant['Merchant']['merchant_name']
			,'company'
			,Router::url("/{$merchant['Merchant']['safe_merchant_name']}",true)
			,$merchant['Merchant']['logo_url']
			,$merchant['Merchant']['metadesc']
		);
		
	}

	function incrementfbsharecount($merchantid = null)
	{
		if(null == $merchantid) return;
		$this->Merchant->incrementFBShareCount($merchantid);

		$this->layout = 'ajax';
	}

	function incrementtweetcount($merchantid = null)
	{
		if(null == $merchantid) return;
		$this->Merchant->incrementTweetCount($merchantid);

		$this->layout = 'ajax';
	}
	
	function increment_view_count($safe_merchant_name)
	{
		$this->layout = 'ajax';
		
		$this->Merchant->incrementViewCountBySafeName($safe_merchant_name);
	} 

	/*
	 * Admin area starts
	 */
	function admin_widget_manage_merchants($firstLoad = null){

		$this->layout = 'ajax';

		$conditions = array();
		if($firstLoad == null){

			if(!empty($this->data)){

				if(!empty($this->data['Merchant']['search'])){
					$conditions[] = "merchant_name LIKE '%{$this->data['Merchant']['search']}%'";
					$_SESSION['Merchant']['search'] = $this->data['Merchant']['search'];
				}

			}else{

				if(isset($_SESSION['Merchant']['search'])){
					$conditions[] = "merchant_name LIKE '%{$_SESSION['Merchant']['search']}%'";
				}
			}
		}
		else
		{
			unset($_SESSION['Merchant']['search']);
		}

		$pagination_params = array(
			'Vwmerchantsbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'id', 'source', 'merchant_name', 'safe_merchant_name'
					, 'description', 'logo_url', 'site_url', 'affiliate_url'
					, 'likes', 'viewcount', 'istop', 'fbsharecount', 'tweetcount'
					, 'countCODs', 'countLocations'
				),
				'contain' => array()
				,'limit' => 20
				,'order' => 'Vwmerchantsbrowse.merchant_name'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('merchants',$this->paginate('Vwmerchantsbrowse'));
		$this->set('view', $this->params['action']);

		$this->_setBackURL('merchants');
		// saving url to session so that we can update manage merchants view
		$_SESSION['Auth']['ManageMerchantURL'] = Router::url($this->here, true);
	}

	function admin_widget_manage_site_merchants($siteid, $firstLoad = null){

		$this->layout = 'ajax';

		$conditions = array();
		$conditions['SITEID'] = $siteid;
		if($firstLoad == null){

			if(!empty($this->data)){

				if(!empty($this->data['Merchant']['search'])){
					$conditions[] = "merchant_name LIKE '%{$this->data['Merchant']['search']}%'";
					$_SESSION['Merchant']['search'] = $this->data['Merchant']['search'];
				}

			}else{

				if(isset($_SESSION['Merchant']['search'])){
					$conditions[] = "merchant_name LIKE '%{$_SESSION['Merchant']['search']}%'";
				}
			}
		}
		else
		{
			unset($_SESSION['Merchant']['search']);
		}

		$pagination_params = array(
			'Vwsitemerchantsbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'SITEID', 'fqdn', 'id', 'source', 'merchant_name', 'safe_merchant_name',
					'description', 'logo_url', 'site_url', 'affiliate_url' , 'likes', 'viewcount',
					'istop', 'fbsharecount', 'tweetcount',
					'countCODs', 'countLocations'
				)
				,'contain' => array()
				,'limit' => 20
				,'order' => 'Vwsitemerchantsbrowse.merchant_name'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('merchants',$this->paginate('Vwsitemerchantsbrowse'));
		$this->set('view', $this->params['action']);
		$this->set('siteid', $siteid);

		$this->_setBackURL('merchants');
		// saving url to session so that we can update manage merchants view
		$_SESSION['Auth']['ManageMerchantURL'] = Router::url($this->here, true);
	}

	function admin_widget_merchants_add($container = 'none'){

		if(!empty($this->data)){

			$validationErrors = array();
			$widget_merchant_add_result = false;

			if(strlen($this->data['Merchant']['merchant_name']) < 1){
				$validationErrors[] = 'Merchant Name: required.';
			}

			if(strlen($this->data['Merchant']['safe_merchant_name']) < 1){
				$validationErrors[] = 'Safe Name: required.';
			}

			if(strlen($this->data['Merchant']['site_url']) < 1){
				$validationErrors[] = 'Site URL: required.';
			}

			if(strlen($this->data['Merchant']['logo_url']) < 1){
				$validationErrors[] = 'Logo URL: required.';
			}else{

				//convert uuid to path if applicable
				if(FALSE == strstr($this->data['Merchant']['logo_url'],'http'))
				{
					$this->loadModel('Picture');
					$filename = $this->Picture->getPictureFilenameFromUuidtag($this->data['Merchant']['logo_url']);
					
					$this->data['Merchant']['logo_url'] =
						substr(Router::url('/',true),0,-1) .
						$this->Picupload->getPathToPicture(
							$this->data['Merchant']['logo_url'],
							Configure::Read('PictureTags.Logo'),
							"." . $this->Picupload->ext($filename)
						);
				}	
			}

			if($this->Merchant->isValidSafeName($this->data['Merchant']['safe_merchant_name'])){
				$validationErrors[] = 'Safe Name: Already exists.';
			}

			if(empty($validationErrors)){

				$this->data['Merchant']['autoupdate'] = 0;
				$this->data['Merchant']['source'] = 'Manual';

				$this->Merchant->create();

				if($this->Merchant->save($this->data)){
					$widget_merchant_add_result = true;

					foreach($this->data['Merchant']['category'] as $CatId){
						$this->Merchant->createCategoryMerchantRelation($CatId, $this->Merchant->id);
					}

					foreach($this->data['Merchant']['site'] as $siteId){
						$this->Merchant->createSiteMerchantRelation($siteId, $this->Merchant->id);
					}

				}else{

					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_merchant_add_result = false;
				}
			}

			$this->set('widget_merchant_add_result', $widget_merchant_add_result);
			$this->set('validationErrors', $validationErrors);
		}

		$this->loadModel('Vwcategoriesbrowse');
		$catlist = $this->Vwcategoriesbrowse->find('list', 
			array(
				'conditions' => array(
					'merged_in' => 0
				)
				,'order'=>'catname'
			)
		);		
		$sitelist = $this->Site->find('list');

		$this->set('catlist', $catlist);
		$this->set('sitelist', $sitelist);
		$this->set('container', $container);
	}
	
	function admin_widget_merchants_edit($safe_name = null){

		if(!empty($this->data)){

			$validationErrors = array();
			$widget_merchant_edit_result = false;

			if(strlen($this->data['Merchant']['merchant_name']) < 1){
				$validationErrors[] = 'Merchant Name: required.';
			}

			if(strlen($this->data['Merchant']['safe_merchant_name']) < 1){
				$validationErrors[] = 'Safe Name: required.';
			}

			if(strlen($this->data['Merchant']['site_url']) < 1){
				$validationErrors[] = 'Site URL: required.';
			}

			if(strlen($this->data['Merchant']['logo_url']) < 1){
				$validationErrors[] = 'Logo URL: required.';
			}else{

				//convert uuid to path if applicable
				if(FALSE == strstr($this->data['Merchant']['logo_url'],'http'))
				{
					$this->loadModel('Picture');
					$filename = $this->Picture->getPictureFilenameFromUuidtag($this->data['Merchant']['logo_url']);
					
					$this->data['Merchant']['logo_url'] =
						substr(Router::url('/',true),0,-1) .
						$this->Picupload->getPathToPicture(
							$this->data['Merchant']['logo_url'],
							Configure::Read('PictureTags.Logo'),
							"." . $this->Picupload->ext($filename)
						);
				}	
			}

			if($this->Merchant->isValidSafeNameUpdate($this->data['Merchant']['safe_merchant_name'],
													$this->data['Merchant']['id'])){
				$validationErrors[] = 'Safe Name: Already exists.';
			}

			if(empty($validationErrors)){

				$this->data['Merchant']['autoupdate'] = 0;

				if($this->Merchant->save($this->data)){

					$widget_merchant_edit_result = true;

					// Merchant Categories
					$this->Merchant->removeCatMerchantRelation($this->data['Merchant']['id']);
					foreach($this->data['Merchant']['category'] as $CatId){
						$this->Merchant->createCategoryMerchantRelation($CatId, $this->data['Merchant']['id']);
					}

					// Merchant Sites
					$this->Merchant->removeSiteMerchantRelation($this->data['Merchant']['id']);
					foreach($this->data['Merchant']['site'] as $SiteId){
						$this->Merchant->createSiteMerchantRelation($SiteId, $this->data['Merchant']['id']);
					}

				}else{

					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_merchant_edit_result = false;
				}
			}

			$this->set('widget_merchant_edit_result', $widget_merchant_edit_result);
			$this->set('validationErrors', $validationErrors);
		}

		if(!empty($safe_name)){
			$this->data = $this->Merchant->getMerchantbySafeName($safe_name);
		}

		$this->loadModel('Vwcategoriesbrowse');
		$catlist = $this->Vwcategoriesbrowse->find('list', 
			array(
				'conditions' => array(
					'merged_in' => 0
				)
				,'order'=>'catname'
			)
		);
		$sitelist = $this->Site->find('list');
		$this->set('catlist', $catlist);
		$this->set('sitelist', $sitelist);
	}

	function admin_widget_merchants_lnk_to_site($MerchantIDs = null){

		if(!empty($this->data)){

			$widget_merchant_link_sites_result = false;
			$validationErrors = array();
			$MerchantIDs = $this->data['Merchant']['merchantIDs'];

			$merchants = explode(',', $MerchantIDs);

			// link
			foreach($this->data['Merchant']['sites'] as $index => $sId){
				foreach($merchants as $merchant){
						$exists = $this->MerchantsSite->find('first',
													array('conditions' =>
															array(
																'MerchantsSite.site_id' => $sId,
																'MerchantsSite.merchant_id' => $merchant)));
							if(!$exists){

								$data['MerchantsSite']['site_id'] = $sId;
								$data['MerchantsSite']['merchant_id'] = $merchant;

								$this->MerchantsSite->create();
								$this->MerchantsSite->save($data);
							}
				}
			}

			$widget_merchant_link_sites_result = true;
			$this->set("widget_merchant_link_sites_result", $widget_merchant_link_sites_result);
		}

		$sites = $this->Merchant->Site->find('list');
		$this->set('MerchantIDs', $MerchantIDs);
		$this->set('sites', $sites);
	}

	function admin_widget_merchants_unlink($merchantIDs, $SiteId){
		$this->Merchant->unLinkMerchants($merchantIDs, $SiteId);
	}

	function admin_widget_merchants_just_unlink($merchantIDs = null){

		$this->layout = 'ajax';

		if(!empty($this->data)){

			$widget_merchant_unlink_sites_result = false;
			$validationErrors = array();
			$merchantIDs = $this->data['Merchant']['merchantIDs'];

			// unlink
			foreach($this->data['Merchant']['sites'] as $index => $sId){

				// unlink merchant
				$this->Merchant->unLinkMerchants($merchantIDs, $sId);
			}

			$widget_merchant_unlink_sites_result = true;
			$this->set("widget_merchant_unlink_sites_result", $widget_merchant_unlink_sites_result);
		}

		$sites = $this->Merchant->Site->find('list');
		$this->set('merchantIDs', $merchantIDs);
		$this->set('sites', $sites);
	}

	function admin_widget_single_merchant_lnk_to_site($merchantId = null){

		if(!empty($this->data)){

			$widget_single_merchant_link_sites_result = false;
			$validationErrors = array();

			$merchantId = $this->data['Merchant']['id'];

			$this->Merchant->removeSiteMerchantRelation($merchantId);

			if(!empty($this->data['Merchant']['site'])){

				foreach($this->data['Merchant']['site'] as $index => $sId){
					// link
					$this->Merchant->createSiteMerchantRelation($sId, $merchantId);
				}
			}

			$widget_single_merchant_link_sites_result = true;
			$this->set("widget_single_merchant_link_sites_result", $widget_single_merchant_link_sites_result);
		}

		if(!empty($merchantId)){
			$this->data = $this->Merchant->getMerchantbyId($merchantId);
		}

		$sites = $this->Category->Site->find('list');

		$this->set('merchantId', $merchantId);
		$this->set('sites', $sites);
	}

	function admin_remove($merchantIDs = null){

		if(null == $merchantIDs){
			return false;
		}

		$merchants = explode(',', $merchantIDs);

		foreach($merchants as $MerchantId){
			$this->Merchant->removeMerchant($MerchantId);
		}
	}

	function admin_check_safe_name_exists(){

		$this->layout = 'ajax';

		if(!empty($this->data)){

			$Results = array();
			$bRet = true;

			if($this->data['Merchant']['id'] == 0){

				$bRet = $this->Merchant->isValidSafeName($this->data['Merchant']['safe_merchant_name']);

			}else{

				$bRet = $this->Merchant->isValidSafeNameUpdate(
												$this->data['Merchant']['safe_merchant_name'],
												$this->data['Merchant']['id']
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