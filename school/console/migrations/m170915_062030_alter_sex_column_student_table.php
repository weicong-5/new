<?php

use yii\db\Migration;

class m170915_062030_alter_sex_column_student_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%student}}','sex','SMALLINT(8) NOT NULL DEFAULT 0 COMMENT"性别"');
    }

    public function down()
    {
        echo "m170915_062030_alter_sex_column_student_table cannot be reverted.\n";

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
