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

class IcodesusCategoriesController extends Dvs4icodesusAppController {

	var $name = 'IcodesusCategories';
	var $uses = array('IcodesusCategory','Category');
	
	
	function index()
	{

	}
	
	function admin_import()
	{
//		$username = $this->__getUserName();
//		$subsid = $this->__getSubscriptionId();
//		
//		$category_webservices_request = 'http://webservices.icodes-us.com/ws2_us.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=CategoryList';
//		$category_webservices_request = str_replace("<usernamehere>", $username, $category_webservices_request);
//		$category_webservices_request = str_replace("<subsidhere>", $subsid, $category_webservices_request);
//
//
//		$xml = simplexml_load_file($category_webservices_request);
//		
//		$import_count = 0;
//		$ignore_count = 0;
//		$import_details = array();
//		$ignore_details = array();
//		
//		
//		foreach($xml->item as $item)
//		{
//			$data['IcodesusCategory']['icodes_name'] = $item->category;
//			$data['IcodesusCategory']['icodes_id'] = $item->id;
//			
//			if($this->IcodesukCategory->find('count', array(
//				'conditions' => array(
//					'icodes_name' => $item->category,
//					'icodes_id' => $item->id
//				)
//			)) == 0 ){
//				$this->IcodesusCategory->create();
//				$this->IcodesusCategory->save($data,false);
//				
//				$import_count ++;
//				$import_details[] = "Importing [{$item->id}]@[{$item->category}]";
//			}else{
//				$ignore_count ++;
//				$ignore_details[] = "Ignoring [{$item->id}]@[{$item->category}]";
//			}
//		}
//		
//		$this->set('import_details',$import_details);
//		$this->set('ignore_details',$ignore_details);
//		
//		$this->Session->setFlash("Imported [$import_count] - Ignored [$ignore_count] categories from iCodesUS");
		
	}
		
	function admin_map()
	{
		$this->set('categories', $this->Category->find('list'));
		
		$icodesusCats = $this->IcodesusCategory->find('all');
		$this->set('icodesusCats', $icodesusCats);
	}
	
	function admin_map_to_category($uscatid, $mappedid){
		
		$this->IcodesusCategory->id = $uscatid;
		$this->IcodesusCategory->saveField('category_id',$mappedid,false);
		
	}
}
?>