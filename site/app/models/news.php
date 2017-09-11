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

class News extends AppModel {
	var $name = 'News';
	var $displayField = 'title';
	var $actsAs = array('containable');
	
	var $hasAndBelongsToMany  = array(
		'Site' => array(
			'className' => 'Site',
			'joinTable' => 'news_sites',
			'foreignKey' => 'news_id',
			'associationForeignKey'  => 'site_id',
			'conditions' => '',
			'order' => ''
		)
	);
	


	function createNewsSiteLink($NewsId, $SiteId){ 		
		
		if(null == $NewsId || null == $SiteId){
			return false;
		}
		
		$this->query("INSERT INTO 
							news_sites
							(news_id, site_id) 
								VALUES 
							({$NewsId}, {$SiteId});");
	}
	
	function removeNewsSiteLink($NewsId){
		
		if(null == $NewsId){
			return false;
		}
		
		$this->query("DELETE FROM 
						news_sites
						WHERE news_id = {$NewsId};");
	}
	
	function getNewsbyId($NewsId){
		
		$data = $this->find('first', array('conditions' => 
										array('id' => $NewsId)));
		
		$ret['News'] = $data['News'];
		$ret['News']['site'] = array();
		
		foreach($data['Site'] as $Site){
			$ret['News']['site'][] = $Site['NewsSite']['site_id'];
		}
		
		return $ret;
	}
	
	function unLinkNews($NewsIds){
		
		if(empty($NewsIds) || null == $NewsIds){
			return false;
		}
		
		$this->query("DELETE FROM news_sites WHERE news_id IN ({$NewsIds});");
		$this->query("DELETE FROM news WHERE id IN ({$NewsIds});");
	}
	
}
?>