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

class SitesSubscription extends AppModel {
	var $name = 'SitesSubscription';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Site' => array(
			'className' => 'Site',
			'foreignKey' => 'site_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Subscription' => array(
			'className' => 'Subscription',
			'foreignKey' => 'subscription_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function isEmailLinked($siteid, $subscriptionid){
		$ret = $this->find('first',array(
			'conditions' => array(
				'site_id' => $siteid,
				'subscription_id' => $subscriptionid
			),
			'fields' => array(
				'id'
			)
		));
		
		if(false != $ret){
			$ret = $ret['SitesSubscription']['id'];
		}
		
		return $ret;
	}
	
	function updateSubscription($siteSubscriptionId, $subscribed){
		$this->save(array(
			'id' => $siteSubscriptionId,
			'subscribed' => $subscribed
		));
	}
	
	function createSubscription($siteid, $subscriptionid){
		$this->save(array(
			'site_id' => $siteid,
			'subscription_id' => $subscriptionid,
			'subscribed' => 1
		));
	}
}
?>