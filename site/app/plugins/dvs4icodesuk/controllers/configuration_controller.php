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

class ConfigurationController extends Dvs4icodesukAppController {

	var $name = 'Configuration';
	var $uses = array();
    var $helpers = array('Html');
    

    function index() {
    }

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
				$this->data['Pluginsconfiguration']['username'],
				$this->data['Pluginsconfiguration']['subscriptionid'],
				implode(",", $this->data['Pluginsconfiguration']['sites'])
			);
			
			$result = 'IcodesUK Service v2 credentials updated successfully.';
		}
		else
		{
			$result = 'IcodesUK Service v2 credentials Settings';
		}
		
		$this->data['Pluginsconfiguration']['username'] = $this->__getUserName();
		$this->data['Pluginsconfiguration']['subscriptionid'] = $this->__getSubscriptionId(); 
	
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
				$this->data['Pluginsconfiguration']['username'],
				$this->data['Pluginsconfiguration']['subscriptionid'],
				implode(",", $this->data['Pluginsconfiguration']['sites'])
			);
			
			$result = 'IcodesUK Service v2 credentials updated successfully.';
		}
		else
		{
			$result = 'IcodesUK Service v2 credentials Settings';
		}
		
		$this->data['Pluginsconfiguration']['username'] = $this->__getUserName();
		$this->data['Pluginsconfiguration']['subscriptionid'] = $this->__getSubscriptionId(); 
	
		$defaultSites = $this->__getSites();
		if(!empty($defaultSites)){
			$this->data['Pluginsconfiguration']['sites'] = explode(",", $defaultSites);
		}
		
		$this->loadModel('Site');
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
		
		$this->set('result', $result);
	}
	
	
	function __updateServiceCredentials($username, $subscriptionid, $sites)
	{
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'username',
			$username
		);
		
		$this->Pluginsconfiguration->setDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'subscriptionid',
			$subscriptionid
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