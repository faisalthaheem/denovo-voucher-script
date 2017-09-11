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

class CodsController extends AppController {

	var $name = 'Cods';
	var $uses = array(	
						'Vwbrowse',
	);
	
	var $helpers = array('Barcode');
	var $components = array(
		'Picupload'
	);
	
	var $cacheAction = array(
		'index' => CACHE24HR,
       	'view'  => CACHE24HR,
       	'viewlarge'  => CACHE24HR,
       	'printcod'  => CACHE24HR,
       	'everything'  => CACHE24HR,
       	'new_stuff'  => CACHE1HR,
       	'expiring_stuff'  => CACHE24HR,
       	'printable'  => CACHE24HR,
		'out'  => CACHEANNUAL,
	);
	
	public function beforeFilter() {
       parent::beforeFilter();

       $this->Auth->allow(	'index',
       						'view',
       						'viewlarge',
       						'printcod',
       						'incrementfbsharecount',
       						'incrementtweetcount',
       						'everything',
       						'new_stuff',
       						'expiring_stuff',
       						'printable',
       						'search',
       						'out',
       						'increment_view_count'
       	);
	}
	
	function out($safetitle = null)
	{
		if(null == $safetitle)
		{
			$this->redirect('/',true);
			return;
		}
		
		if(!is_numeric($safetitle)){

			$cod = $this->Vwbrowse->find('first', array(
				'conditions' => array(
					'safe_title' => $safetitle
					,'SITEID' => $this->site_id
				)
			));
		}else{

			$cod = $this->Vwbrowse->find('first', array(
				'conditions' => array(
					'CODID' => $safetitle
					,'SITEID' => $this->site_id
				)
			));
		}
		
		$this->flash('Please wait while we take you there...', $cod['Vwbrowse']['CODAFFILIATEURL'],5);
		
		/////////////////////CE Ends here
		
	}
	
	function increment_view_count($codid)
	{
		$this->layout = 'ajax';
		
		$this->loadModel('Cod');
		
		$this->Cod->incrementViewCount($codid);
	} 

	function view($codid = null, $locationid = null)
	{
		$this->viewlarge($codid, $locationid);
//		if(null == $codid) return;
//
//		
//
//		$cod = $this->Vwcodssitesmerchants->find('first', array(
//			'conditions' => array(
//				'CODID' => $codid
//				,'SITEID' => $this->site_id
//			)
//		));
//		
//		$this->set('cod',$cod);
//		$this->Cod->incrementViewCount($codid);
//		$this->set('title_for_layout',$cod['Vwcodssitesmerchants']['merchant_name'] . ' - ' . $cod['Vwcodssitesmerchants']['title']);
	}
	
	function viewlarge($safetitle = null, $locationid = null)
	{
		if(null == $safetitle) return;

		if(!is_numeric($safetitle)){

			$cod = $this->Vwbrowse->find('first', array(
				'conditions' => array(
					'safe_title' => $safetitle
					,'SITEID' => $this->site_id
				)
			));
		}else{

			$cod = $this->Vwbrowse->find('first', array(
				'conditions' => array(
					'CODID' => $safetitle
					,'SITEID' => $this->site_id
				)
			));
		}
		$this->set('cod',$cod);
		
		$this->set('title_for_layout',$cod['Vwbrowse']['merchant_name'] . ' - ' . $cod['Vwbrowse']['title']);
		
		//Set Open Graph data
		$this->setOGInfo(
			$cod['Vwbrowse']['title']
			,'product'
			,Router::url("/cods/view/{$cod['Vwbrowse']['safe_title']}",true)
			,$cod['Vwbrowse']['logo_url']
			,$cod['Vwbrowse']['CODDESC']
		);
	}
	
	function printcod($codid = null)
	{
		$this->view($codid);
		//todo: set from the voucher
		$this->layout = 'print-voucher-template-default';
	}

	function incrementfbsharecount($codid = null)
	{
		if(null == $codid) return;
		
		$this->loadModel('Cod');
		
		$this->Cod->incrementFBShareCount($codid);

		$this->layout = 'ajax';
	}
	
	function incrementtweetcount($codid = null)
	{
		if(null == $codid) return;
		
		$this->loadModel('Cod');
		
		$this->Cod->incrementTweetCount($codid);
		
		$this->layout = 'ajax';
	}
	

	function everything()
	{
		$this->_setBackURL('cods');
		
		$pagination_params = array(
			'Vwbrowse'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id,
					"start_date <= '". date('Y-m-d') ." 23:59:59'",
					"expiry_date > '". date('Y-m-d') ."'"
				),
				'limit' => 18,
				'order' => "CODID desc",
				'group' => 'CODID'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwbrowse'));
	}

	function new_stuff()
	{
		$this->_setBackURL('cods');
		
		$pagination_params = array(
			'Vwbrowse'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id,
					"start_date <= '". date('Y-m-d') ." 23:59:59'",
					"expiry_date > '". date('Y-m-d') ."'",
					"DATEDIFF('" . date('Y-m-d') ."',CODCREATED) <= 10"
				),
				'limit' => 18,
				'order' => "CODID desc",
				'group' => 'CODID'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwbrowse'));
	}

	function expiring_stuff()
	{
		$this->_setBackURL('cods');
		
		$pagination_params = array(
			'Vwbrowse'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id,
					"start_date <= '". date('Y-m-d') ." 23:59:59'",
					"expiry_date > '". date('Y-m-d') ."'",
					"DATEDIFF(expiry_date,'" . date('Y-m-d') ."') <= 4"
				),
				'limit' => 18,
				'order' => "CODID desc",
				'group' => 'CODID'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwbrowse'));
	}

	function printable(){

		$this->_setBackURL('cods');
		
		$pagination_params = array(
			'Vwbrowse'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id,
					'isprintable' => '1',
					"start_date <= '". date('Y-m-d') ." 23:59:59'",
					"expiry_date > '". date('Y-m-d') ."'",
				),
				'limit' => 18,
				'order' => "CODID desc",
				'group' => 'CODID'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwbrowse'));
	}

	function search()
	{
		$this->_setBackURL('cods');

		$pagination_params = array(
			'Vwbrowse'=>array(
				'conditions' => array(
					'SITEID' => $this->site_id,
					"start_date <= '". date('Y-m-d') ." 23:59:59'",
					"expiry_date > '". date('Y-m-d') ."'"
				),
				'limit' => 18,
				'order' => "CODID desc",
				'group' => 'CODID'
			)
		);

		if(!empty($this->data)){
			$_SESSION['cods']['search_kw'] = $this->data['Searches']['keyword'];
		}elseif(isset($_REQUEST['kw'])){
			$_SESSION['cods']['search_kw'] = $_REQUEST['kw'];
		}

		if(isset($_SESSION['cods']['search_kw']))
		{
			$pagination_params['Vwbrowse']['conditions'][] = "title LIKE '%{$_SESSION['cods']['search_kw']}%'";
		}

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwbrowse'));

	}

	/*
	 * Admin area starts
	 */
	function admin_widget_manage_cods($firstLoad = null){

		$this->loadModel('Vwcodsbrowse');
		
		$this->layout = 'ajax';

		$conditions = array();

		if($firstLoad == null){

			if(!empty($this->data)){

				if(!empty($this->data['Cod']['search'])){
					$conditions[] = "title LIKE '%{$this->data['Cod']['search']}%'";
					$_SESSION['Cod']['search'] = $this->data['Cod']['search'];
				}

			}else{

				if(isset($_SESSION['Cod']['search'])){
					$conditions[] = "title LIKE '%{$_SESSION['Cod']['search']}%'";
				}
			}
		}
		else
		{
			unset($_SESSION['Cod']['search']);
		}

		$pagination_params = array(
			'Vwcodsbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'merchant_name', 'safe_merchant_name', 'logo_url',
					'id', 'merchant_id', 'cod_type', 'source', 'title',
					'description', 'vouchercode', 'start_date', 'expiry_date',
					'likes', 'viewcount', 'fbsharecount'
				),
				'contain' => array()
				,'limit' => 20
				,'order' => 'Vwcodsbrowse.merchant_name'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwcodsbrowse'));
		$this->set('view', $this->params['action']);
		$this->set('title', __('All Voucher Codes',true));

		// saving url to session so that we can update manage cods view
		$_SESSION['Auth']['ManageCODURL'] = Router::url($this->here, true);
	}

	function admin_widget_manage_site_cods($siteid, $firstLoad = null){

		$this->loadModel('Vwsitecodsbrowse');
		
		$this->layout = 'ajax';

		$conditions = array();
		$conditions['SITEID'] = $siteid;

		if($firstLoad == null){

			if(!empty($this->data)){

				if(!empty($this->data['Cod']['search'])){
					$conditions[] = "title LIKE '%{$this->data['Cod']['search']}%'";
					$_SESSION['Cod']['search'] = $this->data['Cod']['search'];
				}

			}else{

				if(isset($_SESSION['Cod']['search'])){
					$conditions[] = "title LIKE '%{$_SESSION['Cod']['search']}%'";
				}
			}
		}
		else
		{
			unset($_SESSION['Cod']['search']);
		}

		$pagination_params = array(
			'Vwsitecodsbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'merchant_name', 'safe_merchant_name', 'logo_url',
					'id', 'merchant_id', 'cod_type', 'source', 'title',
					'description', 'vouchercode', 'start_date', 'expiry_date',
					'likes', 'viewcount', 'fbsharecount'
				),
				'contain' => array()
				,'limit' => 20
				,'order' => 'Vwsitecodsbrowse.merchant_name'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwsitecodsbrowse'));
		$this->set('view', $this->params['action']);
		$this->set('siteid', $siteid);
		$this->set('title', $this->sitename."'s Voucher Codes");

		// saving url to session so that we can update manage cods view
		$_SESSION['Auth']['ManageCODURL'] = Router::url($this->here, true);
	}

	function admin_widget_manage_merchant_cods($merchantid = null){

		$this->layout = 'ajax';
		
		$this->loadModel('Merchant');
		$this->loadModel('Vwcodsbrowse');
		

		$conditions = array();

		if(null == $merchantid){
			$this->redirect('/admin/dashboard', true);
			return false;
		}

		$conditions['merchant_id'] = $merchantid;

		$pagination_params = array(
			'Vwcodsbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'merchant_name', 'safe_merchant_name', 'logo_url',
					'id', 'merchant_id', 'cod_type', 'source', 'title',
					'description', 'vouchercode', 'start_date', 'expiry_date',
					'likes', 'viewcount', 'fbsharecount'
				)
				,'contain' => array()
				,'limit' => 20
				,'order' => 'Vwcodsbrowse.merchant_name'
			)
		);

		$this->paginate = $pagination_params;
		$this->set('cods',$this->paginate('Vwcodsbrowse'));
		$this->set('view', $this->params['action']);
		$this->set('title', $this->Merchant->getMerchantNamebyId($merchantid)."'s Voucher Codes");

		// saving url to session so that we can update manage cods view
		$_SESSION['Auth']['ManageCODURL'] = Router::url($this->here, true);
	}

	function admin_widget_cods_add($container = 'none'){

		$this->loadModel('Merchant');
		$this->loadModel('Site');
		
		if(!empty($this->data)){

			$widget_cod_add_result = false;
			
			$this->loadModel('Cod');

			//convert multi select options to string for storage
			if(!empty($this->data['Cod']['tag']))
			{
				$this->data['Cod']['tag'] = implode(',',$this->data['Cod']['tag']);
			}

		
			//Convert possible uuid to image path
			if(!empty($this->data['Cod']['custom_cod_img_url']) && FALSE == strstr($this->data['Cod']['custom_cod_img_url'],'http'))
			{
				$this->loadModel('Picture');
				$filename = $this->Picture->getPictureFilenameFromUuidtag($this->data['Cod']['custom_cod_img_url']);
				
				$this->data['Cod']['custom_cod_img_url'] =
					substr(Router::url('/',true),0,-1) .
					$this->Picupload->getPathToPicture(
						$this->data['Cod']['custom_cod_img_url'],
						Configure::Read('PictureTags.Voucher'),
						"." . $this->Picupload->ext($filename)
					);
			}				
			
			$this->data['Cod']['source'] = 'Manual';

			$this->Cod->create();
			if($this->Cod->save($this->data)){

				$widget_cod_add_result = true;
				foreach($this->data['Cod']['site'] as $siteId){
					$this->Cod->createSiteCodRelation($siteId, $this->Cod->id);
				}

			}else{
				$widget_cod_add_result = false;
			}
						
			
			$this->set('widget_cod_add_result', $widget_cod_add_result);
		}
		
		//Set options for "tag"
		$this->loadModel('Sysconfiguration');
		$Options = $this->Sysconfiguration->getDataVal('CODS-TAGS');
		$Options = explode(',',$Options);			
		$tagOptions = array_combine($Options, $Options);
		$this->set('tagOptions',$tagOptions);		

		$this->set('templates', Configure::read('PrintableVouchersTemplates'));
		$this->set('container', $container);

		$merchants = $this->Merchant->find('list');
		$this->set('merchants', $merchants);

		$sitelist = $this->Site->find('list');
		$this->set('sitelist', $sitelist);

	}
	
	function admin_widget_cods_edit($CodId = null){

		$this->loadModel('Site');
		$this->loadModel('Merchant');
		$this->loadModel('Cod');
		
		if(!empty($this->data)){

			$widget_cod_edit_result = false;
			
			//convert multi select options to string for storage
			if(!empty($this->data['Cod']['tag']))
			{
				$this->data['Cod']['tag'] = implode(',',$this->data['Cod']['tag']);
			}

			

			//Convert possible uuid to image path
			if(!empty($this->data['Cod']['custom_cod_img_url']) && FALSE == strstr($this->data['Cod']['custom_cod_img_url'],'http'))
			{
				$this->loadModel('Picture');
				$filename = $this->Picture->getPictureFilenameFromUuidtag($this->data['Cod']['custom_cod_img_url']);
				
				$this->data['Cod']['custom_cod_img_url'] =
					substr(Router::url('/',true),0,-1) .
					$this->Picupload->getPathToPicture(
						$this->data['Cod']['custom_cod_img_url'],
						Configure::Read('PictureTags.Voucher'),
						"." . $this->Picupload->ext($filename)
					);
			}				
			
			if($this->Cod->save($this->data)){

				$widget_cod_edit_result = true;

				// Cod Sites
				$this->Cod->removeSiteCodRelation($this->data['Cod']['id']);
				foreach($this->data['Cod']['site'] as $SiteId){
					$this->Cod->createSiteCodRelation($SiteId, $this->data['Cod']['id']);
				}

			}else{
				
				$widget_cod_edit_result = false;
			}
			

			$this->set('widget_cod_edit_result', $widget_cod_edit_result);
			
		}

		if(!empty($CodId)){
			$this->data = $this->Cod->getCodData($CodId);
		}
		
		//Set options for "tag"
		$this->loadModel('Sysconfiguration');
		$Options = $this->Sysconfiguration->getDataVal('CODS-TAGS');
		$Options = explode(',',$Options);			
		$tagOptions = array_combine($Options, $Options);
		$this->set('tagOptions',$tagOptions);			

		$this->set('templates', Configure::read('PrintableVouchersTemplates'));

		$merchants = $this->Merchant->find('list');
		$this->set('merchants', $merchants);

		$sitelist = $this->Site->find('list');
		$this->set('sitelist', $sitelist);
	}

	function admin_widget_cods_lnk_to_site($CodIDs = null){

		$this->loadModel('Site');
		
		if(!empty($this->data)){

			$this->loadModel('Cod');
			
			$widget_cod_link_sites_result = false;
			$validationErrors = array();
			$CodIDs = $this->data['Cod']['CodIDs'];

			$cods = explode(',', $CodIDs);

			// link
			foreach($this->data['Cod']['sites'] as $index => $sId){

				foreach($cods as $cod){
					$this->Cod->createSiteCodRelation($sId, $cod);
				}
			}

			$widget_cod_link_sites_result = true;
			$this->set("widget_cod_link_sites_result", $widget_cod_link_sites_result);
		}

		$sites = $this->Site->find('list');
		$this->set('CodIDs', $CodIDs);
		$this->set('sites', $sites);
	}

	function admin_widget_cods_unlink($CodIDs, $SiteId){
		
		$this->loadModel('CodsSite');
		
		$this->CodsSite->unLinkCod($CodIDs, $SiteId);
	}

	function admin_widget_cods_just_unlink($codIDs = null){

		$this->layout = 'ajax';

		$this->loadModel('Site');
		$this->loadModel('Cod');
		
		if(!empty($this->data)){
			

			$widget_cod_unlink_sites_result = false;
			$validationErrors = array();
			$codIDs = $this->data['Cod']['codIDs'];

			$cods = explode(',', $codIDs);
			
			// unlink
			foreach($this->data['Cod']['sites'] as $index => $sId){

				foreach($cods as $cod){
					// unlink cod
					$this->Cod->removeSiteCodRelationSigle($cod, $sId);
				}
			}

			$widget_cod_unlink_sites_result = true;
			$this->set("widget_cod_unlink_sites_result", $widget_cod_unlink_sites_result);
		}

		$sites = $this->Cod->Site->find('list');

		$this->set('codIDs', $codIDs);
		$this->set('sites', $sites);
	}

	function admin_widget_single_cod_lnk_to_site($codId = null){
		
		$this->loadModel('Site');
		$this->loadModel('Cod');

		if(!empty($this->data)){

			$widget_single_cod_link_sites_result = false;
			$validationErrors = array();

			$codId = $this->data['Cod']['id'];

			$this->Cod->removeSiteCodRelation($codId);

			if(!empty($this->data['Cod']['site'])){

				foreach($this->data['Cod']['site'] as $index => $sId){
					// link
					$this->Cod->createSiteCodRelation($sId, $codId);
				}
			}

			$widget_single_cod_link_sites_result = true;
			$this->set("widget_single_cod_link_sites_result", $widget_single_cod_link_sites_result);
		}

		if(!empty($codId)){
			$this->data = $this->Cod->getCodData($codId);
		}

		$sites = $this->Cod->Site->find('list');

		$this->set('codId', $codId);
		$this->set('sites', $sites);
	}

	function admin_remove($codIDs = null){

		if(null == $codIDs){
			return false;
		}
		
		$this->loadModel('Cod');

		$cods = explode(',', $codIDs);

		foreach($cods as $CodId){
			$this->Cod->removeCod($CodId);
		}
	}

	function admin_check_safe_title_exists(){

		$this->layout = 'ajax';

		if(!empty($this->data)){
			
			$this->loadModel('Cod');

			$Results = array();
			$bRet = true;

			if($this->data['Cod']['id'] == 0){

				$bRet = $this->Cod->isValidSafeTitle($this->data['Cod']['safe_title']);

			}else{

				$bRet = $this->Cod->isValidSafeTitleUpdate(
												$this->data['Cod']['safe_title'],
												$this->data['Cod']['id']
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