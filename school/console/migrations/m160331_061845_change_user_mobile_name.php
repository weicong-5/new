<?php
/**
 * @Copyright Copyright (c) 2016 @m160331_061845_change_user_mobile_name.php By Kami
 * @License http://www.yuzhai.tv/
 */

use yii\db\Migration;

class m160331_061845_change_user_mobile_name extends Migration
{
    public function up()
    {
        $this->renameColumn('{{%user}}', 'mobile', 'phone');
    }

    public function down()
    {
        echo "m160331_061845_change_user_mobile_name cannot be reverted.\n";
        $this->renameColumn('{{%user}}', 'phone', 'mobile');
        //return false;
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
