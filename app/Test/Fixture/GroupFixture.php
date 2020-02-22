<?php
/**
 * Group Fixture
 */
class GroupFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Admin',
			'created' => '2020-02-19 21:50:17',
			'modified' => '2020-02-19 21:50:17'
		),
		array(
			'id' => 2,
			'name' => 'Author',
			'created' => '2020-02-19 21:50:17',
			'modified' => '2020-02-19 21:50:17'
		),
		array(
			'id' => 3,
			'name' => 'Reader',
			'created' => '2020-02-19 21:50:17',
			'modified' => '2020-02-19 21:50:17'
		)
	);

}
