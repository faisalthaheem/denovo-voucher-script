<?php
/* IcodesukCategory Test cases generated on: 2011-02-15 23:18:52 : 1297804732*/
App::import('Model', 'Dvs3icodesuk.IcodesukCategory');

class IcodesukCategoryTestCase extends CakeTestCase {
	function startTest() {
		$this->IcodesukCategory =& ClassRegistry::init('IcodesukCategory');
	}

	function endTest() {
		unset($this->IcodesukCategory);
		ClassRegistry::flush();
	}

}
?>