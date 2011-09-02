<?php

namespace Fuel\Migrations;

class Create_options {

	public function up()
	{
		\DBUtil::create_table('options', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'name' => array('constraint' => 255, 'type' => 'varchar'),
			'value' => array('type' => 'text'),
			'active' => array('constraint' => 1, 'type' => 'tinyint', 'default' => 1),
			'created_at' => array('type' => 'datetime'),
			'updated_at' => array('type' => 'datetime'),
		), array('id'), true, 'InnoDB');
	}

	public function down()
	{
		\DBUtil::drop_table('options');
	}
}