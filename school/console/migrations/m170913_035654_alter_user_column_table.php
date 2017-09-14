<?php

use yii\db\Migration;

class m170913_035654_alter_user_column_table extends Migration
{
    public function up()
    {
        $this->renameColumn('{{%user}}','status','active');
    }

    public function down()
    {
        echo "m170913_035654_alter_user_column_table cannot be reverted.\n";

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
