<?php

use yii\db\Schema;
use yii\db\Migration;

class m150104_083432_add_fk_catalog_parent extends Migration
{
    public function up()
    {
        $this->addColumn('catalog', 'level', Schema::TYPE_INTEGER.' NOT NULL');
        $this->addForeignKey('parentFk', 'catalog', 'parent_id', 'catalog', 'id');
    }

    public function down()
    {
        $this->dropColumn('catalog', 'level');
        $this->dropForeignKey('parentFK', 'catalog');
    }
}
