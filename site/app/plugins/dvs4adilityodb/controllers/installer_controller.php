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

class InstallerController extends Dvs4adilityodbAppController {

	var $name = 'Installer';
	var $uses = array();
    var $helpers = array('Html');

    function beforeFilter(){
    	parent::beforeFilter();
		$this->Auth->allow('admin_install');
    }
        
    function index(){}

    function admin_install() {        

    	$this->layout = 'ajax';
    	
    	echo "__ Installation Started...<br/>";
    	
    	$this->loadModel('ConnectionManager');
    	
    	$db = ConnectionManager::getDataSource('default');

        if(!$db->isConnected()) {
            
            echo 'Could not connect to database. Please check the settings in app/config/database.php and try again';
        }else{
        	$this->__createTables($db);
        }
    }

    private function __createTables($db) {
        
    	echo "__createTables:: Commencing installation<br>";

        $this->__executeSQLScript($db, APP . 'plugins' . DS . $this->__PLUGIN_NAME . DS . 'config' . DS . 'schema' . DS . 'install.sql');
		
        echo "__createTables:: Installation complete.<br>";
        
    }
    
    private function __executeSQLScript($db, $fileName) {
        
    	echo "__executeSQLScript()<br>";

        $exec_cmd = sprintf("mysql -h%s -D%s -u%s -p%s < %s",
            ConnectionManager::getInstance()->config->default['host'],
            ConnectionManager::getInstance()->config->default['database'],
            ConnectionManager::getInstance()->config->default['login'],
            ConnectionManager::getInstance()->config->default['password'],
            $fileName
        );

        exec($exec_cmd);     	
    }
    
    function manager_install() {        

    	$this->layout = 'ajax';
    	
    	echo "__ Installation Started...<br/>";
    	
    	$this->loadModel('ConnectionManager');
    	
    	$db = ConnectionManager::getDataSource('default');

        if(!$db->isConnected()) {
            
            echo 'Could not connect to database. Please check the settings in app/config/database.php and try again';
        }else{
        	$this->__createTables($db);
        }
    }
    
    	
}
?>