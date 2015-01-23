<?php

use yii\db\Schema;
use yii\db\Migration;

class m150123_101748_create_table_file extends Migration
{
    public function up()
    {
        $this->createTable('file', [
            'id'            => 'pk',
            'fid'           => Schema::TYPE_INTEGER.' NOT NULL',
            'type'          => Schema::TYPE_STRING.' NOT NULL',
            'name'          => Schema::TYPE_STRING.' NOT NULL',
            'path'          => Schema::TYPE_STRING.' NOT NULL',
            'thumbnail'     => Schema::TYPE_STRING,
            'extension'     => Schema::TYPE_STRING,
            'create_at'     => Schema::TYPE_DATETIME
        ]);
    }

    public function down()
    {
        $this->dropTable('file');
    }
}
