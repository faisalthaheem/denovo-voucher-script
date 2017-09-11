<?php
/* IcodesukCategories Test cases generated on: 2011-02-15 23:21:31 : 1297804891*/
App::import('Controller', 'Dvs3icodesuk.IcodesukCategories');

class TestIcodesukCategoriesController extends IcodesukCategoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IcodesukCategoriesControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->IcodesukCategories =& new TestIcodesukCategoriesController();
		$this->IcodesukCategories->constructClasses();
	}

	function endTest() {
		unset($this->IcodesukCategories);
		ClassRegistry::flush();
	}

}
?>