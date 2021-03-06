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

class Location extends AppModel {
	
	var $name = 'Location';
	var $displayField = 'address1';
	var $actsAs = array('containable');

	var $belongsTo = array(
		'Merchant' => array(
			'className' => 'Merchant',
			'foreignKey' => 'merchant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function removeLocations($locationId){

		$this->query("DELETE FROM cods_locations WHERE location_id = $locationId");
		$this->query("DELETE FROM locations WHERE id = $locationId");
	}
	
	function getLocationById($locationId){
		
		$data = $this->find('first', array('conditions' => 
										array('Location.id' => $locationId)));
		
		$ret['Location'] = $data['Location'];
		return $ret;
	}
}