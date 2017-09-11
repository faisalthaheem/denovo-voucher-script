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

class FavoritesController extends AppController {

	var $name = 'Favorites';
	
	function toggle($favoritedid){
		$this->Favorite->toggleFavorite($_SESSION['Auth']['User']['id'], $favoritedid);
	}

	function index() {
		//todo: change PictureTags.TinyPicture into PictureTags.ProfileViewPicture and change manager prefix to admin and rectify views
		$this->paginate['Favorite']['conditions'] = array(
			'user_id' => $_SESSION['Auth']['User']['id']
		);
		
		$this->paginate['Favorite']['limit'] = 15;
		$this->paginate['Favorite']['contain'] = array(
			'FavoriteUser' => array(
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
		$this->set('favorites', $this->paginate());
	}
}
?>