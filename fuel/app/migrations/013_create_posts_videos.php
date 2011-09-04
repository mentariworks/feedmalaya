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

class Create_posts_videos {

	public function up()
	{
		\DBUtil::create_table('posts_videos', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
			'post_id' => array('constraint' => 30, 'type' => 'bigint'),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'embed' => array('constraint' => 255, 'type' => 'varchar'),
			'content' => array('type' => 'text'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('posts_videos');
	}
}