<?php

use yii\db\Migration;

class m170912_030325_add_column_profile_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}','phone','VARCHAR(11) NOT NULL COMMENT"手机号码"');
    }

    public function down()
    {
        echo "m170912_030325_add_column_profile_table cannot be reverted.\n";
        $this->dropColumn('{{%profile}}','phone');
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
