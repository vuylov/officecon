<?php

use yii\db\Schema;
use yii\db\Migration;

class m150102_193515_create_product_table extends Migration
{
    public function up()
    {
        $this->createTable('product', [
            'id'                => 'pk',
            'user_id'           => Schema::TYPE_INTEGER. ' NOT NULL',
            'manufacturer_id'   => Schema::TYPE_INTEGER. ' NOT NULL',
            'name'              => Schema::TYPE_STRING. ' NOT NULL',
            'description'       => Schema::TYPE_TEXT,
            'active'            => Schema::TYPE_SMALLINT. ' NOT NULL DEFAULT 1',
            'create_at'         => Schema::TYPE_DATETIME,
            'deactivate_at'     => Schema::TYPE_DATETIME
        ]);

        $this->addForeignKey('userFK', 'product', 'user_id', 'user', 'id', 'cascade', 'cascade');
        $this->addForeignKey('manufacturerFK', 'product', 'manufacturer_id', 'manufacturer', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('userFK', 'product');
        $this->dropForeignKey('manufacturerFK', 'product');
        $this->dropTable('product');
    }
}
