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

class PicturesController extends AppController {

	var $name = 'Pictures';
	var $components = array('Picupload','Imagesizer');
	var $uses = array('Picture','User');

	function edit() {
		
		$this->layout = 'ajax';
		Configure::write('debug', 2);
		$_SESSION['Pictures']['currentAction'] = 'profilepictures';
		$userid = $_SESSION['Auth']['User']['id'];	
		
		$pics = $this->Picture->widget_pictures($userid,Configure::read('PictureTags.ProfileViewPictureWidget'));
		$pictures = array();
		foreach($pics as $index => $pictureInfo)
		{
			$pictures[$pictureInfo['Picture']['picindex']] = $pictureInfo;
		}
		
		$this->set('pictures', $pictures);
		$this->set('userid', $userid);
	}

//	
//User chooses to upload file
//	- dialog box is shown with an iframe
//		- iframe is given the name of the callback function to invoke on completion (rendered via php)
//- system generates all required sized images (in next step files are sent)
//		- iframe uploads the file and on completion calls the parent's completed function or failed function
//	- dialog box now shows status messagea	
//	function widget_upload_iframe($userid = null, $picindex = -1, $cbfunc='uploadcomplete'){
	function widget_upload_iframe($cbfunc = null){		
		
		$this->layout = 'ajax';

		//todo: check to make sure how many pictures are allowed on this site
//		debug($this->data,true);
		
		$userid = $_SESSION['Auth']['User']['id'];
		$this->User->id = $userid;
		
		if(!empty($this->data) && !empty($this->data['Picture']) && !empty($this->data['Picture']['pic']) && !empty($this->data['Picture']['pic']['name']) ){

			//todo: check if admin user and whether user_id overridden, if so, use that
			
			# get all params passed to view and then passed back to the view by form
			$picindex = 0;
			$cbfunc = $this->params['named']['cbfunc'];

			//$watermark = APP.'webroot'.DS.'img'.DS.'watermark.png';
			$watermark = null;
			$uploadLocation = APP.'webroot'.DS.'files'.DS.'pictures'.DS;
			
			$uuidtag = $this->Uuid->generate();
			
			// Initialize Variables
			
			$fnameOriginalImg = Configure::read('PictureTags.Original') . '-' . $uuidtag . '.' . $this->Imagesizer->getFileExtension($this->data['Picture']['pic']['name']);
			$fOriginalImg = $uploadLocation . $fnameOriginalImg;
			
			$fProfileView = $uploadLocation . Configure::read('PictureTags.ProfileView') . '-' . $uuidtag . '.png';

			$fAvatar = $uploadLocation . Configure::read('PictureTags.Avatar') . '-' . $uuidtag . '.png';
			
			$fProfilePictureView = $uploadLocation . Configure::read('PictureTags.ProfileViewPictureWidget') . '-' . $uuidtag . '.png';
			
			$fTinyPicture = $uploadLocation . Configure::read('PictureTags.TinyPicture') . '-' . $uuidtag . '.png';
			
			$fPopupPicture = $uploadLocation . Configure::read('PictureTags.PopupPicture') . '-' . $uuidtag . '.png';

			# Saving Original Image
			$this->Picupload->upload($this->data['Picture']['pic'], $uploadLocation, $fnameOriginalImg);
			
			# Populate data variable with common data
			$this->data['Picture']['user_id'] = $userid;
			$this->data['Picture']['uuidtag'] = $uuidtag;
			$this->data['Picture']['picindex'] = $picindex;
			$this->data['Picture']['title'] = '';			
			$this->data['Picture']['deleted'] = 0;
			$this->data['Picture']['approved'] = 1;
			$this->data['Picture']['processed'] = 1;
			$this->data['Picture']['filename'] = $fnameOriginalImg;
			$this->data['Picture']['pathtofile'] = $fOriginalImg;
			$this->data['Picture']['tag'] = $_SESSION['pictures']['tag'];
			$upload_results = $this->Picture->save($this->data, true);
			
			//todo: log to syslogs if unable to save data

			if($_SESSION['pictures']['picturetype'] == 'user_picture'){ 
			
				# Copy and Resize for Profile View
				$this->Imagesizer->resizeCopy(
					$fOriginalImg,
					108,
					81,
					$fProfileView);
				
				# Copy and Resize for Avatar
				$this->Imagesizer->resizeCopy(
					$fOriginalImg,
					180,
					180,
					$fAvatar);
	
				# Copy and Resize for Artist profile pictures widget
				$this->Imagesizer->resizeCopy(
					$fOriginalImg,
					196,
					196,
					$fProfilePictureView);
	
	
				# Copy and Resize for Tiny
				$this->Imagesizer->resizeCopy(
					$fOriginalImg,
					51,
					38,
					$fTinyPicture);
	
				# Copy and Resize for Popup
				$this->Imagesizer->resizeCopy(
					$fOriginalImg,
					450,
					320,
					$fPopupPicture,
					$watermark);
			}
			else if($_SESSION['pictures']['picturetype'] == 'banner')
			{
					
			}
			
			$this->set('upload_results', $upload_results);
			$this->set('uploaded_image', str_replace($uploadLocation, "", $fProfilePictureView));

			# This is callback function name, will be passed to upload successfull widget.
			$this->set('callback', $this->params['named']['cbfunc']);
		}
		
		$this->set('userid', $userid);
		$this->set('cbfunc', $cbfunc);
	}
	
	function widget_upload_picture($userid = null, $picindex = -1, $cbfunc = 'uploadcomplete()', $container = null, $actiontype = null)
	{
		# In the View it loads widget-upload-picture
		# Where an iframe loads widget_upload_iframe to upload Pictures
	
		if(null == $userid || empty($userid))
		{
			$userid = $_SESSION['Auth']['User']['id'];
		}
		
		$this->set('userid', $userid);
		$this->set('picindex', $picindex);
		$this->set('cbfunc', $cbfunc);
		$this->set('dialogContainer', $container);
		$this->set('actiontype', $actiontype);
	}
	
	function widget_picture_edit($picindex = null, $userid = null)
	{
		if(null == $userid || empty($userid))
		{
			$userid = $_SESSION['Auth']['User']['id'];
		}
	
		$this->Picture->recursive = -1;
		
		# Pictures 
		$pic = $this->Picture->find('first', array(
			'conditions'=> array(
				'Picture.user_id' => $userid,
				'Picture.picindex' => $picindex,
				'Picture.tag' => 'Prov-PEdit',
				'Picture.deleted' => 0,
				'Picture.approved' => 1
			)
		));
		
		$this->set("userid", $userid);
		$this->set('picindex', $picindex);
		$this->set("pic", $pic);
	}
	
	function delete_picture($picindex = null, $userid = null)
	{
		$this->layout = 'ajax';
		
		$result = 'Failed';
		
		if(!empty($picindex) && !empty($userid))
		{
			$res = $this->Picture->query("UPDATE pictures SET deleted = 1 WHERE user_id ='$userid' AND picindex = '$picindex'");
			
			if($res)
			{
				$result = "Success";
			}
			else if(!$res)
			{
				$result = "Failed";
			}
		}
		
		$this->set('result', $result);
	}
	
	function profilepicture(){
		$_SESSION['pictures']['picturetype'] = 'user_picture'; //generate thumbs
		$_SESSION['pictures']['tag'] = Configure::read('PictureTags.ProfileView');
	}
	

	/*
	 * admin uploads Site Logos and Banners
	 */
	function admin_widget_upload_iframe(){		
		
		$this->layout = 'ajax';

		//todo: check to make sure how many pictures are allowed on this site
//		debug($this->data,true);
		
		$userid = $_SESSION['Auth']['User']['id'];
		$this->User->id = $userid;
		
		if(!empty($this->data) && !empty($this->data['Picture']) && !empty($this->data['Picture']['pic']) && !empty($this->data['Picture']['pic']['name']) ){

			//todo: check if admin user and whether user_id overridden, if so, use that
			
			# get all params passed to view and then passed back to the view by form
			$picindex = 0;

			//$watermark = APP.'webroot'.DS.'img'.DS.'watermark.png';
			$watermark = null;
			$uploadLocation = APP.'webroot'.DS.'files'.DS.'pictures'.DS;
			
			$uuidtag = $this->Uuid->generate();
			
			// Initialize Variables
			$fnameOriginalImg = '';
			$fOriginalImg = '';
			
			if($_SESSION['pictures']['picturetype'] == Configure::read('PictureTags.Banner')){
				$fnameOriginalImg = Configure::read('PictureTags.Banner') . '-' . $uuidtag . '.' . $this->Imagesizer->getFileExtension($this->data['Picture']['pic']['name']);
				$fOriginalImg = $uploadLocation . $fnameOriginalImg;
			}elseif($_SESSION['pictures']['picturetype'] == Configure::read('PictureTags.Logo')){
				$fnameOriginalImg = Configure::read('PictureTags.Logo') . '-' . $uuidtag . '.' . $this->Imagesizer->getFileExtension($this->data['Picture']['pic']['name']);
				$fOriginalImg = $uploadLocation . $fnameOriginalImg;
			}elseif($_SESSION['pictures']['picturetype'] == Configure::read('PictureTags.Voucher')){
				$fnameOriginalImg = Configure::read('PictureTags.Voucher') . '-' . $uuidtag . '.' . $this->Imagesizer->getFileExtension($this->data['Picture']['pic']['name']);
				$fOriginalImg = $uploadLocation . $fnameOriginalImg;
			}
			
			
			# Saving Original Image
			$this->Picupload->upload($this->data['Picture']['pic'], $uploadLocation, $fnameOriginalImg);
			
			# Populate data variable with common data
			$this->data['Picture']['user_id'] = $userid;
			$this->data['Picture']['uuidtag'] = $uuidtag;
			$this->data['Picture']['picindex'] = $picindex;	
			$this->data['Picture']['title'] = $this->data['Picture']['title'];		
			$this->data['Picture']['deleted'] = 0;
			$this->data['Picture']['approved'] = 1;
			$this->data['Picture']['processed'] = 1;
			$this->data['Picture']['filename'] = $fnameOriginalImg;
			$this->data['Picture']['pathtofile'] = $fOriginalImg;
			$this->data['Picture']['tag2'] = $_SESSION['pictures']['picturetype'];
			
			$upload_results = $this->Picture->save($this->data, true);
			$this->set('upload_results', $upload_results);
		}
		
		$this->set('userid', $userid);
	}
	
	function admin_widget_site_images($type){
		$_SESSION['pictures']['picturetype'] = $type;
	}
	
	//TODO: this function is obsolete for dvs community
	function admin_user_pictures($userId = null){

		$this->layout = 'ajax';
		
		if(null == $userId){
			return null;
		}
	
		$this->paginate['Picture'] = array(
								'conditions' => array(
										'Picture.tag' => Configure::read('PictureTags.ProfileViewPictureWidget'),
										'Picture.deleted' => 0,
										'Picture.approved' => 1,
										'Picture.picturetype' => 'picture'),
								'limit' => 9,
								'order' => 'Picture.created desc',
								'contain' => array(
										'User' => array(
													'fields' => array(
																'id',
																'fullname')										
													)
											)
									);
		
		$this->_setBackURL('pictures');
		$this->set('pictures',$this->paginate('Picture'));
		$this->render('/elements/widget-backoffice-user-pictures');
	
	}
	
	/*
	 * admin deletes picture
	 */
	function admin_remove_picture($uuidTag = null){
		
		if(null == $uuidTag || empty($uuidTag)){
			return false;
		}
		
		// remove picture
		$this->Picture->RemovePicture($uuidTag);
		
		return true;
	}
	
	function admin_index(){
		
		$this->layout = 'ajax';
		
		$banner = Configure::read('PictureTags.Banner');
		$logo = Configure::read('PictureTags.Logo');
		$voucher = Configure::read('PictureTags.Voucher');
		
		$searchConditions = array(
									"Picture.tag2 IN ('$banner', '$logo', '$voucher')"
									,"Picture.deleted" => 0
									,"Picture.user_id" => $_SESSION['Auth']['User']['id']);
									
		if(!empty($this->data) && isset($this->data['Picture']['search'])){
			$searchConditions[] = "Picture.title LIKE '%{$this->data['Picture']['search']}%'";
		}
		
		$this->paginate['Picture'] = array(
								'conditions' => $searchConditions,
								'limit' => 9,
								'order' => 'Picture.id',
								'contain' => array());
		
		$this->set('pictures',	$this->paginate('Picture'));
	}
	
	function admin_widget_image_selector($type, $hiddenFieldId, $container, $uuidTag = null){
		
		$conditions = array(
						'Picture.tag2' => $type
						,'Picture.deleted' => 0
		);
		
		if(!empty($this->data))
		{
			$conditions[] = "Picture.title LIKE '%{$this->data['Picture']['search']}%'";	
		}
		
		
		$this->paginate['Picture'] = array(
								'conditions' => $conditions,
								'limit' => 9,
								'order' => 'created DESC',
								'contain' => array());
					
		$this->set('pictures', $this->paginate('Picture'));
		$this->set('uuidTag', $uuidTag);
		$this->set('type', $type);
		$this->set('hiddenFieldId', $hiddenFieldId);
		$this->set('container', $container);
	}
}
?>