<?php

use yii\db\Migration;

class m170829_095656_rename_class_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%class}}','{{%grade}}');
    }

    public function down()
    {
        echo "m170829_095656_rename_class_table cannot be reverted.\n";

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
