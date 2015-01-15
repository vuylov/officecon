<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_091024_add_column_country_manufacturer extends Migration
{
    public function up()
    {
        $this->addColumn('manufacturer', 'country', Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('manufacturer', 'country');
    }
}
