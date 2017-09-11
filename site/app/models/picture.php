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

class Picture extends AppModel {
	var $name = 'Picture';
	var $displayField = 'title';
	var $actsAs = array('containable');
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function get_picture($userid, $tag)
	{
		$this->recursive = -1; 
		$picture = $this->find('first', array(
					'conditions'=> array(
						'Picture.user_id' => $userid,
						"(Picture.tag = '$tag')",
						'Picture.deleted' => 0,
						'Picture.approved' => 1
				),
					'fields' => array(	
						'Picture.id', 
						'Picture.user_id',
						'Picture.filename', 
						'Picture.title', 
						'Picture.picindex',
						'Picture.tag',
						'Picture.uuidtag'
				)
			));
			
		return $picture;
	}
	
	/*
	 * 
	 * Used with widgets:
	 * 	- widget-profile-pictures
	 * 
	 * 
	 */
	function widget_pictures($userid, $tag)
	{
	
		$this->recursive = -1; 
		$pics = $this->find('all', array(
					'conditions'=> array(
						'Picture.user_id' => $userid,
						"(Picture.tag = '$tag')",
						'Picture.deleted' => 0,
						'Picture.approved' => 1	
				),
					'fields' => array(	
						'Picture.id', 
						'Picture.user_id',
						'Picture.filename', 
						'Picture.title', 
						'Picture.picindex',
						'Picture.tag'
				), 'order' => 'Picture.picindex'
			));
			
		return $pics;
	}
	
	function widget_slider_pictures($tag = null)
	{
		if(null == $tag){
			$tag = Configure::read('PictureTags.TinyPicture');
		}
	
		$pics = $this->find('all', array(
					'conditions'=> array(
						'Picture.tag' => $tag,
						'Picture.deleted' => 0,
						'Picture.approved' => 1
				),
					'fields' => array(	
						'Picture.filename',
						'User.fullname' 
				), 'order' => 'Picture.id desc'
				, 'limit' => 10
			));
			
		return $pics;
		
	}

	/*
	 * 
	 * Used with widgets:
	 * 	- widget-profile-scripts
	 * 
	 * 
	 */
	function widget_profile_scripts()
	{
		
	}

	/*
	 * Remove Picture
	 */
	function RemovePicture($uuidTag){
		
		$this->query("UPDATE banners 
						SET picture_id = NULL 
						WHERE picture_id = (SELECT id 
												FROM pictures 
												WHERE uuidtag = '{$uuidTag}');");
		
		$this->query("DELETE 
						FROM pictures 
						WHERE uuidtag = '{$uuidTag}'");
	}
	
	function getPictureId($uuidTag){
		
		$ret = $this->find('first', array('conditions' => 
										array('Picture.uuidtag' => $uuidTag)));
	
		if(!empty($ret)){
			return $ret['Picture']['id'];
		}
	}
	
	function getPictureFilenameFromUuidtag($uuidtag)
	{
		$ret = $this->find('first', array(
			'conditions' => array(
				'Picture.uuidtag' => $uuidtag
			),
			'fields' => array(
				'filename'
			)
		));
	
		if(false != $ret){
			$ret = $ret['Picture']['filename'];
		}
		
		return $ret;
	}
}
?>