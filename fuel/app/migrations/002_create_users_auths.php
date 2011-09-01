<?php

namespace Fuel\Migrations;

class Create_users_auths {

	public function up()
	{
		\DBUtil::create_table('users_auths', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'password' => array('constraint' => 50, 'type' => 'varchar'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users_auths');
	}
}