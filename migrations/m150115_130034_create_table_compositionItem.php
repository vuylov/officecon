<?php

use yii\db\Schema;
use yii\db\Migration;

class m150115_130034_create_table_compositionItem extends Migration
{
    public function up()
    {
        $this->createTable('compositionItem',[
            'id'            => 'pk',
            'productItem_id'=> Schema::TYPE_INTEGER.' NOT NULL',
            'composition_id'=> Schema::TYPE_INTEGER. ' NOT NULL',
            'amount'        => Schema::TYPE_SMALLINT
        ]);

        $this->addForeignKey('compProductFK', 'compositionItem', 'productItem_id', 'productItem', 'id', 'restrict', 'cascade');
        $this->addForeignKey('compItemFK', 'compositionItem', 'composition_id', 'composition', 'id', 'restrict', 'cascade');
    }

    public function down()
    {
        $this->dropForeignKey('compProductFK', 'compositionItem');
        $this->dropForeignKey('compItemFK', 'compositionItem');
        $this->dropTable('compositionItem');
    }
}
