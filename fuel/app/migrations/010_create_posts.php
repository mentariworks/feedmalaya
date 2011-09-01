<?php

namespace Fuel\Migrations;

class Create_posts {

	public function up()
	{
		\DBUtil::create_table('posts', array(
			'id' => array('constraint' => 30, 'type' => 'bigint', 'auto_increment' => true),
			'user_id' => array('constraint' => 30, 'type' => 'bigint'),
			'short_uri' => array('constraint' => 100, 'type' => 'varchar'),
			'long_uri' => array('constraint' => 100, 'type' => 'varchar'),
			'type' => array('constraint' => "'text','image','imageset','video','code','link','feed'", 'type' => 'enum', 'default' => 'feed'),
			'status' => array('constraint' => "'draft','publish','private','delete'", 'type' => 'enum', 'default' => 'publish'),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('posts');
	}
}