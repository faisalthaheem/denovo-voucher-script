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

class MessagesController extends AppController {

	var $name = 'Messages';

	function beforeFilter(){
		parent::beforeFilter();
	}
	
	function admin_edit($id = null){
		
		$this->layout = 'ajax';
		
		if(!empty($this->data)){
			
			$user_message_edit = false;
			$user_message_edit = $this->Message->save($this->data, true);
			$this->set('user_message_edit', $user_message_edit);
		}
		
		if($id != null){
			$this->data = $this->Message->getMessagebyId($id);
		}
		
		$this->set('id', $id);
	}
	
	function admin_remove($id = null){
		
		if(null != $id){
			$this->Message->delete($id);
		}
	}
}
?>