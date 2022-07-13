<?php

class m201210_051112_update_index_page_h1_visible extends CDbMigration
{
	public function up()
	{
        $this->update('page', ['show_page_title' => 0], 'alias=:alias', [':alias'=>'index'] );
	}

	public function down()
	{
		echo "m201210_051112_update_index_page_h1_visible does not support migration down.\n";
		return false;
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