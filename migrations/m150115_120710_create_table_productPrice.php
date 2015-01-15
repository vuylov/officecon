<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_120710_create_table_productPrice extends Migration
{
    public function up()
    {
        $this->createTable('productPrice', [
            'id'            => 'pk',
            'productItem_id'=> Schema::TYPE_INTEGER.' NOT NULL',
            'currency_id'   => Schema::TYPE_INTEGER. ' NOT NULL',
            'value'         => Schema::TYPE_FLOAT,
            'cause'         => Schema::TYPE_TEXT
        ]);

        $this->addForeignKey('pPriceItemFK', 'productPrice', 'productItem_id', 'productItem', 'id', 'restrict', 'cascade');
        $this->addForeignKey('pCurrencyFK', 'productPrice', 'currency_id', 'currency', 'id', 'restrict', 'cascade');

    }

    public function down()
    {
        $this->dropForeignKey('pPriceItemFK', 'productPrice');
        $this->dropForeignKey('pCurrencyFK', 'productPrice');
        $this->dropTable('productPrice');
    }
}
