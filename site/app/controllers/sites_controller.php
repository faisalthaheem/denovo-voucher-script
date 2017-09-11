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

class SitesController extends AppController {

	var $name = 'Sites';
	
	function admin_register()
	{
		$registration_status = 'true'; //let go in case of any errors
		
		if(!empty($this->data))
		{
			$registration_key = $this->Uuid->generate();
			$fullname = $this->data['Registration']['fullname'];
			$email = $this->data['Registration']['email'];
			$serverip = $_SERVER['HTTP_HOST'];
			
			//POST - disabled since no host at backend :(
			//$this->admin_postRegistrationData($registration_key, $fullname, $email, $serverip);
			
			$this->loadModel('Sysconfiguration');
			$this->Sysconfiguration->saveDVS4RegistrationKey($registration_key);
			$registration_status = 'true';
		}
		
		$this->set('registration_status', $registration_status);
	}
	

	function admin_postRegistrationData($registrationkey, $fullname, $email, $serverip)
	{
		
		$url = 'http://registrations.voucherscript.com/registrations/register';
		$fields = array(
								"data[Registration][registrationkey]"=>urlencode($registrationkey),
								"data[Registration][fullname]"=>urlencode($fullname),
								"data[Registration][email]"=>urlencode($email),
								"data[Registration][serverip]"=>urlencode($serverip),
						);
		
		$fields_string = '';
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string,'&');

		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //comment to see what the remote site replies with
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);		
	}
	
	function admin_manage_sites()
	{
		$this->layout = 'ajax';
		$sites = $this->Site->getSiteList();
		$this->_setBackURL('sites');
		$this->set('sites', $sites);
	}
	
	function manager_manage_sites()
	{
		$this->layout = 'ajax';
		$sites = $this->Site->getSiteList();
		$this->_setBackURL('sites');
		$this->set('sites', $sites);
	}
	
	function admin_manage_content(){
		
		$this->layout = 'ajax';
		$sites = $this->Site->getSiteList();
		$this->set('sites', $sites);
	}
	
	function admin_toggleSiteStatus($site_id){
		
		if(null == $site_id) return;
		$this->Site->toggleStatus($site_id);
	}
	
	function manager_toggleSiteStatus($site_id){
		
		if(null == $site_id) return;
		$this->Site->toggleStatus($site_id);
	}
	
	function admin_add(){
		
		$this->layout = 'ajax';

		if(!empty($this->data)){
			
			$this->admin_substituteLogoFileNameForUUID();
			$result_widget_site_add = $this->Site->createSite($this->data);
			
			// create default banners for site
			$this->Site->createDefaults($this->data['Site']['fqdn']);
			$this->set('result_widget_site_add', $result_widget_site_add); 
		}
	}
	
	function manager_add(){
		
		$this->layout = 'ajax';
		
		if(!empty($this->data)){
			$result_widget_site_add = $this->Site->createSite($this->data);
			$this->set('result_widget_site_add', $result_widget_site_add); 
		}
	}
	
	function admin_edit($site_id = null){
		
		$this->layout = 'ajax';

		if(!empty($this->data)){
			
			$this->admin_substituteLogoFileNameForUUID();
			$result_widget_site_edit = $this->Site->UpdateSite($this->data);
			$this->set('result_widget_site_edit', $result_widget_site_edit); 
		}
		else
		{
			$this->data = $this->Site->getSite($site_id);	
		}
		
		if(null == $site_id){
			$site_id = $this->data['Site']['id'];
		}
		
		$this->loadModel('Picture');
		$logo = $this->Picture->find('first', array('conditions' => array(
														'Picture.uuidtag' => $this->data['Site']['logopath']),
														'contain' => array()
													));
		$this->set('logo', $logo);
	}
	
	function admin_substituteLogoFileNameForUUID()
	{
		if(!empty($this->data['Site']['logopath']))
		{
			$this->loadModel('Picture');
			$site_logo = $this->Picture->getPictureFilenameFromUuidtag($this->data['Site']['logopath']);
			$this->data['Site']['logopath'] = $site_logo;
		}		
	}
	
	function admin_news()
	{
		$this->layout = 'ajax';
		
		header('Content-type: application/xml');
		$handle = fopen("http://blog.voucherscript.com/feed/", "r");
		
		if ($handle) {
		    while (!feof($handle)) {
		        $buffer = fgets($handle, 4096);
		        echo $buffer;
		    }
		    fclose($handle);
		}

	}
}
?>