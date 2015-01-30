<?php

use yii\db\Schema;
use yii\db\Migration;

class m150129_120059_add_fk_product_in_composition extends Migration
{
    public function up()
    {
        $this->addColumn('composition', 'product_id', Schema::TYPE_INTEGER. ' NOT NULL AFTER id');
        $this->addForeignKey('FK_comp_prod', 'composition', 'product_id', 'product', 'id', 'cascade', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('FK_comp_prod', 'composition');
        $this->dropColumn('composition', 'product_id');
    }
}
