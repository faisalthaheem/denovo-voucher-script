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

class Friend extends AppModel {
	var $name = 'Friend';
	var $actsAs = array('containable');
	
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'friend_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getFriendsFor($userid)
	{
		return $this->find('all', array(
			'conditions' => array(
				'user_id' => $userid
				,'confirmed' => 1
			),
			'contain' => array(
				'User' => array(
					'fields' => array('id','fullname'),
					'Picture' => array(	'fields' => array('uuidtag'),
										'conditions' => array(
											'tag' => Configure::read('PictureTags.ProfileView'),
											'picindex' => 0,
											'deleted' => 0,
											'approved' => 1)
								)
				)
			)
		));
	}
	
	function getFriendsForRadioSelection($userid)
	{
		return $this->find('all', array(
			'conditions' => array(
				'user_id' => $userid
				,'confirmed' => 1
			),
			'fields' => array(
				'friend_id'
			),
			'contain' => array(
				'User' => array(
					'fields' => array('id','fullname'),
					'Picture' => array(	'fields' => array('uuidtag'),
										'conditions' => array(
											'tag' => Configure::read('PictureTags.ProfileView'),
											'picindex' => 0,
											'deleted' => 0,
											'approved' => 1)
								)
				)
			)
		));
	}

	
	function getPendingMyApproval($myid)
	{
		return $this->find('all',array(
			'conditions' => array(
				'user_id' => $myid,
				"initiated_by <> $myid",
				'confirmed' => 0
			),
			'contain' => array(
				'User' => array(
					'fields' => array('id','fullname'),
					'Picture' => array(	'fields' => array('uuidtag'),
										'conditions' => array(
											'tag' => Configure::read('PictureTags.ProfileView'),
											'picindex' => 0,
											'deleted' => 0,
											'approved' => 1)
								)
				)
			)
		));
	}
	
	function getMySentRequestsPending($myid)
	{
		return $this->find('all',array(
			'conditions' => array(
				'user_id' => $myid,
				"initiated_by" => $myid,
				'confirmed' => 0
			),
			'contain' => array(
				'User' => array(
					'fields' => array('id','fullname'),
					'Picture' => array(	'fields' => array('uuidtag'),
										'conditions' => array(
											'tag' => Configure::read('PictureTags.ProfileView'),
											'picindex' => 0,
											'deleted' => 0,
											'approved' => 1)
								)
				)
			)
		));
	}	
	
	function getFriendStatus($myid, $friend_id)
	{
		$friend = $this->find('first', array(
			'conditions' => array(
				'user_id' => $myid,
				'friend_id' => $friend_id
			)
		));
		
		$ret = 'n/a'; //no relation
		if(false != $friend && $friend['Friend']['confirmed'] == 1){
			$ret = 'friends';
		}else if(false != $friend && $friend['Friend']['confirmed'] == 0){
			$ret = 'pending';
		}
		
		return $ret;
	}
	
	function newFriendRequest($myid, $friend_id)
	{
		$this->create();
		$this->save(array(
			'user_id' => $myid
			,'friend_id' => $friend_id
			,'initiated_by' => $myid
		));

		//as connections go both ways
		$this->create();
		$this->save(array(
			'user_id' => $friend_id
			,'friend_id' => $myid
			,'initiated_by' => $myid
		));
		
	}
	
	function approveFriendRequest($myid, $requestfrom)
	{
		$request = $this->find('first', array(
			'conditions' => array(
				'user_id' => $myid,
				'friend_id' => $requestfrom,
				'confirmed' => 0
			)
		));
		
		if(false != $request){
			$request['Friend']['confirmed'] = 1;
			$this->save($request); //update

			//mark corresponding reverse connection as confrimed
			$request = $this->find('first', array(
				'conditions' => array(
					'user_id' => $requestfrom,
					'friend_id' => $myid,
					'confirmed' => 0
				)
			));
			$request['Friend']['confirmed'] = 1;
			$this->save($request);
			
		}
	}
	
	function deleteFriendRequest($myid, $requestto)
	{
		$request = $this->find('first', array(
			'conditions' => array(
				'user_id' => $myid,
				'friend_id' => $requestto,
				'confirmed' => 0
			)
		));
		
		if(false != $request){
			$this->delete($request['Friend']['id']);
		}
		
		//delete corresponding reverse connection
		$request = $this->find('first', array(
			'conditions' => array(
				'user_id' => $requestto,
				'friend_id' => $myid,
				'confirmed' => 0
			)
		));
		if(false != $request){
			$this->delete($request['Friend']['id']);
		}		
	}
	
	function unfriend($myid, $friendid)
	{
		$friend = $this->find('first', array(
			'conditions' => array(
				'user_id' => $myid,
				'friend_id' => $friendid,
				'confirmed' => 1
			)
		));
		
		if(false != $friend){
			$this->delete($friend['Friend']['id']);
		}
		
		//delete corresponding reverse connection
		$friend = $this->find('first', array(
			'conditions' => array(
				'user_id' => $friendid,
				'friend_id' => $myid,
				'confirmed' => 1
			)
		));
		if(false != $friend){
			$this->delete($friend['Friend']['id']);
		}		
	}	
}
?>