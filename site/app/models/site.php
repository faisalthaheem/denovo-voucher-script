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

class Site extends AppModel {
	
	var $name = 'Site';
	var $displayField = 'fqdn';
	var $actsAs = array('containable');
	
	var $hasAndBelongsToMany = array(
		'Merchant' => array(
			'className' => 'Merchant',
			'joinTable' => 'merchants_sites',
			'foreignKey' => 'site_id',
			'associationForeignKey' => 'merchant_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	var $hasMany = array(
		'Page' => array(
			'className' => 'Page',
			'foreignKey' => 'site_id'
		)
	);
	
		
	
	
	function isSiteActive($site_id){
		
		$bRet = false;
		
		$result = $this->field('active', array(
				'Site.id' => $site_id
				)
			);
		
		if($result == 1) 
			$bRet = true;
		else 
			$bRet = false;
	
		return $bRet;
	}
	
	function UpdateSite($data = null){
		
		if(null == $data) return false;
		$res = $this->save($data, true);
		return $res;
	}
	
	function getSiteId($sitename){
		
		$res = $this->find('first', array(
			'conditions' => array(
				'fqdn' => $sitename,
				'active' => 1
			),
			'fields' => array(
				'id'
			)
		));
		
		if(false!=$res){
			$res = $res['Site']['id'];
		}
		
		return $res;
	}
	
	function getSiteList(){

		$ret = $this->query(
							'SELECT id, fqdn, notes, active, created, 
								(SELECT COUNT(*) FROM categories_sites WHERE site_id = Site.id) AS categoryCount,
								(SELECT COUNT(*) FROM merchants_sites WHERE site_id = Site.id) AS merchantCount,
								(SELECT COUNT(*) FROM cods_sites WHERE site_id = Site.id) AS codCount,
								(SELECT COUNT(*) FROM sites_subscriptions WHERE site_id = Site.id) AS subscriptionCount,
								(SELECT COUNT(*) FROM sites_users WHERE site_id = Site.id) AS userCount
							FROM 
							    sites Site
							ORDER BY
							    Site.fqdn
							LIMIT 20');
		return $ret;
	}
	
	function toggleStatus($SiteId)
	{
		$data['Site']['id'] = $SiteId;		
		
		if($this->isSiteActive($SiteId))
			$data['Site']['active'] = 0;
		else
			$data['Site']['active'] = 1;
		
		$this->UpdateSite($data);
	}
	
	function createSite($data = null){
		
		if(null == $data) return false;
		
		$this->create();
		$res = $this->save($data, true);
		
		return $res;
	}

	function getSite($SiteId){
		
		$this->recursive = -1;
		$data = $this->find('first', array(
						'conditions' => array('Site.id' => $SiteId)
						)
					);
		
		return $data;
	}
	
	function getSiteByFQDN($servername){
		
		$this->recursive = -1;
		$data = $this->find('first', array(
						'conditions' => array(
							'Site.fqdn' => $servername
						)
		));
		
		return $data;
	}
	
	function createDefaults($sitename){
		
		$siteId = $this->getSiteId($sitename);
		
		$this->query("INSERT INTO banners (site_id, tag, active, created) VALUES ({$siteId}, 'h-large', 0, '2011-06-20');");
		$this->query("INSERT INTO banners (site_id, tag, active, created) VALUES ({$siteId}, 's-right', 0, '2011-06-20');");
		$this->query("INSERT INTO banners (site_id, tag, active, created) VALUES ({$siteId}, 's-left', 0, '2011-06-20');");
	}
}
?>