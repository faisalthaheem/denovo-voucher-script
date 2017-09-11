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

class Review extends AppModel {
	var $name = 'Review';
	var $displayField = 'user_id';
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
	
	function getReviewStats($userid, $professional = 0){
		$this->recursive = 0;
		
		//find count
		$ret['review_count'] = $this->find('count',array(
			'conditions' => array(
				'user_id' => $userid,
				'Review.professional' => $professional
			)
		));
		
		if($ret['review_count'] == false){
			$ret['review_count'] = 0;
			$ret['review_avg'] = 0;
		}else{
			
			$ret['review_avg'] = $this->find('first',array(
				'conditions' => array(
					'user_id' => $userid,
					'Review.professional' => $professional
				),
				'fields' => array(
					'AVG(rating) as avgrating'
				)
			));
			
			if($ret['review_avg'] == false){
				$ret['review_avg'] = 0;
			}else{
				$ret['review_avg'] = $ret['review_avg'][0]['avgrating'];
			}
		}
		
		return $ret;
	}
	
	function haveReviewed($reviewerid, $reviewedid){
		$this->recursive = -1;
		$ret = $this->find('first',array(
			'conditions' => array(
				'user_id' => $reviewerid,
				'reviewed_id' => $reviewedid
			)
		));
		
		if(false != $ret){
			$ret = true;
		}
		
		return $ret;
	}
	
	function delReview($reviewerid, $reviewedid){
		$this->deleteAll(array(
			'user_id' => $reviewerid
			,'reviewed_id' => $reviewedid
		));
	}
	
	function addReview($reviewerid, $reviewedid, $professional, $rating){

		$review['Review']['user_id'] = $reviewerid;
		$review['Review']['reviewed_id'] = $reviewedid;
		$review['Review']['professional'] = $professional;
		$review['Review']['rating'] = $rating;
		
		$this->save($review);
	}
	
	function reviewed($reviewerid, $reviewedid, $professional, $rating){
		
		if($rating < 0) $rating = 0;
		if($rating > 5) $rating = 5;
		
		if($rating == 0){
			$this->delReview($reviewerid, $reviewedid);					
		}else{
			if($this->haveReviewed($reviewerid, $reviewedid)) return;
			$this->addReview($reviewerid, $reviewedid, $professional, $rating);
		}
	}
}
?>