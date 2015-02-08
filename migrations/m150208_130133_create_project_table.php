<?php

use yii\db\Schema;
use yii\db\Migration;

class m150208_130133_create_project_table extends Migration
{
    public function up()
    {
        $this->createTable('project', [
            'id'            => 'pk',
            'name'          => Schema::TYPE_STRING.' NOT NULL',
            'description'   => Schema::TYPE_TEXT,
            'type'          => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 1'
        ]);
    }

    public function down()
    {
        $this->dropTable('project');
    }
}
