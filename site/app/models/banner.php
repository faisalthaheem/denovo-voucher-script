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

class Banner extends AppModel{

	var $name = "Banner";
	var $actsAs = array('containable');

	var $belongsTo = array(
			'Picture' => array(
				'className' => 'Picture',
				'foreignKey' => 'picture_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			),
			'Site' => array(
				'className' => 'Site',
				'foreignKey' => 'site_id',
				'conditions' => '',
				'fields' => '',
				'order' => ''
			)
		);
		
	function getBannerImage($id){
		
		if(null == $id){
			return false;
		}
		
		$ret = $this->query("SELECT Picture.filename, Picture.uuidtag 
									FROM pictures Picture
									WHERE Picture.id = (SELECT picture_id 
																FROM banners WHERE id = {$id} AND tag <> 'logo')
									AND Picture.tag2 <> 'logo';");
		
	
		return $ret;
	}
	
	function SetBannerImage($BannerId, $uuidTag){
		
		$this->query("Update banners 
						SET 
							picture_id = (SELECT id FROM pictures WHERE uuidtag = '{$uuidTag}'),
							active = 1
						WHERE id = {$BannerId};");
	
	}
	
	function RemoveBannerImage($BannerId){
		
		$data['Banner']['id'] = $BannerId;
		$data['Banner']['picture_id'] = null;
		$data['Banner']['active'] = 0;
		$data['Banner']['accountingmethod'] = '';
		$data['Banner']['maxclicks'] = 0;
		$data['Banner']['clicksdone'] = 0;
		$data['Banner']['maximpressions'] = 0;
		$data['Banner']['impressionsdone'] = 0;
		$data['Banner']['url'] = '';
		$this->save($data, true);
	}
	
	function getBannersForSite($siteid)
	{
		$this->recursive = -1;
		return $this->find('all',array(
			'conditions' => array(
				'site_id' => $siteid
			),
			'contain' => array(
				'Picture' => array(
					'fields' => array(
						'uuidtag','filename'
					)
				)
			)
		));
	}

	function incrementImpressionCount($id)
	{
		$banner = $this->read(null, $id);
		$banner['Banner']['impressionsdone'] = $banner['Banner']['impressionsdone']+1;
		$this->save($banner);
	}
		
	function incrementClickCount($id)
	{
		$banner = $this->read(null, $id);
		$banner['Banner']['clicksdone'] = $banner['Banner']['clicksdone']+1;
		$this->save($banner);
	}

}