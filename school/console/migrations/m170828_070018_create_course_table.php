<?php

use yii\db\Migration;

/**
 * Handles the creation of table `course`.
 */
class m170828_070018_create_course_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB COMMENT="课程表"';
        }

        $this->createTable('course', [
            'id' => $this->primaryKey(),
            'school_id' => $this->integer(11)->notNull()->comment('学校ID'),
            'grade' => $this->string(255)->notNull()->comment('年级'),
            'course' => $this->string(255)->notNull()->comment('课程'),
        ],$tableOptions);

//        $this->addForeignKey('fk_course_school','{{%course}}','school_id','{{%school}}','id','CASCADE','RESTRICT');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        echo 'm170828_070018_create_course_table cannot be reverted';
        $this->dropTable('{{%course}}');
        return false;
    }
}
