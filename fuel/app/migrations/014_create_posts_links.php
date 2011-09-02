<?php

namespace Fuel\Migrations;

class Create_posts_links {

	public function up()
	{
		\DBUtil::create_table('posts_links', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
			'post_id' => array('constraint' => 30, 'type' => 'bigint'),
			'title' => array('constraint' => 255, 'type' => 'varchar'),
			'url' => array('constraint' => 255, 'type' => 'varchar'),
			'content' => array('type' => 'text'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('posts_links');
	}
}