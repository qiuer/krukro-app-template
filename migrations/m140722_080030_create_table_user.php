<?php

use yii\db\Schema;
use yii\db\Migration;

class m140722_080030_create_table_user extends Migration
{
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => 'char(13) NOT NULL',
            'username' => Schema::TYPE_STRING . ' NOT NULL',
            'name' => 'nvarchar(255) NOT NULL',
            'email' => 'nvarchar(255) DEFAULT NULL',
            'password_hash' => Schema::TYPE_STRING . ' NOT NULL',
            'auth_key' => 'char(32) NOT NULL',
            'password_reset_token' => Schema::TYPE_STRING . ' NULL',
            'is_disabled' => 'bit NOT NULL DEFAULT (0)',
            'PRIMARY KEY (id)',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
