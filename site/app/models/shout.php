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

class Shout extends AppModel {
	var $name = 'Shout';
	var $displayField = 'shout';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	/*
	 * Used in widgets
	 * 	- widget-dashboard-shouts
	 * 
	 */
	function widget_dashboard_shouts()
	{
		$this->Behaviors->attach('Containable');
		$this->contain('User');
		
		$this->recursive = 0;
		$shouts = $this->find('all', 
			array(
				'conditions' => array(
					'deleted' => '0'
				),
				'fields' => array(
					'Shout.created',
					'Shout.shout',
					'User.fullname',
					'User.id'
				),
				'limit' => 15,
				'order' => 'Shout.created desc'
			)
		);
		
		return $shouts;		
	}	
}
?>