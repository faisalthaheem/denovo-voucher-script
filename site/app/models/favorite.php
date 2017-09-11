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

class Favorite extends AppModel {
	var $name = 'Favorite';
	var $displayField = 'user_id';
	var $actsAs = array('Containable');

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'FavoriteUser' => array(
			'className' => 'User',
			'foreignKey' => 'favorite_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function getSelfFavoriteStats($userid){
		$this->recursive = -1;
		$ret = $this->find('count',array(
			'conditions' => array(
				'favorite_id' => $userid
			)
		));
		
		if(false == $ret) $ret = 0;
		
		return $ret;
	}
	
	function isFavorited($viewerid, $viewedid){
		$this->recursive = -1;
		
		$ret = $this->find('count',array(
			'conditions' => array(
				'user_id' => $viewerid,
				'favorite_id' => $viewedid
			)
		));
		
		if(false != $ret) $ret = true;
		
		return $ret;
	}
	
	function addFavorite($viewerid, $viewedid){
		$favorite['Favorite']['user_id'] = $viewerid;
		$favorite['Favorite']['favorite_id'] = $viewedid;
		
		$this->save($favorite);
	}
	
	function delFavorite($viewerid, $viewedid){
		$this->deleteAll(
			array(
				'user_id' => $viewerid,
				'favorite_id' => $viewedid
			)
		);
	}
	
	function toggleFavorite($viewerid, $viewedid){
		if($this->isFavorited($viewerid, $viewedid)){
			//del
			$this->delFavorite($viewerid, $viewedid);
		}else{
			//insert
			$this->addFavorite($viewerid, $viewedid);
		}
	}
}
?>