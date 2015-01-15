<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_114042_add_column_producer_in_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'producer', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('product', 'producer');
    }
}
