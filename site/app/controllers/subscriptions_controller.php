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

class SubscriptionsController extends AppController {

	var $name = 'Subscriptions';

	var $components = array(
		'Email'
	);

	public function beforeFilter() {
    	
		parent::beforeFilter();
    	
		$this->Auth->allow(
       		'subscribe'
       		,'unsubscribe'
    	);
	}	
	
	function subscribe(){
		
		Configure::write('debug',0);
		
		$subscription_result = 'error';
		
		if(!empty($this->data)){
			
			$this->Subscription->set($this->data);
			if($this->Subscription->validates()){
			
				$subscription_result =
					$this->Subscription->subscribeUpdateLink(
						$this->sitename, 
						$this->data['Subscription']['email']
					);
					
					// send out the welcome email
					$this->Email->sendAs = 'both';
					$this->Email->from = $this->siteInfo['emailnoreply'];
					$this->Email->to = $this->data['Subscription']['email'];
					$this->Email->subject = "You have been successfully subscribed to {$this->sitename}'s mailing list.";
					$this->Email->template = 'email_subscribe';
					$this->Email->delivery = Configure::read('Mail.method');
					$this->set('emailaddress', $this->data['Subscription']['email']);
					$url = str_replace('##site##', $this->siteInfo['fqdn'], Configure::read('URLs.unsubscribeURL'));
					$url = str_replace('##emailaddress##', urlencode($this->data['Subscription']['email']), $url);
	        		$this->set('unsubscribeurl', $url);
					$this->Email->send();
					
			}else{
				$subscription_result = $this->Subscription->validationErrors;	
			}
		}
		
		$this->set('subscription_result',$subscription_result);
	}
	
	function unsubscribe($emailaddress = null)
	{
		$result = false;
		if(null != $emailaddress){
			$result = $this->Subscription->unsubscribe($this->sitename, urldecode($emailaddress));
		} 
		
		$this->set('emailaddress', $emailaddress);
		$this->set('result',$result);
	}
	
	function admin_index()
	{
		$this->loadModel('Site');
		$sites = $this->Site->find('list'
//			,array(
//				'fields' => array(
//					'id',
//					'fqdn'
//				)
//			)
		);
		
		$this->set('sites',$sites);
	}
	
	function admin_download($siteid)
	{
		$this->layout = null;
		$subscribers = $this->Subscription->query("select subscriptions.email from subscriptions where id in (Select subscription_id from sites_subscriptions where site_id = $siteid)");
		
		$this->set('subscribers',$subscribers);
	}
	
}
?>