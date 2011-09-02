<?php

namespace Fuel\Migrations;

class Create_posts_images {

	public function up()
	{
		\DBUtil::create_table('posts_images', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
			'post_id' => array('constraint' => 30, 'type' => 'bigint'),
			'path' => array('constraint' => 255, 'type' => 'varchar'),
			'caption' => array('type' => 'text'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('posts_images');
	}
}