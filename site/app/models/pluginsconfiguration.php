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

class Pluginsconfiguration extends AppModel {
	var $name = 'Pluginsconfiguration';
	
	
	function getData($pluginid, $pluginname, $datakey)
	{
		return $this->find('first', array(
			'conditions' => array(
				'pluginid' => $pluginid,
				'pluginname' => $pluginname,
				'datakey' => $datakey
			)
		));
	}	
	
	function getDataVal($pluginid, $pluginname, $datakey)
	{
		$res = $this->getData($pluginid, $pluginname, $datakey);
		
		if(false != $res){
			$res = $res['Pluginsconfiguration']['dataval'];
		}
		
		return $res;
	}
	
	function setDataVal($pluginid, $pluginname, $datakey, $dataval)
	{
		$record = $this->getData($pluginid, $pluginname, $datakey);
		
		if(false != $record)
		{
			$record['Pluginsconfiguration']['dataval'] = $dataval;
			$this->save($record);
		}
	}
	
	function getinstalledPlugins()
	{
		$list =	$this->find('all', array('conditions' =>
											array(
												'Pluginsconfiguration.plugintype' => 'configurable'
											)
										,'fields' => 
											array(
												'Pluginsconfiguration.pluginid'
												,'Pluginsconfiguration.pluginname'
											),
											'group' => 'Pluginsconfiguration.pluginname'
										)
									);
				
		return $list;
	}

	function getPluginList()
	{
		$plugins = $this->find('list', array(
										'fields' => array(
											'Pluginsconfiguration.pluginid'
											,'Pluginsconfiguration.pluginname'
										),'group' => 'Pluginsconfiguration.pluginname'
									));
		return $plugins;
	}
}
?>