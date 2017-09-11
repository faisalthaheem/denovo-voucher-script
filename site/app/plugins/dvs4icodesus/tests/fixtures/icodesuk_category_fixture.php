<?php
/* IcodesukCategory Fixture generated on: 2011-02-15 23:18:52 : 1297804732 */
class IcodesukCategoryFixture extends CakeTestFixture {
	var $name = 'IcodesukCategory';

	var $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'icodes_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'key' => 'index', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'icodes_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'icodes_unique' => array('column' => array('icodes_name', 'icodes_id'), 'unique' => 1)),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

	var $records = array(
		array(
			'id' => 1,
			'icodes_name' => 'Lorem ipsum dolor sit amet',
			'icodes_id' => 1,
			'category_id' => 1,
			'created' => '2011-02-15 23:18:52',
			'modified' => '2011-02-15 23:18:52'
		),
	);
}
?>