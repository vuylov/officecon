<?php

use yii\db\Schema;
use yii\db\Migration;

class m150104_082123_product_to_catalog_table_create extends Migration
{
    public function up()
    {
        $this->createTable('productToCatalog', [
            'id'        => 'pk',
            'product_id'=> Schema::TYPE_INTEGER.' NOT NULL',
            'catalog_id'=> Schema::TYPE_INTEGER.' NOT NULL',
        ]);

        $this->addForeignKey('productFK', 'productToCatalog', 'product_id', 'product', 'id', 'cascade', 'cascade');
        $this->addForeignKey('catalogFK', 'productToCatalog', 'catalog_id', 'catalog', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('productFK', 'productToCatalog');
        $this->dropForeignKey('catalogFK', 'productToCatalog');
        $this->dropTable('productToCatalog');
    }
}
