<?php

use yii\db\Migration;

/**
 * Handles the creation of table `parent`.
 */
class m170911_072812_create_parent_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="家长表"';
        }

        $this->createTable('{{%parent}}', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(11)->notNull()->comment('用户ID'),
            'student_id'=>$this->integer(11)->notNull()->comment('学生ID'),
            'parent_name'=>$this->string(255)->notNull()->comment('家长姓名'),
            'tel'=>$this->string(11)->comment('联系号码'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170911_072812_create_parent_table cannot be reverted';
        $this->dropTable('{{%parent}}');
        return false;
    }
}
