<?php

use yii\db\Migration;

class m170831_064928_alter_student_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%student}}','sex','VARCHAR(8) NULL DEFAULT "男" COMMENT "性别"');
    }

    public function down()
    {
        echo "m170831_064928_alter_student_table cannot be reverted.\n";

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
