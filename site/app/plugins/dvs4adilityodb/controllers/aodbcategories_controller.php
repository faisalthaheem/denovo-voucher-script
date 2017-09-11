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

class AodbcategoriesController extends Dvs4adilityodbAppController {

	var $name = 'Aodbcategories';
	//var $uses = array('IcodesukCategory','Category');
	
	function index()
	{

	}
	
//	function admin_import()
//	{
//		$username = $this->__getUserName();
//		$subsid = $this->__getSubscriptionId();
//		
//		$category_webservices_request = 'http://webservices.icodes.co.uk/ws2.php?UserName=<usernamehere>&SubscriptionID=<subsidhere>&RequestType=CategoryList';
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
//			$data['IcodesukCategory']['icodes_name'] = $item->category;
//			$data['IcodesukCategory']['icodes_id'] = $item->id;
//			
//			if($this->IcodesukCategory->find('count', array(
//				'conditions' => array(
//					'icodes_name' => $item->category,
//					'icodes_id' => $item->id
//				)
//			)) == 0 ){
//				$this->IcodesukCategory->create();
//				$this->IcodesukCategory->save($data,false);
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
//		$this->Session->setFlash("Imported [$import_count] - Ignored [$ignore_count] categories from iCodesUK");
//		
//	}
//		
//	function admin_map()
//	{
//		$this->set('categories', $this->Category->find('list'));
//		
//		$icodesukCats = $this->IcodesukCategory->find('all');
//		$this->set('icodesukCats', $icodesukCats);
//	}
//	
//	function admin_map_to_category($ukcatid, $mappedid){
//		
//		$this->IcodesukCategory->id = $ukcatid;
//		$this->IcodesukCategory->saveField('category_id',$mappedid,false);
//		
//	}
}
?>