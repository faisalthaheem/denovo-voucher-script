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

class AppController extends Controller {
	var $helpers = array('Html','Form','Js','Session','Picturescomponent','Cache');
	var $uses = array('Site');

	var $components = array('Session',
							'RequestHandler',
							'Uuid',
 							'Auth' => array(
 										'loginAction' => array(
 											'controller' => 'users',
 											'action' => 'widget_signin',
 											'plugin' => false,
 											'admin' => false
										),
										'fields' => array(
											'username' => 'email',
											'password' => 'pass'
										)
	     					)# Auth End
   						); # END components

	var $view = 'Theme';
	var $theme = 'factory';

	//this is set everytime to determine what site the user has requested a page at
	var $sitename = 'default';
	var $site_id = 1; //by default the first site
	var $siteInfo = array();

	//fb connect params
	var $facebook;
	var $__fbAppId = '';
	var $__fbApiKey = '';
	var $__fbSecret = '';
	var $__fbAuthCode = '';
	var $__fbAccessToken = '';
	var $__fbAccessTokenTimeout = 0;
	var $__fbuser = 0;
	var $fbConfigured = false; //we set this to true if settings for the current site have been defined

	function __construct(){
		parent::__construct();

		$GLOBALS['facebook_config']['debug'] = NULL;
	}

	function beforeFilter(){

		$this->Auth->authorize = 'controller';

		//see comments
		$this->sitename = $_SERVER['SERVER_NAME'];
		$this->set('sitename',$this->sitename);

		//get site info
		$this->siteInfo = $this->Site->getSiteByFQDN($this->sitename);
		$this->siteInfo = $this->siteInfo['Site'];

		//set site's id		
		$this->site_id = $this->siteInfo['id'];

		//set theme
		if(!empty($this->siteInfo['theme']))
		{
			$this->theme = $this->siteInfo['theme'];
		}

//		//check fb configuration
//		if(!empty($this->siteInfo['fbapikey'])){
//			$this->__fbAppId = $this->siteInfo['fbappid'];
//			$this->__fbApiKey = $this->siteInfo['fbapikey'];
//			$this->__fbSecret = $this->siteInfo['fbsecret'];
//			$this->fbConfigured = true;
//			$this->siteInfo['fbconfigured'] = $this->fbConfigured;
//
//			$this->__validateFBStatus();
//		}
		$this->fbConfigured = false;
		$this->siteInfo['fbconfigured'] = false;

		//set for use in views
		$this->set('siteInfo',$this->siteInfo);

		//set data for layout based widgets
		if( strpos($this->here, 'nolayout') === FALSE )
		{
			$this->setDataForLayout();
		}

		//insert current request for analytics - v4.5 removed in favor of performance and other publicly available
		//analytics tools
		//$this->_insertHistory();

		if( isset($this->params['prefix']) &&
			($this->params['prefix'] == 'admin' ||
			$this->params['prefix'] == 'manager')){

			$this->view = null;
			$this->theme = null;
		}
	}
	
	//passed from user's controller
	function _setFBAuthToken($code, $token, $timeout)
	{
		$this->__fbAuthCode = $code;
		$this->__fbAccessToken = $token;
		$this->__fbAccessTokenTimeout = $timeout;

		$this->__validateFBStatus();
	}

	function __getFBUser()
	{
		$user = 0;

		if(!$this->__fbuser && !empty($this->__fbAccessToken)){
			$graph_url = "https://graph.facebook.com/me?access_token=" . $this->__fbAccessToken;
			$this->__fbuser = json_decode(file_get_contents($graph_url));
		}
		$user = $this->__fbuser;

		return $user;
	}

	function __validateFBStatus()
	{

		$this->loadModel('User');
		
		if(null == $this->Auth->user() && $this->__getFBUser()){

			$fbprofile = $this->__getFBUser();

			$user = $this->User->find('first', array(
				'conditions' => array(
					'fbid' => $fbprofile->id
				),
				'fields' => array(
					'fbid', 'fbpass', 'pass'
				)
			));

			if(false == $user){


				$user['fbid'] = $fbprofile->id;
				$user['fbpass'] = $this->_randomString();
				$user['pass'] = $this->Auth->password($user['fbpass']);
				$user['group_id'] = 3;//for users
				$user['fullname'] = $fbprofile->name;
				$user['email'] = $fbprofile->email;
				$user['usertype'] = 'user';
				$user['gender'] = $fbprofile->gender;
				$user['active'] = 1;
				$user['setupstatus'] = 1;

				$this->User->create();
				$this->User->save($user,false);

			}

			$this->Auth->fields = array(
								'username' => 'fbid'
								,'password' => 'pass'
			);

			$this->Auth->login($user);
			$this->redirect('/dashboard');
		}
	}

    protected function _randomString($minlength = 20, $maxlength = 20, $useupper = true, $usespecial = false, $usenumbers = true){
        $charset = "abcdefghijklmnopqrstuvwxyz";
        if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($usenumbers) $charset .= "0123456789";
        if ($usespecial) $charset .= "~@#$%^*()_+-={}|][";
        if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
        else $length = mt_rand ($minlength, $maxlength);
        $key = '';
        for ($i=0; $i<$length; $i++){
            $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
        }
        return $key;
    }
    
    function setOGInfo($title = '', $type = '', $url = '', $image = '', $desc = '')
    {
    	$ogInfo['title'] = $title;
    	$ogInfo['type'] = $type;
    	$ogInfo['url'] = $url;
    	$ogInfo['image'] = $image;
    	$ogInfo['desc'] = $desc;
    	
    	//set this to indicate to the layout we have to set OG values
    	$this->set('ogInfo',$ogInfo);
    }

	function isAuthorized(){

		$ret = true;

		if (isset($this->params['prefix'])) {

		    if($this->Auth->user('usertype') != $this->params['prefix']){
		    	$ret = false;
		    }
		}

		return $ret;
	}

	function _validateUserID($userid)
	{
		//psuedo
		//if admin, then return passed user id
		// else return auth user id

		//TODO: implement above psuedo
		return $_SESSION['Auth']['User']['id'];
	}

	function setDataForLayout()
	{
		if(!$this->RequestHandler->isAjax()){

			if(isset($this->params['prefix']) &&
				($this->params['prefix'] == 'admin' || $this->params['prefix'] == 'manager')
			)
			{
				$this->setBackOfficePluginMenu();
			}
			else
			{
				$this->setBannersForLayout();
				$this->setCategoriesForLayout();
				$this->setWidgetMerchantsMostPopularData();
				$this->setWidgetMerchantsTopData();
				$this->setTopCODsDataForIndexPage();

				//footer
				$this->setFooterRecentMerchantsData();
				$this->setFooterRecentCategoriesData();
			}
		}
	}

	function setBannersForLayout()
	{
		$this->loadModel('Banner');
		$banners = $this->Banner->getBannersForSite($this->site_id);
		$this->set('banners',$banners);
	}

	function setCategoriesForLayout(){

		$this->loadModel('Vwbrowse');
		$widget_categories_vouchers_deals_data = $this->Vwbrowse->find('all',array(
			'conditions' => array(
				'SITEID' => $this->site_id
			)
			,'fields' => array(
				'count(*) countMerchants'
				,'safe_catname'
				,'catname'
				,'CATID'
			)
			,'group' => 'CATID'
			,'order' => 'countMerchants DESC'
			,'limit' => 14
		));
		
		$this->set('widget_categories_vouchers_deals_data',$widget_categories_vouchers_deals_data);
	}

	function setWidgetMerchantsMostPopularData()
	{
		$this->loadModel('Vwbrowse');
		
		$widget_merchants_most_popular_data = $this->Vwbrowse->find('all',array(
			'conditions' => array(
				'SITEID' => $this->site_id
			),
			'fields' => array(
				'DISTINCT(merchant_name) merchant_name',
				'safe_merchant_name',
				'logo_url',
			),
			'limit' => 9,
			'order' => 'MERVIEWS DESC'
		));
			
		$this->set('widget_merchants_most_popular_data',$widget_merchants_most_popular_data);
		
	}

	function setWidgetMerchantsTopData()
	{
		$this->loadModel('Vwbrowse');
		
		$widget_merchants_top_data = $this->Vwbrowse->find('all',array(
			'conditions' => array(
				'SITEID' => $this->site_id,
				'MERISTOP' => 1
			),
			'fields' => array(
				'DISTINCT(merchant_name) merchant_name',
				'safe_merchant_name',
				'logo_url',
			),
			'limit' => 9,
			'order' => 'MERVIEWS DESC'
		));
			
		$this->set('widget_merchants_top_data',$widget_merchants_top_data);

	}

	function setFooterRecentMerchantsData()
	{
		$this->loadModel('Vwbrowse');
		
		$footer_recent_merchants = $this->Vwbrowse->find('all',array(
			'conditions' => array(
				'SITEID' => $this->site_id,
			),
			'fields' => array(
				'DISTINCT(merchant_name) merchant_name',
				'safe_merchant_name',
			),
			'limit' => 8,
			'order' => 'MERLASTVIEWED DESC'
		));
			
		$this->set('footer_recent_merchants',$footer_recent_merchants);

	}

	function setFooterRecentCategoriesData()
	{
		$this->loadModel('Vwbrowse');
		
		$footer_recent_categories = $this->Vwbrowse->find('all',array(
			'conditions' => array(
				'SITEID' => $this->site_id
			),
			'fields' => array(
				'DISTINCT(safe_catname) safe_catname'
				,'catname'
			),
			'limit' => 8,
			'order' => 'CATLASTVIEWED DESC'
		));
			
		$this->set('footer_recent_categories',$footer_recent_categories);
	}

	function setTopCODsDataForIndexPage()
	{
		$this->loadModel('Vwbrowse');
		$index_page_top_cod_data =
			$this->Vwbrowse->getTopCODsDataForIndexPage($this->site_id,9);
		$this->set('index_page_top_cod_data', $index_page_top_cod_data);
	}

	function setBackOfficePluginMenu(){

		// fetches plugins list, to create plugins menu
		$this->loadModel('Pluginsconfiguration');
		$plugins_list = $this->Pluginsconfiguration->getPluginList();
		$this->set('plugins_list', $plugins_list);
	}
	
	function setMostViewedCODsDataForIndexPage()
	{
		$this->loadModel('Vwbrowse');
		$index_page_most_viwed_cod_data =
			$this->Vwbrowse->getMostViewedCODsDataForIndexPage($this->site_id,20);
		$this->set('index_page_most_viwed_cod_data', $index_page_most_viwed_cod_data);
	}

	function setPrintableCODsDataForIndexPage()
	{
		$this->loadModel('Vwbrowse');
		$index_page_printable_cod_data =
			$this->Vwbrowse->getPrintableCODsDataForIndexPage($this->site_id,20);
		$this->set('index_page_printable_cod_data', $index_page_printable_cod_data);
	}
	
	function _getCurrentUserId()
	{
		if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['User'])){
			return $_SESSION['Auth']['User']['id'];
		}

		return 1; //1 is for visitors
	}

	function _setBackURL($controllerName,$url = null)
	{
		if(null == $url){
			$url = Router::url();
		}
		
		$_SESSION['backurls'][$controllerName] = $url;
	}
	
	function _unsetBackURLs()
	{
		unset($_SESSION['backurls']);
	}

//	function _insertHistory(){
//
//		if(strstr($this->here,'imports') == FALSE)
//		{
//			$this->UsageHistory->insertHistory(
//				$this->site_id,
//				$this->_getCurrentUserId(),
//				$this->here
//			);
//		}
//
//	}
}
