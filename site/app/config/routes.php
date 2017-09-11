<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'welcome'));
	
	Router::connect('/nolayout/cods/increment_view_count/*', array('controller' => 'cods', 'action' => 'increment_view_count'));
	Router::connect('/nolayout/categories/increment_view_count/*', array('controller' => 'categories', 'action' => 'increment_view_count'));
	Router::connect('/nolayout/merchants/increment_view_count/*', array('controller' => 'merchants', 'action' => 'increment_view_count'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/captcha_image', array('controller' => 'pages', 'action' => 'captcha_image'));	
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/dashboard', array('controller' =>'users', 'action' => 'dashboard'));
	Router::connect('/admin/dashboard', array('controller' =>'users', 'action' => 'dashboard', 'admin' => true));

	# Header Menu Tabs Routs
	Router::connect('/home', array('controller' => 'pages', 'action' => 'welcome'));
	Router::connect('/categories', array('controller' => 'categories', 'action' => 'index'));
	Router::connect('/new', array('controller' => 'cods', 'action' => 'new_stuff'));
	Router::connect('/expiring', array('controller' => 'cods', 'action' => 'expiring_stuff'));
	Router::connect('/printable', array('controller' => 'cods', 'action' => 'printable'));
	Router::connect('/everything', array('controller' => 'cods', 'action' => 'everything'));
	
	
	# Footer Static Pages menu
	Router::connect('/about', array('controller' => 'pages', 'action' => 'display', 'about'));
	Router::connect('/advertise-with-us', array('controller' => 'pages', 'action' => 'display', 'advertise-with-us'));
	Router::connect('/contact-us', array('controller' => 'pages', 'action' => 'display', 'contact-us'));
	Router::connect('/privacy-policy', array('controller' => 'pages', 'action' => 'display', 'privacy-policy'));
	Router::connect('/terms-and-conditions', array('controller' => 'pages', 'action' => 'display', 'terms-and-conditions'));
		
	/*
	 * Admin
	 */
	Router::connect('/admin', array('controller' => 'users', 'action' => 'home', 'admin' => true));
	
	/*
	 * Manager
	 */
	Router::connect('/manager', array('controller' => 'users', 'action' => 'home', 'manager' => true));

	/*
	 * Default path after site's root
	 * 
	 */
	Router::connect(
		'/:safeMerchantName', 
		array('controller' => 'merchants', 'action' => 'detail'),
		array(
			'pass' => array('safeMerchantName')
		)
	);