<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_081556_add_keywords_description_in_catalog extends Migration
{
    public function up()
    {
        $this->addColumn('catalog', 'keywords', Schema::TYPE_TEXT.' NOT NULL');
        $this->addColumn('catalog', 'description', Schema::TYPE_TEXT.' NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('catalog', 'keywords');
        $this->dropColumn('catalog', 'description');
    }
}
