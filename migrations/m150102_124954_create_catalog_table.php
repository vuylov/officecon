<?php

use yii\db\Schema;
use yii\db\Migration;

class m150102_124954_create_catalog_table extends Migration
{
    public function up()
    {
        $this->createTable('catalog', [
            'id'        => 'pk',
            'parent_id' => Schema::TYPE_INTEGER.' DEFAULT NULL',
            'name'      => Schema::TYPE_STRING.' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->truncateTable('catalog');
        $this->dropTable('catalog');
    }
}
