<?php

class m201207_033520_add_h1_visible_property extends CDbMigration
{
	public function up()
	{
        $this->addColumn('page', 'show_page_title', 'TINYINT(1) DEFAULT 1');
	}

	public function down()
	{
		$this->dropColumn('page', 'show_page_title');
		//return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}