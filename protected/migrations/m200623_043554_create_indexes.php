<?php

class m200623_043554_create_indexes extends CDbMigration
{
	public function up()
	{
		$this->createIndex('alias', 'event', 'alias');
		$this->createIndex('alias', 'page', 'alias');
		$this->createIndex('alias', 'sale', 'alias');
		$this->createIndex('alias', 'category', 'alias');

		$this->createIndex('category_id', 'product', 'category_id');
		$this->createIndex('hidden_category_id', 'product', ['hidden', 'category_id']);

		$this->createIndex('accordion_id', 'accordion_items', 'accordion_id');

		$this->createIndex('id_attrs', 'eav_value', 'id_attrs');
		$this->createIndex('id_product', 'eav_value', 'id_product');
		$this->createIndex('id_product_id_attrs', 'eav_value', ['id_product', 'id_attrs']);
		
		$this->createIndex('item_id', 'file', 'item_id');
		$this->createIndex('model_item_id', 'file', ['model', 'item_id']);
	
		$this->createIndex('item_id', 'image', 'item_id');
		$this->createIndex('model_item_id', 'image', ['model', 'item_id']);
		
		$this->createIndex('alias', 'gallery', 'alias');
		$this->createIndex('preview_id', 'gallery', 'preview_id');
		
		$this->createIndex('gallery_id', 'gallery_img', 'gallery_id');
		
		$this->createIndex('owner_name_owner_id', 'metadata', ['owner_name', 'owner_id']);		
	}

	public function down()
	{
		echo "m200623_043554_create_indexes does not support migration down.\n";
		// return false;
	}
}