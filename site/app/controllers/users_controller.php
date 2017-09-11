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

class UsersController extends AppController {

	var $name = 'Users';
	var $components = array('Captcha', 'Email','Janrain');
	var $helpers = array('Paginator');
	//var $scaffold = 'admin';
	var $uses = array('Vwusersbrowse','User');

	public function beforeFilter() {
       parent::beforeFilter();

       $this->Auth->allow(	'add'
       						,'fbauth'
       						,'captcha_image'
       						,'generatePassword'
       						,'widget_signup'
       						,'widget_forgot_password'
       						,'forgot_password'
       						,'widget_signin'
       						,'verify_email'
       						,'admin_home'
       						,'manager_home'
       );
	}

	function captcha_image(){
		$this->layout = null;
		Configure::write('debug',0);
		$this->Captcha->image();
	}
	
	function generatePassword ($length = 8){

		# variable initialization
        $password = "";
        $i = 0;
        $possible = "0123456789bcdfghjkmnpqrstvwxyz";

        # get random characters
        while ($i < $length){

        	$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }

        # return password
        return $password;
    }

    public function logout()
    {
		$this->Auth->logoutRedirect = '/';
		$this->redirect($this->Auth->logout());
   	}

	function widget_signup()
	{
		if(!empty($this->data))
		{
			$i = -1;

			$this->User->create();

			# Check Fullname
			if(empty($this->data['User']['fullname']))
			{
				$i++;
				$Errors[$i] = 'Full Name cannot be blank.';
			}

			# Check Fullname
			if(empty($this->data['User']['email']))
			{
				$i++;
				$Errors[$i] = 'Email cannot be blank.';
			}

			#Check Password lenght
			if(empty($this->data['User']['pass']))
			{
				$i++;
				$Errors[$i] = 'Password cannot be blank.';
			}

			# Check Password and Confirm Password Matched.
			if($this->data['User']['pass'] != $this->Auth->password($this->data['User']['passconf']))
			{
				$i++;
				$Errors[$i] = 'Confirm Password does not matched.';
			}

			# Check Captch
			if(false == $this->Captcha->check($this->data['User']['usercaptchacode'], true))
			{
				$i++;
				$Errors[$i] = "Your eneterd code does not match with the image.";
			}

			# Check Email address is unique
			$users = $this->User->findbyEmail($this->data['User']['email']);
			if(!empty($users))
			{
				$i++;
				$Errors[$i] = 'The email address you entered is already exists';
			}

			if($i == -1)
			{
				# Category Contains id of the service by which we will get category name
				$this->data['User']['category'] = 'user';
				$this->data['User']['tokenhash'] = sha1($this->data['User']['email'].rand(0,100));
				$this->data['User']['group_id'] = 3; //users

				if($this->User->save($this->data,true,
											array(	'fullname',
													'email',
													'pass',
													'category',
													'tokenhash',
													'active',
													'group_id'
											)
									)
				)
				{
					$this->set('usercreated',true);

					# Send Email for Verification
					$this->Email->sendAs = 'both';
					$this->Email->from = $this->siteInfo['emailnoreply'];
					$this->Email->to = $this->data['User']['email'];
					$this->Email->subject = 'Account Activation';
					$this->Email->template = 'account_activation';
					$this->Email->delivery = Configure::read('Mail.method');
					$this->set('FullName', $this->data['User']['fullname']);
	        		$this->set('url', str_replace('##site##',$this->siteInfo['fqdn'],Configure::read('URLs.verificationURL')) . $this->data['User']['email'] . '/' . $this->data['User']['tokenhash']);
					$this->Email->send();
				}
				else
				{
					$i++;
					$Errors[$i] = 'Could no create account.';
				}
			}
			else
			{
				$this->data['User']['pass'] = '';
				$this->data['User']['passconf'] = '';
			}

			# Set Errors variable if there are errors
			if($i != -1)
			{
				$this->set('Errors', $Errors);
			}
		}
	}

	function widget_forgot_password()
	{
		$this->layout = 'ajax';
	}

	function forgot_password()
	{
		if(!empty($this->data['User']))
		{
			$email = $this->data['User']['email'];
			$nPassword = $this->generatePassword();
			$this->User->id = $this->User->field('id', array('User.email'=> $email));
			$this->data['User']['pass'] = $this->Auth->password($nPassword);

			if(false != $this->User->id && $this->User->save($this->data))
			{
				# Sending Email to User for Password Reset
				$this->Email->sendAs = 'both';
				$this->Email->from = $this->siteInfo['emailnoreply'];
				$this->Email->to = $email;
				$this->Email->subject = 'Password Reset Request';
				$this->Email->template = 'password_reset';
				$this->Email->delivery = Configure::read('Mail.method');
				$this->set('password', $nPassword);

				$password_reset_result = $this->Email->send();

				$this->set('result', $password_reset_result);
			}
			else
			{
				$password_reset_result = false;
				$this->set('result', $password_reset_result);
			}

			$this->render('/elements/widget-forgot-password');
		}
	}


	function widget_singupsuccess()
	{
		$this->layout = 'ajax';
	}

	function widget_signin()
	{
		if(!empty($this->data))
		{
			if($this->Auth->login($this->data) == 1)
			{
				$this->set('loginerror',false);
				if($_SESSION['Auth']['User']['usertype'] == 'user'){

					$this->set('loginpath',Router::url('/dashboard',true));

				}else if ($_SESSION['Auth']['User']['usertype'] == 'manager'){

					$this->set('loginpath',Router::url('/manage',true));
				}
			}
			else
			{
				$this->set('loginerror',true);
			}

			$this->data['User']['pass'] = '';
		}
	}

	function fbauth()
	{
		$fbCode = $_REQUEST['code'];

		$return_url = Router::url('/users/fbauth',true);
		$url = "https://graph.facebook.com/oauth/access_token?client_id={$this->siteInfo['fbappid']}&redirect_uri=$return_url&client_secret={$this->siteInfo['fbsecret']}&code=$fbCode";

		$response = file_get_contents($url);
		$params = null;
		parse_str( $response, $params);

		if(empty($params)){
			//error here
			echo 'We are sorry we could not log you in using facebook at this moment.';
		}else{
			$this->_setFBAuthToken($fbCode, $params['access_token'],$params['expires']); //should redirect
		}


	}

	function verify_email($email, $token)
	{
		$this->layout = 'signup';

		if($email != null || $token != null)
		{
			$userid = $this->User->field('id', array('email' => $email, 'tokenhash' => $token));

			# Activate User
			$this->data['User']['id'] = $userid;
			$this->data['User']['active'] = 1;

			$verified = $this->User->save($this->data, true);
			$this->set('verified', $verified);
		}

		$this->loadModel('Picture');
		$sliderImages = $this->Picture->widget_slider_pictures();
		$this->set('sliderImages',$sliderImages);
	}

	function widget_avatar()
	{
		$this->loadModel('Picture');
		$userid = $_SESSION['Auth']['User']['id'];
		$pic = $this->Picture->get_picture($userid,Configure::read('PictureTags.ProfileView'));
		$this->set('pic', $pic);
	}

	function account()
	{

	}

	function changepassword()
	{
		if(!empty($this->data['User']))
		{
			$errors = array();
			$widget_change_pass_result = false;
			$i = 0;
			$count = $this->User->find('count',
											array('conditions' =>
													array(
														'User.id' => $this->_getCurrentUserId()
														,'User.pass' => $this->Auth->password($this->data['User']['oldpass'])
														)
												)
										);


			if($count == 0)
			{
				$errors[$i] = 'Your old password is incorrect.';
				$i++;
			}

			if($i == 0)
			{
				if($this->data['User']['newpass'] == '' || $this->data['User']['confpass'] == '')
				{
					$errors[$i] = 'New or Confirm password cannot be blank.';
					$i++;
				}
			}

			if($i == 0)
			{
				if($this->data['User']['newpass'] != $this->data['User']['confpass'])
				{
					$errors[$i] = 'New password does not match confirm password.';
					$i++;
				}
			}

			if($i == 0)
			{
				$this->User->id = $this->_getCurrentUserId();

				$changedPassHash = $this->Auth->password($this->data['User']['newpass']);
				$widget_users_change_password_res = $this->User->saveField('pass', $changedPassHash);
				if(!$widget_users_change_password_res)
				{
					$errors[$i] = 'Could not chang password, please try again.';
				}else{
					$errors[$i] = 'Password changed.';
				}
			}

			$this->set('errors', $errors);
			$this->set('widget_users_change_password_res', $widget_change_pass_result);
		}
		$this->render('/elements/widget-users-change-password');
	}

	/*
	 * view has all the juice
	 */
	function dashboard()
	{

		$this->widget_dashboard();
		$this->render('widget_dashboard');

//		if($_SESSION['Auth']['User']['setupstatus'] == 0){
//			$this->welcome();
//			$this->render('welcome');
//		}else{
//			$this->widget_dashboard();
//			$this->render('widget_dashboard');
//		}
	}

	function widget_dashboard()
	{
		$this->loadModel('NewsSite');
		$news = $this->NewsSite->widget_dashboard_news($this->site_id);
		if(false == $news){ $news = array(); }; //to prevent invalid argument errors in loop
		$this->set('news',$news);

//		$this->loadModel('Shout');
//		$shouts = $this->Shout->widget_dashboard_shouts();
//		if(false == $shouts){ $shouts = array(); }; //to prevent invalid argument errors in loop
//		$this->set('shouts', $shouts);
//
	}

	function welcome()
	{
		//$this->layout = 'welcome';
		$this->setAdverts();
	}

	//TODO: move to app_controller
	function setAdverts()
	{
		$this->loadModel('Advertisement');
		$right_top_ads = $this->Advertisement->getAdverts();
		$right_mid_ads = $this->Advertisement->getAdverts('right-mid');
		$right_bottom_ads = $this->Advertisement->getAdverts('right-bottom');
		$bottom_ads = $this->Advertisement->getAdverts('bottom');

		$this->set(compact('right_top_ads','right_mid_ads','right_bottom_ads','bottom_ads'));
	}

	function profile_setup()
	{
		$this->User->id = $_SESSION['Auth']['User']['id'];
		$this->User->saveField('setupstatus', 1);

		$this->User->recursive = -1;
		$user = $this->User->find('first', array(
				'conditions' => array(
					'id' => $_SESSION['Auth']['User']['id']
				)
			)
		);

		$_SESSION['Auth']['User'] = $user['User'];
		$this->redirect(array('controller' => 'users', 'action' => 'dashboard'));
	}

	function widget_profile($userid = null)
	{

		if( null == $userid){
			$userid = $_SESSION['Auth']['User']['id'];
		}

		$this->User->Behaviors->attach('Containable');
		$user = $this->User->find('first', array(
									'conditions' => array(
													'User.id' => $userid,
													'User.usertype' => array('user'))
												)
											);

		$this->set('user',$user);
		$this->loadModel('AbuseReport');

		//get videos for this profile
		$this->loadModel('Picture');
//		$pictures = $this->Picture->widget_pictures($userid, Configure::read('PictureTags.ProfileViewPictureWidget'));
//		//check current user has reported any picture as abused of this profile

//			$pictures = $this->AbuseReport->hasReportedPictures($pictures, $_SESSION['Auth']['User']['id'], $user['User']['id']);
//		$this->set('pictures', $pictures);

		//get profile pic for this profile
		$profile_view_picture = $this->Picture->get_picture($userid, Configure::read('PictureTags.ProfileView'));
		$this->set('profile_view_picture', $profile_view_picture);

		//get favorite statistics for this profile
		$this->loadModel('Favorite');
		$favStats = $this->Favorite->getSelfFavoriteStats($userid);
		$this->set('favStats',$favStats);

		//get info on whether the viewer has previously marked this profile as favorite
		$isFavorited = $this->Favorite->isFavorited($_SESSION['Auth']['User']['id'], $userid);
		$this->set('isFavorited',$isFavorited);

		//get professional and community review information for this profile
//		$this->loadModel('Review');
//		$professional_review_stats = $this->Review->getReviewStats($userid,1);
//		$community_review_stats = $this->Review->getReviewStats($userid,0);
//		$this->set(compact('professional_review_stats','community_review_stats'));

		//get info on whether this user has previously reviewed this profile
//		$haveReviewed = $this->Review->haveReviewed($_SESSION['Auth']['User']['id'], $userid);
//		$this->set('haveReviewed',$haveReviewed);

		// get info on whether this profile is reported abuse
		$isAbuseReported = $this->AbuseReport->hasReportedProfile($_SESSION['Auth']['User']['id'], $userid);
		$this->set('isAbuseReported',$isAbuseReported);

		//get info on the friend status of the viewer and the viewed

		$friendStatus = $this->User->Friend->getFriendStatus($_SESSION['Auth']['User']['id'], $userid);
		$this->set('friendStatus', $friendStatus);

	}

	function widget_profileedit($userid = null)
	{
		$this->layout = 'ajax';

		$userid = $this->_validateUserID($userid);

		//set profile info
		$this->data = $this->User->find('first', array(
				'conditions' => array(
					'User.id' => $userid
				)
			)
		);

		$this->set('user',$this->data);

	}

	function widget_profile_biodata_edit_about($userid = null){

		$userid = $this->_validateUserID($userid);

		$this->data['User']['id'] = $userid;
		$this->data['User']['dirty'] = 1;

		$widget_profile_biodata_edit_about_result = $this->User->save($this->data, true, array(
				'fullname',
				'nationality',
				'dob',
				'dirty',
				'modified'
			)
		);

		$this->set('widget_profile_biodata_edit_about_result',$widget_profile_biodata_edit_about_result);

		$this->render('/elements/widget-profile-biodata-edit-about');
	}

	function widget_profile_biodata_edit_contact($userid = null){

		$userid = $this->_validateUserID($userid);

		$this->data['User']['id'] = $userid;
		$this->data['User']['dirty'] = 1;

		$widget_profile_biodata_edit_contact_result = $this->User->save($this->data, true, array(
				'address',
				'addressvisible',
				'phone',
				'phonevisible',
				'webaddress',
				'webvisible',
				'blogaddress',
				'blogvisible',
				'facebookurl',
				'facebookvisible',
				'myspaceurl',
				'myspacevisible',
				'twitterurl',
				'twittervisible',
				'orkuturl',
				'orkutvisible',
				'profilemail',
				'profilemailvisible',
				'dirty',
				'modified',
				)
		);

		$this->set('widget_profile_biodata_edit_contact_result',$widget_profile_biodata_edit_contact_result);

		$this->render('/elements/widget-profile-biodata-edit-contact');
	}

   /*
	* Search Community
	*/
	function widget_search_community()
	{
		$this->layout = 'ajax';

		unset($_SESSION['user']['search']['filters']);

		$this->set('users', array()); // for preventing errors
	}

	function widget_search()
	{
		$this->layout = 'ajax';
		Configure::write('debug', 2);
		$users = array();
		$Filters = array();
		if(isset($_REQUEST['data']))
		{
			# Coming From Search Form
			$temp = unserialize($_REQUEST['data']);
			# creating name value pair of filters
			foreach($temp as $rawfilter)
			{
				$spliteFilters = explode(':', $rawfilter);
				switch(count($spliteFilters))
				{
					case 0:
						break;

					case 2:
						$Filters[$spliteFilters[0]] = $spliteFilters[1];
						break;

					case 3:
						$multipleFilters = explode(';', $spliteFilters[1]);
						$Filters[$spliteFilters[0]] = $multipleFilters[0];
						$Filters[$multipleFilters[1]] = $spliteFilters[2];
						break;
				}
			}

			# Save Filters to Session
			$_SESSION['user']['search']['filters'] = $Filters;
		}
		else
		{
			# Coming From Pagination, get Filters from Session
			$Filters = $_SESSION['user']['search']['filters'];
		}

		# necessary filters
		$conditions = array('User.setupstatus' => 1,
							'User.active' => 1);

		$contain = array();

		# map filters to appropriate fields in conditions array
		foreach($Filters as $index => $value)
		{
			switch($index)
			{
				case 'username':
					if(!empty($value)){
						$conditions['User.fullname LIKE'] = "%$value%";
					}
					break;

				case 'age':
					if(!empty($value)){
						$conditions['User.age'] = $value;
					}
					break;

				case 'agefrom':
					if(!empty($value)){
						$conditions['User.age >='] = $value;
					}
					break;

				case 'ageto':
					if(!empty($value)){
						$conditions['User.age <='] = $value;
					}
					break;

				case 'gender':
					if(!empty($value)){
						$conditions['User.gender'] = $value;
					}
					break;
			}
		}

		$this->User->Behaviors->attach('Containable', array('autoFields' => false));
		$this->paginate['User']['limit'] = 10;
		$this->paginate['User']['contain'] = array('Picture' => array(	'fields' => array('uuidtag'),
																		'conditions' => array(
																			'tag' => Configure::read('PictureTags.ProfileView'),
																			'picindex' => 0,
																			'deleted' => 0,
																			'approved' => 1)
																		)
																);

		$this->paginate['User']['fields'] = array('id', 'fullname', 'gender', 'age');
		$this->paginate['User']['conditions'] = $conditions;

		$this->set('users', $this->paginate('User'));
		$this->render('/elements/widget-search-community-search-results');
	}

//	this was copied with community module, we have our own manager_dashboard function
//	function manager_dashboard(){
//		$this->layout = 'manager';
//
//		$this->loadModel('AbuseReport');
//		$abuseProfilesDashboard = $this->AbuseReport->managerGetRecentProfiles4Dashboard();
//		$this->set('abuseProfilesDashboard',$abuseProfilesDashboard);
//	}


   /*
	* Admin Area
	*/

	function admin_home()
	{
		$this->layout = 'bo_login';

		if(!empty($this->data)){

			if($this->Auth->login($this->data) == 1){

				if($_SESSION['Auth']['User']['usertype'] == 'admin'){

					// log user login ip and time
					$_SESSION['Auth']['User']['current_ip'] = $this->RequestHandler->getClientip();
					$this->User->SetUserIpAndTime(
									$_SESSION['Auth']['User']['id'],
									$_SESSION['Auth']['User']['current_ip'],
									date('Y-m-d h:i:s'));

					$this->redirect('/admin/dashboard', true);

				}else{

					$this->Session->setFlash(__('Invalid credentials. Please try again.', true));
				}

			}else{
				$this->Session->setFlash(__('Invalid credentials. Please try again.', true));
			}

			$this->data['User']['pass'] = '';
		}
	}

	public function admin_logout() {

		unset($_SESSION['Auth']);
		$this->redirect("/admin", true);
   	}

	function admin_widget_signin(){
		$this->redirect("/admin", true);
	}

   	function admin_dashboard()
   	{
   		$this->layout = 'backoffice';
   		$this->set("title_for_layout", "Welcome to Back Office");

   		$this->loadModel('Sysconfiguration');
   		$this->set('registration_status', $this->Sysconfiguration->getDataVal('DVS4-REGISTRATION-ID'));
   	}

   	function admin_widget_welcome()
   	{
   		$this->layout = 'ajax';
   	}

	function admin_change_password()
	{
		$this->layout = 'ajax';
		$this->data['User']['id'] = $_SESSION['Auth']['User']['id'];
	}

	function admin_widget_change_password()
	{
		if(!empty($this->data['User']))
		{
			$errors = array();
			$widget_change_pass_result = false;
			$count = $this->User->find('count',
											array('conditions' =>
													array(
														'User.id' => $this->data['User']['id']
														,'User.pass' => $this->Auth->password($this->data['User']['oldpass'])
														)
												)
										);


			if($count == 0)
			{
				$errors[] = 'Your old password is incorrect.';
			}

			if($this->data['User']['newpass'] == '' || $this->data['User']['confpass'] == '')
			{
				$errors[] = 'New or Confirm password cannot be blank.';
			}

			if($this->data['User']['newpass'] != $this->data['User']['confpass'])
			{
				$errors[] = 'New password does not match with confirm password.';
			}

			if(empty($errors))
			{
				$this->User->id = $this->data['User']['id'];

				$changedPassHash = $this->Auth->password($this->data['User']['newpass']);
				$widget_change_pass_result = $this->User->saveField('pass', $changedPassHash);
				if(!$widget_change_pass_result)
				{
					$errors[] = 'Could not changed password, please try again.';
				}
			}

			$this->set('errors', $errors);
			$this->set('widget_change_pass_result', $widget_change_pass_result);
			$this->render('/elements/widget-backoffice-change-password');
		}
	}

   /*
    *  Manager Area
    */
	function manager_home()
	{
		$this->layout = null;

		$this->Session->setFlash(__('Welcome to DVS Control Panel, Please login using your Email and Password.', true));

		if(!empty($this->data)){

			if($this->Auth->login($this->data) == 1){

				if($_SESSION['Auth']['User']['usertype'] == 'manager'){

					// log user login ip and time
					$_SESSION['Auth']['User']['current_ip'] = $this->RequestHandler->getClientip();
					$this->User->SetUserIpAndTime(
									$_SESSION['Auth']['User']['id'],
									$_SESSION['Auth']['User']['current_ip'],
									date('Y-m-d h:i:s'));

					$this->redirect('/manager/users/dashboard', true);

				}else{

					$this->Session->setFlash(__('You need Manager account to login.', true));
				}

			}else{
				$this->Session->setFlash(__('Invalid credentials. Please try again.', true));
			}

			$this->data['User']['pass'] = '';
		}
	}

	public function manager_logout() {

		unset($_SESSION['Auth']);
		$this->redirect("/manager", true);
	}

   	function manager_dashboard()
   	{
   		$this->layout = 'backoffice';
   	}

   	function manager_widget_welcome()
   	{
   		$this->layout = 'ajax';
   	}

   	function manager_widget_signin(){
		$this->redirect("/manager", true);
	}


   	/*
   	 * All Users
   	 */
   	function admin_widget_users(){

   		$this->layout = 'ajax';

		unset($_SESSION['User']['search']);

   		$conditions['usertype'] = 'user';

		$pagination_params = array(
			'Vwusersbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'id',
					'fullname',
					'email',
					'age',
					'gender',
					'nationality',
					'active',
					'convCount',
					'fconvCount',
					'pictureCount',
					'fpictureCount',
					'profilePicture'
				),
				'limit' => 9
			)
		);

		$this->paginate = $pagination_params;
		$this->set('users',$this->paginate('Vwusersbrowse'));

		$this->_setBackURL('users', "/admin/users/all_users/");
   	}

   	function admin_all_users(){

   		$this->layout = 'ajax';

		unset($_SESSION['User']['search']);

   		$conditions['usertype'] = 'user';

		$pagination_params = array(
			'Vwusersbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'id',
					'fullname',
					'email',
					'age',
					'gender',
					'nationality',
					'active',
					'convCount',
					'fconvCount',
					'pictureCount',
					'fpictureCount',
					'profilePicture'
				),
				'limit' => 9
			)
		);

		$this->paginate = $pagination_params;
		$this->set('users',$this->paginate('Vwusersbrowse'));
		$this->_setBackURL("users");

		$this->render('/elements/widget-backoffice-manage-users');
   	}

   	function admin_new_users(){

   		$this->layout = 'ajax';

		unset($_SESSION['User']['search']);

   		$conditions['usertype'] = 'user';

		$pagination_params = array(
			'Vwusersbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'id',
					'fullname',
					'email',
					'age',
					'gender',
					'nationality',
					'active',
					'convCount',
					'fconvCount',
					'pictureCount',
					'fpictureCount',
					'profilePicture'
				),
				'limit' => 9
			)
		);

		$this->paginate = $pagination_params;
		$this->set('users',$this->paginate('Vwusersbrowse'));
		$this->_setBackURL("users");

		$this->render('/elements/widget-backoffice-manage-users');
   	}

   	function admin_online_users(){

   		$this->layout = 'ajax';

		unset($_SESSION['User']['search']);

   		$conditions['usertype'] = 'user';


		$pagination_params = array(
			'Vwusersbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'id',
					'fullname',
					'email',
					'age',
					'gender',
					'nationality',
					'active',
					'convCount',
					'fconvCount',
					'pictureCount',
					'fpictureCount',
					'profilePicture'
				),
				'limit' => 9
			)
		);

		$this->paginate = $pagination_params;
		$this->set('users',$this->paginate('Vwusersbrowse'));
		$this->_setBackURL("users");

		$this->render('/elements/widget-backoffice-manage-users');
   	}

	function admin_search_users(){

   		$this->layout = 'ajax';

   		if(!empty($this->data)){

   			$conditions[] = "fullname LIKE '%{$this->data['User']['search']}%'";
   			$_SESSION['User']['search'] = $this->data['User']['search'];

   		}else{

   			$conditions[] = "fullname LIKE '%{$_SESSION['User']['search']}%'";
   		}

   		$conditions['usertype'] = 'user';

		$pagination_params = array(
			'Vwusersbrowse' => array(
				'conditions' => $conditions
				,'fields' => array(
					'id',
					'fullname',
					'email',
					'age',
					'gender',
					'nationality',
					'active',
					'convCount',
					'fconvCount',
					'pictureCount',
					'fpictureCount',
					'profilePicture'
				),
				'limit' => 9
			)
		);

		$this->paginate = $pagination_params;
		$this->set('users',$this->paginate('Vwusersbrowse'));
		$this->_setBackURL("users");

		$this->render('/elements/widget-backoffice-manage-users');
	}

	function admin_view_user_profile($userId = null){

		$this->layout = 'ajax';

		if($userId == null){
			$this->redirect('/admin/users/dashboard');
		}

		$this->User->recursive = -1;
		$user = $this->User->find('first', array(
									'conditions' => array(
													'User.id' => $userId,
													'User.usertype' => array('user'))
												)
											);

		$this->set('user', $user);

		//get profile picture
		$this->loadModel('Picture');
		$profile_picture = $this->Picture->get_picture($userId, Configure::read('PictureTags.ProfileView'));

		$this->set('profile_picture', $profile_picture);

		$this->render('/elements/widget-backoffice-user-profile');
	}

	function admin_profile_data_edit($id = null){

		if(null == $id){
			return false;
		}

		if(!empty($this->data)){

			$validationErrors = array();
			$profile_data_edit_result = false;

			if(strlen($this->data['User']['fullname']) < 1){
				$validationErrors[] = 'Name is required.';
			}

			if(strlen($this->data['User']['email']) < 1){
				$validationErrors[] = 'Email is required';
			}

			if(empty($validationErrors)){

				if($this->User->save($this->data)){

					$profile_data_edit_result = true;
				}else{

					$validationErrors[] = 'Could not complete operation, please try later.';
					$profile_data_edit_result = false;
				}
			}

			$this->set('profile_data_edit_result', $profile_data_edit_result);
			$this->set('validationErrors', $validationErrors);
		}
		else
		{
			$this->data = $this->User->getUserById($id);
		}

		$this->set('id', $id);
	}

	function admin_toggleUserStatus($UserId = null){

		if(null == $UserId){return null;}
		$this->User->toggleStatus($UserId);
	}

	function admin_remove_user($UserId = null){

		if(null == $UserId){
			return null;
		}

		$this->User->RemoveUser($UserId);
	}

	function janrainauth(){
		$result = $this->Janrain->engage();
		if(false == $result){
			$this->redirect('/users/widget_signin',200,true);
		}

		$user = $this->User->find('first', array(
			'conditions' => array(
				'email' => $result['profile']['verifiedEmail']
			),
			'fields' => array(
				'id','fbpass','email','pass'
			)
		));


		if(false == $user){


			$user['User']['fbpass'] = $this->_randomString();
			$user['User']['pass'] = $this->Auth->password($user['User']['fbpass']);
			$user['User']['group_id'] = 3;//for users
			$user['User']['fullname'] = $result['profile']['displayName'];
			$user['User']['email'] = $result['profile']['verifiedEmail'];
			$user['User']['usertype'] = 'user';
			$user['User']['gender'] = '';
			$user['User']['active'] = 1;
			$user['User']['setupstatus'] = 1;

			$this->User->create();
			$this->User->save($user,false);

		}

		$this->data = $user;


		if(! ($this->Auth->login($this->data) == 1) ) {
			$this->redirect('/users/widget_signin');
		}
	}
}
?>