<?php

use yii\db\Schema;
use yii\db\Migration;

class m150130_083955_add_keywords_description_in_product_model extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'keywords', Schema::TYPE_STRING.' NOT NULL AFTER active');
        $this->addColumn('product', 'description_seo', Schema::TYPE_STRING.' NOT NULL AFTER keywords');
    }

    public function down()
    {
        $this->dropColumn('product', 'description_seo');
        $this->dropColumn('product', 'keywords');
    }
}
