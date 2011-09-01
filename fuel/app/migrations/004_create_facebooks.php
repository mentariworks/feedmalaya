<?php

namespace Fuel\Migrations;

class Create_facebooks {

	public function up()
	{
		\DBUtil::create_table('facebooks', array(
			'id' => array('constraint' => 30, 'type' => 'bigint'),
			'facebook_name' => array('constraint' => 200, 'type' => 'varchar'),
			'first_name' => array('constraint' => 100, 'type' => 'varchar'),
			'last_name' => array('constraint' => 100, 'type' => 'varchar'),
			'facebook_url' => array('constraint' => 255, 'type' => 'varchar'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('facebooks');
	}
}