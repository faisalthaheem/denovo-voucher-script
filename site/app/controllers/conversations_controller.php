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

class ConversationsController extends AppController {

	var $name = 'Conversations';
	
	
	function index()
	{
		//$conversations = $this->Conversation->getConversationsForUser($_SESSION['Auth']['User']['id']);
		//$this->set('conversations',$conversations);
		
		$this->paginate['Conversation'] = array(
			'conditions' => array(
				'or' => array(
					'user_id' => $_SESSION['Auth']['User']['id'],
					'sender_id' => $_SESSION['Auth']['User']['id'],
				),
				'deleted' => 0
			),
			'limit' => 10,
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
					'limit' => 1,
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
		);
		
		$this->_setBackURL('conversations');
		
		$this->set('conversations',$this->paginate('Conversation'));
	}
	
	function detail($conversation_id)
	{
		$convMsgs = $this->Conversation->getConversationDetail($_SESSION['Auth']['User']['id'], $conversation_id);
		$this->set('convMsgs',$convMsgs);
	}
	
	function new_conversation()
	{
		if(!empty($this->data)){
			$this->Conversation->create();
			$this->data['Conversation']['deleted'] = 0;
			$this->data['Conversation']['sender_id'] = $_SESSION['Auth']['User']['id'];
			$result = $this->Conversation->save($this->data);
			
			if($result)
			{
				$this->loadModel('Message');
				$result = $this->Message->addToConversation(
					$this->Conversation->id, 
					$this->data['Conversation']['sender_id'], 
					$this->data['Conversation']['message']
				);
			}
			
			$error = true;
			if($result){
				$error = false;
			}
			
			$this->set('error',$error);
			$this->render(null,null,'/elements/widget-conversations-new-result');
		}
	}
	
	function reply(){
		
		$this->Conversation->Message->addToConversation(
			$this->data['Conversation']['id'],
			$_SESSION['Auth']['User']['id'],
			$this->data['Message']['messagebody']
		);
		
		$this->detail($this->data['Conversation']['id']);
		$this->render('detail');
	}
	
	function delete($renderIndex = null){
		$this->Conversation->deleteConversation(
			$_SESSION['Auth']['User']['id'],
			$this->data['Conversation']['id']
		);
		
		if(null == $renderIndex){
			$this->index();
			$this->render('index');
		}
	}
	
	function admin_user_conversations($userId = null){
		
		if(null == $userId){
			return null;
		}
		
		$this->paginate['Conversation'] = array(
			'conditions' => array(
				'or' => array(	
							'user_id' => $userId,
							'sender_id' => $userId),
				'deleted' => 0),
			'limit' => 2,
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
						'limit' => 25,
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
		);
		
		$this->_setBackURL('conversations');
		$this->set('conversations',$this->paginate('Conversation'));
		$this->render('/elements/widget-backoffice-user-conversations');
	}
	
}
?>