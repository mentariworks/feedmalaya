<?php

namespace Fuel\Migrations;

class Create_users {

	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_name' => array('constraint' => 100, 'type' => 'varchar'),
			'full_name' => array('constraint' => 200, 'type' => 'varchar'),
			'email' => array('constraint' => 150, 'type' => 'varchar'),
			'status' => array('constraint' => "'unverified','verified','banned'", 'type' => 'enum', 'default' => 'verified'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users');
	}
}