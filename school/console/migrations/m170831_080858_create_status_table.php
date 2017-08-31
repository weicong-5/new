<?php

use yii\db\Migration;

/**
 * Handles the creation of table `status`.
 */
class m170831_080858_create_status_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="身份表"';
        }

        $this->createTable('{{%status}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(11)->notNull()->comment('用户ID'),
            'status' => $this->string(255)->notNull()->comment('身份'),
            'name'=> $this->string(255)->notNull()->comment('姓名'),
            'school'=>$this->string(255)->null()->comment('所在学校'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170831_080858_create_status_table cannot be reverted';
        $this->dropTable('{{%status}}');
        return false;
    }
}
