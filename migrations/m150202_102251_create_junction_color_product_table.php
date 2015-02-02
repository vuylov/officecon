<?php

use yii\db\Schema;
use yii\db\Migration;

class m150202_102251_create_junction_color_product_table extends Migration
{
    public function up()
    {
        $this->createTable('productColor', [
            'id'            => 'pk',
            'product_id'    => Schema::TYPE_INTEGER.' NOT NULL',
            'color_id'      => Schema::TYPE_INTEGER.' NOT NULL'
        ]);
        $this->addForeignKey('FKcolor_product', 'productColor', 'product_id', 'product', 'id', 'cascade', 'cascade');
        $this->addForeignKey('FKcolor_color', 'productColor', 'color_id', 'color', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('FKcolor_product', 'productColor');
        $this->dropForeignKey('FKcolor_color', 'productColor');
        $this->dropTable('productColor');
    }
}
