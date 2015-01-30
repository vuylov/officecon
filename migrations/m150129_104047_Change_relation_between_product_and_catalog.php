<?php

use yii\db\Schema;
use yii\db\Migration;

class m150129_104047_Change_relation_between_product_and_catalog extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'catalog_id', Schema::TYPE_INTEGER.' NOT NULL AFTER parent_id');
        $this->addForeignKey('FK_catalog_id', 'product', 'catalog_id', 'catalog', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('FK_catalog_id', 'product');
        $this->dropColumn('product', 'catalog_id');
    }
}
