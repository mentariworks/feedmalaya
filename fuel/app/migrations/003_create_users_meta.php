<?php

namespace Fuel\Migrations;

class Create_users_meta {

	public function up()
	{
		\DBUtil::create_table('users_meta', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'first_name' => array('constraint' => 100, 'type' => 'varchar'),
			'last_name' => array('constraint' => 100, 'type' => 'varchar'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users_meta');
	}
}