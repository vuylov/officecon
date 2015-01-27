<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_104254_Add_column_manufacturer_in_composition extends Migration
{
    public function up()
    {
        $this->addColumn('composition', 'manufacturer_id', Schema::TYPE_INTEGER.' NOT NULL');
        $this->addForeignKey('FKcompManufact', 'composition', 'manufacturer_id', 'manufacturer', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('FKcompManufact', 'composition');
        $this->dropColumn('composition', 'manufacturer_id');

    }
}
