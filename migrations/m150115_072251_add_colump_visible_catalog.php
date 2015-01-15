<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_072251_add_colump_visible_catalog extends Migration
{
    public function up()
    {
        $this->addColumn('catalog', 'visible', Schema::TYPE_SMALLINT.' DEFAULT 1');
    }

    public function down()
    {
        $this->dropColumn('catalog', 'visible');
    }
}
