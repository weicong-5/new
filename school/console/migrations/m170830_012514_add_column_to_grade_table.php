<?php

use yii\db\Migration;

/**
 * Class m170830_012514_add_column_to_grade_table 增加一列到班级表中
 */
class m170830_012514_add_column_to_grade_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%grade}}','school_name','VARCHAR(255) NOT NULL COMMENT "学校名称"');
    }

    public function down()
    {
        echo "m170830_012514_add_column_to_grade_table cannot be reverted.\n";

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
