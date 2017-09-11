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

class AbuseReportsController extends AppController {

	var $name = 'AbuseReports';
		
	function toggleprofile($profileid = null){
		
		if(null == $profileid ) return ;
		$this->AbuseReport->toggleProfileReport($_SESSION['Auth']['User']['id'], $profileid);
	}
	
	function togglepicture($profileid = null, $picture = null){
		
		if(null == $profileid || null == $picture) return;
		$this->AbuseReport->togglePictureReport($_SESSION['Auth']['User']['id'], $profileid, $picture);
	}
	
	function togglevideo($profileid = null, $video = null){
		
		if(null == $profileid || null == $video) return;
		$this->AbuseReport->toggleVideoReport($_SESSION['Auth']['User']['id'], $profileid, $video);
	}
	
	function manager_widget_dashboard()
	{
		$abuseProfilesDashboard = $this->AbuseReport->managerGetRecentProfiles4Dashboard();
		$this->set('abuseProfilesDashboard',$abuseProfilesDashboard);
	}
	
	function manager_index()
	{
		debug($this->params,true);
		debug($this->Auth,true);
		debug($_SESSION,true);
		//todo: change PictureTags.TinyPicture into PictureTags.ProfileViewPicture and change manager prefix to admin and rectify views 
		$this->paginate['AbuseReport']['limit'] = 15;
		$this->paginate['AbuseReport']['contain'] = array(
			'User' => array(
				'fields' => array(
					'category'
					,'gender'
					,'dob'
					,'fullname'
					,'id'
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
			),
			'AbuseReporter' => array(
				'fields' => array(
					'category'
					,'gender'
					,'dob'
					,'fullname'
					,'id'
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
		);
		$this->set('abuseReports', $this->paginate());		
	}
}
?>