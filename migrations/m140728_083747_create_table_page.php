<?php

use yii\db\Schema;
use yii\db\Migration;

class m140728_083747_create_table_page extends Migration
{
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => Schema::TYPE_PK,
            'title' => 'nvarchar(255) NOT NULL',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'meta_title' => 'nvarchar(255) NULL',
            'meta_description' => 'nvarchar(255) NULL',
            'meta_keywords' => 'nvarchar(255) NULL',
            'content' => 'ntext NOT NULL',
            'is_disabled' => 'bit NOT NULL DEFAULT (0)',
        ]);
        $this->createIndex('UK-page-slug', 'page', 'slug');
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
