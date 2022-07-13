<?php

class m201202_083051_create_article_table extends CDbMigration
{
	public function up()
	{
        if(!$this->getDbConnection()->createCommand("SHOW TABLES LIKE 'articles'")->query()->rowCount) {
            $this->createTable('articles', [
                'id' => 'pk',
                'alias' => 'string',
                'preview_image' => 'string',
                'preview_image_enable' => 'boolean',
                'preview_image_alt' => 'string',
                'title' => 'string',
                'published' => 'boolean',
                'sort' => 'integer',
                'intro' => 'TEXT',
                'text' => 'LONGTEXT',
                'create_time' => 'TIMESTAMP',
                'update_time' => 'TIMESTAMP',
            ]);
        }
	}

	public function down()
	{
		$this->dropTable('articles');
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