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

/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       cake
 * @subpackage    cake.cake.libs.controller
 * @link http://book.cakephp.org/view/958/The-Pages-Controller
 */
class PagesController extends AppController {

	
	var $cacheAction = array(
		'display' => CACHE24HR,
       	'welcome' => CACHE24HR,
	);
	
	
	public function beforeFilter() {
       
		parent::beforeFilter();
		
       	$this->Auth->allow(
       		array_keys($this->cacheAction)
       	);
	}
	
	
	var $components = array('Captcha', 'Email');
	
	
/**
 * Controller name
 *
 * @var string
 * @access public
 */
	var $name = 'Pages';

/**
 * Default helper
 *
 * @var array
 * @access public
 */
	var $helpers = array('Html', 'Session');

/**
 * This controller does not use a model
 *
 * @var array
 * @access public
 */
	var $uses = array(
					'Page'
					,'Vwbrowse'
					);

/**
 * Displays a view
 *
 * @param mixed What page to display
 * @access public
 */
	function display() {

		//
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			$this->redirect('/');
		}
	
		//do we have page for this site in db with this link name?
		$page = $this->Page->checkPageExists($this->site_id, $path[0]);
		
		if(false == $page )
		{

			//cake default logic
			
			$page = $subpage = $title_for_layout = null;
	
			if (!empty($path[0])) {
				$page = $path[0];
			}
			if (!empty($path[1])) {
				$subpage = $path[1];
			}
			if (!empty($path[$count - 1])) {
				$title_for_layout = Inflector::humanize($path[$count - 1]);
			}
			$this->set(compact('page', 'subpage', 'title_for_layout'));
			$this->render(implode('/', $path));
			
		}else{
			//check if page exists in db
			 $this->set('content', $page['Page']['pagecontent']);
			 $this->set('metatitle',$page['Page']['metatitle']);
			 $this->set('metadesc',$page['Page']['metadesc']);
			 $this->set('metakws',$page['Page']['metakws']);
			 
		}
	}
	
	function welcome()
	{
		$this->set('recentCODs', $this->Vwbrowse->getRecentCODsForIndexPage($this->site_id));
		
		
		$topMerchants = $this->Vwbrowse->getTopMerchantsForIndexPage($this->site_id);
		foreach($topMerchants as &$topMerchant)
		{
			
			$topMerchant['Vwbrowse']['cods_count'] = $this->Vwbrowse->find('count',array(
				'conditions' => array(
					'SITEID' => $this->site_id
					,'MERID' => $topMerchant['Vwbrowse']['MERID']
					,"start_date <= '". date('Y-m-d') ." 23:59:59'"
					,"expiry_date > '". date('Y-m-d') ."'"
				),
				'fields' => array(
					'COUNT(DISTINCT(CODID)) AS count'
				)
			));
		}
			
		$this->set('topMerchants', $topMerchants);
		
		
		$this->set('title_for_layout', 'Welcome');
		
		$this->_unsetBackURLs();
	}
	
	function admin_index($SiteId = null){
		
		$this->layout = 'ajax';
		
		$this->paginate['Page'] = 
				array(
					'conditions' => array('site_id' => $SiteId),
					'order' => 'pagename',
					'limit' => 6,
					'contain' => array()
				);

		$this->set('pages', $this->paginate('Page'));
		$this->set('SiteId', $SiteId);
	}
	
	function admin_add(){
		
		if(!empty($this->data)){
			
			$validationErrors = array();
			$widget_page_add_result = false;
			
			if(strlen($this->data['Page']['pagename']) < 1){
				$validationErrors[] = 'Page Name is required.';
			}
			
			if(strlen($this->data['Page']['linkname']) < 1){
				$validationErrors[] = 'Link Name is required.';
			}else{
				$this->data['Page']['safe_page_name'] = $this->data['Page']['linkname'];
				$link_name_exists = $this->admin_check_safe_name_exists(true);
				if($link_name_exists['Exists'] == 'yes'){
					$validationErrors[] = 'Safe name already exists.';
				}
			}
					
			if(empty($validationErrors)){
				
				$this->Page->create();
				
				if($this->Page->save($this->data)){
					
					$widget_page_add_result = true;
					$this->set('siteid', $this->data['Page']['site_id']);
				
				}else{
					
					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_page_add_result = false;
				}
			}
			
			$this->set('widget_page_add_result', $widget_page_add_result);
			$this->set('validationErrors', $validationErrors);
		}
		
		$SiteList = $this->Site->find('list');
		$this->set('SiteList', $SiteList);
	}
	
	function admin_edit($pageid = null){
		
		if(!empty($this->data)){
			$validationErrors = array();
			$widget_page_edit_result = false;
			
			if(strlen($this->data['Page']['pagename']) < 1){
				$validationErrors[] = 'Page Name is required.';
			}
			
//			if(strlen($this->data['Page']['linkname']) < 1){
//				$validationErrors[] = 'Link Name is required.';
//			}
			
			if(strlen($this->data['Page']['pagecontent']) < 1){
				$validationErrors[] = 'Page Content is required.';
			}
			
			if(empty($validationErrors)){

				if($this->Page->save($this->data)){
					$widget_page_edit_result = true;
					$this->set('siteid', $this->data['Page']['site_id']);
				}else{
					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_page_edit_result = false;
				}
			}
			
			$this->set('widget_page_edit_result', $widget_page_edit_result);
			$this->set('validationErrors', $validationErrors);
		}
		
		if(!empty($pageid)){
			$this->data = $this->Page->getPageInfo($pageid);
		}
		
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
	}
	
	function admin_delete($siteid, $pageid)
	{
		$this->Page->id = $pageid;
		$this->Page->delete();

		$this->admin_index($siteid);
		$this->render('admin_index');
	}
	
	function admin_about_us(){
		
		$this->layout = 'ajax';
	}
	
	function captcha_image(){
		$this->layout = null;
		Configure::write('debug',0);
		$this->Captcha->image();
	}
	
	function admin_check_safe_name_exists($return = false){

		$this->layout = 'ajax';

		if(!empty($this->data)){

			$Results = array();
			$bRet = true;

			if(!isset($this->data['Page']['id']) ||  $this->data['Page']['id'] == 0){

				$bRet = $this->Page->isValidSafeName(
					$this->data['Page']['site_id'],
					$this->data['Page']['linkname']
				);

			}else{

				$bRet = $this->Page->isValidSafeNameUpdate(
												$this->data['Page']['site_id'],
												$this->data['Page']['linkname'],
												$this->data['Page']['id']
											);
			}

			if($bRet){
				$Results['Exists'] = 'yes';
			}else{
				$Results['Exists'] = 'no';
			}

			$this->set('results', json_encode($Results));
			
			if($return)
			{
				return $Results;
			}
		}
	}	
	

}

