<?php

use yii\db\Migration;

class m170908_074931_alter_teacher_staff_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%teacher_staff}}','subject','VARCHAR(255) NULL COMMENT "所教科目"');
        $this->addColumn('{{%teacher_staff}}','teach_grade','VARCHAR(6) NULL COMMENT "所教年级"');
        $this->addColumn('{{%teacher_staff}}','teach_class','VARCHAR(255) NULL COMMENT "所教班级"');
    }

    public function down()
    {
        echo "m170908_074931_alter_teacher_staff_table cannot be reverted.\n";

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
