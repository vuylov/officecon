<?php

use yii\db\Schema;
use yii\db\Migration;

class m150109_094252_add_paerent_to_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'parent_id', Schema::TYPE_INTEGER.' DEFAULT NULL AFTER user_id');
        $this->addForeignKey('prodParentFK', 'product', 'parent_id','product', 'id', 'restrict', 'cascade');
    }

    public function down()
    {
        //$this->delete('product', 'id is NULL');
        $this->dropForeignKey('prodParentFK', 'product');
        $this->dropColumn('product', 'parent_id');
    }
}
