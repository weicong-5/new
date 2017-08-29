<?php

use yii\db\Migration;

/**
 * Handles the creation of table `school`.
 */
class m170828_060733_create_school_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="学校表"';
        }

        $this->createTable('{{%school}}', [
            'id' => $this->primaryKey(),
            'area_id' => $this->integer(11)->notNull()->comment('学校地区ID'),
            'school_name' => $this->string(255)->notNull()->comment('学校名称'),
            'address' => $this->string(255)->notNull()->comment('学校地址'),
        ],$tableOptions);

//        $this->createIndex('school_address','{{%school}}','id,address',true);

//        $this->addForeignKey('fk_school_area','{{%school}}','area_id','{{%area}}','id','CASCADE','RESTRICT');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170828_060733_create_school_table cannot be reverted';
        $this->dropTable('{{%school}}');
        return false;
    }
}
