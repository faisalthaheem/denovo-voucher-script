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

class AbuseReport extends AppModel {
	var $name = 'AbuseReport';
	var $displayField = 'type';
	var $actsAs = array('Containable');

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'AbuseReporter' => array(
			'className' => 'User',
			'foreignKey' => 'reporter_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)		
	);	
	
	function hasReported($reporter_id, $abuser_id, $reportType = 'profile', $data = null){
		
		$this->recursive = -1;
		
		$conditions = array(
			'user_id' => $abuser_id
			,'reporter_id' => $reporter_id
			,'type' => $reportType
		);
		
		if(null != $data){
			$conditions['data'] = $data;
		}
		
		$res = $this->find('first', array(
			'conditions' => $conditions,
			'fields' => array(
				'id'
			)
		));
		
		if(false != $res){
			$res = true;
		}
		
		return $res;
	}
	
	function hasReportedProfile($reporter_id, $abuser_id){
		return $this->hasReported($reporter_id, $abuser_id);
	}
	
	function hasReportedPicture($reporter_id, $abuser_id, $data){
		return $this->hasReported($reporter_id, $abuser_id, 'picture, $data');
	}
	
	function reportAbuse($reporter_id, $abuser_id, $reportType='profile', $data = null){
		
		$data = array(
			'user_id' => $abuser_id
			,'reporter_id' => $reporter_id
			,'type' => $reportType
			,'data' => $data
		);
		$this->save($data);
	}
	
	# Toggle Profile Report
	function toggleProfileReport($reporter_id, $abuser_id){
		
		if($this->hasReportedProfile($reporter_id, $abuser_id)){
			$this->deleteAll(array(
				'user_id' => $abuser_id
				,'reporter_id' => $reporter_id
				,'status' => 0 //only if admin has not resolved this yet
			));
		}else{
			$this->reportAbuse($reporter_id, $abuser_id);
		}
	}
	
	# Toggle Picture Report
	function togglePictureReport($reporter_id, $abuser_id, $picture_id){

		if($this->hasReported($reporter_id, $abuser_id, 'picture', $picture_id)){
			
			$this->deleteAll(array(
				'user_id' => $abuser_id
				,'reporter_id' => $reporter_id
				,'type' => 'picture'
				,'data' => $picture_id
				,'status' => 0 //only if admin has not resolved this yet
			));
		
		}else{
			$this->reportAbuse($reporter_id, $abuser_id, 'picture', $picture_id);
		}
	}
	
	# Check any Picture is Reported Abuse
	function hasReportedPictures($pictures = null, $reporter_id, $abuser_id)
	{
		$retPictures = null;
		
		if(!empty($pictures)){
			
			foreach($pictures as $index => $Picture){
				
				if($this->hasReported($reporter_id, $abuser_id, 'picture', $Picture['Picture']['id'])){
					$pictures[$index]['Picture']['isReportedAbuse'] = true;	
				}else{
					$pictures[$index]['Picture']['isReportedAbuse'] = false;	
				}
			}
			
			$retPictures = $pictures;
		}
		
		return $retPictures;
	}
	
	function managerGetRecentProfiles4Dashboard()
	{
		return $this->find('all', array(
			'conditions' => array(
				'type' => 'profile'
				,'status' => 0
			),
			'fields' => array(
				'AbuseReport.id',
				'AbuseReport.user_id'
			),
			'limit' => 6,
			'order' => 'AbuseReport.id desc'
			,'contain' => array(
				'User' => array(
					'fields' => array(
						'fullname',
						'address'
					),
					'Picture' => array(
						'fields' => array(
							'filename'
						),
						'conditions' => array(
							'tag' => Configure::read('PictureTags.TinyPicture')
							,'picindex' => 0
							,'deleted' => 0
							,'approved' => 1
						)
					)
				)				
			)
		));
		
	}
}
?>