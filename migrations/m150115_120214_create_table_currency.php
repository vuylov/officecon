<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_120214_create_table_currency extends Migration
{
    public function up()
    {
        $this->createTable('currency', [
            'id'        => 'pk',
            'name'      => Schema::TYPE_STRING.' NOT NULL'
        ]);
    }

    public function down()
    {
        $this->dropTable('currency');
    }
}
