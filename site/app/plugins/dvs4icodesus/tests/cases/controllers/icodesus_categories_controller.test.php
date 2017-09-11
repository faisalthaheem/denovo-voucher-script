<?php
/* IcodesusCategories Test cases generated on: 2011-02-15 23:21:31 : 1297804891*/
App::import('Controller', 'Dvs3icodesus.IcodesusCategories');

class TestIcodesusCategoriesController extends IcodesusCategoriesController {
	var $autoRender = false;

	function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

class IcodesusCategoriesControllerTestCase extends CakeTestCase {
	function startTest() {
		$this->IcodesusCategories =& new TestIcodesusCategoriesController();
		$this->IcodesusCategories->constructClasses();
	}

	function endTest() {
		unset($this->IcodesusCategories);
		ClassRegistry::flush();
	}

}
?>