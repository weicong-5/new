<?php

use yii\db\Migration;

/**
 * Handles the creation of table `student_position`.
 */
class m170915_065427_create_student_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="学生职位表"';
        }

        $this->createTable('{{%student_position}}', [
            'id' => $this->primaryKey(),
            'student_id' => $this->integer(11)->notNull()->comment('学生ID'),
            'position' => $this->string(255)->notNull()->comment('学生职务'),
        ],$tableOptions);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170915_065427_create_student_position_table cannot be reverted';
        $this->dropTable('{{%student_position}}');
        return false;
    }
}
