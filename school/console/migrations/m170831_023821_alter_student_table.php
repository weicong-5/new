<?php

use yii\db\Migration;

class m170831_023821_alter_student_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%student}}','class_name','VARCHAR(255) NOT NULL COMMENT "班级" ');
        $this->alterColumn('{{%student}}','course_id','INT(11) NULL COMMENT "课程ID"');
    }

    public function down()
    {
        echo "m170831_023821_alter_student_table cannot be reverted.\n";

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
