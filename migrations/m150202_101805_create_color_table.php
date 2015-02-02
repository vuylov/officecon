<?php

use yii\db\Schema;
use yii\db\Migration;

class m150202_101805_create_color_table extends Migration
{
    public function up()
    {
        $this->createTable('color', [
            'id'    => 'pk',
            'manufacturer_id' => Schema::TYPE_INTEGER.' NOT NULL',
            'name'  => Schema::TYPE_STRING.' NOT NULL'
        ]);
        $this->addForeignKey('FKcolor_manuf', 'color', 'manufacturer_id', 'manufacturer', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('FKcolor_manuf', 'color');
        $this->dropTable('color');
    }
}
