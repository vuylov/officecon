<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_114450_create_productItem_table extends Migration
{
    public function up()
    {
        $this->createTable('productItem', [
            'id'            => 'pk',
            'product_id'    => Schema::TYPE_INTEGER.' NOT NULL',
            'article'       => Schema::TYPE_STRING. ' NOT NULL',
            'size'          => Schema::TYPE_STRING,
            'weight'        => Schema::TYPE_FLOAT,
            'volume'        => Schema::TYPE_FLOAT,
            'amount'        => Schema::TYPE_INTEGER,
            'description'   => Schema::TYPE_TEXT
        ]);

        $this->addForeignKey('productItemFK', 'productItem', 'product_id','product', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('productItemFK', 'productItem');
        $this->dropTable('productItem');
    }
}
