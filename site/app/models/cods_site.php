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

class CodsSite extends AppModel{
	
	var $name = 'CodsSite';

	var $belongsTo = array(
		'Site' => array(
			'className' => 'Site',
			'foreignKey' => 'site_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Cod' => array(
			'className' => 'Cod',
			'foreignKey' => 'cod_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	function linkCodSite($SiteId, $CodId){
		
		$exists = $this->find('first', 
									array('conditions' => 
										array('CodsSite.site_id' => $SiteId,
												'CodsSite.cod_id' => $CodId)));
		
		if(!$exists){
			
			$data['CodsSite']['site_id'] = $SiteId;
			$data['CodsSite']['cod_id'] = $CodId;
			
			$this->create();
			$this->save($data, true);
		}
	}
	
	function unLinkCod($CodIDs, $SiteId){
		$this->query("DELETE FROM cods_sites WHERE site_id = {$SiteId} AND cod_id IN ({$CodIDs})");
	}
}
?>