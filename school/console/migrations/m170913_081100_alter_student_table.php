<?php

use yii\db\Migration;

class m170913_081100_alter_student_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%student}}','course_id');
        $this->dropColumn('{{%student}}','score_id');
        $this->addColumn('{{%student}}','accommodate','SMALLINT(8)  NOT NULL COMMENT "是否住宿"');
    }

    public function down()
    {
        echo "m170913_081100_alter_student_table cannot be reverted.\n";

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
