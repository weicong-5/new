<?php

use yii\db\Migration;

class m170911_092537_alter_profile_table extends Migration
{
    public function up()
    {
        $this->addColumn('{{%profile}}','sex','SMALLINT(8) NOT NULL COMMENT "性别"');
        $this->addColumn('{{%profile}}','political_status','VARCHAR(255) NOT NULL COMMENT "政治面貌"');
    }

    public function down()
    {
        echo "m170911_092537_alter_profile_table cannot be reverted.\n";

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
