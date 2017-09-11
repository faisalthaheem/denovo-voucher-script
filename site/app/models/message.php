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

class Message extends AppModel {
	var $name = 'Message';
	var $displayField = 'messagebody';
	var $actsAs = array('containable');

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Conversation' => array(
			'className' => 'Conversation',
			'foreignKey' => 'conversation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function addToConversation($conversation_id, $user_id, $messagebody){
		
		$this->create();
		return $this->save(array(
			'conversation_id' => $conversation_id,
			'user_id' => $user_id,
			'messagebody' => $messagebody
		));

	}
	
	function getMessagebyId($id){
		
		$ret = $this->find('first',
							array('conditions' => array('Message.id' => $id)));
		
		return $ret;
	}
}
?>