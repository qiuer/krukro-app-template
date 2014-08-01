<?php

use yii\db\Schema;
use yii\db\Migration;

class m140728_083747_create_table_page extends Migration
{
    public function up()
    {
        $this->createTable('{{%page}}', [
            'id' => 'char(13) NOT NULL',
            'title_ru' => 'nvarchar(255) NOT NULL',
            'title_en' => 'nvarchar(255) NULL',
            'title_ua' => 'nvarchar(255) NULL',
            'slug' => Schema::TYPE_STRING . ' NOT NULL',
            'author_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'site_id' => 'varchar(50) NOT NULL',
            'meta_title_ru' => 'nvarchar(255) NULL',
            'meta_title_en' => 'nvarchar(255) NULL',
            'meta_title_ua' => 'nvarchar(255) NULL',
            'meta_description_ru' => 'nvarchar(255) NULL',
            'meta_description_en' => 'nvarchar(255) NULL',
            'meta_description_ua' => 'nvarchar(255) NULL',
            'meta_keywords_ru' => 'nvarchar(255) NULL',
            'meta_keywords_en' => 'nvarchar(255) NULL',
            'meta_keywords_ua' => 'nvarchar(255) NULL',
            'content_ru' => 'ntext NOT NULL',
            'content_en' => 'ntext NULL',
            'content_ua' => 'ntext NULL',
            'is_disabled' => 'bit NOT NULL DEFAULT (0)',
            'CONSTRAINT PK_page PRIMARY KEY (id)',
        ]);
        $this->createIndex('UK-page-slug', '{{%page}}', ['slug', 'site_id']);
    }

    public function down()
    {
        $this->dropTable('{{%page}}');
    }
}
