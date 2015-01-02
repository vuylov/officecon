<?php

use yii\db\Schema;
use yii\db\Migration;

class m150102_131258_create_user_table extends Migration
{
    public function up()
    {
        $this->createTable('user', [
            'id'            => 'pk',
            'name'          => Schema::TYPE_STRING. ' NOT NULL',
            'role'          => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 10',
            'email'         => Schema::TYPE_STRING. ' NOT NULL',
            'password'      => Schema::TYPE_STRING. ' NOT NULL',
            'active'        => Schema::TYPE_SMALLINT.' NOT NULL DEFAULT 1',
            'create_at'     => Schema::TYPE_DATETIME,
            'deactivate_at' => Schema::TYPE_DATETIME
        ]);

        $this->insert('user', [
            'name'          => 'Вуйлов Дмитрий',
            'role'          => 10,
            'email'         => 'vuylov@gmail.com',
            'password'      => Yii::$app->security->generatePasswordHash('12345'),
            'active'        => 1
        ]);
    }

    public function down()
    {
        $this->truncateTable('user');
        $this->dropTable('user');
    }
}
