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

class FriendsController extends AppController {

	var $name = 'Friends';
	var $uses = array('Friend');

	public function beforeFilter() {
       parent::beforeFilter();
       
       //$this->Auth->allow('');
	}	
	
	
	function add($friendid)
	{
		$this->Friend->newFriendRequest($_SESSION['Auth']['User']['id'], $friendid);
	}

	function pending_my_approval()
	{
		$requests = $this->Friend->getPendingMyApproval($_SESSION['Auth']['User']['id']);
		$this->set('requests',$requests);
	}
	
	function sent_requests()
	{
		$requests = $this->Friend->getMySentRequestsPending($_SESSION['Auth']['User']['id']);
		$this->set('requests',$requests);		
	}
	
	function manage()
	{
		$friends = $this->Friend->getFriendsFor($_SESSION['Auth']['User']['id']);
		$this->set('friends',$friends);
	}
	
	function approve($friendid = null)
	{
		if(null == $friendid) return;
		
		$this->Friend->approveFriendRequest($_SESSION['Auth']['User']['id'],$friendid);
	}
	
	function reject($friendid = null)
	{
		if(null == $friendid) return;
		
		$this->Friend->deleteFriendRequest($_SESSION['Auth']['User']['id'],$friendid);
	}
	
	function withdraw($friendid = null)
	{
		if(null == $friendid) return;
		
		$this->Friend->deleteFriendRequest($_SESSION['Auth']['User']['id'],$friendid);
	}
	
	function unfriend($friendid = null)
	{
		if(null == $friendid) return;
		
		$this->Friend->unfriend($_SESSION['Auth']['User']['id'],$friendid);
	}
	
	function radioselector()
	{
		$friends = $this->Friend->getFriendsForRadioSelection($_SESSION['Auth']['User']['id']);
		$this->set('friends',json_encode($friends));
	}
}
?>