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

class Create_twitters {

	public function up()
	{
		\DBUtil::create_table('twitters', array(
			'id' => array('constraint' => 30, 'type' => 'bigint'),
			'twitter_name' => array('constraint' => 200, 'type' => 'varchar'),
			'full_name' => array('constraint' => 100, 'type' => 'varchar'),
			'profile_image' => array('constraint' => 255, 'type' => 'varchar'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('twitters');
	}
}