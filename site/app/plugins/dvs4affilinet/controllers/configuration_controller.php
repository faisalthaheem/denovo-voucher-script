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

class ConfigurationController extends Dvs4affilinetAppController{

	var $name = 'Configuration';
	var $uses = array();
    var $helpers = array('Html');
    

    function index() {}

    function admin_index(){
    	
    	$this->set('plugintitle', ucfirst($this->__PLUGIN_NAME));
    	$this->set('pluginname', $this->__PLUGIN_NAME);
    }
    
	function admin_configure()
	{
		$this->layout = 'ajax';
		
		if(!empty($this->data))
		{
			$this->__updateServiceCredentials(
				$this->data['Pluginsconfiguration']['userid'],
				$this->data['Pluginsconfiguration']['publisherid'],
				$this->data['Pluginsconfiguration']['code'],
				implode(",", $this->data['Pluginsconfiguration']['sites'])
			);
			
			$result = 'Affilinet WebService credentials updated Successfully.';
		}
		else
		{
			$result = 'Affilinet WebService Settings.';		
		}
		
		$this->data['Pluginsconfiguration']['userid'] = $this->__getUserID();
		$this->data['Pluginsconfiguration']['publisherid'] = $this->__getPublisherID();
		// saving to code because we dont want auth component to hash this password
		$this->data['Pluginsconfiguration']['code'] = $this->__getPassword();
		
		$defaultSites = $this->__getSites();
		if(!empty($defaultSites)){
			$this->data['Pluginsconfiguration']['sites'] = explode(",", $defaultSites);
		}
		
		$this->loadModel('Site');
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
		
		$this->set('result', $result);
	}
	
	function manager_configure()
	{
		$this->layout = 'ajax';
		
		if(!empty($this->data))
		{
			$this->__updateServiceCredentials(
				$this->data['Pluginsconfiguration']['userid'],
				$this->data['Pluginsconfiguration']['publisherid'],
				$this->data['Pluginsconfiguration']['code'],
				implode(",", $this->data['Pluginsconfiguration']['sites'])
			);
			
			$result = 'Affilinet WebService credentials updated Successfully.';
		}
		else
		{
			$result = 'Affilinet WebService Settings.';		
		}
		
		$this->data['Pluginsconfiguration']['userid'] = $this->__getUserID();
		$this->data['Pluginsconfiguration']['publisherid'] = $this->__getPublisherID();
		// saving to code because we dont want auth component to hash this password
		$this->data['Pluginsconfiguration']['code'] = $this->__getPassword();
		
		$defaultSites = $this->__getSites();
		if(!empty($defaultSites)){
			$this->data['Pluginsconfiguration']['sites'] = explode(",", $defaultSites);
		}
		
		$this->loadModel('Site');
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
		
		$this->set('result', $result);
	}
	
	function __updateServiceCredentials($userid, $publisherid, $password, $sites)
	{
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'userid',
			$userid
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'publisherid',
			$publisherid
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'password',
			$password
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'default-sites',
			$sites
		);
	}
}
?>