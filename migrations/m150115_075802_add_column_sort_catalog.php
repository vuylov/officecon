<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_075802_add_column_sort_catalog extends Migration
{
    public function up()
    {
        $this->addColumn('catalog', 'sort', Schema::TYPE_INTEGER.' DEFAULT 1000');
    }

    public function down()
    {
        $this->dropColumn('catalog', 'sort');
    }
}
