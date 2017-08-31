<?php

use yii\db\Migration;

class m170831_071929_alter_student_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%student}}','class_id');
    }

    public function down()
    {
        echo "m170831_071929_alter_student_table cannot be reverted.\n";

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
