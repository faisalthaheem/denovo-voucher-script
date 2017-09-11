<?php
/* IcodesukCategory Test cases generated on: 2011-02-15 23:18:52 : 1297804732*/
App::import('Model', 'Dvs3icodesus.IcodesusCategory');

class IcodesusCategoryTestCase extends CakeTestCase {
	function startTest() {
		$this->IcodesusCategory =& ClassRegistry::init('IcodesusCategory');
	}

	function endTest() {
		unset($this->IcodesusCategory);
		ClassRegistry::flush();
	}

}
?>