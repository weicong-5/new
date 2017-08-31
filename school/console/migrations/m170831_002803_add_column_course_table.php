<?php

use yii\db\Migration;

class m170831_002803_add_column_course_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%course}}','school_name','VARCHAR(255) NOT NULL COMMENT"学校名称" ');
    }

    public function down()
    {
        echo "m170831_002803_add_column_course_table cannot be reverted.\n";

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
