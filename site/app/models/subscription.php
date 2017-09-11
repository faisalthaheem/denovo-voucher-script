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

class Subscription extends AppModel {
	var $name = 'Subscription';
	var $displayField = 'email';
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
		'SitesSubscription' => array(
			'className' => 'SitesSubscription',
			'foreignKey' => 'subscription_id'
		)
	);

	var $hasAndBelongsToMany = array(
		'Site' => array(
			'className' => 'Site',
			'joinTable' => 'sites_subscriptions',
			'foreignKey' => 'subscription_id',
			'associationForeignKey' => 'site_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
	
	var $validate = array(
		'email' => array(
			'rule' => 'email',
			'message' => 'Invalid email address.'	
		)
	);
	
	function recordExists($email){
		
		$ret = $this->find('first', array(
			'conditions' => array(
				'email' => $email
			),
			'fields' => array(
				'id'
			)
		));
		
		if(false != $ret){
			$ret = $ret['Subscription']['id'];
		}
		
		return $ret;
	}
	
	function unsubscribe($site, $email){
		
		$ret = false;
		
		$subscription_id = $this->recordExists($email);
		if(false != $subscription_id){

			$siteid = $this->Site->getSiteId($site);
			$site_subscription_id = $this->SitesSubscription->isEmailLinked($siteid, $subscription_id);
			
			if(false != $site_subscription_id){
				$this->SitesSubscription->updateSubscription($site_subscription_id, 0);
				$ret = true;
			}
			
		}
		
		return $ret;
	}
	
	function createSubscription($email){
		$this->save(
			array(
				'email' => $email
			)
		);
	}

	function subscribeUpdateLink($site, $email){
		
		$ret = 'Subscribed successfuly.';
		
		$siteid = $this->Site->getSiteId($site);
		
		if(false == $siteid){
			$ret = 'Invalid request.';
		}else{
			
			//does the user exist in our db?
			if(false == $this->recordExists($email)){
				$this->createSubscription($email);
			}
			
			$subscriptionid = $this->recordExists($email);
			$siteSubscriptionid = $this->SitesSubscription->isEmailLinked($siteid, $subscriptionid); 
			if(false == $siteSubscriptionid){
				//create link
				$this->SitesSubscription->createSubscription($siteid, $subscriptionid);
			}else{
				//update subscribed to 1
				$this->SitesSubscription->updateSubscription($siteSubscriptionid,1);
				$ret = 'Subscription updated.';
			}
		}
		
		return $ret;
	}
}
?>