<?php

use yii\db\Schema;
use yii\db\Migration;

class m140808_133004_create_page_block_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%page_block}}', [
            'page_id' => 'char(13) NOT NULL',
            'site_id' => 'varchar(50) NOT NULL',
            'sort' => Schema::TYPE_INTEGER . ' NULL DEFAULT (1)',
            'params' => Schema::TYPE_TEXT . ' NULL',
            'widget_class' => Schema::TYPE_STRING . ' NULL DEFAULT (1)',
        ]);
        $this->insert('{{%page_block}}', [
            'page_id' => '53db5852b8b04',
            'site_id' => 'krukro',
            'sort' => '1',
            'params' => '{"content":"<h3>Это тестовый <i>текстовый блок</i>!</h3>"}',
            'widget_class' => 'app\widgets\pageblocks\PageBlockTextWidget',
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%page_block}}');
    }
}
