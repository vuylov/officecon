<?php

use yii\db\Schema;
use yii\db\Migration;

class m150127_064248_add_current_currency__in_table extends Migration
{
    public function up()
    {
        $this->addColumn('currency', 'short', Schema::TYPE_STRING);

       $this->batchInsert('currency', ['name', 'short'],[
           ['Рубли', 'руб.'],
           ['Доллары', '$'],
            ['Евро', 'eur']
       ]);
    }

    public function down()
    {
        $this->truncateTable('currency');
        $this->dropColumn('currency', 'short');
    }
}
