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

class Sysconfiguration extends AppModel {
	var $name = 'Sysconfiguration';
	
	
	function getData($datakey)
	{
		return $this->find('first', array(
			'conditions' => array(
				'datakey' => $datakey
			)
		));
	}	
	
	function getDataVal($datakey)
	{
		$res = $this->getData($datakey);
		
		if(false != $res){
			$res = $res['Sysconfiguration']['dataval'];
		}
		
		return $res;
	}
	
	function setDataVal($datakey, $dataval)
	{
		$record = $this->getData($datakey);
		
		if(false != $record)
		{
			$record['Sysconfiguration']['dataval'] = $dataval;
			$this->save($record);
		}
	}
	
	function saveDataVal($datakey, $dataval)
	{
		$record['Sysconfiguration']['datakey'] = $datakey;
		$record['Sysconfiguration']['dataval'] = $dataval;
		$this->create();
		$this->save($record);
	}
	
	function saveDVS4RegistrationKey($dataval)
	{
		$this->query("DELETE FROM sysconfigurations WHERE datakey='DVS4-REGISTRATION-ID'");
		$this->saveDataVal('DVS4-REGISTRATION-ID',$dataval);	
	}
}
?>