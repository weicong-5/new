<?php

use yii\db\Migration;

class m170915_035805_del_column_student_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%student}}','class_position');
    }

    public function down()
    {
        echo "m170915_035805_del_column_student_table cannot be reverted.\n";

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
