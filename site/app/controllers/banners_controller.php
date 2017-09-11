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

class BannersController extends AppController{

	var $name = "Banners";
	var $uses = array("Banner", "Site", "Picture");
	
	function beforeFilter(){
		parent::beforeFilter();
		
       $this->Auth->allow(	'impression',
       						'click'
       						);		
	}
	
	function impression($bannerid = null)
	{
		if(null == $bannerid) return;
		$this->Banner->incrementImpressionCount($bannerid);
	}
	
	function click($bannerid = null)
	{
		if(null == $bannerid) return;
		$this->Banner->incrementClickCount($bannerid);
	}

	
	function admin_index($siteid = null){
		
		$this->layout = 'ajax';
		
		$this->paginate['Banner'] = array(
					
						'conditions' => 
							array(
								'Banner.site_id' => $siteid,
								'Banner.tag <>' => 'logo'
								)
						,'order' => 'Banner.created'
						,'limit' => 100
						,'contain' => 
							array(
								'Picture' =>
									array('fields' => 
										array(
											'Picture.uuidtag',
											'Picture.filename')
										)
								) 
						);
	
		$this->set('banners', $this->paginate('Banner'));
	}
	
	function admin_edit($id = null){
		
		$this->layout = 'ajax';
		
		if(!empty($this->data)){
			
			$validationErrors = array();
			$widget_banner_edit_result = false;
			
			if(strlen($this->data['Banner']['url']) < 1){
				$validationErrors[] = 'URL is required.';
			}
			
			if($this->data['Banner']['accountingmethod'] == "impressions"){
				
				if($this->data['Banner']['maximpressions'] <= 0 || empty($this->data['Banner']['maximpressions']))
				{
					$validationErrors[] = 'Invalid Max. Impressions.';
				}				
			}
			else if($this->data['Banner']['accountingmethod'] == "clicks")
			{
				if($this->data['Banner']['maxclicks'] <= 0 || empty($this->data['Banner']['maxclicks']))
				{
					$validationErrors[] = 'Invalid Max. Clicks.';
				}				
			}
			
			if(empty($validationErrors)){
				
				$widget_banner_edit_result = $this->Banner->save($this->data);
				
				// set banner image
				if(!empty($this->data['Banner']['bannerImage'])){
					$this->Banner->SetBannerImage($this->data['Banner']['id'], $this->data['Banner']['bannerImage']);
				}
				
				if(!$widget_banner_edit_result){
					$validationErrors[] = "could not complete operation, please try again.";
				}
			}
			
			$this->set('widget_banner_edit_result', $widget_banner_edit_result);
			$this->set('validationErrors', $validationErrors);
		}
		
		if(!empty($id)){
			$this->data = $this->Banner->find('first',	array(
														'conditions' => array('id' => $id),
														'contain' => array()));
		}
		
		// set sites
		$sites = $this->Site->find('list');
		$this->set('sites', $sites);
		
		//set banner image if exists
		$banner = $this->Banner->getBannerImage($this->data['Banner']['id']);
		$this->set('banner', $banner);
		
		$this->render('/elements/widget-backoffice-banner-edit');
	}
	
	function admin_remove_image($id = null){
	
		$this->layout = 'ajax';
		
		if(null == $id){
			return false;
		}
		
		$this->Banner->RemoveBannerImage($id);
	}
}
?>