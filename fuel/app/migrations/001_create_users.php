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

class Create_users {

	public function up()
	{
		\DBUtil::create_table('users', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
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