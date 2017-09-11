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

class NewsController extends AppController {
	
	var $name = 'News';
	var $uses = array('News', 'Site');
	
	function beforeFilter(){
		parent::beforeFilter();
	}

	function admin_index(){
		
		$this->layout = 'ajax';
		
		$this->paginate['News'] = 
					array(
						'conditions' => array(
							'News.deleted' => 0
						),'fields' => array(
							'News.id',
							'News.title',
							'News.created'
						),'order' => 'News.created DESC'
						,'limit' => 10
						,'contain' => array() 
					);
					
		$this->set('news', $this->paginate('News'));
	}
	
	function admin_add(){
		
		$this->layout = 'ajax';
		
		if(!empty($this->data)){
			
			$validationErrors = array();
			$widget_news_add_result = false;
			
			if(strlen($this->data['News']['title']) < 1){
				$validationErrors[] = 'News Title: Cannot be blank.';
			}
			
			if(strlen($this->data['News']['description']) < 1){
				$validationErrors[] = 'Description: Cannot be blank.';
			}
			
			if(empty($validationErrors)){
				
				$this->News->create();
				
				if($this->News->save($this->data)){
					$widget_news_add_result = true;
					foreach($this->data['News']['site'] as $SiteId){
						$this->News->createNewsSiteLink($this->News->id, $SiteId);
					}
				}else{
					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_news_add_result = false;
				}
			}
			
			$this->set('widget_news_add_result', $widget_news_add_result);
			$this->set('validationErrors', $validationErrors);
			
			
		}
		
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
	}
	
	function admin_edit($id){
		
		$this->layout = 'ajax';

		if(!empty($this->data)){
			
			$validationErrors = array();
			$widget_news_edit_result = false;
			
			if(strlen($this->data['News']['title']) < 1){
				$validationErrors[] = 'News Title: Cannot be blank.';
			}
			
			if(strlen($this->data['News']['description']) < 1){
				$validationErrors[] = 'Description: Cannot be blank.';
			}
						
			if(empty($validationErrors)){
				
				if($this->News->save($this->data)){
					
					$widget_news_edit_result = true;
					$this->News->removeNewsSiteLink($this->data['News']['id']);
					foreach($this->data['News']['site'] as $SiteId){
						$this->News->createNewsSiteLink($this->News->id, $SiteId);
					}
				
				}else{
					
					$validationErrors[] = 'Could not complete operation, please try later.';
					$widget_news_edit_result = false;
				}
			}
			
			$this->set('widget_news_edit_result', $widget_news_edit_result);
			$this->set('validationErrors', $validationErrors);
		}
		
		if(!empty($id)){
			$this->data = $this->News->getNewsbyId($id);
		}
		
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
	}
	
	function admin_remove($NewsIDs = null){
		
		if(null == $NewsIDs){
			return false;
		}
		
		$this->News->unLinkNews($NewsIDs);
	}
}
?>