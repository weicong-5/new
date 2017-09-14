<?php

use yii\db\Migration;

class m170911_074318_alter_parent_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%parent}}','Parents');
    }

    public function down()
    {
        echo "m170911_074318_alter_parent_table cannot be reverted.\n";

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
