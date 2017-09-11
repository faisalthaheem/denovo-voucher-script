<?php
/*
 * The DVS License (http://www.voucherscript.com/license.html)
 * Denovo Voucher Script (DVS): The Instant Voucher Site (http://www.voucherscript.com)
 * Copyright 2009-2011, Computed Synergy (http://www.computedsynergy.com)
 *
 * Permission is hereby granted to:
 *
 * 1] Use this software free of charge for both personal and commercial purposes.
 * 2] Modify the script to customize it as needed.
 *
 *
 * Provided you agree to the following terms:
 *
 * 1] You may NOT redistribute, repost, resell any part of this script, or works deriving
 *    from this script, or works that enahance or add more features to this script. Redistribution
 *    is defined as re-offering our script for download/distribution in any manner, anywhere.
 * 2] You will not remove or modify any copyright notice and/or credits without written permission
 *    except where allowed (such as the "Powered by DVS" at the bottom of all pages, except the backoffice pages).
 * 3] You will not use this software for illegal purposes.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
 * DEALINGS IN THE SOFTWARE.
 * 
 */
class Dvs4icodesukAppController extends AppController {
	var $__PLUGIN_ID = '87d9dba5-2168-4bf7-bb13-fc12ff3dc030';
	var $__PLUGIN_NAME = 'dvs4icodesuk';
	
	var $components = array('Session');
	var $uses = array('Pluginsconfiguration','Syslog');
	
	function beforeFilter(){
		parent::beforeFilter();
	}	
    
	function __getUserName()
	{
		$username = 'not-configured';
		
		$result = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'username'
		);

		if(false != $result)
		{
			$username = $result;
		}

		return $username;
	}
	
	function __getSubscriptionId()
	{
		$subsid = 'not-configured';
		
		$result = $this->Pluginsconfiguration->getDataVal(
			$this->__PLUGIN_ID,
			$this->__PLUGIN_NAME,
			'subscriptionid'
		);		
		
		if(false != $result)
		{
			$subsid = $result;
		}
		
		return $subsid;		
	}
	
	function __getSites()
	{
		$sites = "not-configured";
		
		$result = $this->Pluginsconfiguration->getDataVal(
							$this->__PLUGIN_ID,
							$this->__PLUGIN_NAME,
							'default-sites');
							
		
		if(false != $result)
		{
			$sites = $result;
		}

		return $sites;
	}
	
	function __log($message)
	{
		$msg['Syslog']['srcid'] = $this->__PLUGIN_ID;
		$msg['Syslog']['srcname'] = $this->__PLUGIN_NAME;
		$msg['Syslog']['logmsg'] = $message;
		
		$this->Syslog->create();
		$this->Syslog->save($msg,false);
	}
}

?>