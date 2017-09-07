<?php

use yii\db\Migration;

class m170907_020158_alter_score_table extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%score}}','times');
        $this->alterColumn('{{%score}}','score','VARCHAR(4) NOT NULL COMMENT "分数"');
        $this->addColumn('{{%score}}','subject','VARCHAR(20) NOT NULL COMMENT "科目"');
        $this->addColumn('{{%score}}','comment','VARCHAR(255) NOT NULL COMMENT "备注"');
        //加入学校年级班级是为了班级排名和年级排名
        $this->addColumn('{{%score}}','school','VARCHAR(225) NOT NULL COMMENT "学校"');
        $this->addColumn('{{%score}}','grade','VARCHAR(6) NOT NULL COMMENT "年级"');
        $this->addColumn('{{%score}}','class','VARCHAR(4) NOT NULL COMMENT "班级"');
    }

    public function down()
    {
        echo "m170907_020158_alter_score_table cannot be reverted.\n";

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
