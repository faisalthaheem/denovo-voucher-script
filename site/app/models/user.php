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

class User extends AppModel {
	var $name = 'User';
	var $displayField = 'fullname';
	var $actsAs = array(
					'Containable',
//					'Acl' => array('type' => 'requester')	
					);

	var $validate = array(
		'email' => array(
			'rule' => 'email',
			'message' => 'Please provide a valid email address.'
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
		)
	);

	var $hasMany = array(
		'Favorite' => array(
			'className' => 'Favorite',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'AbuseReport' => array(
			'className' => 'AbuseReport',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),	
		'AbuseReporter' => array(
			'className' => 'AbuseReport',
			'foreignKey' => 'reporter_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),	
		'Picture' => array(
			'className' => 'Picture',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Friend' => array(
			'className' => 'Friend',
			'foreignKey'=> 'user_id'
		),
		'Conversation' => array(
			'className' => 'Conversation',
			'foreignKey' => 'sender_id'
		)		
	);
	
	var $virtualFields = array(
   		'age' => "YEAR(NOW())-YEAR(User.dob)"
	);
	
	function parentNode() {
	    
		if (!$this->id && empty($this->data)) {
	        return null;
	    }
	    
	    if (isset($this->data['User']['group_id'])) {
			$groupId = $this->data['User']['group_id'];
	    } else {
		   	$groupId = $this->field('group_id');
	    }
	    
	    if (!$groupId) {
			return null;
	    } else {
	        return array('Group' => array('id' => $groupId));
	    }
	}	
	

	/*
	 * Used with elements:
	 * 	- widget-profile-header
	 * 	- widget-profile-biodata
	 */
	function widget_profiledata($userid)
	{
		
	}
	
	/*
	 * 
	 */
	function SetUserIpAndTime($UserId, $UserIp, $CurrTime){

		$bRet = false;
		
		$data['User']['id'] = $UserId;
		$data['User']['lastloginip'] = $UserIp;
		$data['User']['lastlogintime'] = $CurrTime;
		
		$bRet = $this->save($data, true);
		
		return $bRet;
	}
	
	function toggleStatus($UserId){
		$data['User']['id'] = $UserId;		
		
		if($this->isUserActive($UserId))
			$data['User']['active'] = 0;
		else
			$data['User']['active'] = 1;
		
		$this->UpdateUser($data);
	}
	
	function isUserActive($UserId){
		
		$bRet = false;
		
		$result = $this->field('active', 
								array('User.id' => $UserId)
							);
		
		if($result == 1) 
			$bRet = true;
		else 
			$bRet = false;
		
		return $bRet;
	}
	
	function UpdateUser($data){
		
		if(null == $data) return false;
		$res = $this->save($data, true);
		return $res;
	}
	
	function RemoveUser($UserId){
		$this->query("DELETE FROM abuse_reports WHERE user_id = $UserId OR reporter_id = $UserId");
		$this->query("DELETE FROM favorites WHERE user_id = $UserId OR favorite_id = $UserId");
		$this->query("DELETE FROM friends WHERE user_id = $UserId OR friend_id = $UserId");
		$this->query("DELETE FROM messages WHERE user_id = $UserId OR conversation_id IN (SELECT id FROM conversations WHERE user_id = $UserId OR sender_id = $UserId)");
		$this->query("DELETE FROM conversations WHERE user_id = $UserId OR sender_id = $UserId");
		$this->query("DELETE FROM pictures WHERE user_id = $UserId");
		$this->query("DELETE FROM reviews WHERE user_id = $UserId OR reviewed_id = $UserId");
		$this->query("DELETE FROM shouts WHERE user_id = $UserId");
		$this->query("DELETE FROM usage_histories WHERE user_id = $UserId");
		$this->query("DELETE FROM users WHERE id = $UserId");			
	}
	
	function getUserById($UserId){
		
		$ret = $this->find('first',
							array('conditions' => 
										array('User.id' => $UserId)
							)
						);
	
		return $ret;
	}
}
?>