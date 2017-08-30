<?php

use yii\db\Migration;

class m170830_062247_alter_column_course_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%course}}','course','TEXT COMMENT "课程"');
    }

    public function down()
    {
        echo "m170830_062247_alter_column_course_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
