<?php

use yii\db\Migration;

class m170901_022356_add_column_school_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%school}}','district','VARCHAR(255) NOT NULL COMMENT "区域"');
    }

    public function down()
    {
        echo "m170901_022356_add_column_school_table cannot be reverted.\n";

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
