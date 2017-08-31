<?php

use yii\db\Migration;

class m170831_070023_alter_student_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%student}}','school_id','INT(11) NOT NULL COMMENT "学校ID"');
        $this->alterColumn('{{%student}}','class_id','VARCHAR(255) NOT NULL COMMENT "班级"');
    }

    public function down()
    {
        echo "m170831_070023_alter_student_table cannot be reverted.\n";

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
