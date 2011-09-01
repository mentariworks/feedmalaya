<?php

namespace Fuel\Migrations;

class Create_users_facebooks {

	public function up()
	{
		\DBUtil::create_table('users_facebooks', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'facebook_id' => array('constraint' => 11, 'type' => 'int'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users_facebooks');
	}
}