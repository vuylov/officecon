<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_125509_create_table_composition extends Migration
{
    public function up()
    {
        $this->createTable('composition', [
            'id'            => 'pk',
            'name'          => Schema::TYPE_STRING.' NOT NULL',
            'description'   => Schema::TYPE_STRING,
            'price'         => Schema::TYPE_FLOAT
]);
}

public function down()
{
    $this->dropTable('composition');
}
}
