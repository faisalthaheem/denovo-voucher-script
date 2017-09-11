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

Class Dvs4affilinetAppController extends AppController{
	var $__PLUGIN_ID = '6a1aa6d1-e4c9-4b56-98d2-f0d64c37e3ba';
	var $__PLUGIN_NAME = 'dvs4affilinet';
	
	var $components = array('Session');
	var $uses = array('Pluginsconfiguration','Syslog');

	function __getUserID()
	{
		$userid = 'not-configured';
		
		$result = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'userid'
		);

		if(false != $result)
		{
			$userid = $result;
		}

		return $userid;
	}

	function __getPublisherID()
	{
		$publisherid = 'not-configured';
		
		$result = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'publisherid'
		);

		if(false != $result)
		{
			$publisherid = $result;
		}

		return $publisherid;
	}
	
	function __getPassword()
	{
		$password = 'not-configured';
		
		$result = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'password'
		);		
		
		if(false != $result)
		{
			$password = $result;
		}
		
		return $password;		
	}

	function __getShopImportStatus()
	{
		$status = "not-configured";
		
		$result = $this->Pluginsconfiguration->getDataVal(
							$this->__PLUGIN_ID,
							$this->__PLUGIN_NAME,
							'isShopImportComplete');
							
		if(false != $result)
		{
			$status = $result;
		}
		
		return $status;
	}
	
	function __getCategoryImportStatus()
	{
		$status = "not-configured";
		
		$result = $this->Pluginsconfiguration->getDataVal(
							$this->__PLUGIN_ID,
							$this->__PLUGIN_NAME,
							'isCategoryImportComplete');
							
		if(false != $result)
		{
			$status = $result;
		}
		
		return $status;
	}

	function __getVoucherImportStatus()
	{
		$status = "not-configured";
		
		$result = $this->Pluginsconfiguration->getDataVal(
							$this->__PLUGIN_ID,
							$this->__PLUGIN_NAME,
							'isVoucherImportComplete');
							
		if(false != $result)
		{
			$status = $result;
		}
		
		return $status;
	}
	
	function __getSites()
	{
		$sites = "not-configured";
		
		$result = $this->Pluginsconfiguration->getDataVal(
							$this->__PLUGIN_ID,
							$this->__PLUGIN_NAME,
							'default-sites');
							
		
		if(false != $result)
		{
			$sites = $result;
		}

		return $sites;
	}
	
	function __log($message)
	{
		$msg['Syslog']['srcid'] = $this->__PLUGIN_ID;
		$msg['Syslog']['srcname'] = $this->__PLUGIN_NAME;
		$msg['Syslog']['logmsg'] = $message;
		
		$this->Syslog->create();
		$this->Syslog->save($msg,false);
	}
}
?>