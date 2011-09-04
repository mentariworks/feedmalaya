<?php

/**
 * FeedMalaya 
 * Share everything, a great combination of Forrst, Tumblr and Google Reader
 *
 * @package    FeedMalaya
 * @version    2.0
 * @author     FeedMalaya Development Team
 * @license    GPLv2 License (or later)
 * @link       http://github.com/mentariworks/feedmalaya
 */
 
namespace Fuel\Migrations;

class Create_users_auths {

	public function up()
	{
		\DBUtil::create_table('users_auths', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
			'user_id' => array('constraint' => 30, 'type' => 'bigint'),
			'password' => array('constraint' => 50, 'type' => 'varchar'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('users_auths');
	}
}