<?php

namespace Fuel\Migrations;

class Create_users_twitters {

	public function up()
	{
		\DBUtil::create_table('users_twitters', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'user_id' => array('constraint' => 11, 'type' => 'int'),
			'twitter_id' => array('constraint' => 11, 'type' => 'int'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users_twitters');
	}
}