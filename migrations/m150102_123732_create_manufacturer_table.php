<?php

use yii\db\Schema;
use yii\db\Migration;

class m150102_123732_create_manufacturer_table extends Migration
{
    public function up()
    {
        $this->createTable('manufacturer', [
           'id'     => 'pk',
            'name'  => Schema::TYPE_STRING.' NOT NULL',
            'image' => Schema::TYPE_STRING,
            'url'   => Schema::TYPE_STRING
        ]);
    }

    public function down()
    {
        $this->dropTable('manufacturer');
    }
}
