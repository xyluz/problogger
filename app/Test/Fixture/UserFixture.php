<?php
/**
 * User Fixture
 */
class UserFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'username' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'email' => array('type' => 'string', 'null' => false, 'default' => null, 'key' => 'unique', 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'password' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 40, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'group_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'email' => array('column' => 'email', 'unique' => 1)
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
			'first_name' => 'Admin',
			'last_name' => 'Seyi',
			'username' => 'seyiadmin',
			'email' => 'seyi@problogger.com',
			'password' => 'password',
			'group_id' => 1,
			'created' => '2020-02-19 21:50:39',
			'modified' => '2020-02-19 21:50:39'
		),
		array(
			'id' => 2,
			'first_name' => 'Author',
			'last_name' => 'Mike',
			'username' => 'mikeauthor',
			'email' => 'mike@gmail.com',
			'password' => 'password',
			'group_id' => 2,
			'created' => '2020-02-19 21:50:39',
			'modified' => '2020-02-19 21:50:39'
		),
		array(
			'id' => 3,
			'first_name' => 'Reader',
			'last_name' => 'Ola',
			'username' => 'olareader',
			'email' => 'ola@ymail.com',
			'password' => 'password',
			'group_id' => 3,
			'created' => '2020-02-19 21:50:39',
			'modified' => '2020-02-19 21:50:39'
		),
	);

}
