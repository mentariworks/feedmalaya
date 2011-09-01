<?php

namespace Fuel\Migrations;

class Create_users_twitters {

	public function up()
	{
		\DBUtil::create_table('users_twitters', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
			'user_id' => array('constraint' => 30, 'type' => 'bigint'),
			'twitter_id' => array('constraint' => 30, 'type' => 'bigint'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users_twitters');
	}
}