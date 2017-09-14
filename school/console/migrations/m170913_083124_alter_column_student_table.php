<?php

use yii\db\Migration;

class m170913_083124_alter_column_student_table extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%student}}','accommodate','SMALLINT(8) NOT NULL DEFAULT 0 COMMENT "是否住宿"');
    }

    public function down()
    {
        echo "m170913_083124_alter_column_student_table cannot be reverted.\n";

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
