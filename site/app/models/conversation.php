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

class Conversation extends AppModel {
	var $name = 'Conversation';
	var $displayField = 'subject';
	var $actsAs = array('containable');

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Message' => array(
			'className' => 'Message',
			'foreignKey' => 'conversation_id',
			'conditions' => '',
			'order' => 'Message.id DESC'
		)
	);
	
	
	function getConversationsForUser($userid, $limConversation = 10, $limMessages = 1){
		
		return $this->find('all',array(
			'conditions' => array(
				'or' => array(
					'user_id' => $userid,
					'sender_id' => $userid,
				),
				'deleted' => 0
			),
			'limit' => $limConversation,
			'order' => 'created desc',
			'contain' => array(
				'User' => array(
					'fields' => array(
						'id',
						'fullname'
					)
					,'Picture' => array(
						'conditions' => array(
							'Picture.tag' => Configure::read('PictureTags.ProfileView')
						),
						'fields' => array(
							'uuidtag'
						)
					)
				),
				'Message' => array(
					'conditions' => array(
						'deleted' => 0
					),
					'limit' => $limMessages,
					'User' => array(
						'fields' => array(
							'id',
							'fullname'
						)
						,'Picture' => array(
							'conditions' => array(
								'Picture.tag' => Configure::read('PictureTags.ProfileView')
							),
							'fields' => array(
								'uuidtag'
							)
						)
					)					
				)
			)
		));
	}
	
	function getConversationDetail($userid, $conversation_id, $limMessages = 10){
		
		return $this->find('first',array(
			'conditions' => array(
				'or' => array(
					'user_id' => $userid,
					'sender_id' => $userid,
				),
				'Conversation.id' => $conversation_id,
				'Conversation.deleted' => 0
			),
			'contain' => array(
				'User' => array(
					'fields' => array(
						'id',
						'fullname'
					)
					,'Picture' => array(
						'conditions' => array(
							'Picture.tag' => Configure::read('PictureTags.ProfileView')
						),
						'fields' => array(
							'uuidtag'
						)
					)
				),
				'Message' => array(
					'conditions' => array(
						'deleted' => 0
					),
					'limit' => $limMessages,
					'User' => array(
						'fields' => array(
							'id',
							'fullname'
						)
						,'Picture' => array(
							'conditions' => array(
								'Picture.tag' => Configure::read('PictureTags.ProfileView')
							),
							'fields' => array(
								'uuidtag'
							)
						)
					)					
				)
			)
		));
	}
	
	function deleteConversation($userid, $conversationid){

		$cnt = $this->find('count', array(
			'conditions' => array(
				'and' => array(
					'Conversation.id' => $conversationid,
					'or' => array(
						'Conversation.user_id' => $userid,
						'Conversation.sender_id' => $userid,
					)
				)
			)
		));
		
		if(false != $cnt && 0< $cnt){
			$this->save(array(
				'id' => $conversationid,
				'deleted' => 1
			));
		}
	}
}
?>