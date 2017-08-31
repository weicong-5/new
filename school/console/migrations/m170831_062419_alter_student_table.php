<?php

use yii\db\Migration;

class m170831_062419_alter_student_table extends Migration
{
    public function up()
    {
        $this->renameColumn('{{%student}}','school_id','school_name');
        $this->alterColumn('{{%student}}','school_name','VARCHAR(255) NOT NULL COMMENT "学校名称"');
    }

    public function down()
    {
        echo "m170831_062419_alter_student_table cannot be reverted.\n";

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
